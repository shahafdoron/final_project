<!DOCTYPE html>
<?php
include("../db_conn.php");

?>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

  <title></title>
</head>
<script type="text/javascript">
    var user_type=<?php echo $_SESSION["user_type"]; ?>;
</script>

<script src="../user/script.js">  </script>
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
      <nav class="nav nav-pills flex-column flex-sm-row">
        <a class="flex-sm-fill text-sm-center nav-link active" data-toggle="tab"  href="#" onclick="showPoints()">Edit an exiting point</a>
        <a class="flex-sm-fill text-sm-center nav-link" data-toggle="tab"  href="#" onclick="hide()">Create new point</a>
      </nav>
      <div>
        <div id="admin_points" class="row mt-4 ml-3 mr-3"  >

        <div id="points_by_category" >
          <select class='custom-select' data-live-search='true' id='categories' width=50px onchange="showCategoryPoints()"></select>
        </div>
        <div id="points">
        </div>
      </div>
        <script>
        showPoints();
        function showPoints(){
          var query='select * from category';
          callAjax(concatenateCategories,'../db_conn.php?query='+query,"categories");
          // document.getElementById("categories").addEventListener("change",showCategoryPoints);
        }

        function hide(){
          console.log("here");
          document.getElementById("admin_points").innerHTML="";
        }

        </script>
      </div>
    </div>
  </div>



  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>









  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
