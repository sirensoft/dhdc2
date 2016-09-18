<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ErrPersonTypeareaCupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'PERSON ซ้ำซ้อน';
$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลพื้นฐาน', 'url' => ['base-data/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="err-person-typearea-cup-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel' => [
            'before' => ' '
        ],
        'export' => [
            'showConfirmAlert' => false,
            'target' => GridView::TARGET_BLANK
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'CID',
            //'NUM_HOSP',
            'HOSPCODE:ntext',
            'PID:ntext',
            'TYPEAREA:ntext',
            'FULLNAME:ntext',
            'D_UPDATE:ntext',
        //['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
