<?php

use miloschuman\highcharts\Highcharts;
use yii\data\Pagination;
use yii\helpers\Html;

$this->title = "District Health Data Checker";

$this->params['breadcrumbs'][] = ['label' => 'รายหน่วยบริการ' , 'url' => ['site/hos-index']];
$this->params['breadcrumbs'][] = 'คุณภาพข้อมูลของหน่วยบริการ '.$hospcode;
?>
<h4><?=$byear?></h4>
<div>
    <?php
    echo \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
        'hover' => true,
        //'pjax' => true,
        'containerOptions' => ['style' => 'overflow: auto'],
        'responsive' => FALSE,
        //'floatHeader' => true,
        'panel' => [
            'before' => '',
            'type' => \kartik\grid\GridView::TYPE_DANGER,
        ],
        'columns' => [

            ['attribute' => 'FILE'],
            ['attribute' => 'TOTAL'],
            [
                'attribute' => 'ERR',
                'format' => 'raw',
                'label' => 'ERR',
                'value' => function($data) {
                    return Html::a($data['ERR'], [
                                'err-qc/index',
                                'hospcode' => $data['HOSPCODE'],
                                'filename' => $data['FILE'],
                                'from' => 'hos-file'
                    ]);
                }
                    ],
                    ['attribute' => 'QC', 'label' => 'คุณภาพ'],
                ]
            ]);
            ?>
</div>