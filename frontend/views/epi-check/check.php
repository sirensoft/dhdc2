<?php
/* @var $this yii\web\View */
$this->title = 'EPI-CHECK';
?>
<h4>งานสร้างเสริมภูมิคุ้มกันโรค-EPI</h4>

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
<b style="color: blue">ได้รับวัคซีน (<u>EPI</u> + SERVICE + DIAGNOSIS_OPD)</b>
<?php
echo \kartik\grid\GridView::widget([
    'dataProvider' => $check,
    'summary' => "",
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
    'columns' => [
         ['attribute' => 'DATE_SERV', 'header' => 'วันที่ได้รับ'],
        ['attribute' => 'AGEY_DATESERV', 'header' => 'อายุ(ปี)', 'contentOptions' => ['class' => 'text-center']],
        ['attribute' => 'AGEM_DATESERV', 'header' => '(เดือน)', 'contentOptions' => ['class' => 'text-center']],
        ['attribute' => 'VACCINETYPE', 'header' => 'รหัสวัคซีน', 'contentOptions' => ['class' => 'text-center']],
        ['attribute' => 'engvaccine', 'header' => 'ชื่อวัคซีน'],       
        ['attribute' => 'VACCINEPLACE', 'header' => 'ได้รับที่'],
        ['attribute' => 'HOSPCODE', 'header' => 'ผู้บันทึก'],       
        ['attribute' => 'DX', 'header' => 'Dx'],
        'DUPDATE'
    ]

        /* 'panel' => [
          'before' => '',
          //'type' => \kartik\grid\GridView::TYPE_SUCCESS,

          ], */
]);
?>