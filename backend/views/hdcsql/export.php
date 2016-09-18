<div class="well" style="word-break:break-all">
<?php

$con_db = \Yii::$app->db;




$sql = " select * from hdc_rpt_sql where rpt_id ='$id'";

$raw = $con_db->createCommand($sql)->queryAll();
$cols = array_keys($raw[0]);



$insert_val = '';
foreach ($cols as $value) {
    if (empty($raw[0][$value])) {
        $val = 'NULL,';
    } else {
        $val = "'" . mysql_escape_string($raw[0][$value]) . "',";
    }
    $insert_val.=$val;
}

$cols = implode(",", $cols);
$cols = "($cols)";
$insert_val = rtrim($insert_val, ",");
$insert_val = "( $insert_val )";

$full = "SET NAMES 'utf8' COLLATE 'utf8_general_ci';\r\n";
$full.= " REPLACE INTO hdc_rpt_sql $cols VALUES $insert_val;";
echo $full;

//////////////
echo "<br>";
////

$sql = " select * from hdc_sys_report where id ='$id'";

$raw = $con_db->createCommand($sql)->queryAll();
$cols = array_keys($raw[0]);



$insert_val = '';
foreach ($cols as $value) {

    $val = "'" . mysql_escape_string($raw[0][$value]) . "',";

    $insert_val.=$val;
}

$cols = implode(",", $cols);
$cols = "($cols)";
$insert_val = rtrim($insert_val, ",");
$insert_val = "( $insert_val )";

$full = "delete from hdc_sys_report where id = '$id';\r\n";
$full.= " REPLACE INTO hdc_sys_report $cols VALUES $insert_val;";
echo $full;


//////////////////////////////////////////////////////
?>

</div>