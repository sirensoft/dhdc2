<?php
/* @var $this yii\web\View */
use yii\helpers\Html;

$this->params['breadcrumbs'][] = 'ข้อมูลพื้นฐาน';
?>

<div class="alert alert-warning">
    <?php
    $model = frontend\models\SysEventLog::find()->orderBy('id DESC')->one();
    $last_process = '';
    if ($model->end_at != 'wait')
    $last_process = date_format(date_create($model->end_at), 'Y-m-d H:i:s');
    ?>
    ประมวลผลล่าสุดเมื่อ <?= $last_process ?>
</div>

<p>
    <?php
    echo \yii\helpers\Html::a('1) ตรวจสอบปริมาณข้อมูลรายแฟ้ม', ['/count-file/index']);    
    ?>
</p>

<p>
    <?php
    echo \yii\helpers\Html::a('2) จำนวนประชากรแยกตามกลุ่มอายุ', ['/base-data/pyramid']);    
    ?>
</p>

<p>
    <?php
    echo \yii\helpers\Html::a('3) จำนวนประชากรแยกตาม TYPEAREA', ['/base-data/checktype']);    
    ?>
</p>


<p>
    <?php
    echo \yii\helpers\Html::a('4) รายการ PERSON ที่มี TYPEAREA 1,3 ซ้ำซ้อน', ['/err-person-typearea-cup/index']);    
    ?>
</p>

<p>
    <?php
    echo Html::a('5) ตรวจสอบผลการบันทึก',['/portal-qc/index']);
    ?>
</p>





<div class="footerrow" style="padding-top: 60px">
    <div class="alert alert-success">
        
    </div>
</div>
