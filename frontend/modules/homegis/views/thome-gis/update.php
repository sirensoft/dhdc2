<?php

use yii\helpers\Html;

// gis
$this->registerCssFile('https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.css', ['async' => false, 'defer' => true]);
$this->registerCssFile('./lib-gis/leaflet-search.min.css', ['async' => false, 'defer' => true]);
$this->registerCssFile('./lib-gis/leaflet.label.css', ['async' => false, 'defer' => true]);

$this->registerJsFile('https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.js', ['position' => $this::POS_HEAD]);
$this->registerJsFile('./lib-gis/leaflet-search.min.js', ['position' => $this::POS_HEAD]);
$this->registerJsFile('./lib-gis/leaflet.label.js', ['position' => $this::POS_HEAD]);



//gis

$this->title = $model->HOSPCODE . "-" . $model->HID;
$this->params['breadcrumbs'][] = ['label' => 'หลังคาเรือนในเขตรับผิดชอบ', 'url' => ['/homegis/default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/L.Control.Locate.min.js'></script>
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/L.Control.Locate.mapbox.css' rel='stylesheet' />

<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/css/font-awesome.min.css' rel='stylesheet' />




<div class="thome-gis-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
<div id="map" class="well" style="height: 400px"></div>

<?php
$js = <<<JS
             
    L.mapbox.accessToken = 'pk.eyJ1IjoidGVobm5uIiwiYSI6ImNpZzF4bHV4NDE0dTZ1M200YWxweHR0ZzcifQ.lpRRelYpT0ucv1NN08KUWQ';
    var map = L.mapbox.map('map', 'mapbox.streets').setView([16, 100], 6);
    L.control.locate().addTo(map);
    //var map = L.mapbox.map('map');
        
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }
    function showPosition(position) {
        var lat = position.coords.latitude; 
        var lon = position.coords.longitude; 
        map.setView([lat, lon], 12);
    }
    $('#btnLocate').on('click',function(){
        getLocation();
    });
JS;
$this->registerJs($js);
?>  

