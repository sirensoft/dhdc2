<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\ErrPersonTypeareaCup */

$this->title = 'Create Err Person Typearea Cup';
$this->params['breadcrumbs'][] = ['label' => 'Err Person Typearea Cups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="err-person-typearea-cup-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
