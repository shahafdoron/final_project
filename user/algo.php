<?php

function KnapSack($capacity, $weight, $value, $itemsCount,$json_points_decoded){
	$K = array();
	$result=array();
	// echo "<br> <h3>capacity:</h3>";
	// print_r($capacity);
	// echo "<br> <h3>weight:</h3>";
	// print_r($weight);
	// echo "<br> <h3>value:</h3>";;
	// print_r($value);
	//
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
	// echo "<br><h3>the matrix</h3>";
	// print_r($K);
	// echo "<br>";
	$k_copy = new ArrayObject($K);
	$copy = $k_copy->getArrayCopy();
	array_shift($copy);
	// print_r($copy);
	$col=$capacity;
	// echo "<h4>col:$col</h4>";
	for ($i = $itemsCount-1; $i >= 0 && ($col>=0); --$i )
	{
		if($i>0){
			if ($copy[$itemsCount-1][$capacity]==$copy[1][$capacity]){
					array_push($result,$json_points_decoded[$i]);
					// echo "<br><h3>BBBBBBBB<h3>";
					break;
			}
			if( ($copy[$i][$col]>$copy[$i-1][$col]) ){// && ($copy[$i][$col]>0)
				// echo "<br><h4>i=$i</h4>";
				array_push($result,$json_points_decoded[$i]);
				$col-=$weight[$i];
				// echo "<h4>col:$col</h4>";

			}
		}
		if ($i==0){
			if ($copy[$i+1][$col]>0) {
				array_push($result,$json_points_decoded[$i]);

				// code...
			}
		}


	}
	// echo "<br> <h4>points result:</h4>";
	//
	// // return $result;
	// // return $K[$itemsCount][$capacity];
	// // echo "<h4>knapsack itteration:</h4>";
	// print_r($result);
	// echo "<br><br>";
	// echo "End of KnapSack";
	// echo "<br><br>";
	//
	// echo "===========================";
	// echo "<br><br><br><br>";
	return $result;
}

function manageKnapsak($category_list){
	$result=array();
	foreach ($category_list as $key => $val) {

		$weight=array();
		$value=array();

		// echo ($key. ", ". $val[0]. ", ". $val[1]. "<br>" );
		$query="select point_of_interest.point_id,point_of_interest.name,point_of_interest.average_time_minutes, point_of_interest.average_ranking,point_of_interest.category_id,point_of_interest.longitude,point_of_interest.latitude";
		$query.=" FROM point_of_interest WHERE point_of_interest.category_id=".$val[0] ." and point_of_interest.average_time_minutes<=".$val[2] ;
		// echo $query . "<br><br>";

		$json_points=extract_data_to_json($query);
		$json_points_decoded=json_decode($json_points,true);
		$itemsCount=sizeof($json_points_decoded); //$itemsCount

		for ($i=0;$i<$itemsCount;$i+=1){
			// array_push($value, (floatval($json_points_decoded[$i]["average_time_minutes"])*floatval($json_points_decoded[$i]["average_ranking"])) );
			// array_push($value,(floatval($json_points_decoded[$i]["average_ranking"])) );
			array_push($weight,floatval($json_points_decoded[$i]["average_time_minutes"]));
			$rank=floatval($json_points_decoded[$i]["average_ranking"]);
			$int_rank=floor($rank);
			$decimal_rank=$rank-$int_rank;
			$new_rank=pow(2,$int_rank)+$decimal_rank;
			array_push($value,$new_rank);

		}


		$cat_capacity=$val[2];
		$result=array_merge_recursive($result,KnapSack($cat_capacity,$weight,$value,$itemsCount,$json_points_decoded));
		// echo "End of KnapSack";
		// echo "===========================";
		// echo "<br><br><br><br>";

		// print_r($result[$j][$key]);
	}
	return $result;
}

function byCategoryAlgo($json_data,$total_tour_duration){
	$category_list=[];
	foreach ($json_data as $key => $value) {
		$category_list[$key]=[$value["category_id"],$value["category_weight"],floatval($value["category_weight"])*$total_tour_duration];
	}

	$result=manageKnapsak($category_list);
	$result=json_encode($result);
	return $result;
}


function byPointAlgo($json_data){
	print_r( $json_data);
	$ids_points=array();
	foreach ($json_data as $key => $value) {
		$ids_points=array_merge($ids_points,$json_data[$key]["points"]);
	}
	// $json_data_keys=array_keys($json_data);
	$ids_str=implode(",",$ids_points);
	$query="select * from point_of_interest WHERE point_of_interest.point_id in (".$ids_str.")";
	// echo "<br><br>";
	// echo $ids_str;
	$result=extract_data_to_json($query);
	// print_r($result) ;
	return $result;
}

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
	if(intval($_REQUEST["cafeteria"])==1){
		$dis=[];
		for ($i=0; $i <sizeof($_SESSION['cafeteria_json']) ; $i++)
		array_push($dis,(haversine($sorted[sizeof($sorted)-1],$_SESSION['cafeteria_json'][$i])));
		$index=array_search(min($dis),$dis);
		array_push($sorted,$_SESSION['cafeteria_json'][$index]);
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
