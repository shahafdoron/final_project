<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <style media="screen">
  html, body {
  height: 100%;
  margin: 0;
  padding: 0;
}
#map {
  height: 100%;
  width: 100%;
  height: 100%;
}
  </style>
  <body>
    <!-- <button onclick="for (var r of gRenderers) r.setMap(gMap);">Show line</button> -->

<!-- <button onclick="for (var r of gRenderers) r.setMap(null);">Hide line</button> -->

<div id="map" onload="for (var r of gRenderers) r.setMap(gMap);"></div>
<script>
  function initMap() {
    var service = new google.maps.DirectionsService;
    var map = new google.maps.Map(document.getElementById('map'));
    // window.gMap = map;

    // list of points
    var stations = [
        {lat: 31.90818, lng: 34.819053, name: 'Station 1'},
        {lat: 31.905964, lng: 34.810162, name: 'Station 2'},
        {lat: 31.907779, lng: 34.814134, name: 'Station 3'},
        {lat: 31.907698, lng: 34.809867, name: 'Station 4'},
        {lat: 31.906015, lng: 34.810296, name: 'Station 5'},
        {lat: 31.907193, lng: 34.806777, name: 'Station 6'},
      
        // ... as many other stations as you need
    ];

    // Zoom and center map automatically by stations (each station will be in visible map area)
    var lngs = stations.map(function(station) { return station.lng; });
    var lats = stations.map(function(station) { return station.lat; });
    map.fitBounds({
        west: Math.min.apply(null, lngs),
        east: Math.max.apply(null, lngs),
        north: Math.min.apply(null, lats),
        south: Math.max.apply(null, lats),
    });

    // Show stations on the map as markers
    for (var i = 0; i < stations.length; i++) {
        new google.maps.Marker({
            position: stations[i],
            map: map,
            title: stations[i].name
        });
    }

    // Divide route to several parts because max stations limit is 25 (23 waypoints + 1 origin + 1 destination)
    for (var i = 0, parts = [], max = 8 - 1; i < stations.length; i = i + max)
        parts.push(stations.slice(i, i + max + 1));

    // Service callback to process service results
    var service_callback = function(response, status) {
        if (status != 'OK') {
            console.log('Directions request failed due to ' + status);
            return;
        }
        var renderer = new google.maps.DirectionsRenderer;
        if (!window.gRenderers)
        		window.gRenderers = [];
        window.gRenderers.push(renderer);
        renderer.setMap(map);
        renderer.setOptions({ suppressMarkers: true, preserveViewport: true });
        renderer.setDirections(response);
    };

    // Send requests to service to get route (for stations count <= 25 only one request will be sent)
    for (var i = 0; i < parts.length; i++) {
        // Waypoints does not include first station (origin) and last station (destination)
        var waypoints = [];
        for (var j = 1; j < parts[i].length - 1; j++)
            waypoints.push({location: parts[i][j], stopover: false});
        // Service options
        var service_options = {
            origin: parts[i][0],
            destination: parts[i][parts[i].length - 1],
            waypoints: waypoints,
            travelMode: 'WALKING'
        };
        // Send request
        service.route(service_options, service_callback);
    }
  }

  function nearest(points){
  // var enter=<?php //echo json.encode($_SESSION["entry_point"]); ?>;
  var enter={"id" : 0, "longitude" : 1, "latitude" : 1,};
  var sorted=[];
  sorted.push(enter);
  var len=points.length
  for(i=0;i<len;i++){
    dis=[];
    for(j=0;j<points.length;j++){
      dis.push(haversine(sorted[sorted.length-1],points[j]));
    }
    index=dis.indexOf(Math.min.apply(null, dis));
    sorted.push(points[index]);
    points.splice(index,1);
  }
  return sorted;
}


function haversine (point1,point2) {
    var earthRadius = 6371e3;

    var diffLat = (point2.latitude-point1.latitude) * Math.PI / 180;
    var diffLng = (point2.longitude-point1.longitude) * Math.PI / 180;

    var arc = Math.cos(point1.latitude * Math.PI / 180) * Math.cos(point2.latitude * Math.PI / 180)
                    * Math.sin(diffLng/2) * Math.sin(diffLng/2)
                    + Math.sin(diffLat/2) * Math.sin(diffLat/2);
    var line = 2 * Math.atan2(Math.sqrt(arc), Math.sqrt(1-arc));

    var distance = earthRadius * line;

    return distance;
}
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAb2-b5Z6Ce1SxyiByMODVVXLH-2O9w7ds&callback=initMap"></script>
  </body>
</html>
