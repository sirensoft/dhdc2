<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\homegis\models\ThomeGis */

$this->title = $model->HOSPCODE."-".$model->HID;
$this->params['breadcrumbs'][] = ['label' => 'หลังคาเรือนในเขตรับผิดชอบ', 'url' => ['/homegis/default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="thome-gis-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <button class="btn btn-success">แผนที่</button>
</div>
