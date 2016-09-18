<?php
$this->registerCssFile('https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.css', ['async' => false, 'defer' => true]);

$this->registerJsFile('https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.js', ['position' => $this::POS_HEAD,]);
?>

<div class="test-default-index">
    <div class="panel panel-success">       
        <div class="panel-body">
            <div id="map" style="width: 100%;height: 460px"></div>   
        </div>
        <div class="panel-footer" id="info"></div>
    </div>
</div>
<?php
$js = <<<JS
        
L.mapbox.accessToken = 'pk.eyJ1IjoidGVobm5uIiwiYSI6ImNpZzF4bHV4NDE0dTZ1M200YWxweHR0ZzcifQ.lpRRelYpT0ucv1NN08KUWQ';
var map = L.mapbox.map('map', 'mapbox.streets')
.setView([15.89, 99.90], 6);
        
JS;
$this->registerJs($js);
?>
