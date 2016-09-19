<?php

use yii\helpers\Html;
use frontend\assets\CustomAsset;

/* @var $this \yii\web\View */
/* @var $content string */

CustomAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">

        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <div style="margin: 5px">
            <?= $content ?>
        </div>    
         
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
