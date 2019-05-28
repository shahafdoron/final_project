<!DOCTYPE html>
<?php
$point=$_REQUEST['point'];
$data=json_decode($point,true);


?>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title></title>    <title></title>
</head>
<body>
  <?php include('navs.php');  ?>

  <div class="container">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="analytics.php">Statistical Analysis</a>
      </li>
      <li class="breadcrumb-item active">
        <a href="points_info.php">Points Information</a>
      </li>
      <li class="breadcrumb-item active">Point Description</li>
    </ol>




    <div class="card w-100 h-100 shadow p-3 mb-5 bg-white rounded">
      <div class='card-header w-100 h-100  border'>
        <h2 class="card-title text-center"><u><?php echo $data["name"]; ?></u></h2>
      </div>
      <img class="card-img-top img-responsive text-center border " src="../images/points/<?php echo $data["point_id"].".jpg"; ?>"   >
      <div class='card-header w-100 h-100  border'>
        <div class="row">
          <div class="col-4 ">
            <h3 class="card-title text-left">Average ranking: <?php echo $data["average_ranking"]; ?></h3>
          </div>
          <div class="col-5 ">
          <h3 class="card-title text-left">Average time (minutes): <?php echo $data["average_time_minutes"]; ?></h3>
          </div>
          <div class="col-3">
          <h3 class="card-title text-left">Accessiblity: <?php echo $data["is_accessible"]; ?></h3>
          </div>
        </div>

      </div>
      <div class="card-body card-footer d-flex flex-column border">
        <h4 class="card-subtitle mt-3">Description</h5>
        <p class="card-text text-left mt-3" style="font-size:20px;"><?php echo $data["point_description"]; ?></p>
      </div>
    </div>
  </div>




  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
