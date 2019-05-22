<!DOCTYPE html>
<?php
include("../db_conn.php");
$tour=json_decode($_REQUEST["json_tour"],true);
echo "<br><br><br><br><br>";
print_r($tour);
$start_tour_query="update tour set has_started='1' where tour.tour_id='".$tour["tour_id"]."'";
// global $conn;
mysqli_query($conn,$start_tour_query);

$tour_points_query='select tour_points_of_interest.tour_id,tour_points_of_interest.point_id,point_of_interest.name,tour_points_of_interest.point_position,point_of_interest.average_time_minutes, point_of_interest.average_ranking,point_of_interest.category_id,point_of_interest.longitude,point_of_interest.latitude ';
$tour_points_query.='FROM point_of_interest,tour_points_of_interest ';
$tour_points_query.='WHERE point_of_interest.point_id=tour_points_of_interest.point_id AND tour_points_of_interest.tour_id='.$tour["tour_id"];
$tour_points_query.=' ORDER BY tour_points_of_interest.point_position ASC';
$tour_points=(extract_data_to_json($tour_points_query));

echo $tour_points_query. "<br><br>";
echo($tour_points);

$feedback_query="select * from feedback where feedback.tour_id='".$tour["tour_id"]."' and feedback.user_id='".$_SESSION["user_id"]."'";
echo($feedback_query);
$feedback=json_decode(extract_data_to_json($feedback_query),true);
$feedbak_has_been_alredy_shared=0;
if (sizeof($feedback)>0){
  $feedbak_has_been_alredy_shared=1;
}

$_SESSION["tour_points"]=$tour_points;


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
        <a href="my_tours.php">My Tours</a>
      </li>
      <li class="breadcrumb-item active">Tour Map</li>
    </ol>
    <div class="container border shadow p-3 mb-5 bg-white rounded" style="width:100%; height:90%; ">
        <h1 ><u>Tour Map:</u></h1><br>

      <div  class="container border shadow p-3 mb-3 bg-white rounded" style="width:100%; height:85%;" >
        <div class="row border  mt-0 ml-0 mr-0 d-flex " style="width:100%; height:90%;">

        <div id="data" class="col-3 p-0 mt-0 card-footer h-100 w-100 bg-light">

          <script>


        var total_tour_duration=<?php echo $tour["tour_duration"]; ?>;
        var points_json=<?php echo ($_SESSION["tour_points"]);  ?>;


        console.log("total_tour_duration --> "+total_tour_duration);
        console.log(points_json);

        loadTourData('0',total_tour_duration,points_json);
      </script>

        </div>

        <div id="map" class="col-9 h-100 w-100 "  >

        </div>
        <script type="text/javascript">

        var sorted_json_points= (<?php echo($_SESSION["tour_points"]); ?>);
        console.log(sorted_json_points);


        </script>
        <script type="text/javascript" src="map.js"></script>


        </div>

        <div class="row justify-content-center mt-1">
          <button class="btn btn-primary btn-lg" onclick="finishTourHandler()" style="width:250px;">Finish</button>
        </div>
      </div>
      </div>
    </div>
</div>


    <script>
    function finishTourHandler() {

    var feedbak_has_been_alredy_shared= <?php echo $feedbak_has_been_alredy_shared; ?>;

      if(feedbak_has_been_alredy_shared=='0'){
      var ask = window.confirm("Would you like to share a feedback?");
        if (ask) {
            window.location.href = "tour_feedback.php";
        }
        else{
          window.location.href = "homepage_user.php";
        }
      }
      else{
        window.location.href = "homepage_user.php";
      }

      }


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
