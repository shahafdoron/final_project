<!DOCTYPE html>
<?php
include("../db_conn.php");

$total_tour_duration=120;
$is_accessible_only=0;
$actual_time=80;
$is_cafitaria=0;
$cafiteria_time=0;
$category_list=["attraction"=>[6,0.4,32],"history"=>[1,0.6,48]];

// $category_list=json_encode($category_list);


foreach ($category_list as $key => $val) {
  $weight=array();
  $value=array();
  echo ($key. ", ". $val[0]. ", ". $val[1]. "<br>" );
  $query="select point_of_interest.point_id,point_of_interest.name,point_of_interest.average_time_minutes, point_of_interest.average_ranking";
  $query.=" FROM point_of_interest WHERE point_of_interest.category_id=".$val[0] ."" ;
  echo $query . "<br><br>";

  $json_points=extract_data_to_json($query);
  $json_points_decoded=json_decode($json_points);
  $len=sizeof($json_points_decoded);

  for ($i=0;$i<$len;$i+=1){
    array_push($value,(floatval($json_points_decoded[$i]->{"average_time_minutes"})*floatval($json_points_decoded[$i]->{"average_ranking"})));
    array_push($weight,floatval($json_points_decoded[$i]->{"average_time_minutes"}));
  }

  $result=KnapSack($val[2],$weight,$value,$len,$json_points_decoded);

  // $value=set_value_array($json_points_decoded);
  print_r($result);
// echo($json_points_decoded[0]->{"average_time_minutes"});
// print_r($json_points);


// array_push($value,($json_points["average_time_minutes"]*))
}

// function set_value_array($json_points_decoded){
//   $arr=array();
//   $len=sizeof($json_points_decoded);
//   for ($i=0;$i<$len;$i+=1){
//     array_push($arr,(floatval($json_points_decoded[$i]->{"average_time_minutes"})*floatval($json_points_decoded[$i]->{"average_ranking"})));
//   }
//   return $arr;
// }

function KnapSack($capacity, $weight, $value, $itemsCount,$json_points_decoded)
{
	$K = array();

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

  $result=array();
  $col=$capacity;
  for ($i = $itemsCount; $i <= 0; --$i)
  {

    if(max($copy[$i])!=max($copy[$i-1])){
      array_push($result,$json_points_decoded[$i]);
      $col-=$weight[$i];
      // $copy[$i-1]=
    }


  }


	return $K;
}

 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title></title>
  </head>
  <body>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
