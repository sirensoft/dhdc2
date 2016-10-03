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

    <?= $form->field($model, 'HID')->textInput(['maxlength' => true,'readonly'=>TRUE]) ?>

    <?= $form->field($model, 'HOUSE')->textInput(['maxlength' => true,'readonly'=>TRUE]) ?>

    <?= $form->field($model, 'LATITUDE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LONGITUDE')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-danger']) ?>
        
    </div>

    <?php ActiveForm::end(); ?>

</div>
