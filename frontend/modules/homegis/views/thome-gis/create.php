<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\homegis\models\ThomeGis */

$this->title = 'Create Thome Gis';
$this->params['breadcrumbs'][] = ['label' => 'Thome Gis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="thome-gis-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
