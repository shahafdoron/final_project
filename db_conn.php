<?php
$host="localhost";
$username = "root";
$password = "";
$database= "final_project";
$conn =  mysqli_connect($host,$username,$password,$database);
session_start();

if (!$conn){
  die("Database connection has failed!");
}

if (is_ajax_request()) {
  ajaxCall();
}

function is_ajax_request(){
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ;
}

function ajaxCall(){
  $query=$_REQUEST['query'];
  $jsonData=extract_data_to_json($query);
  echo $jsonData;

}
function validate_email_password(){

  global  $conn;
  $emailAddress=$_POST['emailAddress'];
  $password=$_POST['password'];
  $emailAddress=mysqli_real_escape_string($conn,$emailAddress);
  $password=mysqli_real_escape_string($conn,$password);

  $query= "select * from user where user.Email='" . $emailAddress . "' and user.Password=" . $password ."";
  $result=mysqli_query($conn,$query);

  if ($row=mysqli_fetch_assoc($result)){
    $_SESSION["emailAddress"]=$row["email"];
    $_SESSION["password"]=$row["password"];
    $_SESSION["user_id"]=$row["user_id"];
    $result->free();
    header('location:user/homepage_user.php');
  }

  else {
    $_SESSION['error'] = "Incorrect login or password!";
    $conn->close();
  	header('location:index.php');

  }
}

function user_authintication($emailAddress,$password){
  if ($emailAddress=='' || $password==''){
    echo "Please enter email address and password";
  }
}

function extract_data_to_json($query){
  global $conn;
  $data=array();
  $result=mysqli_query($conn,$query);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      $data[]=$row;
  }
}
  $json_string_data=json_encode($data);
  $result->free();
  // $conn->close();
  return $json_string_data;
}

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

function manageKnapsak($category_list){
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
  $ids_str=implode(",",$json_data);
  $query="select * from point_of_interest WHERE point_of_interest.point_id in (".$ids_str.")";
  echo $query;
  $result=extract_data_to_json($query);
  print_r($result) ;
  return $result;
}

 ?>
