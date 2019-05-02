<!DOCTYPE html>
<?php
// session_start();// $user_id=$_SESSION["user_id"];
// $tour_id=$_SESSION["tour_id_current"];
// $query='insert into feedback (tour_id, user_id) VALUES ('.$tour_id.','.$user_id.')';
$get_current_rank_query='select point_feedback.point_id,COUNT(point_feedback.point_id) as number_ranking , point_of_interest.average_ranking ';
$get_current_rank_query.='from point_feedback ,point_of_interest ';
$get_current_rank_query.='where point_feedback.point_id=point_of_interest.point_id GROUP BY point_feedback.point_id ';
 ?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h3 id="y"></h3>

    <script type="text/javascript">
    // var query="SELECT * FROM point_of_interest,category WHERE point_of_interest.category_id=category.category_id AND category.cat_name='Sculptures'";
  //   for (var i=0; i<72;i++){
  //   var query="SELECT * FROM point_of_interest WHERE point_of_interest.point_id="+i;
  //   var url="yotam_server.php?query="+query;
  //   var txt=callAjax(url,f);
  // }
  // var query=

  var query="select point_feedback.point_id,COUNT(point_feedback.point_id) as 'number_ranking' , sum(point_feedback.point_ranking) as 'sum_ranking',point_of_interest.average_ranking from point_feedback ,point_of_interest where point_feedback.point_id=point_of_interest.point_id GROUP BY point_feedback.point_id ;"
  console.log(query);
  callAjax('../ajax_post_management.php?query='+query,fu);



  function callAjax(url,func){
    var request = new XMLHttpRequest();
    request.open("GET",url);
    // request.setRequestHeader('X-Requested-With','XMLHttpRequest');
    request.onreadystatechange = function() {
      if ((request.readyState==4) & (request.status==200)){
        // console.log(request.responseText);
        var json_data=request.responseText;
        func(json_data);
      }
    }
    request.send();
  }
    function fu(json_data){
      document.getElementById("y").innerHTML+=json_data;
      console.log(json_data);
    }
    </script>
  </body>
</html>
