<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\CpmHici */

$this->title = 'Update Cpm Hici: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cpm Hicis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cpm-hici-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
