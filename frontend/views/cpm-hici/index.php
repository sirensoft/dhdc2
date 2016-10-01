<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CpmHiciSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายงานสำรวจลูกน้ำยุงลาย';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cpm-hici-index">

    <h1>รายงานสำรวจลูกน้ำยุงลาย</h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('เพิ่มข้อมูล', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'hospcode',
            'vid',
            'hid',
            'd_survey',
            'found',
            // 'note1',
            // 'note2',
            // 'note3',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
