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
    $tour=json_decode($_REQUEST['tour'],true);
    $_SESSION["tour"]=$tour;
    $counter=$_REQUEST['counter'];
    $_SESSION["counter"]=$counter;
  }

  ?>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <?php include('navs.php'); ?>

</head>

<body>

  <div class="container  shadow p-3 mb-5 bg-white rounded border">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="homepage_user.php">Home</a>
      </li>
      <li class="breadcrumb-item active">
        <a href="enter_dates_guided.php">Select Date For The Guided Tours</a>
      </li>
      <li class="breadcrumb-item active">
        <a href="Existing_guided_Tour.php">Guided Tours</a>
      </li>
      <li class="breadcrumb-item active">
        <a >Guided Tour Information And Booking</a>
      </li>
    </ol>
    <div class="container shadow p-3 mb-5 bg-white rounded border">

      <div class='card w-100 h-50 mb-24 p-2'>
        <div class='card-header body align-items-center d-flex justify-content-center'><u><h5>Tour Number <?php echo $counter; ?></h5></u></div>
        <div class='card-body align-items-center d-flex justify-content-center'>
          <div class="container">
            <div class="row">
              <div class="col-sm">
                <p class='card-text align-items-center d-flex justify-content-center'>  Guide: <?php echo $tour['guide_first']." ".$tour['guide_last']; ?></p>
              </div>
              <div class="col-sm">
                <p class='card-text align-items-center d-flex justify-content-center'> Tour duration: <?php echo floatval ($tour['tour_duration'])." Minutes."; ?></p>
              </div>
            </div>
            <br>
            <div class=".col-md-6">
              <u><p class='card-text align-items-center d-flex justify-content-center'> Tour description: </p></u>
              <p class='card-text align-items-center d-flex justify-content-center mt-1'><?php echo $tour['description']."."; ?></p>
            </div>
          </div>
        </div>
      </div>
      <form method='post' action="">

        <div class="card-footer align-items-center d-flex justify-content-center">
          <div class="container">
            <div class="row justify-content-center mt-1">
              <div class=".col-md-9" style='color: red;'><b>Remaining tickets: <?php echo $tour['remaining_tickets']; ?></b></div>
            </div>
            <div class="row justify-content-center mt-1">
              <div class=".col-md-9">Ticket cost (price per unit): <?php echo $tour['tour_cost'].' ₪'; ?></div>
            </div>

            <div class="row justify-content-center mt-1">
              <div class=".col-md-6 ">Tickets to purchase: <input name="Ticket" type="text" style="width: 100px" required oninvalid="this.setCustomValidity('Please Enter Number Of Tickets')"/></div>
            </div>

            <?php
            if(isset($_POST['Ticket'])){
              if(floatval($_POST['Ticket'])>floatval($tour['remaining_tickets'])){
                echo "<h3 align='center' style='color: red;'>There's Not Enough Tickets! </h3>";
              }
              else
              {
                $tour=$_SESSION["tour"];
                $couner=$_SESSION["counter"];
                $query="insert into guided_tour_registration (guided_tour_id, registered_tourist_id, subscribers, registration_date) VALUES (".$tour['guided_tour_id'].", ".$user_id.", ".$_POST['Ticket'].", NOW())";
                $query2="update tour SET participants = ".(floatval($tour['participants'])+floatval($_POST['Ticket']))." WHERE tour_id = ".$tour['guided_tour_id']."";
                $conn->query($query);
                $conn->query($query2);
                $conn->close();
                echo "<h3 align='center'> You Been Successfully Booked To The Tour </h3>";
              }
            }
            ?>

            <br>
            <div class="row justify-content-center">
              <input class='btn btn-primary btn-lg btn-block' type='submit' value='Book Tour'>
              <div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
