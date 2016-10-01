<?php
use miloschuman\highcharts\Highcharts;
use yii\helpers\ArrayHelper;

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


<div id="chart1"></div>

<?php
$sql = "select hospcode,hospname,total from sys_person_type";
$rawData = Yii::$app->db->createCommand($sql)->queryAll();

$main_data = [];
foreach ($rawData as $data) {
    $main_data[] = [
        'name' => $data['hospname'],
        'y' => $data['total'] * 1,
        'drilldown' => $data['hospcode']
    ];
}
$main = json_encode($main_data);
$sql = " SELECT * FROM sys_person_type ";
$rawData = Yii::$app->db->createCommand($sql)->queryAll();
$sub_data = [];
foreach ($rawData as $data) {
    $sub_data[] = [
        'id' => $data['hospcode'],
        'name' => $data['hospname'],
        'data' => [['type1', intval($data['type1'])], ['type2', $data['type2'] * 1], ['type3', $data['type3'] * 1], ['type4', $data['type4'] * 1]]
    ];
}
$sub = json_encode($sub_data);

$this->registerJs("$(function () {
    $('#chart1').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'แผนภูมิแท่งเปรียบเทียบประชากร'
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: '<b>คน</b>'
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
            name: 'ประชากร',
            colorByPoint: true,
            data:$main
            
        }
        ],
        drilldown: {
            series:$sub
            
        }
    });
});", yii\web\View::POS_END);
?>

