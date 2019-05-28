<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <?php
  include("../db_conn.php");
  if(isset($_POST['enter'])){
    $_SESSION['enter_date']=$_REQUEST['enter'];
    $_SESSION['finish_date']=$_REQUEST['finish'];
    $_SESSION['is_access']=$_REQUEST['access'];
    $query= "select user.first_name as guide_first, user.last_name as guide_last,DATE_FORMAT(date(tour.planned_date_and_time_tour),'%d-%m-%Y') As tour_date,Time_Format(time(tour.planned_date_and_time_tour),
    '%k:%i') as Start_time ,tour.tour_duration,TIME_FORMAT(time(DATE_ADD(tour.planned_date_and_time_tour, INTERVAL tour.tour_duration MINUTE)),'%k:%i') as Finish_Time,guided_tour.description,
    (guided_tour.group_size-tour.participants) as remaining_tickets, guided_tour.registration_deadline,guided_tour.tour_cost,guided_tour.guided_tour_id,tour.participants
    FROM tour,guided_tour,guide,user
    where tour.tour_type=2 and tour.tour_id=guided_tour.guided_tour_id
    and tour.planned_date_and_time_tour BETWEEN SUBDATE('".$_SESSION['enter_date']."', INTERVAL 1 DAY) and Date_ADD('".$_SESSION['finish_date']."', INTERVAL 1 DAY) and
    tour.is_acccessible_only=".$_SESSION['is_access']." and (guided_tour.group_size-tour.participants)>0 and guided_tour.registration_deadline > NOW()and guide.guide_id=user.user_id and user.user_type=2";
    // echo $query;
    // $query_current= "select participants FROM tour WHERE tour_id=".$json_data['tour_id']."";
    $_SESSION['data']=extract_data_to_json($query);

  }



  ?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> -->
  <title></title>
  <u>
    <!-- <h2>Enter date range for existing tours</h2> -->
  </u>
</head>
<body>
  <script src="../user/script.js">  </script>

  <?php include('navs.php'); ?>

  <div class="container border shadow p-3 mb-5 bg-white rounded">



    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="analytics.php.php">Statistical Analysis</a>
      </li>
      <li class="breadcrumb-item"><a href="edit_guided.php" >Guided Tours Administration</a>
      </li>
      <li class="breadcrumb-item active"><a>Edit Existing Guided Tours</a>
      </li>
    </ol>


    <div class="container shadow p-3 mb-5 bg-white rounded border">
      <h2 style="text-align: center;"><u>Guided Tours In The Selected Dates</u></h2><br>

      <div id=container class="container">
        <script>

        concatenateGuidedTours(<?php print_r($_SESSION['data']); ?>,<?php echo $_SESSION['user_type']; ?>);
        </script>
      </div>
    </div>

  </div>


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</body>
</html>
