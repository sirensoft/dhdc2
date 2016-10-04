<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\homegis\models\ThomeGis */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="thome-gis-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //echo $form->field($model, 'HOSPCODE')->textInput(['maxlength' => true]) ?>
    <?php //echo $form->field($model, 'VCODE')->textInput(['maxlength' => true,'readonly'=>true]) ?>
    <div class="row">
        <div class="col-md-6"><?= $form->field($model, 'HID')->textInput(['maxlength' => true,'readonly'=>TRUE]) ?></div>
        <div class="col-md-6"><?= $form->field($model, 'HOUSE')->textInput(['maxlength' => true,'readonly'=>TRUE]) ?></div>
    </div>
    <div class="row">
        <div class="col-md-6"><?= $form->field($model, 'LATITUDE')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-6"> <?= $form->field($model, 'LONGITUDE')->textInput(['maxlength' => true]) ?></div>
    </div>
    

    

    

   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'บันทึก', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
        <?=  Html::a('ยกเลิก', ['/homegis/default/index'],['class'=>'btn btn-info'])?>
        <a href="#" class="btn btn-warning" id="btnLocate">พิกัดอัตโนมัติ</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
