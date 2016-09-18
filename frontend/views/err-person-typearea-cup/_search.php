<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ErrPersonTypeareaCupSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="err-person-typearea-cup-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'CID') ?>

    <?= $form->field($model, 'NUM_HOSP') ?>

    <?= $form->field($model, 'HOSPCODE') ?>

    <?= $form->field($model, 'PID') ?>

    <?= $form->field($model, 'TYPEAREA') ?>

    <?php // echo $form->field($model, 'FULLNAME') ?>

    <?php // echo $form->field($model, 'D_UPDATE') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
