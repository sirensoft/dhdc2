<?php

use yii\helpers\Html;
?>
<?php
$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลพื้นฐาน', 'url' => ['base-data/index']];
$this->params['breadcrumbs'][] = 'จำนวนครั้งให้บริการ (SERVICE)';
?>

<div class='well'>
    <form method="POST">
        ปีงบประมาณ:
        <div class='row'>

            <div class='col-sm-3'>

                <?php
                $list_year = [
                    '2014' => '2557',
                    '2015' => '2558',
                    '2016' => '2559',
                    '2017' => '2560'];
                echo Html::dropDownList('selyear', $selyear, $list_year, [
                    'class' => 'form-control'
                ]);
                ?>
            </div>
            <div class='col-sm-3'>

                <button class='btn btn-danger'>ประมวลผล</button>
            </div>
        </div>
    </form>
</div>
<a href="#" id="btn_sql">ชุดคำสั่ง</a>
<div id="sql" style="display: none"><?= 'store_procedure' ?></div>

<?php
if (isset($dataProvider)) {
    $dev = Html::a('คุณอุเทน จาดยางโทน', 'https://fb.com/tehnn', ['target' => '_blank']);


    $y = $selyear + 543;
    $y = substr($y, 2, 2);
    $py = $y - 1;

    //echo yii\grid\GridView::widget([
    echo \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => "จำนวนครั้งให้บริการ",
        //'responsive' => TRUE,
        //'hover' => true,
        //'floatHeader' => true,
        'panel' => [
            'before' => '',
            'type' => \kartik\grid\GridView::TYPE_SUCCESS,
        ],
        'columns' => [
            [
                'attribute' => 'hoscode',
                'label' => ''
            ],
            [
                'attribute' => 'hosname',
                'label' => 'สถานบริการ'
            ],
            [
                'attribute' => 'oct1',
                'label' => "ตค" . $py
            ],
            [
                'attribute' => 'nov1',
                'label' => "พย" . $py
            ],
            [
                'attribute' => 'dec1',
                'label' => "ธค" . $py
            ],
            [
                'attribute' => 'jan1',
                'label' => "มค" . $y
            ],
            [
                'attribute' => 'feb1',
                'label' => "กพ" . $y
            ],
            [
                'attribute' => 'mar1',
                'label' => "มีค" . $y
            ],
            [
                'attribute' => 'apr1',
                'label' => "เมย" . $y
            ],
            [
                'attribute' => 'may1',
                'label' => "พค" . $y
            ],
            [
                'attribute' => 'jun1',
                'label' => "มิย" . $y
            ],
            [
                'attribute' => 'jul1',
                'label' => "กค" . $y
            ],
            [
                'attribute' => 'aug1',
                'label' => "สค" . $y
            ],
            [
                'attribute' => 'sep1',
                'label' => "กย" . $y
            ],
        ]
    ]);
}
?>

<?php
$script = <<< JS
$('#btn_sql').on('click', function(e) {
    
   $('#sql').toggle();
});
JS;
$this->registerJs($script);
?>



