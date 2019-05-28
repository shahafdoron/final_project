<!DOCTYPE html>
<?php
include("../db_conn.php");
include("algo.php");

//set all needed parameters:
$sorted_json_points=array();

if( isset($_POST['sel_tab']) ){

setTourParameters();

//set algo key
$algorithem_key=$_REQUEST["sel_tab"];
//get algo key result
$result=array();
if ($algorithem_key=="1") {
  $result=byCategoryAlgo($_SESSION["json_data"],$_SESSION["total_tour_duration"]);
  // echo "<br><br><br><br><br>";
  // print_r($result);
}
else {
  $result=byPointAlgo($_SESSION["json_data"]);
}

// final tour points (sorted)
$sorted_json_points=nearest(json_decode($result,true));


//=============================update db======================================

$_SESSION["tour_points"]=$sorted_json_points;
// $_SESSION["tour_id_current"]=$generated_tour_id;

//=============================update db======================================

}

// ===================================echo parameters===========================================
// echo "<br><br><br><br> ";
//
// echo "<br><br><br><br>";
// print_r("<h5>final result :</h5> ". json_encode ($sorted_json_points));
// echo "<br><br>";
// print_r("<h5>category json: </h5>".json_encode($json_data));
// echo "<br><br>";
// echo $total_tour_duration;
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
  <?php include('navs.php'); ?>
  <div class="container  border shadow p-3 h-100 w-100 bg-white rounded" style="width:100%; height:100%;">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="homepage_user.php">Home</a>
      </li>
      <li class="breadcrumb-item">
        <a href="independent_tour.php">Build A Tour</a>
      </li>
      <li class="breadcrumb-item active">Map</li>
    </ol>
    <div class="container border shadow p-3 mb-5 bg-white rounded" style="width:100%; height:90%; ">
        <h1 ><u>Tour Map:</u></h1><br>

      <div  class="container border shadow p-3 mb-3 bg-white rounded" style="width:100%; height:85%;" >
        <div class="row border  mt-0 ml-0 mr-0 d-flex " style="width:100%; height:90%;">

        <div id="data" class="col-3 p-0 mt-0 card-footer h-100 w-100 bg-light">

          <script>

        var algo_key=<?php echo $algorithem_key; ?>;
        var total_tour_duration=<?php echo $_SESSION["total_tour_duration"]; ?>;
        var points_json=<?php print_r(json_encode($_SESSION["tour_points"]));  ?>;
        var category_json=(<?php print_r(json_encode($_SESSION["json_data"]));  ?>);
        console.log("algo_key --> "+algo_key);
        console.log("total_tour_duration --> "+total_tour_duration);
        console.log(points_json);
        console.log(category_json);
        loadTourData(algo_key,total_tour_duration,points_json,category_json);
      </script>

        </div>

        <div id="map" class="col-9 h-100 w-100 "  >

        </div>
        <script type="text/javascript">

        var sorted_json_points= (<?php print_r(json_encode($_SESSION["tour_points"])); ?>);
        console.log(sorted_json_points);


        </script>
        <script type="text/javascript" src="map.js"></script>


        </div>

        <div class="row justify-content-center mt-1">
          <button class="btn btn-primary btn-lg" onclick="tourHandler()" style="width:250px;">Schedule Tour</button>
        </div>
      </div>



      </div>




    </div>
</div>


    <script>
    function tourHandler() {
      var sorted_json_points= (<?php print_r(json_encode($_SESSION["tour_points"])); ?>);


      var ask = window.confirm("Are you sure you would like to schedule this tour?");
        if (ask) {
            sendAjax('../db_conn.php','schedule',sorted_json_points);
            window.location.href = "my_tours.php";
        }
        else{
            window.location.href = "homepage_user.php";
        }



      }
  // ====================================workkkkkkkkkkkkoinggg====================================

    // var sorted_json_points= (<?php //print_r(json_encode($_SESSION["tour_points"])); ?>);
    //
    // function initMap() {
    //   var map = new google.maps.Map(document.getElementById('map'), {
    //     center: {lat: 31.9045, lng: 34.8083},
    //     zoom: 15
    //   });
    //
    //   var point_pos={};
    //   var tourPath=[]
    //   for (var i = 0; i < sorted_json_points.length; i++) {
    //     tourPath.push({lat: parseFloat(sorted_json_points[i].latitude), lng: parseFloat(sorted_json_points[i].longitude)});
    //     new google.maps.Marker({
    //       position: tourPath[i],
    //       map: map,
    //       label: {
    //         text: ""+(i+1),
    //         color: 'white',
    //       },
    //       title: "Station Number "+(i+1)+"\n"+sorted_json_points[i].name
    //
    //     });
    //   }
    //   var lineSymbol = {
    //     path: 'M 0,-1 0,1',
    //     strokeOpacity: 1,
    //     scale: 4
    //   };
    //   tourPath.push({lat: parseFloat(sorted_json_points[0].latitude), lng: parseFloat(sorted_json_points[0].longitude)})
    //   var tourPath = new google.maps.Polyline({
    //     path: tourPath,
    //     geodesic: true,
    //     map: map,
    //     icons: [{
    //       icon: lineSymbol,
    //       offset: '0',
    //       repeat: '20px'
    //     }],
    //     strokeColor: '#FF0000',
    //     strokeOpacity: 0
    //   });
    //
    // }
    //


    // }
    // ====================================workkkkkkkkkkkkoinggg====================================
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
  </div>




  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAb2-b5Z6Ce1SxyiByMODVVXLH-2O9w7ds&callback=initMap" async defer></script>
  <!--Map Initiation  -->
  <!-- <script src="map_ben_shahaf.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
