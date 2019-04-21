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
        <a href="enter_dates_guided.php">Guided Tour</a>
      </li>
    </ol>
  </div>

  <script src="script.js">  </script>

  <div class="container">
    <h2>Enter date range for existing tours</h2>
    <br>
    <div >
      <form action="Existing_guided_Tour.php">
        Starting Date:<input type="date" name="enter" min="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>">
      </div>
      <br>
      <br>
      <br>
      Finishing Date: <input type="date" name="finish" min="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>">
      <br>
      <br>
      <br>
      Accessibility:
      <input type="radio" name="access" value="1" > Yes
      <input type="radio" name="access" value="0" checked="checked"> No
      <br>
      <br>
      <br>
      <input class="btn btn-primary" type="submit" value="Submit">
    </form>
  </div>
</div>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

</body>
</html>
