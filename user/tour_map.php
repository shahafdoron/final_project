<!DOCTYPE html>
<?php
include("../db_conn.php");


$json_data_str=$_REQUEST["json_data"];
echo $json_data_str;
$json_data=json_decode($json_data_str,true);
print_r($json_data);

$total_tour_duration=120;
$is_accessible_only=0;
$actual_time=80; //$capacity
$is_cafitaria=0;
$cafiteria_time=0;
$category_list=["attraction"=>[6,0.6,120],"history"=>[1,0.4,80]];
$result=array();
// $category_list=json_encode($category_list);


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
print_r(gettype ($result));
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
    var json_points = (<?php echo $result; ?>);
    console.log(json_points);


    </script>

<script src="map_ben_shahaf.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAb2-b5Z6Ce1SxyiByMODVVXLH-2O9w7ds&callback=initMap" async defer></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
