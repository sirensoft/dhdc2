<?php
$this->title = "Tambon";
$this->registerCssFile('https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.css', ['async' => false, 'defer' => true]);
$this->registerCssFile('./lib-gis/leaflet-search.min.css',['async' => false, 'defer' => true]);

$this->registerJsFile('https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.js', ['position' => $this::POS_HEAD]);
$this->registerJsFile('./lib-gis/leaflet-search.min.js',['position' => $this::POS_HEAD]);

?>


<div class="panel panel-success">       
    <div class="panel-body">
        <div id="map" style="width: 100%;height: 460px"></div>   
    </div>
    <div class="panel-footer" id="info">
        
        <?php
        //echo $hos_json;
        ?>
        
    </div>
</div>




<?php
$icon1 = "#40ff00";
$icon2 = "#3366ff";
$icon3 = "#ff3300";
$js = <<<JS
             
    L.mapbox.accessToken = 'pk.eyJ1IjoidGVobm5uIiwiYSI6ImNpZzF4bHV4NDE0dTZ1M200YWxweHR0ZzcifQ.lpRRelYpT0ucv1NN08KUWQ';
    //var map = L.mapbox.map('map', 'mapbox.streets').setView([16, 100], 6);
    var map = L.mapbox.map('map');
        
     var baseLayers = {
	"แผนที่ถนน": L.mapbox.tileLayer('mapbox.streets').addTo(map),        
        "แผนที่ดาวเทียม": L.mapbox.tileLayer('mapbox.satellite'),
        
    };
        
    var _group1 = L.layerGroup().addTo(map);
    var _group2 = L.layerGroup().addTo(map);
         
    var tam_layer=L.geoJson($tambon_json,{
        style:style,
        onEachFeature:function(feature,layer){             
        
                layer.bindPopup(feature.properties.TAM_NAMT);
         }
           
       }).addTo(_group1);
    map.fitBounds(tam_layer.getBounds());
    
    var hos_layer =L.geoJson($hos_json,{
           onEachFeature:function(feature,layer){    
                layer.setIcon(L.mapbox.marker.icon({'marker-color': '#008000','marker-symbol':'h'})); 
                layer.bindPopup(feature.properties.HOS);
           }
    }).addTo(_group2);
        
    var overlays = {               
        "ขอบเขตตำบล": _group1,
        "หน่วยบริการ": _group2,
               
    };
        
    L.control.layers(baseLayers,overlays).addTo(map);
      
    //search
    var searchControl = new L.Control.Search({
		layer: hos_layer,
		propertyName: 'SEARCH_TEXT',
		circleLocation: false,
		
    });

    searchControl.on('search:locationfound', function(e) {
				
		if(e.layer._popup)e.layer.openPopup();

    }).on('search:collapsed', function(e) {

		hos_layer.eachLayer(function(layer) {	
			hos_layer.resetStyle(layer);
		});	
    });
	
	map.addControl( searchControl );  
    
    // other function    
    function style(feature) {
        return {
            fillColor: '#4169E1',
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



