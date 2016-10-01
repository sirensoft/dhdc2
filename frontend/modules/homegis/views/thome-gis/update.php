<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\homegis\models\ThomeGis */

$this->title = 'Update Thome Gis: ' . ' ' . $model->HOSPCODE;
$this->params['breadcrumbs'][] = ['label' => 'Thome Gis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->HOSPCODE, 'url' => ['view', 'HOSPCODE' => $model->HOSPCODE, 'HID' => $model->HID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="thome-gis-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
