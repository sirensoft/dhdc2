<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ErrPersonTypeareaCup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="err-person-typearea-cup-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NUM_HOSP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HOSPCODE')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'PID')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'TYPEAREA')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'FULLNAME')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'D_UPDATE')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
