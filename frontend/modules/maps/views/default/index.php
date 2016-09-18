<?php

use yii\web\View;
use yii\helpers\Url;

$this->title = 'MAP';
$this->params['breadcrumbs'][] = 'แผนทีแสดงผู้ป่วยเบาหวาน';


$url_css = 'http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css';
$this->registerCssFile($url_css, ['async' => false, 'defer' => true]);
$this->registerCss($this->render('style.css'));


$url_js = 'http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js';
$this->registerJsFile($url_js, ['async' => false, 'defer' => true]);


$this->registerJs($this->render('script.js'));
?>

<div class="maps-default-index">
    <div class="panel panel-success">       
        <div class="panel-body">
            <div id="map" style="width: 100%;height: 460px"></div>   
        </div>
        <div class="panel-footer" id="info"></div>
    </div>
</div>
