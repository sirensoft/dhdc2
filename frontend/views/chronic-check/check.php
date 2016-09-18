<?php
/* @var $this yii\web\View */
$this->title = 'CHRONIC-CHECK';
?>
<h4>งาน CHRONIC</h4>

<form method="POST">
    <input type="text" name="cid" id="cid" placeholder="กรอกเลข 13 หลัก" value="<?= isset($_GET['cid']) ? $_GET['cid'] : '' ?>" > 
    <button> ตรวจสอบ </button>
</form>

<?php
//print_r($data)
?>
<hr>
<b style="color: blue">ข้อมูลผู้ป่วย (<u>CHRONIC</u>)</b>
<?php
echo \kartik\grid\GridView::widget([
    'dataProvider' => $person,
    'summary' => "",
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
]);
?>
<b style="color: blue">ได้รับบริการติดตามดูแล 5 ครั้งหลังสุด(<u>CHRONICFU</u>)</b>
<?php
echo \kartik\grid\GridView::widget([
    'dataProvider' => $check,
    'summary' => "",
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
   
  
]);
?>

<b style="color: blue">ได้รับบริการตรวจทางห้องปฏิบัติการ ย้อนหลัง 2 ปี(<u>LABFU</u>)</b>
<?php
echo \kartik\grid\GridView::widget([
    'dataProvider' => $check_lab,
    'summary' => "",
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
   
  
]);
?>