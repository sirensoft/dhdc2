<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\ErrPersonTypeareaCup */

$this->title = $model->CID;
$this->params['breadcrumbs'][] = ['label' => 'Err Person Typearea Cups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="err-person-typearea-cup-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->CID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->CID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'CID',
            'NUM_HOSP',
            'HOSPCODE:ntext',
            'PID:ntext',
            'TYPEAREA:ntext',
            'FULLNAME:ntext',
            'D_UPDATE:ntext',
        ],
    ]) ?>

</div>
