<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = "พบข้อผิดพลาด";
?>
<div class="site-error">

    <h1><?php //echo Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <h4><?= nl2br(Html::encode($message)) ?></h4>
    </div>

   

</div>
