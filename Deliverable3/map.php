<!DOCTYPE html>
<html>
<head>
  <link href="map.css" type="text/css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
   <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>
    <script src="jquery-2.1.1.min.js"></script>
    <script src="newcoordinates.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../node_modules/leaflet-search/src/leaflet-search.css" />
   <style>
    #mapid{ height: 800px; }
  </style>
  <title>Leaflet Skeleton Website</title>
</head>

<body>

  <div class="pagecontainer">

  <div class="top">
  <ul>
   <li><a class="link" href="StudentD3.php">Students</a></li>
    <li><a class="link" href="ParentPageD3.php">Parents</a></li>
    <li><a class="link" href="PolicyD3.php">Policy Makers</a></li>
    <li><a class="link" href="FacultyD3.php">Faculty</a></li>
    <li><a class="link" href="HomePageD3.php">Home Page</a></li>
  </ul>
  </div>

  <div id="mapid">
    <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
    <script src="../node_modules/leaflet-search/src/leaflet-search.js"></script>
    <script>
    var mymap = L.map('mapid').setView([37.9643, -91.8318], 8);

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZmlubmVnYW5jIiwiYSI6ImNra3l4azE3OTBiMGoycHBsYmFwcWY0aXIifQ.mC9N2Q385vu7a2f9i6284Q', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'your.mapbox.access.token'
}).addTo(mymap);
   var schools = "newcoordinates.js";

    function onEachFeature(feature, layer) {
        // does this feature have a property named popupContent?
        if (feature.properties && feature.properties.Name) {
            layer.bindPopup(feature.properties.Name);
        }
    }

    /*var geojsonFeature = {
       "type": "Feature",
       "properties": {
         "name": "Saint Louis University",
         "amenity": "College",
         "popupContent": "Go Billikens",
         "show_on_map": true
       },
       "geometry": {
         "type": "Point",
         "coordinates": [ -90.2342, 38.6359 ]
       }
    };*/

    var schoolIcon = L.icon({
      iconUrl: 'school.png',
      iconSize: [40,35]
    });

    //  L.geoJson([myGeoJson]).addTo(mymap);

      var schools = L.geoJSON([myGeoJson], {
        onEachFeature: onEachFeature
  }).addTo(mymap);

  var markersLayer = new L.LayerGroup();

  mymap.addLayer(markersLayer);

  var controlSearch = new L.Control.Search({
    position: 'topright',
    layer: markersLayer,
    initial: false,
    zoom: 12,
    marker: false
  });

  mymap.addControl( controlSearch );


    </script>
  </div>
 </div>
</body>

</html>
