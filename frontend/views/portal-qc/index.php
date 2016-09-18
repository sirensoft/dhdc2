<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลพื้นฐาน', 'url' => ['base-data/index']];
$this->params['breadcrumbs'][] = 'ตรวจสอบการบันทึก';
?>
<div class="alert alert-success"><p></p></div>
<p>1) <?=Html::a('ตรวจสอบการบันทึกงานสร้างเสริมภูมิคุ้มกันโรค-EPI ', ['epi-check/index']);?></p>
<p>2) <?=Html::a('ตรวจสอบการบันทึกงานวางแผนครอบครัว-FP  ', ['fp-check/index']);?></p>
<p>3) <?=Html::a('ตรวจสอบการบันทึกงานฝากครรภ์-ANC  ', ['anc-check/index']);?></p>
<p>4) <?=Html::a('ตรวจสอบการบันทึกงานโภชนาการและพัฒนาการเด็ก-NUTRITION  ', ['nutri-check/index']);?></p>
<p>5) <?=Html::a('ตรวจสอบการบันทึกงานคัดกรอง-NCDSCREEN  ', ['ncdscreen-check/index']);?></p>
<p>6) <?=Html::a('ตรวจสอบการบันทึกงานดูแลแม่หลังคลอด-POSTNATAL  ', ['postnatal-check/index']);?></p>
<p>7) <?=Html::a('ตรวจสอบการบันทึกงานดูแลเด็กหลังคลอด-NEWBORNCARE  ', ['newborncare-check/index']);?></p>
<p>8) <?=Html::a('ตรวจสอบการบันทึกงานติดตามดูแลผู้ป่วยโรคเรื้อรัง CHRONIC', ['chronic-check/index']);?></p>

