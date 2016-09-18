<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'AngularJs';
$this->params['breadcrumbs'][] = 'AngularJs';

$url_js = 'https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js';
$this->registerJsFile($url_js,['position' => $this::POS_HEAD,'async' => false, 'defer' => true]);
?>

<div class="angular-default-index" ng-app="">
      <?php
    ActiveForm::begin([
        'method' => 'get',
        'action' => Url::to(['index']),
    ]);
    ?>
    
    <p>Name : <input type="text" ng-model="name" name="name" ></p>
    <h1>Hello <span ng-bind="name"></span></h1>
    
    <?php
    echo Html::submitButton(' ตกลง ', ['class' => 'btn btn-danger']);
    ActiveForm::end();
    ?>

</div>
