<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\homegis\models\ThomeGis */

$this->title = $model->HOSPCODE."-".$model->HID;
$this->params['breadcrumbs'][] = ['label' => 'หลังคาเรือนในเขตรับผิดชอบ', 'url' => ['/homegis/default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="thome-gis-view">

    

    <p>
        <?= Html::a('Update', ['update', 'HOSPCODE' => $model->HOSPCODE, 'HID' => $model->HID], ['class' => 'btn btn-danger']) ?>
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'HOSPCODE',
            'VCODE',
            'HID',
            'HOUSE',
            'LATITUDE',
            'LONGITUDE',
        ],
    ]) ?>

</div>
