<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\homegis\models\ThomeGis */

$this->title = $model->HOSPCODE;
$this->params['breadcrumbs'][] = ['label' => 'Thome Gis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="thome-gis-view">

    

    <p>
        <?= Html::a('Update', ['update', 'HOSPCODE' => $model->HOSPCODE, 'HID' => $model->HID], ['class' => 'btn btn-danger']) ?>
        <button class="btn btn-success">แผนที่</button>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'HOSPCODE',
            'VCODE',
            'HID',
            'HOUSE',
            'LATITUDE',
            'LONGITUDE',
        ],
    ]) ?>

</div>
