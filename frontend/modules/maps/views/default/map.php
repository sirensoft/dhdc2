<?php

use yii\web\View;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

$this->title = 'DM Indiv';
$this->params['breadcrumbs'][] = 'แผนทีแสดงที่ตั้งผู้ป่วยเบาหวาน';

$this->registerCssFile('https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.css', ['async' => false, 'defer' => true]);
$this->registerCssFile('https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/MarkerCluster.css', ['async' => false, 'defer' => true]);
$this->registerCssFile('https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/MarkerCluster.Default.css', ['async' => false, 'defer' => true]);
$this->registerCssFile('https://api.mapbox.com/mapbox.js/plugins/leaflet-draw/v0.2.3/leaflet.draw.css');
$this->registerCss($this->render('style.css'));

$this->registerJsFile('https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.js', ['position' => $this::POS_BEGIN,]);
$this->registerJsFile('https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/leaflet.markercluster.js', ['position' => $this::POS_BEGIN,]);
$this->registerJsFile('https://api.mapbox.com/mapbox.js/plugins/leaflet-draw/v0.2.3/leaflet.draw.js', ['position' => $this::POS_BEGIN,]);



$js = <<<JS
L.mapbox.accessToken = 'pk.eyJ1IjoidGVobm5uIiwiYSI6ImNpZzF4bHV4NDE0dTZ1M200YWxweHR0ZzcifQ.lpRRelYpT0ucv1NN08KUWQ';

var map = L.mapbox.map('map')
        .setView([38.9, -77], 13)
        .addLayer(L.mapbox.tileLayer('mapbox.streets'));


var overlays = L.layerGroup().addTo(map);
var featureGroup = L.featureGroup().addTo(map);

var layers;

L.mapbox.featureLayer()
        .loadURL('./gis/stations.geojson')
        .on('ready', function (e) {
            layers = e.target;
            
            showStations();
        });

var filters = document.getElementById('colors').filters;

function showStations() {

    var list = [];
    for (var i = 0; i < filters.length; i++) {
        if (filters[i].checked)
            list.push(filters[i].value);
    }

    overlays.clearLayers();

    var clusterGroup = new L.MarkerClusterGroup().addTo(overlays);

    layers.eachLayer(function (layer) {
        if (list.indexOf(layer.feature.properties.line) !== -1) {
            clusterGroup.addLayer(layer);
            layer.bindPopup(layer.feature.properties.name);
        }
    });
}  

// legend
var legend = L.control({position: 'bottomleft'});
legend.onAdd = function (map) {
    var div = L.DomUtil.create('div', 'info legend');
    var labels = ['<b>หัวข้อ</b>'];
    labels.push('<i style="background:green"></i>พื้นที่ผู้ป่วยคุมน้ำตาลได้ร้อยละ 80 ขึ้นไป');
    labels.push('<i style="background:orange"></i>พื้นที่ผู้ป่วยคุมน้ำตาลได้ร้อยละ 60-80');
    labels.push('<i style="background:red"></i>พื้นที่ผู้ป่วยคุมน้ำตาลได้ร้อยละน้อยกว่า 60');
    div.innerHTML = labels.join('<br>');
    return div;
};
legend.addTo(map);
//end legend
        
var drawControl = new L.Control.Draw({
    edit: {
      featureGroup: featureGroup
    }
  }).addTo(map);

JS;

$this->registerJs($js, View::POS_END);
?>
<script>
</script>

<div class="contrainer">

    <div class="alert alert-danger">
         <?php
        echo Html::dropDownList('hospcode', '',['01'=>'เมือง','02'=>'อัมพวา','03'=>'บางคนที'], ['prompt' => '--- อำเภอ ---']);
        ?>
         <?php
        echo Html::dropDownList('hospcode', '',['01'=>'เมือง','02'=>'อัมพวา','03'=>'บางคนที'], ['prompt' => '--- ตำบล ---']);
        ?>
        
         <?php
        echo Html::dropDownList('hospcode', '',['01'=>'เมือง','02'=>'อัมพวา','03'=>'บางคนที'], ['prompt' => '--- หมู่บ้าน ---']);
        ?>
        อายุ
        <input type="text" style="width: 30px">
        ขึ้นไป
        <button class='btn btn-danger'> ตกลง </button>
    </div>
    <div class="panel panel-success">     
        <div class="panel-body">
            <div class="row">
                
            <div id="map" style="height: 460px"class="block1" class="col-md-12" >

                <form id='colors' class="block2" style="z-index: 999">
                    <div><input type='checkbox' name='filters' onclick='showStations();' value='red' checked> กลุ่มผู้ป่วยระดับแดง</div>
                    <div><input type='checkbox' name='filters' onclick='showStations();' value='green' checked> กลุ่มผู้ป่วยระดับเขียว</div>
                    <div><input type='checkbox' name='filters' onclick='showStations();' value='orange' checked> กลุ่มผู้ป่วยระดับส้ม</div>
                    <div><input type='checkbox' name='filters' onclick='showStations();' value='yellow' checked> กลุ่มผู้ป่วยระดับเหลือง</div>
                    <div><input type='checkbox' name='filters' onclick='showStations();' value='blue' checked> กลุ่มผู้ป่วยระดับน้ำเงิน</div>
                </form>
            </div> 
                </div>
        </div>
        <div class="panel-footer" id="info"></div>
    </div>
</div>



