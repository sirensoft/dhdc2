<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\homegis\models\ThomeGisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$sql = " SELECT t.villagecode moo,c1.tambonname tb,c2.ampurname amp FROM cvillage_amp t
LEFT JOIN ctambon_amp c1 on c1.tamboncodefull = t.tamboncode
LEFT JOIN campur c2 on c2.ampurcodefull = t.ampurcode
WHERE t.villagecodefull = '$vcode' ";

$raw = \Yii::$app->db->createCommand($sql)->queryOne();
$area = "ม.".$raw['moo']." ต.".$raw['tb']." อ.".$raw['amp'];
$this->title = "พื้นที่ $area";

$this->params['breadcrumbs'][] = ['label' => 'หลังคาเรือนในเขตรับผิดชอบ', 'url' => ['/homegis/default/index']];

?>
<div class="thome-gis-index">

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel'=>['before'=>"<h4>พื้นที่ $area</h4>"],
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
