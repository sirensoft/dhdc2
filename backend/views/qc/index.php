<?php
$this->title = 'ตรวจคุณภาพแฟ้มข้อมูล';

use yii\helpers\Html;
use yii\helpers\Url;

$sql =" select yearprocess from sys_config limit 1";
$res = \Yii::$app->db->createCommand($sql)->queryOne();

?>
<h3>ตรวจคุณภาพแฟ้มข้อมูล ปีงบ<?=$res['yearprocess']*1+543?></h3>
<div id="res" style="display: none" class="alert alert-danger">
    กำลังประมวลผล...
</div>

<a class="btn btn-material-blue-300 btn-lg" onclick="qc_exec()">
    ประมวลผลตรวจคุณภาพ
</a>

<?= Html::a("  ตั้งเวลา  ", ['/syssettime/index'], ['class' => 'btn btn-material-orange-300 btn-lg']) ?>


<?php
$link_qc = Url::to(['qc/exec']);
?>
<?php
$js = <<<JS
    function qc_exec() {  
        $('#res').toggle();
        $.ajax({
            url: "$link_qc",            
            success: function (data) {                
                 $('#res').toggle();    
                 if(data=='running'){
                    alert('ไม่สามารถดำเนินการได้ ระบบกำลังประมวลผล');
                 } 
            }
        });
    }

JS;
$this->registerJs($js, yii\web\View::POS_HEAD);
?>