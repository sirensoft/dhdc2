<?php
/* @var $this yii\web\View */
$this->title = 'NCDSCREEN-CHECK';
?>
<h4>งานคัดกรอง</h4>

<form method="POST">
    <input type="text" name="cid" id="cid" placeholder="กรอกเลข 13 หลัก" value="<?= isset($_GET['cid']) ? $_GET['cid'] : '' ?>" > 
    <button> ตรวจสอบ </button>
</form>

<?php
//print_r($data)
?>
<hr>
<b style="color: blue">ข้อมูลประชากร (<u>PERSON</u>)</b>
<?php
echo \kartik\grid\GridView::widget([
    'dataProvider' => $person,
    'summary' => "",
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
]);
?>
<b style="color: blue">ได้รับบริการคัดกรอง (<u>NCDSCREEN</u>)</b>
<?php
echo \kartik\grid\GridView::widget([
    'dataProvider' => $check,
    'summary' => "",
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
   
  
]);
?>