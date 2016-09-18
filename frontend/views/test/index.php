<?php
/* @var $this yii\web\View */
?>


<?php
//echo $cid;
?>

<form method="POST">
    <input type="text" name="cid" id="cid" placeholder="กรอกเลข 13 หลัก">

    <input type="submit" value=" ตกลง ">
</form>
<hr>
เลข 13 หลัก <b style="color: white;background-color: red"><?=$cid?></b> <br>

<b style="color: #0000cc">Person</b>
<?php
echo \kartik\grid\GridView::widget([
    'dataProvider' => $person,
    'summary'=>"",
]);
?>

<b style="color: #0000cc">Service</b>
<?php
echo \kartik\grid\GridView::widget([
    'dataProvider' => $service,
    'summary'=>"",
]);
?>

<b style="color: #0000cc">Diag</b>
<?php
echo \kartik\grid\GridView::widget([
    'dataProvider' => $diag,
    'summary'=>"",
]);
?>

<b style="color: #0000cc">Procedure</b>
<?php
echo \kartik\grid\GridView::widget([
    'dataProvider' => $procedure,
    'summary'=>"",
]);
?>

<b style="color: #0000cc">Drug</b>
<?php
echo \kartik\grid\GridView::widget([
    'dataProvider' => $drug,
    'summary'=>"",
]);
?>

<b style="color: #0000cc">Dental</b>
<?php
echo \kartik\grid\GridView::widget([
    'dataProvider' => $dental,
    'summary'=>"",
]);
?>

<b style="color: #0000cc">Charge</b>
<?php
echo \kartik\grid\GridView::widget([
    'dataProvider' => $charge,
    'summary'=>"",
]);
?>