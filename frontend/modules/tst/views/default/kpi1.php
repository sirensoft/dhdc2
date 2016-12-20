<?php

use kartik\grid\GridView;

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
        'before'=>$searchModel->getGroup()
    ],
]);



