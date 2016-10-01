<?php

//use Yii;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'ชื่อรายงาน';
$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลพื้นฐาน', 'url' => ['myreport/default/index']];
$this->params['breadcrumbs'][] = 'ชื่อรายงาน';
?>


<div class='well'>
    <?php
    ActiveForm::begin([
        'method' => 'get',
        'action' => Url::to(['test/index']),
    ]);
    ?>

    <?php
    $sql = "SELECT DISTINCT t.tb FROM sys_dhdc_count_file t ORDER BY t.tb DESC";
    $rawData = Yii::$app->db->createCommand($sql)->queryAll();
    $items = ArrayHelper::map($rawData, 'tb', 'tb');
    echo Html::dropDownList('tb', '', $items, ['prompt' => '--- แฟ้ม ---']);
    ?>

    <?php
    $sql = "SELECT DISTINCT t.b_year FROM sys_dhdc_count_file t ORDER BY t.b_year DESC";
    $rawData = Yii::$app->db->createCommand($sql)->queryAll();
    $items = ArrayHelper::map($rawData, 'b_year', 'b_year');
    echo Html::dropDownList('b_year', '', $items, ['prompt' => '--- ปีงบประมาณ ---']);
    ?>    

    <?php
    echo Html::submitButton(' ตกลง ', ['class' => 'btn btn-danger']);
    ActiveForm::end();
    ?>
</div>

