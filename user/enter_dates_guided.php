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
  <div class="container">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="homepage_user.php">Home</a>
      </li>
      <li class="breadcrumb-item active">
        <a >Guided Tour</a>
      </li>
    </ol>

    <script src="script.js">  </script>

    <div class="container border">
      <h1><u>Enter Date Range For Existing Tours:</u></h1><br>
      <div class="row">
        <br>
        <div >
          <br>
          <form method="POST" action="Existing_guided_Tour.php">
            Starting Date: <input type="date" name="enter" style="border-radius:5px;" min="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>">
            <br>
            <br>
            <br>
            Finishing Date: <input type="date" name="finish"  style="border-radius:5px;"  min="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>">
            <br>
            <br>
            <br>
            <label for="accessible_radio" >Accessible: </label>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="accessible_yes" name="access" class="custom-control-input" value="1">
              <label class="custom-control-label" for="accessible_yes">Yes</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="accessible_no" name="access" class="custom-control-input" checked value="0">
              <label class="custom-control-label" for="accessible_no">No</label>
            </div>
            <br>
            <br>
            <div class="form-group row" >
              <div class="col-auto mr-auto">
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

</body>
</html>
