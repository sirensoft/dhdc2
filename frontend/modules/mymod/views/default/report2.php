<?php

use miloschuman\highcharts\HighchartsAsset;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;

HighchartsAsset::register($this)->withScripts([
    //'highstock',
    //'modules/exporting',
    'modules/drilldown',
    'highcharts-more',
        //'themes/grid'
]);
?>

<?php
$this->params['breadcrumbs'][] = ['label' => 'module หนองบุญมาก', 'url' => ['/mymod/default/index']];
$this->params['breadcrumbs'][] = 'รายงาน 2';
?>


<?php
Pjax::begin();
?>

<div class="well">

    <?php
    $orm = ActiveForm::begin([
                'method' => 'get',
                'action' => Url::to(['/mymod/default/report2']),
                'options' => [
                    'data-pjax' => 'true'
                ],
    ]);
    ?>

    <?php
    $list = ['1' => 'A', '2' => 'B'];
    echo yii\helpers\Html::dropDownList('hospcode', '', $list, [
        'prompt' => 'เลือกสถานบริการ',
    ]);
    ?>

    ให้บริการระหว่าง:
    <?php
    echo yii\jui\DatePicker::widget([
        'name' => 'date1',
        'value' => $date1,
        'language' => 'th',
        'dateFormat' => 'yyyy-MM-dd',
        'clientOptions' => [
            'changeMonth' => true,
            'changeYear' => true,
        ]
    ]);
    ?>
    ถึง:
    <?php
    echo yii\jui\DatePicker::widget([
        'name' => 'date2',
        'value' => $date2,
        'language' => 'th',
        'dateFormat' => 'yyyy-MM-dd',
        'clientOptions' => [
            'changeMonth' => true,
            'changeYear' => true,
        ]
    ]);
    ?>
    <?php
    echo Html::submitButton(' ตกลง ', ['class' => 'btn btn-danger']);
    ActiveForm::end();
    ?>

</div>


<div id="chart1">
</div>

<?php

use kartik\grid\GridView;

echo GridView::widget([

    'dataProvider' => $dataProvider,
    'panel' => [
        'before' => 'รายงานของฉัน 2',
        'after'=>$sql,
        'footer'=>"พัฒนาโดย  รพ.หนองบุญมาก"
    ],
    'columns'=>[
        'hoscode:raw:หน่วยงาน',
        'hosname:raw:ชื่อหน่วยงาน',
        'visit:integer:ครั้ง'
    ]
]);
?>


<?php

$data = [];

foreach ($raw as $value) {
    $data[] = ['name' => $value['hosname'], 'y' => $value['visit'] * 1];
}

$data = json_encode($data);


$this->registerJs("$(function () {
    $('#chart1').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'แผนภูมิแท่งแสดงจำนวนมารับบริการ'
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: '<b>ครั้ง</b>'
            },
        },
        legend: {
            enabled: true
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true
                }
            }
        },
        series: [
        {
            name: 'บริการ',
            colorByPoint: true,
            data:$data
            
        }
        ]
    });
});", yii\web\View::POS_END);
?>

<?php
Pjax::end();
?>