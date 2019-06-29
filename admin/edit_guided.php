<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <?php
  include("../db_conn.php");
  include("../user/algo.php");

  if(isset($_POST['create_tour'])) {
    setTourParameters();
    $group_size=$_REQUEST["group_size"];
    $deadline=$_REQUEST["registration_deadline"];

    // $_SESSION["tour_id_current"]
    $result=byPointAlgo($_SESSION["json_data"]);
    $sorted_json_points=nearest(json_decode($result,true));
    loadTourDetails($sorted_json_points);
    $generated_tour_id=$_SESSION["tour_id_current"];
    $guided_tour_query="insert into guided_tour (guided_tour_id, guide_id, group_size, registration_deadline, tour_cost, description) VALUES ('".$generated_tour_id."', '".$_POST['guides_select']."', '".$group_size."', '".$deadline."', '".$_REQUEST['tour_cost']."', '".$_REQUEST['description']."' )";
    // echo "<br><br><br><br><br><br><br>";
    // echo $guided_tour_query;
    mysqli_query($conn,$guided_tour_query);

  }
  ?>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">


  <title></title>
  <u>
  </u>
</head>
<body>
  <script src="../user/script.js">  </script>

  <?php include('navs.php'); ?>
  <div class="container border shadow p-3 mb-5 bg-white rounded">

    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="analytics.php">Statistical Analysis</a>
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
            <form method='post' id="tour_details_form" name="tour_details_form" action="">
              <div class="card">

                <div class="row mt-3">
                  <label for="tour_duration" class="col-2 col-form-label ml-3 " >Tour Duration (minutes):</label>
                  <div class=" col-3 ">
                    <!--  working!!!<input type="number" id="tour_duration_time" name="tour_duration_time" class="form-control" value="45" min="45" max="300" step="5" onKeyDown="return false" required > -->
                    <div class="row  ml-1">
                      <button id="minus_tour_duration_time" class="btn btn-light border" type="button" onclick="incrementInput('tour_duration_time','45','360','-5','positive','time_left_label')" ><i class="far fa-minus-square fa-lg"></i></button>
                      <input type="text"  id="tour_duration_time" name="tour_duration_time" class="form-control text-center w-25 border" value="45"  onkeydown="return false" required >
                      <button id="plus_ctour_duration_time" class="btn btn-light border" type="button" onclick="incrementInput('tour_duration_time','45','360','5','positive','time_left_label')" ><i class="far fa-plus-square fa-lg"></i></button>
                      <div class="col-1 ">
                        <i class="far fa-clock"></i>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row mt-3">
                  <label for="planned_tour_date_time" class="col-2 col-form-label ml-3 " >Tour Date and Time:</label>
                  <div class="col-3 ">
                    <input type="datetime-local" class="form-control w-100 " id="planned_tour_date_time" name="planned_tour_date_time" min="<?php  echo(date("Y-m-d")."T00:00"); ?>" step="1" required >
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
                    <select class='custom-select' name="guides_select" id='guides_select'>
                      <script>
                      showGuides("guides_select");
                      </script>
                    </select>
                  </div>
                  <div class="col-3 ml-5">
                    <label for="cost" class="col-6 col-form-label ">Tour Cost($):</label>
                  </div>
                  <div class="input-group-append col-3">
                    <input type="number" min=20 step=5 value="20" id="tour_cost" name="tour_cost" class="form-control w-50" placeholder="In Dollar" required >
                    <span class="input-group-text">$</span>
                  </div>
                </div>

                <div class="row mt-3">
                  <label for="registration_deadline" class="col-2 col-form-label ml-3" >Tour Registration Deadline:</label>
                  <div class="col-3">
                    <input type="datetime-local" class="form-control w-100 " id="registration_deadline" name="registration_deadline" min="<?php  echo(date("Y-m-d")."T00:00"); ?>" step="1" required >
                  </div>

                  <div class="col-3 ml-5">
                    <label for="group_size" class="col-7 col-form-label pl-2 " >Tour Group Size:</label>
                  </div>
                  <div class="col-sm">
                    <input type="number" min=15 step=5 value="15" id="group_size" name="group_size" class="form-control w-25 "  required >
                  </div>
                </div>

                <div class="row mt-3">
                  <label for="cafeteria_radio" class="col-3 col-form-label ml-3">Cafeteria:</label>

                  <div class="custom-control custom-radio custom-control-inline mt-1 ">
                    <input type="radio" id="cafeteria_yes" name="cafeteria" class="custom-control-input" onchange="document.getElementById('cafeteria_time_div').style.visibility='visible' ;" value="1"  onkeydown="return false">
                    <label class="custom-control-label" for="cafeteria_yes">Yes</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline mt-1">
                    <input type="radio" id="cafeteria_no" name="cafeteria" class="custom-control-input" checked onchange="document.getElementById('cafeteria_time_div').style.visibility='hidden';" value="0">
                    <label class="custom-control-label" for="cafeteria_no">No</label>
                  </div>
                  <div id="cafeteria_time_div" class="custom-control custom-radio custom-control-inline " style="visibility:hidden">
                    <!-- working!! <input type="number" id="cafeteria_time" name="cafeteria_time" class="form-control" value="0" min="0" max="25" step="5"  style="visibility:hidden" required > -->

                    <button id="minus_cafeteria_time" class="btn btn-light border" type="button" onclick="incrementInput('cafeteria_time','0','25','-5','negative','time_left_label')" ><i class="far fa-minus-square fa-lg"></i></button>
                    <input type="text"  id="cafeteria_time" name="cafeteria_time" class="form-control text-center w-25 border" value="0"   required >
                    <button id="plus_cafeteria_time" class="btn btn-light border" type="button" onclick="incrementInput('cafeteria_time','0','25','5','negative','time_left_label')" ><i class="far fa-plus-square fa-lg"></i></button>
                  </div>
                </div>

                <div class="row mt-3">

                  <label for="description" class="col-2 col-form-label ml-3" >Tour Discription: </label>
                  <div class="col-3">
                    <textarea name="description" class="form-control" id="description" rows="3" required></textarea>
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
                              <th class="text-center">Point Category</th>
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
                  <button type="submit" class="btn btn-primary btn-lg" name="create_tour" onclick="formHandler()"style="width:250px;">Create Tour</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <script>
        function formHandler(){
          var json_data="";
          var ready_for_submit=true;
          var validation={};
          if (validateGeneralInputs()) {
            validation=validateBypoints();
            if (validation["validation_test"]) {
              document.tour_details_form.action='edit_guided.php?json_data='+ validation["json_data"];
            }
          }
        }
        </script>

        <div id="enter_dates" class="tab-pane fade in active">
          <div class="container border  p-3 mb-5 bg-white rounded">
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
