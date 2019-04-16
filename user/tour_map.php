<!DOCTYPE html>
<?php
include("../db_conn.php");
//set the entry point for the Nearest Neighbour Algorithm
$query="select * from point_of_interest where name='main gate'";
$_SESSION["entry_point"]=extract_data_to_json($query);

$json_data_str=$_REQUEST["json_data"];

$json_data=json_decode($json_data_str,true);
$is_accessible_only=0;
$actual_time=80; //$capacity
$is_cafitaria=0;
$cafiteria_time=0;
$category_list=[];

$total_tour_duration=floatval($_REQUEST["tour_duration_time"]);
foreach ($json_data as $key => $value) {
  $category_list[$key]=[$value["category_id"],$value["category_weight"],floatval($value["category_weight"])*$total_tour_duration];
}
$result=array();

foreach ($category_list as $key => $val) {

  $weight=array();
  $value=array();
  // echo ($key. ", ". $val[0]. ", ". $val[1]. "<br>" );
  $query="select point_of_interest.point_id,point_of_interest.name,point_of_interest.average_time_minutes, point_of_interest.average_ranking,point_of_interest.category_id,point_of_interest.longitude,point_of_interest.latitude";
  $query.=" FROM point_of_interest WHERE point_of_interest.category_id=".$val[0] ."" ;
  // echo $query . "<br><br>";

  $json_points=extract_data_to_json($query);
  $json_points_decoded=json_decode($json_points,true);
  $itemsCount=sizeof($json_points_decoded); //$itemsCount

  for ($i=0;$i<$itemsCount;$i+=1){
    array_push($value, (floatval($json_points_decoded[$i]["average_time_minutes"])*floatval($json_points_decoded[$i]["average_ranking"])) );
    array_push($weight,floatval($json_points_decoded[$i]["average_time_minutes"]));
  }
  $cat_capacity=$val[2];
  $result=array_merge_recursive($result,KnapSack($cat_capacity,$weight,$value,$itemsCount,$json_points_decoded));
}

echo "<br><br> <h2>result:</h2>";
$result=json_encode($result);
  echo "<br>";
function KnapSack($capacity, $weight, $value, $itemsCount,$json_points_decoded){
$K = array();
$result=array();
// echo "<br> <h3>capacity:</h3>";
// print_r($capacity);
// echo "<br> <h3>weight:</h3>";
// print_r($weight);
// echo "<br> <h3>value:</h3>";;
// print_r($value);
// echo "<br> <h3>itemcounts:</h3>";;
// print_r($itemsCount);
// echo "<br> <h3>json_points_decoded:</h3>";;
// print_r($json_points_decoded);
// echo "<br>";
	for ($i = 0; $i <= $itemsCount; ++$i)
	{
		for ($w = 0; $w <= $capacity; ++$w)
		{
			if ($i == 0 || $w == 0)
				$K[$i][$w] = 0;
			else if ($weight[$i - 1] <= $w)
				$K[$i][$w] = max($value[$i - 1] + $K[$i - 1][$w - $weight[$i - 1]], $K[$i - 1][$w]);
			else
				$K[$i][$w] = $K[$i - 1][$w];
		}
	}

  $k_copy = new ArrayObject($K);
  $copy = $k_copy->getArrayCopy();
  array_shift($copy);
  // print_r($copy);
  $col=$capacity;
  for ($i = $itemsCount-1; $i > 0; --$i && ($col>=0))
  {
    if( ($copy[$i][$col]>$copy[$i-1][$col]) && ($copy[$i][$col]>0) ){
      // echo "<br><h4>i=$i</h4>";
      array_push($result,$json_points_decoded[$i]);
      $col-=$weight[$i];
      // echo "<h4>col:$col</h4>";

    }

  }
  // echo "<br> <h4>points result:</h4>";

	// return $result;
  // return $K[$itemsCount][$capacity];
  return $result;
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



    var json_points =<?php print_r($result); ?>;
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
      for (var i = 0; i < json_points.length; i++) {
       point_pos={lat: parseFloat(json_points[i].latitude), lng: parseFloat(json_points[i].longitude)};
        new google.maps.Marker({
            position: point_pos,
            map: map,
            title: "Station Number "+i+"\n"+json_points[i].name
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
