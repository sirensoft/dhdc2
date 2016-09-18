<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ErrPersonTypeareaCup */

$this->title = 'Update Err Person Typearea Cup: ' . ' ' . $model->CID;
$this->params['breadcrumbs'][] = ['label' => 'Err Person Typearea Cups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->CID, 'url' => ['view', 'id' => $model->CID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="err-person-typearea-cup-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
