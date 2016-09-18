<?php
/* @var $this yii\web\View */
$this->title = 'NUTRITION-CHECK';
?>
<h4>งานโภชนาการและพัฒนาการเด็ก</h4>

<form method="POST">
    <input type="text" name="cid" id="cid" placeholder="กรอกเลข 13 หลัก" value="<?= isset($_GET['cid']) ? $_GET['cid'] : '' ?>" > 
    <button> ตรวจสอบ </button>
</form>

<?php
//print_r($data)
?>
<hr>
<b style="color: blue">ข้อมูลประชากร (<u>PERSON</u> + HOME)</b>
<?php
echo \kartik\grid\GridView::widget([
    'dataProvider' => $person,
    'summary' => "",
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
]);
?>
<b style="color: blue">ได้การตรวจโภชนาการและพัฒนาการ(<u>NUTRITION</u>)</b>
<?php
echo \kartik\grid\GridView::widget([
    'dataProvider' => $check,
    'summary' => "",
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
    'columns' => [
        
        ['attribute' => 'DATE_SERV', 'header' => 'วันที่รับบริการ'],
        ['attribute' => 'AGEY_DATESERV', 'header' => 'อายุ(ปี)'],
        ['attribute' => 'AGEM_DATESERV', 'header' => '(เดือน)'],
        'WEIGHT','HEIGHT','HEADCIRCUM',
        ['attribute' => 'CHILDDEVELOP', 'header' => 'พัฒนาการ',
            'value' => function($data) {
                $msg = '';
                switch ($data['CHILDDEVELOP']) {
                    case '1' :$msg = '1-ปกติ';
                        break;
                    case '2' :$msg = '2-สงสัยช้ากว่าปกติ';
                        break;
                    case '3' :$msg = '3-ช้ากว่าปกติ';
                        break;
                    default:$msg = '';
                }
                return $msg;
            }
        ],
        ['attribute' => 'FOOD', 'header' => 'อาหาร',
            'value' => function($data) {
                $msg = '';
                switch ($data['FOOD']) {
                    case '0' :$msg = '0-เลิกดื่มนมแล้ว บันทึกเฉพาะเด็กไม่เกิน 3 ขวบ';
                        break;
                    case '1' :$msg = '1 = นมแม่อย่างเดียว';
                        break;
                    case '2' :$msg = '2 = นมแม่และน้ำ';
                        break;
                    case '3' :$msg = '3 - นมแม่และนมผสม';
                        break;
                    case '4' :$msg = '4 - นมผสมอย่างเดียว';
                        break;
                    default:$msg = '';
                }
                return $msg;
            }
        ],
        
        ['attribute' => 'NUTRITIONPLACE', 'header' => 'รับบริการที่'],
        ['attribute' => 'HOSPCODE', 'header' => 'ผู้บันทึก'],
        'DUPDATE'
    ]

        /* 'panel' => [
          'before' => '',
          //'type' => \kartik\grid\GridView::TYPE_SUCCESS,

          ], */
]);
?>