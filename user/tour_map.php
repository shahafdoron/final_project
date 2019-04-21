<!DOCTYPE html>
<?php
include("../db_conn.php");
//set the entry point for the Nearest Neighbour Algorithm
$query="select * from point_of_interest where name='main gate'";

$total_tour_duration=floatval($_REQUEST["tour_duration_time"]);
$_SESSION["entry_point"]=json_decode(extract_data_to_json($query),true);
$json_data=json_decode($_REQUEST["json_data"],true);
$algorithem_key=$_REQUEST["sel_tab"];

$is_accessible_only=0;

$cafiteria_time=0;
if(intval($_REQUEST["cafiteria"])==1){
  $cafiteria_time=floatval($_REQUEST["cafiteria_time"]);
  $total_tour_duration=$total_tour_duration-$cafiteria_time;
  $query="select * from point_of_interest where point_of_interest.category_id=7";
  $_SESSION['cafiteria_json']=json_decode(extract_data_to_json($query),true);

}
$result=array();

if ($algorithem_key=="1") {
  $result=byCategoryAlgo($json_data,$total_tour_duration);
}

else {
  $result=byPointAlgo($json_data);
}

$sorted_json_points=nearest(json_decode($result,true));
echo "<h1>Result:</h1>";
echo "<br>";

function nearest($points){
  $entry=$_SESSION["entry_point"];

  $sorted=[];
  array_push($sorted,$entry[0]);
  $len=sizeof($points);

  for ($i=0; $i<$len ; $i++) {
    $dis=[];
    for ($j=0; $j <sizeof($points) ; $j++) {
      array_push($dis,(haversine($sorted[sizeof($sorted)-1],$points[$j])));
    }
    $index=array_search(min($dis),$dis);
    array_push($sorted,$points[$index]);
    array_splice($points,$index,1);
  }
  if(intval($_REQUEST["cafiteria"])==1){
    $dis=[];
    for ($i=0; $i <sizeof($_SESSION['cafiteria_json']) ; $i++)
    array_push($dis,(haversine($sorted[sizeof($sorted)-1],$_SESSION['cafiteria_json'][$i])));
    $index=array_search(min($dis),$dis);
    array_push($sorted,$_SESSION['cafiteria_json'][$index]);
  }
  return $sorted;
}

function haversine($point1,$point2){
  $earthRadius = 6371e3;

  $diffLat = ($point2['latitude']-$point1['latitude']) * PI() / 180;
  $diffLng = ($point2['longitude']-$point1['longitude']) * PI() / 180;
  $arc = cos($point1['latitude'] * PI() / 180) * cos($point2['latitude'] * PI() / 180)
  * sin($diffLng/2) * sin($diffLng/2)
  + sin($diffLat/2) * sin($diffLat/2);
  $line = 2 * atan2(sqrt($arc), sqrt(1-$arc));

  $distance = $earthRadius * $line;

  return $distance;
}
?>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <title></title>
  <style>
  /* Always set the map height explicitly to define the size of the div
  * element that contains the map. */
  #map {
    height: 80%;
    width: 80%;
    margin: auto;
  }
  /* Optional: Makes the sample page fill the window. */
  html, body {
    height: 100%;
    margin: 0;
    padding: 0;
  }
  </style>
</head>
<body>
  <?php include('navs.php'); ?>
  <div class="container">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="homepage_user.php">Home</a>
      </li>
      <li class="breadcrumb-item active">
        <a href="independent_tour.php">Independent Tour</a>
      </li>
      <li class="breadcrumb-item active">Map</li>
    </ol>
  </div>
  <div id="map"></div>


  <script>

  var sorted_json_points= (<?php print_r(json_encode($sorted_json_points)); ?>);
  function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: 31.9045, lng: 34.8083},
      zoom: 15
    });

    var point_pos={};
    var tourPath=[]
    for (var i = 0; i < sorted_json_points.length; i++) {
      tourPath.push({lat: parseFloat(sorted_json_points[i].latitude), lng: parseFloat(sorted_json_points[i].longitude)});
      new google.maps.Marker({
        position: tourPath[i],
        map: map,
        label: {
          text: ""+(i+1),
          color: 'white',
        },
        title: "Station Number "+(i+1)+"\n"+sorted_json_points[i].name

      });
    }
    var lineSymbol = {
      path: 'M 0,-1 0,1',
      strokeOpacity: 1,
      scale: 4
    };
    tourPath.push({lat: parseFloat(sorted_json_points[0].latitude), lng: parseFloat(sorted_json_points[0].longitude)})
    var tourPath = new google.maps.Polyline({
      path: tourPath,
      geodesic: true,
      map: map,
      icons: [{
        icon: lineSymbol,
        offset: '0',
        repeat: '20px'
      }],
      strokeColor: '#FF0000',
      strokeOpacity: 0
    });

    // // Zoom and center map automatically by stations (each station will be in visible map area)
    // var lngs = stations.map(function(station) { return station.lng; });
    // var lats = stations.map(function(station) { return station.lat; });
    // map.fitBounds({
    //     west: Math.min.apply(null, lngs),
    //     east: Math.max.apply(null, lngs),
    //     north: Math.min.apply(null, lats),
    //     south: Math.max.apply(null, lats),
    // });

    // // Show stations on the map as markers
    // for (var i = 0; i < stations.length; i++) {
    //     new google.maps.Marker({
    //         position: stations[i],
    //         map: map,
    //         title: stations[i].name
    //     });
    // }

  }



  </script>


  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAb2-b5Z6Ce1SxyiByMODVVXLH-2O9w7ds&callback=initMap" async defer></script>
  <!--Map Initiation  -->
  <!-- <script src="map_ben_shahaf.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
