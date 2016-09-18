<?php
/* @var $this yii\web\View */
$this->title ='ANC-CHECK';
?>
<h4>งาน ANC</h4>

<form method="POST">
    <input type="text" name="cid" id="cid" placeholder="กรอกเลข 13 หลัก" value="<?= isset($_GET['cid']) ? $_GET['cid'] : '' ?>" > 
    <button> ตรวจสอบ </button>
</form>

<?php
//print_r($data)
?>
<hr>
<b style="color: blue">ข้อมูลประชากร (<u>PERSON+LABOR</u> + HOME)</b>
<?php
echo \kartik\grid\GridView::widget([
    'dataProvider' => $person,
    'summary' => "",
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
]);
?>


<b style="color: blue">ได้รับบริการฝากครรภ์ (<u>ANC</u> + SERVICE)</b>
<?php
echo \kartik\grid\GridView::widget([
    'dataProvider' => $check,
    'summary' => "",
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
    'columns' => [
        ['attribute' => 'GRAVIDA', 'header' => 'ครรภ์ที่'],
        ['attribute' => 'DATE_SERV', 'header' => 'วันที่'],
        ['attribute' => 'GA', 'header' => 'อายุครรภ์(สัปดาห์)'],
        ['attribute' => 'ANCNO', 'header' => 'ANC ช่วงที่'],
        ['attribute' => 'ANCRESULT', 'header' => 'ผลตรวจ',
            'value' => function($data) {
                $msg = '';
                switch ($data['ANCRESULT']) {
                    case '1' :$msg = '1-ปกติ';
                        break;
                    case '2' :$msg = '2-ผิดปกติ';
                        break;
                    case '9' :$msg = '9-ไม่ทราบ';
                        break;
                    default:$msg = '';
                }
                return $msg;
            }
        ],
        ['attribute' => 'ANCPLACE', 'header' => 'รับบริการที่'],
        ['attribute' => 'HOSPCODE', 'header' => 'ผู้บันทึก'],
        ['attribute' => 'D_UPDATE',
            'value' => function($data) {
                return date('Y-m-d', strtotime($data['D_UPDATE']));
            }
        ]
    ]

        /* 'panel' => [
          'before' => '',
          //'type' => \kartik\grid\GridView::TYPE_SUCCESS,

          ], */
]);
?>