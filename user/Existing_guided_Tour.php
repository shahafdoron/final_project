<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php
      include("../db_conn.php");
        ?>

    <meta charset="utf-8">

    <link rel="stylesheet" href="style/innerWindow.css" type="text/css">
    <title></title>

<!--
    <u>
    <h2></h2>
  </u> -->
  </head>


  <body>
    <!-- <form action="/action_page.php"> -->


    <?php
    $enter_date=$_REQUEST['enter'];
    $finish_date=$_REQUEST['finish'];
    $is_access=$_REQUEST["access"];

    $query= "select tour.planned_date_and_time_tour, tour.tour_duration,tour.Description, guided_tour.group_size,
     guided_tour.currently_participants, guided_tour.registration_deadline,guided_tour.tour_cost
    FROM tour, guided_tour,guide where tour.tour_type=2 and tour.tour_ID=guided_tour.guided_tour_ID
    and tour.planned_date_and_time_tour BETWEEN '".	$enter_date."' and '".$finish_date."' and
     tour.is_acccessible_only=".$is_access." and (guided_tour.group_size-guided_tour.currently_participants < 0)";

    $result = $conn->query($query);

    $str="<div class=\"table-body\">";
    $counter=1;
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_array(MYSQLI_ASSOC))   {
        $remaining=(int)($row['guided_tour.group_size']-$row['guided_tour.currently_participants']);
        $cost=(float)$row['guided_tour.tour_cost'];
        $schedule=explode(" ",$row['tour.planned_date_and_time_tour']);
        $d=strtotime($schedule[0]);
        // $hour="14:00";
        $str.="<div class=\"container\">
    <div class=\"row\" style=\"border-style: solid; border-width: 1px; padding: 1px 4px\">

    	<table style=\"width: 100%\">
    	<tr>
				<td style=\"text-align: center\">Tour Number".$counter."</td>
				<td style=\"text-align: center\">Date: ".date( 'd/m/Y', $d ).", Hours:".$hour."</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td style=\"text-align: center\">cost:".$cost."<br><br>Remaining tickets:".$remaining." </td>
			</tr>
		</table>
		    <div class=\"btn\" style=\"text-align: center\"><input name=\"Submit1\" type=\"submit\" value=\"More information and booking\" ></div>
    </div>
    <div class='clear'></div>
    </div>";
    }
    $str.= "</div>";
    echo $str;
    $result->free();
    $conn->close();
    ?>

  </body>
</html>
