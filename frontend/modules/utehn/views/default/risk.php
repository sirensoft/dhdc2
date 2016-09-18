<?php
$this->title = "Risk Point";
$this->registerCssFile('https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.css', ['async' => false, 'defer' => true]);
$this->registerJsFile('https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.js', ['position' => $this::POS_HEAD]);
?>


<div class="panel panel-success">       
    <div class="panel-body">
        <div id="map" style="width: 100%;height: 460px"></div>   
    </div>
    <div class="panel-footer" id="info">
        <?php
        echo $geojson;
        ?>
    </div>
</div>




<?php
$icon1 = "#40ff00";
$icon2 = "#3366ff";
$icon3 = "#ff3300";
$js = <<<JS
        
   
        
    L.mapbox.accessToken = 'pk.eyJ1IjoidGVobm5uIiwiYSI6ImNpZzF4bHV4NDE0dTZ1M200YWxweHR0ZzcifQ.lpRRelYpT0ucv1NN08KUWQ';
    var map = L.mapbox.map('map', 'mapbox.streets').setView([16, 100], 6);
    
    L.geoJson($geojson,{
           onEachFeature:function(feature,layer){    
                layer.setIcon(L.mapbox.marker.icon({'marker-color': '$icon3'})); 
                layer.bindPopup(feature.properties.name);
           }
       }).addTo(map);
    
        
JS;
$this->registerJs($js);
?>



