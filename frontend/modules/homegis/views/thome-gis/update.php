<?php

use yii\helpers\Html;

// gis
$this->registerCssFile('//api.mapbox.com/mapbox.js/v3.0.1/mapbox.css', ['async' => false, 'defer' => true]);
$this->registerCssFile('//domoritz.github.io/leaflet-locatecontrol/dist/L.Control.Locate.min.css', ['async' => false, 'defer' => true]);
$this->registerCssFile('//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css', ['async' => false, 'defer' => true]);

$this->registerJsFile('//api.mapbox.com/mapbox.js/v3.0.1/mapbox.js', ['position' => $this::POS_HEAD]);
$this->registerJsFile('//domoritz.github.io/leaflet-locatecontrol/dist/L.Control.Locate.min.js', ['position' => $this::POS_HEAD]);



//gis

$this->title = $model->HOSPCODE . "-" . $model->HID;
$this->params['breadcrumbs'][] = ['label' => 'หลังคาเรือนในเขตรับผิดชอบ', 'url' => ['/homegis/default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>




<div class="thome-gis-update">

  

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
<div id="map" class="well" style="height: 400px"></div>

<?php
$js = <<<JS
   
     var lat = $('#thomegis-latitude').val(); 
     var lng = $('#thomegis-longitude').val();   
   
    L.mapbox.accessToken = 'pk.eyJ1IjoidGVobm5uIiwiYSI6ImNpZzF4bHV4NDE0dTZ1M200YWxweHR0ZzcifQ.lpRRelYpT0ucv1NN08KUWQ';
    var map = L.mapbox.map('map', 'mapbox.streets').setView([lat, lng], 16);
    L.control.locate().addTo(map);
    //var map = L.mapbox.map('map');
    var baseLayers = {
	"แผนที่ถนน": L.mapbox.tileLayer('mapbox.streets'),        
        "แผนที่ดาวเทียม": L.mapbox.tileLayer('mapbox.satellite').addTo(map),
        
    };
     L.control.layers(baseLayers).addTo(map);
     /*var lc = L.control.locate({
        position: 'topright',
        strings: {
            title: "Show me where I am, yo!"
        }
    }).addTo(map);*/
     
      
     
     var pos = [lat,lng];
        
     var marker = L.marker(pos, {
            draggable: true
     });
     marker.bindPopup("อยู่ที่นี่..")
     marker.addTo(map);
        
     marker.on("dragend", function(e) {
        var m = e.target;
        var position = m.getLatLng();
        map.panTo(new L.LatLng(position.lat, position.lng));
        $('#thomegis-latitude').val(position.lat); 
        $('#thomegis-longitude').val(position.lng); 
    });
    marker.on("drag", function(e) {
        var m = e.target;
        var position = m.getLatLng();        
        $('#thomegis-latitude').val(position.lat); 
        $('#thomegis-longitude').val(position.lng); 
    });
        
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }
    function showPosition(position) {
        lat = position.coords.latitude;
        lng = position.coords.longitude
        map.setView([lat, lng], 16);
        //map.panTo(new L.LatLng(lat,lng));
        $('#thomegis-latitude').val(lat); 
        $('#thomegis-longitude').val(lng); 
        
        var newLatLng = new L.LatLng(lat, lng);
        marker.setLatLng(newLatLng); 
        marker.openPopup();
    }
    $('#btnLocate').on('click',function(){
        getLocation();
    });
JS;
$this->registerJs($js);
?>  

