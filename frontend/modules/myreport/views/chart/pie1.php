<?php
use miloschuman\highcharts\Highcharts;
?>
<div style="display: none">
    <?php
    echo Highcharts::widget([
        'scripts' => [
            'highcharts-more', // gauge, arearange, columnrange, etc.
            //'modules/exporting', 
            //'themes/grid',       
            //'highcharts-3d',
            'modules/drilldown'
        ]
    ]);
    ?>
</div>

<div id="pie"></div>
<?php
$pie_data = [];
$pie_data[] = [
    'name' => 'UC',
    'y' => 22
];
$pie_data[] = [
    'name' => 'ข้าราชการ',
    'y' => 19,
    'sliced' => true,
    'selected' => true
];
$pie_data[] = [
    'name' => 'ต่างด้าว',
    'y' => 9,
    
   
];

$pie_data = json_encode($pie_data);
$this->registerJs("$(function () {
    $('#pie').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Patient, 2016'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Browser share',
            data: $pie_data
        }]
    });
});
", yii\web\View::POS_END);