<?php
$this->title = "DHDC2:GIS";
$this->registerCssFile('https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.css', ['async' => false, 'defer' => true]);
$this->registerCssFile('./lib-gis/leaflet-search.min.css',['async' => false, 'defer' => true]);
$this->registerCssFile('./lib-gis/leaflet.label.css',['async' => false, 'defer' => true]);

$this->registerJsFile('https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.js', ['position' => $this::POS_HEAD]);
$this->registerJsFile('./lib-gis/leaflet-search.min.js',['position' => $this::POS_HEAD]);
$this->registerJsFile('./lib-gis/leaflet.label.js',['position' => $this::POS_HEAD]);

?>


<div class="panel panel-danger">
    <div class="panel-heading">
        <b>แผนที่แสดงที่ตั้งหน่วยบริการ</b>
        <p></p>
    </div>
    <div class="panel-body" >
        <div id="map" style="width: 100%;height: 75vh;"></div>   
    </div>
    <div class="panel-footer" id="info">
        ประสงค์ใช้งาน<b><u>แผนที่ขอบเขตระดับหมู่บ้าน</u></b>กรุณาติดต่อ <a href="https://www.facebook.com/tehnn" target="_blank">UTEHN PHNU</a>
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
        
    //L.marker([16, 100]).bindLabel('Look revealing label!').addTo(map);
        
     var baseLayers = {
	"แผนที่ถนน": L.mapbox.tileLayer('mapbox.streets').addTo(map),        
        "แผนที่ดาวเทียม": L.mapbox.tileLayer('mapbox.satellite'),
        
    };
    
    
        
    var _group1 = L.layerGroup().addTo(map);
    var _group2 = L.layerGroup().addTo(map);
         
    var tam_layer=L.geoJson($tambon_json,{
        style:style,
        onEachFeature:function(feature,layer){         
            //layer.bindPopup(feature.properties.TAM_NAMT);
            layer.bindLabel(feature.properties.TAM_NAMT);
            layer.on({
                    mouseover: highlightFeatureTamLayer,
                    mouseout: resetHighlightTamLayer,
                    click: zoomToFeature
                });
         },
         
       }).addTo(_group1);
    map.fitBounds(tam_layer.getBounds());
    

       
    var hos_layer =L.geoJson($hos_json,{                
            
           onEachFeature:function(feature,layer){    
                layer.setIcon(L.mapbox.marker.icon({'marker-color': '#f25a17','marker-symbol':'h'})); 
                layer.bindPopup(feature.properties.HOS);
                //layer.bindLabel(feature.properties.HOS);
                
               
           },
           
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
        
    function highlightFeatureTamLayer(e) {
        var layer = e.target;
        layer.setStyle({
            weight: 5,
            color: '#B5E61D',
            dashArray: '',
            fillOpacity: 0.7
        });
        if (!L.Browser.ie && !L.Browser.opera) {
            layer.bringToFront();
        }
        
    }
    function resetHighlightTamLayer(e) {
        tam_layer.resetStyle(e.target);
        
    }
    function zoomToFeature(e) {
        map.fitBounds(e.target.getBounds());
    }
        
JS;
$this->registerJs($js);
?>



