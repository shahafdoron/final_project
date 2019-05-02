<?php
$host="localhost";
$username = "root";
$password = "";
$database= "final_project";
$conn =  mysqli_connect($host,$username,$password,$database);
mysqli_set_charset($conn,"utf8");
session_start();

if (!$conn){
  die("Database connection has failed!");
}

if (is_ajax_request()) {

  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      ajaxCallGET();
  }
elseif ($_SERVER["REQUEST_METHOD"]==="POST") {
  // code...
  if(isset($_REQUEST["action"])) {
      $action = $_REQUEST["action"];
      ajaxCallPOST($action);
    }
  }

}

function is_ajax_request(){
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ;
}

function ajaxCallGET  (){
  $query=$_REQUEST['query'];
  $jsonData=extract_data_to_json($query);
  echo $jsonData;

}

function ajaxCallPOST($action){
  $query="";
  // define("INITIAL_NUM_USERS",30);
  $action_posted=$action;

      switch($action_posted) {
          case 'feedback' :
          // global $conn;
          $user_id=$_SESSION["user_id"];
          $tour_id=$_SESSION["tour_id_current"];
          $json_data=json_decode($_REQUEST["json_data"],true);

          $new_average_ranking=array();
          global $conn;
          $insert_feedback_query='insert into feedback (tour_id, user_id) VALUES ('.$tour_id.','.$user_id.')';
          mysqli_query($conn,$insert_feedback_query);

          $insert_point_feedback_query="insert into point_feedback (feedback_id, point_id, point_ranking) values ";
          $generated_feedback_id=mysqli_insert_id($conn);
          foreach ($json_data as $point_id => $rank){
            $insert_point_feedback_query.="(".$generated_feedback_id.",".$point_id.",".$rank. "),";
          }
          $insert_point_feedback_query=rtrim($insert_point_feedback_query,",");
          mysqli_query($conn,$insert_point_feedback_query);

          //start calc new average ranking for each point
          $get_current_rank_query='select point_feedback.point_id,COUNT(point_feedback.point_id) as "number_ranking", point_of_interest.average_ranking ';
          $get_current_rank_query.='from point_feedback ,point_of_interest ';
          $get_current_rank_query.='where point_feedback.point_id=point_of_interest.point_id and point_of_interest.point_id in (';
          foreach ($json_data as $point_id => $rank){
            $get_current_rank_query.=$point_id.",";
          }
          $get_current_rank_query=rtrim($get_current_rank_query,",");
          $get_current_rank_query.=' ) GROUP BY point_feedback.point_id ';

          $get_current_rank_result=json_decode(extract_data_to_json($get_current_rank_query),true);

          $INITIAL_NUM_USERS=floatval(30);
// sizeof($get_current_rank_result)
          for ($i=0; $i < 1; $i++) {
            $p_id=$get_current_rank_result[$i]["point_id"];
            $p_average_rank=$get_current_rank_result[$i]["average_ranking"];
            $number_ranking_db=floatval($get_current_rank_result[$i]["number_ranking"]);
            $total_num_ranking=$INITIAL_NUM_USERS+$number_ranking_db;

            $user_point_rank=floatval($json_data[$p_id]);

            $new_rank=(($user_point_rank+ (($total_num_ranking-1)*$p_average_rank) )/$total_num_ranking);
            $new_rank=round($new_rank, 1);
            $update_average_ranking="update point_of_interest set point_of_interest.average_ranking=".$new_rank. " where point_of_interest.point_id=".$p_id;
            mysqli_query($conn,$update_average_ranking);
          }




          break;

      }
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
    $_SESSION["user_type"]=$row["user_type"];
    $result->free();
    if ($_SESSION["user_type"]=='3'){
      header('location:admin/homepage_admin.php');
    }
    else {
      header('location:user/homepage_user.php');
    }

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



 ?>
