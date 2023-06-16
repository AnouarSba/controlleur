<!DOCTYPE html>
<html>
  <head>
    <title>Leaflet 1.0.3</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link type="text/css" rel="stylesheet" href="//unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
    <style>
        body {
    margin: 0;
}

html, body, #leaflet {
    height: 100%;
}
#map { height: 580px; }

    </style>
  </head>
  <body>
    <div id="map"></div>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>  </body>
</html>
<script>
var map = L.map('map').setView([35.2, 	-0.641389], 13);
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);
var marker = L.marker([35.1822247, -0.6131909]).addTo(map);
marker.bindPopup("<b>Hello world!</b><br>I am a popup.").openPopup();
    var popup = L.popup();
    var marker2 = L.marker([35.1822257, -0.6331939]).addTo(map);
marker2.bindPopup("<b>Hello !</b><br>I am a popup.").openPopup();
    var popup2 = L.popup();
    function connectTheDots(){
    var c = [];
        var x = 35.1822247;
        var x1 = 35.1822257;
        var y = -0.6131909;
        var y1 = -0.6331909;
        c.push([x, y]);
        c.push([x1, y1]);
    
    return c;
}

spiralCoords = connectTheDots();
var spiralLine = L.polyline(spiralCoords).addTo(map)
/*  function connectTheDots(data){
    var c = [];
    for(i in data._layers) {
        var x = data._layers[i]._latlng.lat;
        var y = data._layers[i]._latlng.lng;
        c.push([x, y]);
    }
    return c;
}

spiralCoords = connectTheDots(spiralLayer);
var spiralLine = L.polyline(spiralCoords).addTo(map)
 */
 </script>