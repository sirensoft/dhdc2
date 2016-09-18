var map = L.map('map', {
    center: new L.latLng(13.434536, 99.955502),
    zoom: 11
});
var baseLayer = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png');
baseLayer.addTo(map);

var village_layer;
$.getJSON('./gis/p75.json', function (data) {
    village_layer = L.geoJson(data, {
        style: style,
        onEachFeature: function (feature, layer) {
            layer.on({
                mouseover: highlightFeature,
                mouseout: resetHighlight,
                click: zoomToFeature
            });
        }
    }).addTo(map);
    map.fitBounds(village_layer.getBounds());
});

function getColor(code) {
    switch (code) {
        case 1:
            return 'red';
        case 2:
            return 'orange';
        default:
            return 'green';
    }
}
function style(feature) {
    return {
        fillColor: getColor(feature.properties.AMP_CODE),
        weight: 2,
        opacity: 1,
        color: 'white',
        dashArray: '3',
        fillOpacity: 0.7
    }
}
function highlightFeature(e) {
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
    update(layer.feature.properties);
}
function resetHighlight(e) {
    village_layer.resetStyle(e.target);
    $('#info').html('');
}

function zoomToFeature(e) {
    map.fitBounds(e.target.getBounds());
}

function update(props) {
    var tam = props.TAM_NAMT;
    var amp = props.AMP_NAMT;
    var content = 'ต.' + tam + ' อ.' + amp;
    $('#info').html(content);
}

// legend
var legend = L.control({position: 'topright'});
legend.onAdd = function (map) {
    var div = L.DomUtil.create('div', 'info legend');
    var labels = ['<b>หัวข้อ</b>'];
    labels.push('<i style="background:green"></i>พื้นที่ผู้ป่วยคุมน้ำตาลได้ร้อยละ 80 ขึ้นไป');
    labels.push('<i style="background:orange"></i>พื้นที่ผู้ป่วยคุมน้ำตาลได้ร้อยละ 60-80');
    labels.push('<i style="background:red"></i>พื้นที่ผู้ป่วยคุมน้ำตาลได้ร้อยละน้อยกว่า 60');
    div.innerHTML = labels.join('<br>');
    return div;
};
legend.addTo(map);
//end legend

$("#btn_ok").on('click',function(){
   map.fitBounds([
      [-4.8587000, 39.8772333],
      [-6.4917667, 39.0945000]
    ]);
});


