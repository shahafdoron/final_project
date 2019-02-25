<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php
      include("../db_conn.php");
        ?>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style/innerWindow.css" type="text/css">
    <title></title>
  </head>

  <body>
    <script src="script.js">  </script>


    <?php
      $enter_date=$_REQUEST['enter'];
      $finish_date=$_REQUEST['finish'];
      $is_access=$_REQUEST["access"];
// להוסיף לשאילתה את היוזר ואת המדריך
      $query= "select DATE_FORMAT(date(tour.planned_date_and_time_tour),'%d-%m-%Y') As tour_date,Time_Format(time(tour.planned_date_and_time_tour),
      '%k:%i') as Start_time ,tour.tour_duration,TIME_FORMAT(time(DATE_ADD(tour.planned_date_and_time_tour, INTERVAL tour.tour_duration MINUTE)),'%k:%i') as Finish_Time,
      tour.Description,(guided_tour.group_size-guided_tour.currently_participants) as remaining_tickets, guided_tour.registration_deadline,guided_tour.tour_cost
      FROM tour,guided_tour,guide
      where tour.tour_type=2 and tour.tour_ID=guided_tour.guided_tour_ID
      and tour.planned_date_and_time_tour BETWEEN '".	$enter_date."' and '".$finish_date."' and
      tour.is_acccessible_only=".$is_access." and (guided_tour.group_size-guided_tour.currently_participants)>0 and guided_tour.registration_deadline > NOW()";
      $data=extract_data_to_json($query);
    ?>

    <div id=container class=container>
    </div>

    <script>
    // var data=
    // console.log(data);
    concatenateGuidedTours(<?php echo $data; ?>);
   </script>


  </body>
</html>
