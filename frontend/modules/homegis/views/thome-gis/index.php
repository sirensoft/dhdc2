<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\homegis\models\ThomeGisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Thome Gis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="thome-gis-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel'=>['before'=>''],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'HOSPCODE',
            //'VCODE',
            'HID',
            'HOUSE',
            'LATITUDE',
            'LONGITUDE',
            ['class' => ActionColumn::className(),'template'=>'{view}' ],
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
