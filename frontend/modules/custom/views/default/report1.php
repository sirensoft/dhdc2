
<?php

use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;

$this->params['breadcrumbs'][] = ['label' => 'ระบบรายงาน', 'url' => ['/myreport/']];
$this->params['breadcrumbs'][] = 'ผลงานคัดกรองรายหน่วยบริการ';

echo \kartik\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'formatter' => [
        'class' => 'yii\i18n\Formatter',
        'nullDisplay' => '-',
    ],
    'showPageSummary' => true,
    'columns' => [
        [
            'attribute' => 'hoscode'
        ],
        [
            'attribute' => 'hosname',
            'format' => 'raw',
            'value' => function ($data) {
                return Html::a($data['hosname'], ['indiv-report1', 'hoscode' => $data['hoscode']]);
            }
                ],
                [
                    'attribute' => 'target',
                    'pageSummary' => TRUE,
                    'contentOptions' => ['style' => 'text-align:right;']
                ],
                [
                    'attribute' => 'result'
                ],
                [
                    'attribute' => 'percent',
                    'contentOptions' => function ($data) {
                        if ($data['percent'] < 60) {
                            return ['style' => 'background-color:#FF0000;color:white'];
                        }
                         if ($data['percent'] >= 60) {
                            return ['style' => 'background-color:green;color:white'];
                        }
                    }
                        ]
                    ]
                ]);
                ?>

                <div style="display: none">
                    <?php
                    echo Highcharts::widget([
                        'scripts' => [
                            'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
                            //'modules/exporting', // adds Exporting button/menu to chart
                            //'themes/grid',       // applies global 'grid' theme to all charts
                            //'highcharts-3d',
                            'modules/drilldown'
                        ]
                    ]);
                    ?>
                </div>

                <h3>กราฟ</h3>
                <div id="container">

                </div>
                <?php
                // จัดเตรียมข้อมูลกราฟ
                $series = [];
                $hosname =[];
                foreach ($raw as $d) {
                    $hosname[] = $d['hosname'];
                    $series[] = $d['percent']*1;
                   
                }
                $series = json_encode($series);
                $hosname = json_encode($hosname);


$js = <<<JS

$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'ร้อยผลงานการคัดกรอง'
        },
       
        xAxis: {
            categories: $hosname
        },
        yAxis: {
            title: {
                text: 'Temperature (°C)'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [{
            name: 'ร้อยละ',
            data: $series
        }]
    });
});  

        
JS;
                $this->registerJs($js, yii\web\View::POS_END);
                ?>

