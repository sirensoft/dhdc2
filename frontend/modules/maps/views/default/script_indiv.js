L.mapbox.accessToken = 'pk.eyJ1IjoidGVobm5uIiwiYSI6ImNpZzF4bHV4NDE0dTZ1M200YWxweHR0ZzcifQ.lpRRelYpT0ucv1NN08KUWQ';
// Here we don't use the second argument to map, since that would automatically
// load in non-clustered markers from the layer. Instead we add just the
// backing tileLayer, and then use the featureLayer only for its data.
var map = L.mapbox.map('map')
        .setView([38.9, -77], 13)
        .addLayer(L.mapbox.tileLayer('mapbox.streets'));

var overlays = L.layerGroup().addTo(map);

var layers;

// Since featureLayer is an asynchronous method, we use the `.on('ready'`
// call to only use its marker data once we know it is actually loaded.
L.mapbox.featureLayer()
        .loadURL('./gis/stations.geojson')
        .on('ready', function (e) {
            layers = e.target;
            showStations();
        });

var filters = document.getElementById('colors').filters;

function showStations() {
    // first collect all of the checked boxes and create an array of strings
    // like ['green', 'blue']
    var list = [];
    for (var i = 0; i < filters.length; i++) {
        if (filters[i].checked)
            list.push(filters[i].value);
    }
    // then remove any previously-displayed marker groups
    overlays.clearLayers();
    // create a new marker group
    var clusterGroup = new L.MarkerClusterGroup().addTo(overlays);
    // and add any markers that fit the filtered criteria to that group.
    layers.eachLayer(function (layer) {
        if (list.indexOf(layer.feature.properties.line) !== -1) {
            clusterGroup.addLayer(layer);
        }
    });
}





