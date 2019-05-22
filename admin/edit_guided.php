<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <?php
  include("../db_conn.php");
  if(isset($_POST['create_tour'])) {
     $cafeteria=0;
    $input = $_POST['planned_date_and_time_tour'];
    $date = strtotime($input);
    $planned=date('Y-m-d h:i:s', $date);
    if($_REQUEST['cafeteria']=="1"){
      $cafeteria=intval($_REQUEST['cafeteria_time']);
    }
    $tour_query="insert into tour (planned_date_and_time_tour, tour_duration, is_acccessible_only, is_cafeteria, cafeteria_time, participants, tour_type) VALUES ('".$planned."', ".$_POST['tour_duration_time'].", ".$_POST['accessible'].", ".$_POST['cafeteria'].", ".$cafeteria.", 0 , 2)";
    mysqli_query($conn,$tour_query);
    $deadline = $_POST['registration_deadline'];
    $until = strtotime($deadline);
    $registration_deadline=date('Y-m-d h:i:s', $until);
    $generated_tour_id=mysqli_insert_id($conn);
    $guided_tour_query="insert into guided_tour (guided_tour_id, guide_id, group_size, registration_deadline, tour_cost, description) VALUES ('".$generated_tour_id."', ".$_POST['guides_select'].", ".$_POST['participants'].", ".$registration_deadline.", ".$_POST['tour_cost'].", ".$_POST['description']." )";

  }
  ?>
  <!-- //   if(floatval($_POST['Ticket'])>floatval($tour['remaining_tickets'])){
  //     echo "<h3 align='center' style='color: red;'>There's Not Enough Tickets! </h3>";
  //   }
  //   else
  //   {
  //     $tour=$_SESSION["tour"];
  //     $couner=$_SESSION["counter"];
  // $query="insert into guided_tour_registration (guided_tour_id, registered_tourist_id, subscribers, registration_date) VALUES (".$tour['guided_tour_id'].", ".$user_id.", ".$_POST['Ticket'].", NOW())";
  //     $query2="update tour SET participants = ".(floatval($tour['participants'])+floatval($_POST['Ticket']))." WHERE tour_id = ".$tour['guided_tour_id']."";
  //     $conn->query($query);
  //     $conn->query($query2);
  //     $conn->close();
  //     echo "<h3 align='center'> You Been Successfully Booked To The Tour </h3>";
  //   }
  // } -->

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">


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
        <a href="homepage_admin.php">Home</a>
      </li>
      <li class="breadcrumb-item active"><a >Guided Tours Administration</a>
      </li>
    </ol>

    <div class="container shadow p-3 mb-5 bg-white rounded border">
      <h1 ><u>Guided Tours Administration</u></h1><br>

      <nav class="nav nav-pills flex-column flex-sm-row ">
        <a class="flex-sm-fill text-sm-center nav-link rounded border" data-toggle="tab"  href="#enter_dates" onclick="">Edit Existing Tours</a>
        <a class="flex-sm-fill text-sm-center nav-link rounded border" data-toggle="tab"  href="#create_tour_div" onclick="">Create New Tour</a>
      </nav>
      <div class="tab-content mt-3">
        <div id="create_tour_div" class="tab-pane fade in active">
          <div class="form-group">
            <form method='POST' action="">
              <div class="card">

                <div class="row mt-3 ">

                  <div class="col-2 mr-3  ml-3 ">
                    <label for="tour_tour_Duration" class="col-form-label" >Tour Duration:</label>
                  </div>
                  <div class="row  ">

                    <div class="col">
                      <input type="number" id="tour_duration_time" name="tour_duration_time" class="form-control" value="45" min="45" max="300" step="5" onKeyDown="return false" required  >
                    </div>
                    <div class="col-1 ">
                      <i class="fas fa-stopwatch"></i>
                    </div>
                  </div>
                </div>

                <div class="row mt-3">
                  <label for="planned_date_and_time_tour" class="col-2 col-form-label ml-3 " >Tour Date and Time:</label>
                  <div class="col-3">
                    <input type="datetime-local" class="form-control w-100 " id="planned_date_and_time_tour" name="planned_date_and_time_tour" min="<?php  echo(date("Y-m-d")."T00:00"); ?>" step="1" required >
                  </div>

                  <div class="col-3 ml-5">
                    <label for="accessible_radio" class="col-6 col-form-label ">Accessibility:</label>
                  </div>
                  <div class="col-3 mt-2" id="accessible_radio">
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" id="accessible_yes" name="accessible" class="custom-control-input" value="1">
                      <label class="custom-control-label" for="accessible_yes">Yes</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" id="accessible_no" name="accessible" class="custom-control-input" value="0"checked >
                      <label class="custom-control-label" for="accessible_no">No</label>
                    </div>
                  </div>

                </div>
                <div class="row mt-3">
                  <label for="guide_name" class="col-2 col-form-label ml-3" >Guide:</label>
                  <div class="col-3">
                    <select class='custom-select' id='guides_select'>
                      <script>
                      showGuides("guides_select");
                      </script>
                    </select>
                  </div>
                  <div class="col-3 ml-5">
                    <label for="cost" class="col-6 col-form-label ">Tour Cost($):</label>
                  </div>
                  <div class="input-group-append col-3">
                    <input type="number" min=0 step=5 value="10" id="tour_cost" name="tour_cost" class="form-control w-50" placeholder="In Dollar" required >
                    <span class="input-group-text">$</span>
                  </div>
                </div>

                <div class="row mt-3">
                  <label for="cafeteria_radio" class="col-2 col-form-label ml-3">Cafeteria:</label>

                  <div class="custom-control custom-radio custom-control-inline ml-4 mt-2">
                    <input type="radio" id="cafeteria_yes" name="cafeteria" class="custom-control-input" onchange="document.getElementById('cafeteria_time').style.visibility='visible' ;" value="1" >
                    <label class="custom-control-label" for="cafeteria_yes">Yes</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline mt-2">
                    <input type="radio" id="cafeteria_no" name="cafeteria" class="custom-control-input" checked onchange="document.getElementById('cafeteria_time').style.visibility='hidden';" value="0">
                    <label class="custom-control-label" for="cafeteria_no">No</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline  ">
                    <input type="number" id="cafeteria_time" name="cafeteria_time" class="form-control" value="0" min="0" max="25" step="5"  style="visibility:hidden" required >
                  </div>

                  <div class="col-3 ml-5">
                    <label for="participants" class="col-7 col-form-label pl-2 " >Tour Group Size:</label>
                  </div>
                  <div class="col-sm">
                    <input type="number" min=0 step=5 value="10" id="participants" name="participants" class="form-control w-25 "  required >
                  </div>
                </div>

                <div class="row mt-3">
                  <label for="registration_deadline" class="col-2 col-form-label ml-3" >Tour Registration Deadline:</label>
                  <div class="col-3">
                    <input type="datetime-local" class="form-control w-100 " id="registration_deadline" name="registration_deadline" min="<?php  echo(date("Y-m-d")."T00:00"); ?>" step="1" required >
                  </div>
                  <div class="col-4 ml-5">
                    <label for="guide_name" class="col-6 col-form-label" >Tour Discription: </label>
                    <input type="text" name="description" class="form-control w-100 h-100 ml-3" placeholder="Enter tour Discription" required>
                  </div>

                </div>
                <div class="row mt-3">
                  <div class="col-3">
                  </div>
                </div>

                <br>
                <h5 class=" m-3"><u>Add Points:</u></h5>
              </div>
              <div class="container shadow p-3 mb-5 bg-white rounded border">
                <div class="row mt-3">
                  <div class="col-auto mr-auto">
                    <select class='custom-select' id='categories_by_points_option'  onchange="createSelectPoints('categories_by_points_option','div_by_points','table_points')"><script>showCategory("categories_by_points_option");</script></select><br>
                  </div>
                  <div class="col md-4" >
                    <h4  class="btn btn-light btn-md"> <span id="time_left_label" class="badge badge-pill "><script>setTimeLeft(); </script></span></h4>

                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-auto mr-auto" id="div_by_points"></div>
                </div>
                <div class="row mt-3">
                  <div class="col-auto mr-auto" id="divpoints_ta">
                    <div class="card  border-0">

                      <div class="card-body">
                        <div id="table" class="table">
                          <table class="table table-bordered table-responsive-md table-striped text-center shadow p-3 mb-5 bg-white rounded" id="table_points">
                            <tr>
                              <th class="text-center">Point Name</th>
                              <th class="text-center">Average Time (Minutes)</th>
                              <th class="text-center">Average Ranking</th>
                              <th class="text-center">Remove</th>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="mb-5  row justify-content-center">
                  <button type="submit" class="btn btn-primary btn-lg" name="create_tour" style="width:250px;">Create Tour</button>
                </div>
              </div>
            </form>
          </div>
        </div>


        <div id="enter_dates" class="tab-pane fade in active">
          <div class="container border shadow p-3 mb-5 bg-white rounded">
            <div class="row">
              <div class="form-group p-3 ">


                <form method="POST" action="edit_existing_guided.php">
                  <div class="form-group row">
                    <label for="enter"  class="col-md col-form-label" >  Starting Date: </label>
                    <div class="col-md">
                      <input type="date" name="enter" class="form-control" style="border-radius:5px;" min="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>">
                      <!-- <input type="text" class="form-control" id="tour_duration_time" name="tour_duration_time" placeholder="Enter time in minutes..."  required> -->
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="finish"  class="col-md col-form-label" >Finishing Date: </label>
                    <div class="col-md">
                      <input type="date" class="form-control" name="finish"  style="border-radius:5px;"  min="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-5 col-form-label" for="accessible_radio" >Accessibility: </label>
                    <div class="custom-control custom-radio custom-control-inline mt-1">
                      <input type="radio" id="yes" name="access" class="custom-control-input"  value="1">
                      <label class="custom-control-label" for="yes">Yes</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline mt-1">
                      <input type="radio" id="no" name="access" class="custom-control-input" checked value="0">
                      <label class="custom-control-label" for="no">No</label>
                    </div>
                  </div>
                  <div class="form-group row" >
                    <div class="col-auto mr-auto mt-3">
                      <input class="btn btn-primary" type="submit" name="check_dates" value="Check Dates">
                    </div>
                  </div>
                  <br>
                </div>
              </form>
            </div>
          </div>
        </div>


      </div>
    </div>
  </div>



  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
