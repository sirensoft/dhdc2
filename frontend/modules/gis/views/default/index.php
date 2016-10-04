<?php

use yii\helpers\Html;

$this->title = "DHDC2:GIS";
$this->params['breadcrumbs'][] = 'ระบบข้อมูลแผนที่(GIS)'
?>
<div class="gis-default-index">
    <p>
        <?= Html::a('1) ที่ตั้งหน่วยบริการ', ['/gis/default/hos'], ['target' => '_blank']); ?>
    </p>
    <p>
        <?= Html::a('2) กลุ่มหลังคาเรือน', ['/gis/default/house'], ['target' => '_blank']); ?>
    </p>
    <p>
        <?= Html::a('3) ค้นหาบ้าน', ['/gis/default/house-find'], ['target' => '_blank']); ?>
    </p>
    <p>
        <?= Html::a('4) อัตราป่วยด้วยโรคติดต่อ', ['/gis/default/disease'], ['target' => '_blank']); ?>
    </p>

    <p>
        <?= Html::a('5) บันทึกพิกัดหลังคาเรือนในเขตรับผิดชอบ', ['/homegis/default/index']); ?>
    </p>


</div>
<div style="margin-top: 100px" class="alert alert-danger">

</div>
