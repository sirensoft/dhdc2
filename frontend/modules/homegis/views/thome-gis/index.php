<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\homegis\models\ThomeGisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "หลังคาเรือนในพื้นที่ $vcode";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="thome-gis-index">

    
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
            ['class' => ActionColumn::className(),'template'=>'{update}' ],
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
