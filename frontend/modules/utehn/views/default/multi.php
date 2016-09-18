<?php
$this->title = "Multi";

$this->registerCssFile('https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.css', ['async' => false, 'defer' => true]);
$this->registerJsFile('https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.js', ['position' => $this::POS_HEAD]);

?>


<div class="panel panel-success">       
    <div class="panel-body">
        <div id="map" style="width: 100%;height: 460px"></div>   
    </div>
    <div class="panel-footer" id="info"></div>
</div>


<?php
$icon1 = "#40ff00";
$icon2 = "#3366ff";
$icon3 = "#ff3300";
$js = <<<JS
        
    L.mapbox.accessToken = 'pk.eyJ1IjoidGVobm5uIiwiYSI6ImNpZzF4bHV4NDE0dTZ1M200YWxweHR0ZzcifQ.lpRRelYpT0ucv1NN08KUWQ';
    var map = L.mapbox.map('map').setView([16, 100], 6);
      
    var baseLayers = {
	"แผนที่ถนน": L.mapbox.tileLayer('mapbox.streets')  ,
        "แผนที่ดาวเทียม": L.mapbox.tileLayer('mapbox.satellite'),
        
    };
    
    var p_layer;
    var area_layer;
        
    var _group1 = L.layerGroup();
    var _group2 = L.layerGroup().addTo(map);
           
    
     $.getJSON('./gis/point.json',function(data){
          p_layer=L.geoJson(data,{
           onEachFeature:function(feature,layer){
                if(feature.properties.TAM_CODE<=5){
                    layer.setIcon(L.mapbox.marker.icon({'marker-color': '$icon1'})); 
                }else if(feature.properties.TAM_CODE>=10){
                    layer.setIcon(L.mapbox.marker.icon({'marker-color': '$icon2'}));
                }else{
                    layer.setIcon(L.mapbox.marker.icon({'marker-color': '$icon3'}));
                }
                //layer.bindTitle(feature.properties.TAM_NAMT);
                layer.bindPopup(feature.properties.TAM_NAMT);
           }
       }).addTo(_group1);
         map.fitBounds(p_layer.getBounds());
        
    }); 
   
   
   
     $.getJSON('./gis/plk.json',function(data){
       area_layer=L.geoJson(data,{
           style:style,
           onEachFeature:function(feature,layer){               
        
                layer.bindPopup(feature.properties.TAM_NAMT);
           }
       }).addTo(_group2);
        
    });
        var overlays = {
                 "หลังคาเรือน": _group1,
                "ขอบเขตตำบล": _group2
               
            };
        
        L.control.layers(baseLayers,overlays).addTo(map);
        
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



