<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php
    include("../db_conn.php");
    // session_start();
    $user_id=$_SESSION["user_id"];

    $tour='';
    $counter=0;
    if(isset($_REQUEST['tour'])&&isset($_REQUEST['counter'])){
      $tour=json_decode($_REQUEST['tour']);
      $_SESSION["tour"]=$tour;
      $counter=$_REQUEST['counter'];
      $_SESSION["counter"]=$counter;
    }

     ?>
    <meta charset="utf-8">
      <link rel="stylesheet" href="style/innerWindow.css" type="text/css">
      <title>Untitled 2</title>
  <style type="text/css">
  .auto-style3 {
  	border-style: solid;
  	border-width: 1px;
  	padding: 1px 4px;
  }
  .auto-style4 {
  	text-align: center;
  }
  .auto-style5 {
  	margin-left: 20px;
  }
  </style>
  </head>

  <body>

  <div>
  	<div class="auto-style4">
  <span>Tour Number <?php echo $counter; ?></span>
  <br></br>
  		<span>Ticket cost: <?php echo $tour->tour_cost.' ₪'; ?></span> <br />

  </div>

  <div class="auto-style3">
  <div class="auto-style5">
  <div class="auto-style5"><br/>
  Guide: <?php echo $tour->guide_first." ".$tour->guide_last; ?></div>
  <div class="auto-style5"><br/>
  Tour description: <?php echo $tour->description."."; ?></div>
  <div class="auto-style5"><br/>
    Tour duration: <?php echo floatval ($tour->tour_duration)." Minutes."; ?></div>
  <div class="auto-style5"><br/>
    <form method='post' action="">
      <div>
      </div>
  Number of tickets to purchase: <input name="Ticket" type="text" style="width: 50px" required oninvalid="this.setCustomValidity('Please a password')"/></div><br>
  <?php
  if(isset($_POST['Ticket'])){
    if(floatval($_POST['Ticket'])>floatval ($tour->remaining_tickets)){
    echo "There's Not Enough Tickets";
    }
    else
    {
    $tour=$_SESSION["tour"];
    $couner=$_SESSION["counter"];
    $query="insert into guided_tour_registration (guided_tour_id, registered_tourist_id, subscribers, registration_date) VALUES (".$tour->guided_tour_id.", ".$user_id.", ".$_POST['Ticket'].", NOW())";
    $query2="update guided_tour SET currently_participants = ".(floatval($tour->currently_participants)+floatval($_POST['Ticket']))." WHERE guided_tour_id = ".$tour->guided_tour_id."";
    $conn->query($query);
    $conn->query($query2);
    $conn->close();
    echo "You been successfully booked to the tour";
  }
  }
  ?>
  <div class="auto-style4"><br/><input name="Submit1" type="submit" value="Book Tickets" />

  </div>
  </div>
  </div>

  </div>
</form>
  </body>

  </html>
