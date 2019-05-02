<!DOCTYPE html>
<?php
include("../db_conn.php");
include("algo.php");

//set all needed parameters:
$sorted_json_points=array();

if( isset($_POST['sel_tab']) ){

//set the entry point for the Nearest Neighbour Algorithm
$query="select * from point_of_interest where name='main gate'";
$total_tour_duration=floatval($_REQUEST["tour_duration_time"]);
$_SESSION["entry_point"]=json_decode(extract_data_to_json($query),true);
$json_data=json_decode($_REQUEST["json_data"],true);

//set algo key
$algorithem_key=$_REQUEST["sel_tab"];


//set accessible and cafeteria:
$is_accessible_only=$_REQUEST["accessible"];
$is_cafeteria=$_REQUEST["cafeteria"];
$cafeteria_time=0;
if(intval($is_cafeteria)==1){
  $cafeteria_time=floatval($_REQUEST["cafeteria_time"]);
  $total_tour_duration=$total_tour_duration-$cafeteria_time;
  $query="select * from point_of_interest where point_of_interest.category_id=7";
  $_SESSION['cafeteria_json']=json_decode(extract_data_to_json($query),true);

}
//get algo key result
$result=array();
if ($algorithem_key=="1") {
  $result=byCategoryAlgo($json_data,$total_tour_duration);
}
else {
  $result=byPointAlgo($json_data);
}

// final tour points (sorted)
$sorted_json_points=nearest(json_decode($result,true));


//=============================update db======================================
$insert_tour_query="insert into tour (planned_date_and_time_tour, tour_duration,is_acccessible_only,is_cafeteria, cafeteria_time, tour_type) VALUES (NOW() ,$total_tour_duration ,$is_accessible_only ,$is_cafeteria ,$cafeteria_time ,1 )";
$insert_tour_category_query="insert into tour_categories(tour_id, category_id) values ";
mysqli_query($conn,$insert_tour_query);

$generated_tour_id=mysqli_insert_id($conn);


foreach ($json_data as $key => $val){
  $insert_tour_category_query.="(".$generated_tour_id.",".$json_data[$key]["category_id"]. "),";
}
$insert_tour_category_query=rtrim($insert_tour_category_query,",");
mysqli_query($conn,$insert_tour_category_query);
echo "<h5>insert_tour_category_query :</h5>  ". $insert_tour_category_query;
echo "<br><br>";

$insert_tour_points_query="insert into tour_points_of_interest (tour_id,point_id, point_position) VALUES ";
foreach ($sorted_json_points as $position => $val){
  $insert_tour_points_query.="(".$generated_tour_id.",".$sorted_json_points[$position]["point_id"].",".$position. "),";
}
$insert_tour_points_query=rtrim($insert_tour_points_query,  ",");
mysqli_query($conn,$insert_tour_points_query);
echo "<h5>insert_tour_points_query :</h5>  ". $insert_tour_points_query;

$insert_independet_tour_query="insert into independent_tour (independent_tour_id,independent_tourist_id) values (".$generated_tour_id.",".$_SESSION["user_id"]. ")";
mysqli_query($conn,$insert_independet_tour_query);
echo $insert_independet_tour_query;

$_SESSION["tour_points"]=$sorted_json_points;
$_SESSION["tour_id_current"]=$generated_tour_id;

//=============================update db======================================

}

// ===================================echo parameters===========================================
// echo "<br><br><br><br> ";
//
// print_r("<h5>final result :</h5> ". json_encode ($sorted_json_points));
// echo "<br><br>";
// print_r("<h5>category json: </h5>".json_encode($json_data));
// echo "<br><br>";
// echo "<h5>is_accessible_only :</h5>  ".$is_accessible_only;
// echo "<br><br>";
//
// $insert_tour_query="insert into tour (planned_date_and_time_tour, tour_duration,is_acccessible_only,is_cafeteria, cafeteria_time, tour_type) VALUES (NOW() ,$total_tour_duration ,$is_accessible_only ,$is_cafeteria ,$cafeteria_time ,1 )";
// $insert_tour_category_query="insert into tour_categories(tour_id, category_id) values ";
//
// echo "<h5>insert_tour_category_query :</h5>  ". $insert_tour_query;
// echo "<br><br>";
//
// echo "<h5>user id :</h5>  ". $_SESSION["user_id"];
// echo "<br><br>";
//

// ===================================echo parameters===========================================




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
    height: 75%;
    width: 75%;
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
  <script src="script.js">  </script>
  <?php //include('navs.php'); ?>
  <div class="container">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="homepage_user.php">Home</a>
      </li>
      <li class="breadcrumb-item">
        <a href="independent_tour.php">Independent Tour</a>
      </li>
      <li class="breadcrumb-item active">Map</li>
    </ol>
  </div>

  <button class="btn btn-primary" onclick="tourHandler()">Finish</button>
  <div class="col-lg-8 mb-4" id="map"></div>

  <script>

  var sorted_json_points= (<?php print_r(json_encode($_SESSION["tour_points"])); ?>);

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

  }

  function tourHandler() {
    var ask = window.confirm("Would you like to share a feedback?");
      if (ask) {
          window.location.href = "tour_feedback.php";
      }
      else{
        window.location.href = "homepage_user.php";
      }

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

  // }


  </script>


  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAb2-b5Z6Ce1SxyiByMODVVXLH-2O9w7ds&callback=initMap" async defer></script>
  <!--Map Initiation  -->
  <!-- <script src="map_ben_shahaf.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
