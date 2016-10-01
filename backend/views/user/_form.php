<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\UserRole;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => 255]) ?>


    <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'password_hash')->textInput(['maxlength' => 255]) ?>


    <?=
    $form->field($model, 'role')->dropDownList(
            ArrayHelper::map(UserRole::find()->all(), 'role_id', 'role_desc')
    );
    ?>

<?= $form->field($model, 'status')->textInput() ?>
    
<?php
$sql = "SELECT t.hoscode,concat(t.hoscode,'-',t.hosname) hosname from chospital_amp t";
$raw = \Yii::$app->db->createCommand($sql)->queryAll();
$items = ArrayHelper::map($raw, 'hoscode','hosname');
echo $form->field($model, 'office')->dropDownList($items,['prompt'=>'-- หน่วยงาน --']);

?>



    <div class="form-group">
<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
