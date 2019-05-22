<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <title></title>
  <u>
  </u>
</head>
<body>
  <?php include('navs.php'); ?>
  <div class="container border shadow p-3 mb-5 bg-white rounded">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="homepage_user.php">Home</a>
      </li>
      <li class="breadcrumb-item active">
        <a >Guided Tour</a>
      </li>
    </ol>

    <script src="script.js">  </script>

    <div class="container border shadow p-3 mb-5 bg-white rounded">
      <h1><u>Enter Date Range For Existing Tours:</u></h1><br>
      <div class="row">
        <br>
        <div >
          <br>
          <div class="form-group p-3 ">


          <form method="POST" action="Existing_guided_Tour.php">
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
              <input type="radio" id="accessible_yes" name="access" class="custom-control-input" value="1">
              <label class="custom-control-label" for="accessible_yes">Yes</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline mt-1">
              <input type="radio" id="accessible_no" name="access" class="custom-control-input" checked value="0">
              <label class="custom-control-label" for="accessible_no">No</label>
            </div>
          </div>


            <div class="form-group row" >
              <div class="col-auto mr-auto mt-3">
                <input class="btn btn-primary" type="submit" name="check_dates" value="Check Dates">
              </div>
            </div>
            <br>
          </div>
        </div>
      </form>
    </div>
    </div>
  </div>
</div>

</body>
</html>
