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
<script>
function InitializeMap() {
  var ltlng = [];

  ltlng.push(new google.maps.LatLng(17.22, 78.28));
  ltlng.push(new google.maps.LatLng(13.5, 79.2));
  ltlng.push(new google.maps.LatLng(15.24, 77.16));
  ltlng.push(new google.maps.LatLng(17.32, 78.28));
  ltlng.push(new google.maps.LatLng(17.22, 78.28));
  ltlng.push(new google.maps.LatLng(17.22, 78.28));
  ltlng.push(new google.maps.LatLng(17.22, 78.28));
  ltlng.push(new google.maps.LatLng(17.22, 78.28));
  ltlng.push(new google.maps.LatLng(17.22, 78.28));
  ltlng.push(new google.maps.LatLng(17.22, 78.28));
  ltlng.push(new google.maps.LatLng(17.22, 78.28));
  ltlng.push(new google.maps.LatLng(17.22, 78.28));
  ltlng.push(new google.maps.LatLng(17.22, 78.28));



  var myOptions = {
    zoom: 15,
    //center: latlng,
    center: ltlng[0],
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  var map = new google.maps.Map(document.getElementById("map"), myOptions);

  for (var i = 0; i < ltlng.length; i++) {
    var marker = new google.maps.Marker({
      // position: new google.maps.LatLng(-34.397, 150.644),
      position: ltlng[i],
      map: map,
      title: 'Click me'
    });
  }
  //***********ROUTING****************//

  //Intialize the Path Array
  var path = new google.maps.MVCArray();

  //Intialize the Direction Service
  var service = new google.maps.DirectionsService();


  var tourPath = new google.maps.Polyline({
    path: ltlng,
    geodesic: true,
    strokeColor: '#4986E7',
    strokeOpacity: 1.0,
    strokeWeight: 2
  });

  tourPath.setMap(map);

}

window.onload = InitializeMap;


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
<div id="map"></div>

  </body>
</html>
