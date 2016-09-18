<?php
/* @var $this yii\web\View */
$this->title = 'POSTNATAL-CHECK';
?>
<h4>งานดูแลแม่หลังคลอด (POSTNATAL)</h4>

<form method="POST">
    <input type="text" name="cid" id="cid" placeholder="กรอกเลข 13 หลัก" value="<?= isset($_GET['cid']) ? $_GET['cid'] : '' ?>" > 
    <button> ตรวจสอบ </button>
</form>

<?php
//print_r($data)
?>
<hr>
<b style="color: blue">ข้อมูลหญิงคลอด (<u>LABOR</u>)</b>
<?php
echo \kartik\grid\GridView::widget([
    'dataProvider' => $person,
    'summary' => "",
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
]);
?>
<b style="color: blue">แม่ได้รับบริการดูแลหลังคลอด (<u>POSTNATAL</u>)</b>
<?php
echo \kartik\grid\GridView::widget([
    'dataProvider' => $check,
    'summary' => "",
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
    'columns' => [
        'GRAVIDA',
        [
            'attribute' => 'PPCARE', 
        ],
        [
            'attribute' => 'DAY_POSTNATAL','label'=>'หลังคลอด(วัน)'
        ],
        [
            'attribute' => 'PPRESULT',
            'value' => function($data) {
                $msg = '';
                switch ($data['PPRESULT']) {
                    case '1':$msg = '1-ปกติ';
                        break;
                    case '2':$msg = '2-ผิดปกติ';
                        break;
                    case '9':$msg = '9-ไม่ทราบ';
                        break;
                    default :$msg = '';
                }
                return $msg;
            }
        ],
        [
            'attribute' => 'PPPLACE', 'label' => 'สถานที่'
        ],
        [
            'attribute' => 'HOSPCODE', 'label' => 'ผู้บันทึก'
        ],
        'DUPDATE'
    ]
]);
?>