<?php
$host="localhost";
$username = "root";
$password = "";
$database= "final_project";
$conn =  mysqli_connect($host,$username,$password,$database);
mysqli_set_charset($conn,"utf8");
session_start();

// ====================================good=========================
// include("db_conn.php");
//
// $query="";
// // define("INITIAL_NUM_USERS",30);
//
// if(isset($_REQUEST["action"])) {
//     $action = $_REQUEST["action"];
//
//     echo "asdasdasd";
//     switch($action) {
//         case 'feedback' :
//         global $conn;
//         $user_id=$_SESSION["user_id"];
//         $tour_id=$_SESSION["tour_id_current"];
//         $json_data=json_decode($_REQUEST["json_data"],true);
//         $new_average_ranking=array();
//
//         $insert_feedback_query='insert into feedback (tour_id, user_id) VALUES ('.$tour_id.','.$user_id.')';
//         mysqli_query($conn,$insert_feedback_query);
//
//         $insert_point_feedback_query="insert into point_feedback (feedback_id, point_id, point_ranking) values ";
//         $generated_feedback_id=mysqli_insert_id($conn);
//         foreach ($json_data as $point_id => $rank){
//           $insert_point_feedback_query.="(".$generated_feedback_id.",".$point_id.",".$rank. "),";
//         }
//         $insert_point_feedback_query=rtrim($insert_point_feedback_query,",");
//         mysqli_query($conn,$insert_point_feedback_query);
//
//         $INITIAL_NUM_USERS=30;
//
//         break;
//
//     }
// }

// ============================================================

// $get_current_rank_query=$_REQUEST["query"];
// $json_data=json_decode('{"19":"1","21":"1","26":"1","28":"1","29":"1","67":"1"}',true);

// $d=extract_data_to_json($query);
// $d=json_decode($d,true);
$json_data=json_decode('{"74":"1"}',true);
$get_current_rank_query='select point_feedback.point_id,COUNT(point_feedback.point_id) as "number_ranking", point_of_interest.average_ranking ';
$get_current_rank_query.='from point_feedback ,point_of_interest ';
$get_current_rank_query.='where point_feedback.point_id=point_of_interest.point_id and point_of_interest.point_id in (';
foreach ($json_data as $point_id => $rank){
  $get_current_rank_query.=$point_id.",";
}
$get_current_rank_query=rtrim($get_current_rank_query,",");
$get_current_rank_query.=' ) GROUP BY point_feedback.point_id ';
$get_current_rank_result=json_decode(extract_data_to_json($get_current_rank_query),true);
// print_r($get_current_rank_result);

$INITIAL_NUM_USERS=floatval(30);
// sizeof($get_current_rank_result)
$json_data=json_decode('{"74":"1"}',true);
for ($i=0; $i < 1; $i++) {
  $p_id=$get_current_rank_result[$i]["point_id"];
  $p_average_rank=$get_current_rank_result[$i]["average_ranking"];
  $number_ranking_db=floatval($get_current_rank_result[$i]["number_ranking"]);
  $total_num_ranking=$INITIAL_NUM_USERS+$number_ranking_db;
  // $sum_ranking_db=floatval($get_current_rank_result["sum_ranking"]);

  $user_point_rank=floatval($json_data[$p_id]);
  // echo $p_id  ;

  $new_rank=(($user_point_rank+ (($total_num_ranking-1)*$p_average_rank) )/$total_num_ranking);
  $new_rank=round($new_rank, 1);
  $update_average_ranking="update point_of_interest set point_of_interest.average_ranking=".$new_rank. " where point_of_interest.point_id=".$p_id;
  echo $update_average_ranking. "<br>";
  // mysqli_query($conn,$update_average_ranking);
}

// =======just for testing ajax_post_client.php===========================
function extract_data_to_json($query){
  global $conn;
  $data=array();
  mysqli_set_charset($conn,"utf8");
  $result=mysqli_query($conn,$query);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      $data[]=$row;
      // $data["point_description"]=
  }
}

  $json_string_data=json_encode($data);


  $result->free();
  // $conn->close();
  return $json_string_data;
}
//
// =======just for testing ajax_post_client.php===========================
 ?>
