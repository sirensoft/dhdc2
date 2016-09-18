<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
?>
<h3>แฟ้ม SERVICE</h3>
<div class="alert alert-warning">
    <?php
    $model = frontend\models\SysEventLog::find()->orderBy('id DESC')->one();
    $last_process = '';
    if ($model->end_at != 'wait')
        $last_process = @date_format(date_create($model->end_at), 'Y-m-d H:i:s');
    ?>
    ประมวลผล <?= $last_process ?>
</div>

<p>
    <?php
    echo Html::a('1) ข้อมูลการให้บริการ (แฟ้ม SERVICE)', ['opd/report1']);
    ?>
</p>

<div class="footerrow" style="padding-top: 60px">
    <div class="alert alert-success">
        
    </div>
</div>


