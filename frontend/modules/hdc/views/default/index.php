<?php

use yii\helpers\Html;

$this->params['breadcrumbs'][] = 'ระบบรายงาน HDC'
?>
<div class="alert alert-danger">
    <h4>ท่านกำลังดูข้อมูลของปีงบประมาณ 
        <?php
        $sql = "SELECT t.yearprocess+543 'byear' FROM sys_config t limit 1";
        $raw=\Yii::$app->db->createCommand($sql)->queryOne();
        echo $raw['byear'];
        ?>
    </h4>
    <p>
        <?php
        $sql = "SELECT t.p_date,t.p_name  FROM hdc_log t ORDER BY id DESC LIMIT 1";
        $raw=\Yii::$app->db->createCommand($sql)->queryOne();
        echo "ประมวลผลล่าสุด ".$raw['p_date']." สถานะ ".$raw['p_name'];
        ?>
        
    </p>
</div>

<h4>กลุ่มรายงาน</h4>


<?php
$sql = " SELECT t.* from hdc_sys_reportcategory t ";

$raw = \Yii::$app->db->createCommand($sql)->queryAll();
?>
<?php
foreach ($raw as $itm):
    $link_lb = $itm['cat_name'];
    $cat_id = $itm['cat_id'];
    ?>
    <p>
        <i class="glyphicon glyphicon-edit"></i> 
    <?= Html::a($link_lb, ['/hdc/default/report-group', 'cat_id' => $cat_id, 'cat_name' => $link_lb]) ?>
    </p>
    <?php
endforeach;

?>

 

