<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Set Times';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-set-time-index">

   

    <p>
        <?= Html::a('ตั้งเวลาประมวลผล', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'event_time',
            'days',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
