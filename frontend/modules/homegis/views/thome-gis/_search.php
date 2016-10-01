<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\homegis\models\ThomeGisSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="thome-gis-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'HOSPCODE') ?>
       <?= $form->field($model, 'VCODE') ?>

    <?= $form->field($model, 'HID') ?>

    <?= $form->field($model, 'HOUSE') ?>

    <?= $form->field($model, 'LATITUDE') ?>

    <?= $form->field($model, 'LONGITUDE') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
