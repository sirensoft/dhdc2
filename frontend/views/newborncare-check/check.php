<?php
/* @var $this yii\web\View */
$this->title = 'POSTNATAL-CHECK';
?>
<h4>งานดูแลลูกหลังคลอด (NEWBORNCARE)</h4>

<form method="POST">
    <input type="text" name="cid" id="cid" placeholder="กรอกเลข 13 หลัก" value="<?= isset($_GET['cid']) ? $_GET['cid'] : '' ?>" > 
    <button> ตรวจสอบ </button>
</form>

<?php
//print_r($data)
?>
<hr>
<b style="color: blue">ข้อมูลลูกคลอด (<u>NEWBORN</u>)</b>
<?php
echo \kartik\grid\GridView::widget([
    'dataProvider' => $person,
    'summary' => "",
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
]);
?>
<b style="color: blue">ลูกได้รับบริการดูแลหลังคลอด (<u>NEWBORNCARE</u>)</b>
<?php
echo \kartik\grid\GridView::widget([
    'dataProvider' => $check,
    'summary' => "",
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
    'columns' => [
       
        [
            'attribute' => 'BCARE', 
        ],
        [
            'attribute' => 'DAY_POSTNATAL','label'=>'หลังคลอด(วัน)'
        ],
        [
            'attribute' => 'BCARERESULT',
            'value' => function($data) {
                $msg = '';
                switch ($data['BCARERESULT']) {
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
            'attribute' => 'BCPLACE', 'label' => 'สถานที่'
        ],
        [
            'attribute' => 'HOSPCODE', 'label' => 'ผู้บันทึก'
        ],
        'DUPDATE'
    ]
]);
?>