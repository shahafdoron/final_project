<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php
      include("../db_conn.php");
        ?>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../user/style/innerWindow.css" type="text/css">
    <title></title>
  </head>

  <body>
    <script src="script.js">  </script>


    <?php
      $enter_date=$_REQUEST['enter'];
      $finish_date=$_REQUEST['finish'];
      $is_access=$_REQUEST["access"];

      $query= "select user.first_name as guide_first, user.last_name as guide_last,DATE_FORMAT(date(tour.planned_date_and_time_tour),'%d-%m-%Y') As tour_date,Time_Format(time(tour.planned_date_and_time_tour),
      '%k:%i') as Start_time ,tour.tour_duration,TIME_FORMAT(time(DATE_ADD(tour.planned_date_and_time_tour, INTERVAL tour.tour_duration MINUTE)),'%k:%i') as Finish_Time,guided_tour.description,
      guided_tour.short_desc,(guided_tour.group_size-guided_tour.currently_participants) as remaining_tickets, guided_tour.registration_deadline,guided_tour.tour_cost,guided_tour.guided_tour_id,guided_tour.currently_participants
      FROM tour,guided_tour,guide,user
      where tour.tour_type=2 and tour.tour_id=guided_tour.guided_tour_id
      and tour.planned_date_and_time_tour BETWEEN '".	$enter_date."' and '".$finish_date."' and
      tour.is_acccessible_only=".$is_access." and (guided_tour.group_size-guided_tour.currently_participants)>0 and guided_tour.registration_deadline > NOW()and guide.guide_id=user.user_id and user.user_type=2";
      $data=extract_data_to_json($query);
    ?>

    <div id=container class=container>
    </div>

    <script>
    // concatenateGuidedTours(<?php echo $data; ?>);
   </script>


  </body>
</html>
