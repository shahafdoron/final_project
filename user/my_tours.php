<?php
session_start();
$email= $_SESSION['emailAddress'];
$user_id=$_SESSION["user_id"];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <title></title>
</head>
<body>

  <script src="script.js">  </script>

  <?php include('navs.php'); ?>

  <div class="container border shadow p-3 mb-5 bg-white rounded">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="homepage_user.php">Home</a>
      </li>
      <li class="breadcrumb-item active">My Tours</li>
    </ol>
    <div class="container border shadow p-3 mb-5 bg-white rounded">
    <h2><u>My Tours</u></h2><br>
    <nav class="nav nav-pills flex-column flex-sm-row">
      <a class="flex-sm-fill text-sm-center nav-link active" data-toggle="tab"  href="#" onclick="showMySchedule('>','0',<?php echo $user_id; ?>,'my_tours_schedule')">My future</a>

      <a class="flex-sm-fill text-sm-center nav-link" data-toggle="tab"  href="#" onclick="showMySchedule('<','1',<?php echo $user_id; ?>,'my_tours_schedule')">My past tours</a>
    </nav>

  <div >
    <div id="my_tours_schedule" > </div>
  </div>
</div>
  </div>
  <script type="text/javascript">
    showMySchedule('>','0',<?php echo $user_id; ?>,'my_tours_schedule');
  </script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
