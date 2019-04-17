<!DOCTYPE html>
<?php
include("../db_conn.php");
//set the entry point for the Nearest Neighbour Algorithm
$query="select * from point_of_interest where name='main gate'";

$total_tour_duration=floatval($_REQUEST["tour_duration_time"]);
$_SESSION["entry_point"]=extract_data_to_json($query);
// $json_data_str=$_REQUEST["json_data"];
$json_data=json_decode($_REQUEST["json_data"],true);
$algorithem_key=$_REQUEST["sel_tab"];

$is_accessible_only=0;
// $actual_time=80; //$capacity
// $total_tour_duration=0;
$is_cafitaria=0;
$cafiteria_time=0;

if( isset($_REQUEST["cafiteria_time"])){
  $cafiteria_time=floatval($_REQUEST["cafiteria_time"]);
  $total_tour_duration=$total_tour_duration-$cafiteria_time;
  $is_cafitaria=1;
  $query="select * from point_of_interest where point_of_interest.category_id=7";
  $cafiteria_json=extract_data_to_json($query);
  print_r($cafiteria_json);
}
// $is_cafitaria=0;
$result=array();

if ($algorithem_key=="1") {
  $result=byCategoryAlgo($json_data,$total_tour_duration);
  echo "<br><br>";
  print_r($result);
}

else {
  $result=byPointAlgo($json_data);
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

    <div id="map"></div>
    <script>



    var json_points =(<?php print_r($result); ?>);
    console.log(json_points);
    sorted_json_points = nearest(json_points);

    function nearest(points){
      var enter=JSON.parse(<?php echo json_encode($_SESSION["entry_point"]); ?>);
      // var enter={"id" : 0, "longitude" : 1, "latitude" : 1,};
      var sorted=[];
      sorted.push(enter[0]);
      var len=points.length;

      for(i=0;i<len;i++){
        dis=[];
        for(j=0;j<points.length;j++){
          dis.push(haversine(sorted[sorted.length-1],points[j]));
        }
        index=dis.indexOf(Math.min.apply(null, dis));
        sorted.push(points[index]);
        points.splice(index,1);
      }
      // if(<?php //echo $is_cafitaria; ?>=="1"){
        // var caf_json=<?php // print_r($cafiteria_json); ?>;
      //
      //   dis=[];
      //   for (var i = 0; i < caf_json.length; i++) {
      //     dis.push(haversine(sorted[sorted.length-1],caf_json[i]))
      //   }
      //   index=dis.indexOf(Math.min.apply(null, dis));
      //   sorted.push(points[index]);
      // }

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

    var map;
    function initMap() {
      map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 31.9045, lng: 34.8083},
        zoom: 15
      });

      var point_pos={};
      for (var i = 0; i < sorted_json_points.length; i++) {
       point_pos={lat: parseFloat(sorted_json_points[i].latitude), lng: parseFloat(sorted_json_points[i].longitude)};
        new google.maps.Marker({
            position: point_pos,
            map: map,
            title: "Station Number "+i+"\n"+sorted_json_points[i].name
        });

      }

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
