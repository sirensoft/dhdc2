<?php
$this->title = "Polygon";
$this->registerCssFile('https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.css', ['async' => false, 'defer' => true]);
$this->registerJsFile('https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.js', ['position' => $this::POS_HEAD]);
?>


<div class="panel panel-success">  
    <div class="panel-heading panel-danger">
        <h4>แผนที่แสดงความชุกการเกิดอุบัติเหตุ</h4>
    </div>
    <div class="panel-body">
        <div id="map" style="width: 100%;height: 460px"></div>   
    </div>
    <div class="panel-footer" id="info"></div>
</div>


<?php
$icon1 = "#40ff00";
$icon2 = "#3366ff";
$icon3 = "#ff3300";
$prov = 65;
$js = <<<JS
        
    L.mapbox.accessToken = 'pk.eyJ1IjoidGVobm5uIiwiYSI6ImNpZzF4bHV4NDE0dTZ1M200YWxweHR0ZzcifQ.lpRRelYpT0ucv1NN08KUWQ';
    var map = L.mapbox.map('map', 'mapbox.streets').setView([16, 100], 6);
    var area_layer;
     $.getJSON('./gis/tambon/p$prov.json',function(data){
       area_layer=L.geoJson(data,{
           style:style,
           onEachFeature:function(feature,layer){             
        
                layer.bindPopup(feature.properties.TAM_NAMT);
           }
       }).addTo(map);
        map.fitBounds(area_layer.getBounds());
    });
        
    function getColor(code) {
        switch (code) {
            case 1:
                return 'red';
            case 2:
                return 'yellow';
            default:
                return 'green';
        }
    }
    function style(feature) {
        return {
            fillColor: getColor(feature.properties.TAM_CODE),
            weight: 2,
            opacity: 1,
            color: 'white',
            dashArray: '3',
            fillOpacity: 0.7
        }
}
        
JS;
$this->registerJs($js);
?>



