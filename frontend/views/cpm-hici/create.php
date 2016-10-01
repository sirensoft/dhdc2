<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\CpmHici */

$this->title = 'เพิ่มรายงานสำรวจลูกน้ำยุงลาย';
$this->params['breadcrumbs'][] = ['label' => 'รายงานสำรวจลูกน้ำยุงลาย', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cpm-hici-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
