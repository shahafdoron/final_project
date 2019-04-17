<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php
      include("../db_conn.php");

        $enter_date=$_REQUEST['enter'];
        $finish_date=$_REQUEST['finish'];
        $is_access=$_REQUEST["access"];


        $query= "select DATE_FORMAT(date(tour.planned_date_and_time_tour),'%d-%m-%Y') As tour_date,Time_Format(time(tour.planned_date_and_time_tour),
        '%k:%i') as Start_time ,tour.tour_duration,TIME_FORMAT(time(DATE_ADD(tour.planned_date_and_time_tour, INTERVAL tour.tour_duration MINUTE)),'%k:%i') as Finish_Time,
        tour.Description,(guided_tour.group_size-guided_tour.currently_participants) as remaining_tickets, guided_tour.registration_deadline,guided_tour.tour_cost
        FROM tour,guided_tour,guide
        where tour.tour_type=2 and tour.tour_ID=guided_tour.guided_tour_ID
        and tour.planned_date_and_time_tour BETWEEN '".	$enter_date."' and '".$finish_date."' and
        tour.is_acccessible_only=".$is_access." and (guided_tour.group_size-guided_tour.currently_participants > 0) and
        (guided_tour.group_size-guided_tour.currently_participants)>0 and guided_tour.registration_deadline > NOW()";
        $result = $conn->query($query);

        $dbdata = array();

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
          $dbdata[]=$row;


        $query= "select user.first_name as guide_first, user.last_name as guide_last,DATE_FORMAT(date(tour.planned_date_and_time_tour),'%d-%m-%Y') As tour_date,Time_Format(time(tour.planned_date_and_time_tour),
        '%k:%i') as Start_time ,tour.tour_duration,TIME_FORMAT(time(DATE_ADD(tour.planned_date_and_time_tour, INTERVAL tour.tour_duration MINUTE)),'%k:%i') as Finish_Time,guided_tour.description,
        guided_tour.short_desc,(guided_tour.group_size-guided_tour.currently_participants) as remaining_tickets, guided_tour.registration_deadline,guided_tour.tour_cost,guided_tour.guided_tour_id,guided_tour.currently_participants
        FROM tour,guided_tour,guide,user
        where tour.tour_type=2 and tour.tour_id=guided_tour.guided_tour_id
        and tour.planned_date_and_time_tour BETWEEN '".	$enter_date."' and '".$finish_date."' and
        tour.is_acccessible_only=".$is_access." and (guided_tour.group_size-guided_tour.currently_participants)>0 and guided_tour.registration_deadline > NOW()and guide.guide_id=user.user_id and user.user_type=2";
        $data=extract_data_to_json($query);

        ?>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style/innerWindow.css" type="text/css">
    <title></title>
  </head>

  <body>
    <script src="script.js">  </script>
    <div id=container class=container>
    </div>

    <script>
    // var data=
    // console.log(data);
    concatenateGuidedTours(<?php echo $data; ?>);
   </script>


    <script>
    var db= (<?php echo json_encode($dbdata); ?>);
    var counter=1;
    var txt="";
    for (i=0;i<db.length;i++){
      txt+="<form method='POST' action='guided_info_book.php?tour="+JSON.stringify(db[i])+"'>";
      txt+="<div class='row' style='border-style: solid; border-width: 1px; padding: 1px 4px'>";
      txt+="<table style='width: 100%'>";
      txt+="<tr>";
      txt+="<td style='text-align: center; text-decoration: underline;'>Tour number "+counter+"</td>";
      txt+="<td style='text-align: center'>Date : "+db[i].tour_date+", Hours: "+db[i].Start_time+"-"+db[i].Finish_Time+"</td></tr>";
      txt+="<tr><td>&nbsp;</td>";
      txt+="<td style='text-align: center'>Cost: "+db[i].tour_cost+"₪ <br><br>Remaining tickets: "+db[i].remaining_tickets+" Tickets</td></tr></table>";
      txt+="<div class='btn' style='text-align: center'><input name='Submit1' type='submit' value='More information and booking' ></div>";
      txt+="</div><div class='clear'></div></form>";
      counter+=counter;

    }
      document.getElementById("container").innerHTML=txt;
    </script>

    <?php
    $result->free();
    $conn->close();
    ?>

  </body>
</html>
