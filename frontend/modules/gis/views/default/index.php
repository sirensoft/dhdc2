<?php

use yii\helpers\Html;

$this->params['breadcrumbs'][] = 'ระบบข้อมูลแผนที่(GIS)'
?>
<div class="gis-default-index">
    <p>
        <?= Html::a('1) แผนที่แสดงที่ตั้งหน่วยบริการ', ['/gis/default/hos'],['target'=>'_blank']); ?>
    </p>
    <p>
        <?= Html::a('2) แผนที่แสดงหลังคาเรือนในเขตรับผิดชอบ', ['/gis/default/house'],['target'=>'_blank']); ?>
    </p>
    <p>
        <?= Html::a('3) แผนที่แสดงผู้ป่วยด้วยโรคติดต่อ', ['/gis/default/cd'],['target'=>'_blank']); ?>
    </p>
    <p>
        <?= Html::a('4) แผนที่แสดงผู้ป่วยด้วยโรคไม่ติดต่อ', ['/gis/default/ncd'],['target'=>'_blank']); ?>
    </p>

</div>
<div style="margin-top: 100px" class="alert alert-danger">
    
</div>
