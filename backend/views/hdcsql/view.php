<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Hdcsql */

$this->title = $model->rpt_id;
$this->params['breadcrumbs'][] = ['label' => 'Hdcsqls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hdcsql-view">



    <p>
        <?= Html::a('Update', ['update', 'id' => $model->rpt_id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Delete', ['delete', 'id' => $model->rpt_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
        <?=
        Html::a('Gen Report Script', ['export', 'id' => $model->rpt_id], [
            'class' => 'btn btn-success',
            //'data'=>['method'=>'post'],
            'target'=>'_blank'
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'rpt_id',
            'rpt_name',
            'sql_sum:ntext',
            'sql_indiv:ntext',
            'sql_check:ntext',
            'tb_source',
            'dupdate',
            'note1',
            'note2',
            'note3',
        ],
    ])
    ?>

</div>
