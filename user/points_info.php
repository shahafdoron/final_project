<!DOCTYPE html>
<?php
include("../db_conn.php");

?>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title></title>
</head>
<script src="script.js">  </script>
<body >
  <?php include('navs.php'); ?>

  <div class="container border shadow p-3 mb-5 bg-white rounded">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="homepage_user.php">Home</a>
      </li>
      <li class="breadcrumb-item active">Points Information</li>
    </ol>

    <div class="container border shadow p-3 mb-5 bg-white rounded">


    <h2><u>Points of interest</u></h2>
     <div  class="row mt-3 mr-3 mb-4 w-100"  >
    <div class="col-3 ml-3" for="points_by_category">
        <h4 ><b>Choose category:</b></h4>
    </div>
    <div id="points_by_category" class="col-3" >
      <select class='custom-select'  id='categories' width=50px ></select>
    </div>
    </div>
     <div id="points" class="ml-3 mr-3">
    </div>
  </div>
  </div>
  <script>
  var query='select * from category where category.category_id NOT IN ("3") ';
  var user_type=<?php echo $_SESSION["user_type"]; ?>;
  callAjax(concatenateCategories,'../db_conn.php?query='+query,"categories");
  document.getElementById("categories").addEventListener("change",showCategoryPoints);

  </script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
