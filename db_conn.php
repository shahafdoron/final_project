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
          case 'schedule':
            $sorted_json_points=json_decode($_REQUEST["json_data"],true);
            loadTourDetails($sorted_json_points);
            break;

          case 'remove_independent_from_schedule' :
          $tour_id=json_decode($_REQUEST["json_data"],true);
          removeIndependentFromSchedule($tour_id["tour_id"]);
            break;

          case 'remove_guided_from_schedule':
            $tour_id=json_decode($_REQUEST["json_data"],true);
            removeGuidedFromSchedule($tour_id["tour_id"]);
            break;

            case 'edit_point' :
            $point=json_decode($_REQUEST["json_data"],true);
            $update_point_query="update point_of_interest SET category_id='".$point["category_id"]."' , name='".$point["name"]."' , longitude='".$point["longitude"]."', ";
            $update_point_query.="latitude='".$point["latitude"]."', average_time_minutes='".$point["average_time_minutes"]."', is_accessible='".$point["is_accessible"]."', point_description='".$point["point_description"]."' ";
            $update_point_query.=" WHERE point_of_interest.point_id='".$point["point_id"]."'";
            global $conn;
            mysqli_query($conn,$update_point_query);
            break;

            case 'add_point' :
            $point=json_decode($_REQUEST["json_data"],true);
            $add_point_query="insert into point_of_interest (category_id,name,longitude,latitude, average_time_minutes, average_ranking, is_accessible, point_description) values ";
            $add_point_query.="('".$point["category_id"]."','".$point["name"]."','".$point["longitude"]."','".$point["latitude"]."','".$point["average_time_minutes"]."','".$point["average_ranking"]."','".$point["is_accessible"]."','".$point["point_description"]."')";
            global $conn;
            mysqli_query($conn,$add_point_query);
            break;


            case 'remove_participant':
            global $conn;
            $json_data=json_decode($_REQUEST["json_data"],true);
            $query_remove_sub="delete FROM guided_tour_registration WHERE guided_tour_id=".$json_data['tour_id']." and registered_tourist_id=".$json_data['user_id']." ";
            // $query_current= "select participants FROM tour WHERE tour_id=".$json_data['tour_id']."";
            // $participants=json_decode(extract_data_to_json($query_current),true);
            $query_update= "update tour set participants = participants - ".$json_data["tickets_number"]." where tour.tour_id ='".$json_data["tour_id"]."' ";
            mysqli_query($conn,$query_update);
            mysqli_query($conn,$query_remove_sub);
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

function setTourParameters(){

  $total_tour_duration=floatval($_REQUEST["tour_duration_time"]);
  $json_data=json_decode($_REQUEST["json_data"],true);
  $planned_tour_date_time=$_REQUEST["planned_tour_date_time"];

  //set accessible and cafeteria:
  $is_accessible_only=$_REQUEST["accessible"];
  $is_cafeteria=$_REQUEST["cafeteria"];
  $cafeteria_time=0;
  if(intval($is_cafeteria)==1){
    $cafeteria_time=floatval($_REQUEST["cafeteria_time"]);
    $total_tour_duration=$total_tour_duration-$cafeteria_time;
    $query="select * from point_of_interest where point_of_interest.category_id=7";
    $_SESSION['cafeteria_json']=json_decode(extract_data_to_json($query),true);
    $_SESSION["cafeteria_time"]=$_REQUEST["cafeteria_time"];
  }

  //set sessions
  $query="select * from point_of_interest where name='main gate'";
  $_SESSION["entry_point"]=json_decode(extract_data_to_json($query),true);
  $_SESSION["total_tour_duration"]=$total_tour_duration;
  $_SESSION["planned_tour_date_time"]=$planned_tour_date_time;
  $_SESSION["is_accessible_only"]=$is_accessible_only;
  $_SESSION["is_cafeteria"]=$is_cafeteria;
  $_SESSION["json_data"]=$json_data;
  $_SESSION["cafeteria_time"]=$cafeteria_time;

  if($_SESSION["user_type"]=='1'){
    $_SESSION["tour_type"]='1';
    $participants=$_REQUEST["participants"];
    $_SESSION["participants"]=$participants;
  }
  else {
      $_SESSION["tour_type"]='2';
      $_SESSION["participants"]='0';
  }
}

function loadTourDetails($sorted_json_points){
  global $conn;
  $insert_tour_query="insert into tour (planned_date_and_time_tour, tour_duration,is_acccessible_only,is_cafeteria, cafeteria_time, participants ,tour_type,has_started) VALUES ('".  $_SESSION["planned_tour_date_time"] ."' ,".$_SESSION["total_tour_duration"]." ,".$_SESSION["is_accessible_only"]." ,".  $_SESSION["is_cafeteria"]." ,".$_SESSION["cafeteria_time"]." ,".$_SESSION["participants"].",".$_SESSION["tour_type"]." ,0)";
  $insert_tour_category_query="insert into tour_categories(tour_id, category_id) values ";
  mysqli_query($conn,$insert_tour_query);

  $generated_tour_id=mysqli_insert_id($conn);


  foreach ($_SESSION["json_data"] as $key => $val){
    $insert_tour_category_query.="(".$generated_tour_id.",".$_SESSION["json_data"][$key]["category_id"]. "),";
  }
  $insert_tour_category_query.="(".$generated_tour_id.",".$_SESSION["entry_point"][0]["category_id"].")";

  $insert_tour_category_query=rtrim($insert_tour_category_query,",");

  mysqli_query($conn,$insert_tour_category_query);


  $insert_tour_points_query="insert into tour_points_of_interest (tour_id,point_id, point_position) VALUES ";
  foreach ($sorted_json_points as $position => $val){
    $insert_tour_points_query.="(".$generated_tour_id.",".$sorted_json_points[$position]["point_id"].",".$position. "),";
  }
  $insert_tour_points_query=rtrim($insert_tour_points_query,  ",");

  mysqli_query($conn,$insert_tour_points_query);


if ($_SESSION["user_type"]=='1'){
  $insert_independet_tour_query="insert into independent_tour (independent_tour_id,independent_tourist_id) values (".$generated_tour_id.",".$_SESSION["user_id"]. ")";
  mysqli_query($conn,$insert_independet_tour_query);
}


  $_SESSION["tour_id_current"]=$generated_tour_id;

}

function removeIndependentFromSchedule($tour_id){
  global $conn;
  $remove_independent_query="delete from independent_tour where independent_tour.independent_tour_id='".$tour_id."'";
  mysqli_query($conn,$remove_independent_query);
  deleteTourFromDB($tour_id);
}

function removeGuidedFromSchedule($tour_id){
  global $conn;

  $get_subscribers_query="select guided_tour_registration.subscribers from guided_tour_registration ";
  $get_subscribers_query.="where guided_tour_registration.registered_tourist_id='".$_SESSION["user_id"]."' ";
  $get_subscribers_query.="and guided_tour_registration.guided_tour_id='".$tour_id."' ";
  $subscribers=json_decode(extract_data_to_json($get_subscribers_query),true);
  $subscribers_num=$subscribers[0]["subscribers"];

  $remove_guided_registration="delete from guided_tour_registration where guided_tour_registration.guided_tour_id='".$tour_id."' AND guided_tour_registration.registered_tourist_id='".$_SESSION["user_id"]."'";

  $upadte_participents_query="update tour SET participants = participants - ".$subscribers_num." WHERE tour.tour_id ='".$tour_id."'";

  mysqli_query($conn,$upadte_participents_query);
  mysqli_query($conn,$remove_guided_registration);

}

function deleteTourFromDB($tour_id){
  global $conn;
  $remove_tour_query="delete from tour where tour.tour_id='".$tour_id."'";
  $remove_tour_categories_query="delete from tour_categories where tour_categories.tour_id='".$tour_id."'";
  $remove_tour_points_of_interest_query="delete from tour_points_of_interest where tour_points_of_interest.tour_id='".$tour_id."'";
  mysqli_query($conn,$remove_tour_query);
  mysqli_query($conn,$remove_tour_categories_query);
  mysqli_query($conn,$remove_tour_points_of_interest_query);

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
