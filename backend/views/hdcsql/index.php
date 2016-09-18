<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\HdcsqlSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'จัดการรายงาน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hdcsql-index">
    
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <p>
        <?= Html::a('<i class="glyphicon glyphicon-plus-sign"></i> สร้างรายงาน', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'id' => 'my-grid',
        'panel'=>['before'=>''],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //['class'=>'\yii\grid\CheckboxColumn'],

            [
                'attribute'=>'rpt_id',
                'contentOptions'=>['style'=>'max-width: 120px;']
            ],
            [
                'attribute'=>'rpt_name',
                'contentOptions'=>['style'=>'max-width: 500px;']
            ],
            //'sql_indiv:ntext',
            //'sql_sum:ntext',
            //'sql_check:ntext',
            // 'tb_source',
            // 'dupdate',
            // 'note1',
            // 'note2',
            // 'note3',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>


   


