<?php
$this->title = "ระบบประเมินผลงาน(เวอร์ชั่น อ.เทพสถิต)";
$this->params['breadcrumbs'][] = ['url'=>['/tst'],'label'=>'กิจกรรมสาธารณสุข'];
$this->params['breadcrumbs'][] = $searchModel->getGroup();

use kartik\grid\GridView;
use yii\helpers\Html;

$array = $searchModel->getKpi();
$txt ='';
foreach ($array as $value) {
    $txt.= $value['id']."-".$value['item_name']."<br>";
}

echo GridView::widget([
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'panel' => [
        'heading' => $txt,
        'before'=>"<h1>".$searchModel->getGroup()."</h1>"
    ],
]);



