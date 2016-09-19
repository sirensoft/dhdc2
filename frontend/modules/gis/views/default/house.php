<?php
$this->title = "DHDC2:GIS";
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


<div class="panel panel-info">
    <div class="panel-heading">
        <b>แผนที่แสดงที่ตั้งหลังคาเรือน</b>-[แฟ้ม HOME]       
    </div>
    <div class="panel-body" >
        <div id="map" style="width: 100%;height: 75vh;"></div>   
    </div>
    <div class="panel-footer" id="info">
        <b><u>แผนที่ขอบเขตระดับหมู่บ้าน</u></b> กรุณาติดต่อ <a href="https://www.facebook.com/tehnn" target="_blank">ผู้พัฒนา</a>
        <?php
       // echo $house_json;
        ?>
        
    </div>
</div>


<?php

$js = <<<JS
             
    L.mapbox.accessToken = 'pk.eyJ1IjoidGVobm5uIiwiYSI6ImNpZzF4bHV4NDE0dTZ1M200YWxweHR0ZzcifQ.lpRRelYpT0ucv1NN08KUWQ';
   
    var map = L.map('map');
        
   
        
     var baseLayers = {
	"แผนที่ถนน": L.mapbox.tileLayer('mapbox.streets').addTo(map),        
        "แผนที่ดาวเทียม": L.mapbox.tileLayer('mapbox.satellite'),
        
    };
        
     var clusterGroup = new L.MarkerClusterGroup({
        spiderfyOnMaxZoom: true,
        showCoverageOnHover: true,
        zoomToBoundsOnClick: true
    });
    
    
        
    var _group1 = L.layerGroup();
    var _group2 = L.layerGroup();
     
   //ตำบล
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
    // จบตำบล
    
    //house
    var ic_house = L.icon({
        iconUrl: './images/ic_house.png',
        iconSize:     [28, 28],    
        iconAnchor:   [20, 20],   
        popupAnchor:  [-0, -20] 
    });
       
    var house_layer =L.geoJson($house_json,{                
            
           onEachFeature:function(feature,layer){    
                //layer.setIcon(L.mapbox.marker.icon({'marker-color': '#82f217','marker-symbol':'h'})); 
                layer.setIcon(ic_house); 
                layer.bindPopup(feature.properties.FULL_HOUSE+'<br>'+'เจ้าบ้าน:-'+feature.properties.HEAD_NAME);               
                
               
           },
           
    }).addTo(clusterGroup);
    // จบ house
    
    //hos
    var hos_layer =L.geoJson($hos_json,{                
            
           onEachFeature:function(feature,layer){    
                layer.setIcon(L.mapbox.marker.icon({'marker-color': '#09945f','marker-symbol':'h'})); 
                layer.bindPopup(feature.properties.HOS);
                //layer.bindLabel(feature.properties.HOS);
                
               
           },
           
    }).addTo(_group2);
    //จบ hos
    
        
    var overlays = {   
        "หลังคาเรือน": clusterGroup.addTo(map),
        "ขอบเขตตำบล": _group1.addTo(map),
        "หน่วยบริการ":_group2
        
               
    };
        
    L.control.layers(baseLayers,overlays).addTo(map);
      
    //search
    var searchControl = new L.Control.Search({
		layer: house_layer,
		propertyName: 'SEARCH_TEXT',
		circleLocation: false,
		
    });

    searchControl.on('search:locationfound', function(e) {
				
		if(e.layer._popup)e.layer.openPopup();

    }).on('search:collapsed', function(e) {

		house_layer.eachLayer(function(layer) {	
			house_layer.resetStyle(layer);
		});	
    });
    //map.addControl( searchControl );  
    
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



