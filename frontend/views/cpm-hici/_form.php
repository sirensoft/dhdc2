<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\CpmHici */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cpm-hici-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
        $sql = " SELECT t.hoscode,CONCAT(t.hoscode,'-',t.hosname) hosname FROM chospital_amp t ";
        $raw = \Yii::$app->db->createCommand($sql)->queryAll();
        $items = yii\helpers\ArrayHelper::map($raw,'hoscode','hosname');
        
       echo $form->field($model, 'hospcode')->dropDownList($items,['prompt'=>'-- หน่วยงาน --']); 
    ?>

    <?php 
    $sql = " SELECT t.VID
,if(c.villagecode is NOT NULL,concat(c.villagecode,'-',c.villagename),RIGHT(t.VID,2)) VNAME 
FROM village t LEFT JOIN cvillage_amp c ON c.villagecodefull = t.VID ";
        $raw = \Yii::$app->db->createCommand($sql)->queryAll();
        $items = yii\helpers\ArrayHelper::map($raw,'VID','VNAME');
        
       echo $form->field($model, 'vid')->dropDownList($items,['prompt'=>'-- หมู่บ้าน --']); 
    
    //echo $form->field($model, 'vid')->textInput(['maxlength' => true]) 
    ?>

    <?= $form->field($model, 'hid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'd_survey')->textInput(['value'=>date('Y-m-d H:i:s')]) ?>

    <?php
        $items=['y'=>'พบ','n'=>'ไม่พบ'];
        echo $form->field($model, 'found')->dropDownList($items,['prompt'=>'-- ผลการสำรวจ --']); 
    ?>

    <?= $form->field($model, 'note1')->textarea() ?>

   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
