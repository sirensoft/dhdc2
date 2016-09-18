<?php

use yii\helpers\Html;

$this->params['breadcrumbs'][] = 'ระบบข้อมูลแผนที่(GIS)'
?>
<div class="gis-default-index">
    <p>
        <?= Html::a('1) แผนที่แสดงบ้านผู้ป่วยด้วยโรคไข้เลือดออก', ['/gis/default/dhf'],['target'=>'_blank']); ?>
    </p>
    <p>
        <?= Html::a('2) แผนที่แสดงบ้านผู้ป่วยด้วยโรคอุจาระร่วง', ['/gis/default/dhf'],['target'=>'_blank']); ?>
    </p>
    <p>
        <?= Html::a('3) แผนที่แสดงบ้านผู้ป่วยด้วยโรค DM-HT', ['/gis/default/dhf'],['target'=>'_blank']); ?>
    </p>

</div>
<div style="margin-top: 100px" class="alert alert-danger">
    <strong>&copy;</strong> สงวนลิขสิทธิ์ ระบบข้อมูลแผนที่ GIS โดย <a href="https://www.facebook.com/tehnn" target="_blank">UTEHN PHNU</a>
</div>
