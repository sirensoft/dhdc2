<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\ChospitalAmp;
use yii\helpers\ArrayHelper;
?>
<?php if (\Yii::$app->session->hasFlash('success')): ?>
  <div class="alert alert-info alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  <h4><i class="icon fa fa-check"></i>Success!</h4>
  <?= \Yii::$app->session->getFlash('success') ?>
  </div>
<?php endif; ?>


<label><h3> ล้างแฟ้มข้อมูล </h3></label>
<div class="panel" style="padding: 15px">
    <button onclick="$('#person').toggle();">PERSON</button>
    <button onclick="$('#chronic').toggle();">CHRONIC</button>
    <button onclick="$('#home').toggle();">HOME</button>
    <button onclick="$('#village').toggle();">VILLAGE</button>
</div>

<div class="panel" id="person" style="display: none;padding: 15px">
    เลือกหน่วยบริการที่ต้องการล้าง PERSON<br/>
    <form method="POST">
        <?php
        $items = ArrayHelper::map(ChospitalAmp::find()->all(), 'hoscode', 'hoscode');
        echo Html::checkbox(null, false, [
            'label' => 'เลือกทั้งหมด',
            'class' => 'check-person',
        ]);
        echo Html::checkboxList('person', '', $items, ['separator' => '<br/>']);
        ?>
        <button type="SUBMIT" class="btn btn-lg btn-danger"> ล้างแฟ้ม PERSON</button>
    </form>
</div>

<div class="panel" id="chronic" style="display: none;padding: 15px">
    เลือกหน่วยบริการที่ต้องการล้าง CHRONIC<br>
    <form method="POST">
        <?php
        $items = ArrayHelper::map(ChospitalAmp::find()->all(), 'hoscode', 'hoscode');
        echo Html::checkbox(null, false, [
            'label' => 'เลือกทั้งหมด',
            'class' => 'check-chronic',
        ]);
        echo Html::checkboxList('chronic', '', $items, ['separator' => '<br/>']);
        ?>
        <button type="SUBMIT" class="btn btn-lg btn-danger"> ล้างแฟ้ม CHRONIC</button>
    </form>

</div>

<div class="panel" id="home" style="display: none;padding: 15px">
    เลือกหน่วยบริการที่ต้องการล้าง HOME<br>
    <form method="POST">
        <?php
        $items = ArrayHelper::map(ChospitalAmp::find()->all(), 'hoscode', 'hoscode');
        echo Html::checkbox(null, false, [
            'label' => 'เลือกทั้งหมด',
            'class' => 'check-home',
        ]);
        echo Html::checkboxList('home', '', $items, ['separator' => '<br/>']);
        ?>
        <button type="SUBMIT" class="btn btn-lg btn-danger"> ล้างแฟ้ม HOME</button>
    </form>

</div>

<div class="panel" id="village" style="display: none;padding: 15px">
    เลือกหน่วยบริการที่ต้องการล้าง VILLAGE<br>
    <form method="POST">
        <?php
        $items = ArrayHelper::map(ChospitalAmp::find()->all(), 'hoscode', 'hoscode');
        echo Html::checkbox(null, false, [
            'label' => 'เลือกทั้งหมด',
            'class' => 'check-village',
        ]);
        echo Html::checkboxList('village', '', $items, ['separator' => '<br/>']);
        ?>
        <button type="SUBMIT" class="btn btn-lg btn-danger"> ล้างแฟ้ม VILLAGE</button>
    </form>
    
</div>

<?php
$js = <<<JS
    $('.check-person').click(function() {
    
    var selector = $(this).is(':checked') ? ':not(:checked)' : ':checked';
    $('#person input[type="checkbox"]' + selector).each(function() {
        $(this).trigger('click');
    });
});
JS;
$this->registerJs($js);
?>


