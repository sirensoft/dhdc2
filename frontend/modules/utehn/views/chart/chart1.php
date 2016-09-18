<?php
use miloschuman\highcharts\Highcharts;
use kartik\grid\GridView;


echo GridView::widget([
    'dataProvider'=>$dataProvider
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

<div id="container">   
    <?php
        $data = [];        
        foreach ($raw as $value) {
            $data[] = [
                'name'=>$value['hos'],
                'data'=>[$value['total']*1]
            ];            
        }
        $data = json_encode($data);      
    
    ?>
</div>
<?php
$js  = <<<JS
  $(function () {
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
         series: $data
        ,
        title: {
            text: ''
        },  
         xAxis: {
            categories: ['ปริมาณข้อมูล'],
            title: {
                text: null
            }
        },
        yAxis: {            
            title: {
                text: 'หน่วยนับ',                
            },
            
        },
        tooltip: {
            valueSuffix: ' รายการ'
        },       
        
        credits: {
            enabled: false
        },
       
    });
});
JS;

$this->registerJs($js);

?>

