<?php
/* @var $this yii\web\View */

use frontend\models\SysFiles;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

$query = SysFiles::find();
$models = $query->all();
?>

<center> 
    <div id="res" style="display: none">
        <img src="images/busy.gif">
    </div>
</center>
<table class="table table-bordered table-striped">
    <thead>
    <th>แฟ้ม</th><th>ครั้งล่าสุด</th><th>คุณภาพ</th><th>#</th>
</thead>
<tbody>
    <?php foreach ($models as $model): ?>
        <tr>
            <td><?= $model->file_name ?></td>
            <td><?= $model->note2 ?></td>
            <td><?= $model->qc ?></td>
            <td><a href="#" class="btn btn-danger" id="<?=$model->file_name?>" onclick="qc('<?=$model->file_name?>')">ตรวจ</a></td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>

<?php


$script1 = <<< JS
                
var qc = function(fname){
    $("+fname+").hide();
    $.ajax({
       url: "index.php?r=qc/"+fname,       
       success: function(data) {                         
           console.log(data+' สำเร็จ'); 
       }
    });
}
        
JS;

$this->registerJs($script1,  yii\web\View::POS_HEAD);
?>
