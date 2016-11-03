<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>


<label><h3> ล้างแฟ้มข้อมูล </h3></label>
<div class="panel" style="padding: 15px">
    <button onclick="$('#person').toggle();">PERSON</button>
    <button onclick="$('#chronic').toggle();">CHRONIC</button>
    <button onclick="$('#home').toggle();">HOME</button>
    <button onclick="$('#village').toggle();">VILLAGE</button>
</div>

<div class="panel" id="person" style="display: none;padding: 15px">
    เลือกหน่วยบริการที่ต้องการล้าง PERSON
    <?php $f = ActiveForm::begin(); ?>
    <?=  Html::submitButton(' ล้าง ')?>
    <?php ActiveForm::end(); ?>
</div>

<div class="alert alert-info" id="chronic" style="display: none;padding: 15px">
    เลือกหน่วยบริการที่ต้องการล้าง CHRONIC
</div>

<div class="alert alert-info" id="home" style="display: none;padding: 15px">
    เลือกหน่วยบริการที่ต้องการล้าง HOME
</div>

<div class="alert alert-info" id="village" style="display: none;padding: 15px">
    เลือกหน่วยบริการที่ต้องการล้าง VILLAGE
</div>


