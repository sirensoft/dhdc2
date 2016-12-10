<?php
$this->title = "แผนที่ ของฉัน";
$this->registerCssFile('https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.css', ['async' => false, 'defer' => true]);
$this->registerCssFile('./lib-gis/leaflet-search.min.css',['async' => false, 'defer' => true]);
$this->registerCssFile('./lib-gis/leaflet.label.css',['async' => false, 'defer' => true]);

$this->registerJsFile('https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.js', ['position' => $this::POS_HEAD]);
$this->registerJsFile('./lib-gis/leaflet-search.min.js',['position' => $this::POS_HEAD]);
$this->registerJsFile('./lib-gis/leaflet.label.js',['position' => $this::POS_HEAD]);

$this->registerJsFile('https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/leaflet.markercluster.js',['position' => $this::POS_HEAD]);
$this->registerCssFile('https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/MarkerCluster.css',['async' => false, 'defer' => true]);
$this->registerCssFile('https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/MarkerCluster.Default.css',['async' => false, 'defer' => true]);

?>
<?php
print_r($home_json);

?>

<div id="map" style="width: 100%;height: 75vh;">
    
</div>

<?php

$js = <<<JS
             
    L.mapbox.accessToken = 'pk.eyJ1IjoidGVobm5uIiwiYSI6ImNpZzF4bHV4NDE0dTZ1M200YWxweHR0ZzcifQ.lpRRelYpT0ucv1NN08KUWQ';
   
    var map = L.map('map'); 
    map.setView([16.3,101], 8);
   
        
     var baseLayers = {
	"แผนที่ถนน": L.mapbox.tileLayer('mapbox.streets').addTo(map),        
        "แผนที่ดาวเทียม": L.mapbox.tileLayer('mapbox.satellite'),
        
    };
        
    
            var house_layer =L.geoJson($home_json,{                
            
           onEachFeature:function(feature,layer){    
                //layer.setIcon(L.mapbox.marker.icon({'marker-color': '#82f217','marker-symbol':'h'})); 
                //layer.setIcon(ic_house); 
                layer.bindPopup(feature.properties.HOUSE);               
                
               
           },
           
    }).addTo(map);
    // จบ house
        
       L.control.layers(baseLayers,{}).addTo(map);
   
   

JS;
$this->registerJs($js);
?>