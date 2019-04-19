<!DOCTYPE html>
<?php
$point=$_REQUEST['point'];
// $point = html_entity_decode($jsonText);
$data=json_decode($point);

?>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title></title>    <title></title>
</head>
<body>
  <?php include('navs.php');  ?>;


  <div class="container">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="test.php">Home</a>
      </li>
      <li class="breadcrumb-item active">
        <a href="points_info.php">Points Information</a>
      </li>
      <li class="breadcrumb-item active">Point Description</li>
    </ol>
    <br><br>
    <section class="card">
      <div class="card-body text-center">
        <h2 class="card-title"><?php echo $data->{'name'}; ?></h2>
        <br>
        <img class="card-img-top img-responsive text-center" src="wolfson.jpg" style="width: 18rem; "  >
        <br><br>
        <section class="card">
          <br>
          <h5 class="card-subtitle">Description</h5>
          <p class="card-text"><?php echo $data->{'description'}; ?></p>
          <br><br>
        </section>
      </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
  </html>
