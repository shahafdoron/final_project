<!DOCTYPE html>
<?php include('../db_conn.php');



  $_SESSION["point"]=json_decode(($_REQUEST["point"]),true);


  $update_point_query="update point_of_interest SET category_id='".$_SESSION["point"]["category_id"]."' , name='".$_SESSION["point"]["name"]."' , longitude='".$_SESSION["point"]["longitude"]."', ";
  $update_point_query.="latitude='".$_SESSION["point"]["latitude"]."', average_time_minutes='".$_SESSION["point"]["average_time_minutes"]."', is_accessible='".$_SESSION["point"]["is_accessible"]."', point_description='".$_SESSION["point"]["point_description"]."', ";
  $update_point_query.=" WHERE point_of_interest.point_id='".$_SESSION["point"]["point_id"]."'";



 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <title></title>
    <script src="../user/script.js">  </script>

  </head>
  <body>

    <?php include('navs.php'); ?>

    <div class="container border shadow p-3 mb-5 bg-white rounded">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="analytics.php">Statistical Analysis</a>
        </li>
        <li class="breadcrumb-item">
          <a href="points_info.php">Points information</a>
        </li>
        <li class="breadcrumb-item active">Edit point</li>
      </ol>
      <div class="container border shadow p-3 mb-5 bg-white rounded">
        <h2><u>Points ID : <?php echo $_SESSION["point"]["point_id"]; ?></u></h2>
        <div class="mt-3 mb-5 border">

          <form action=""  id="point_form" name="point_form" accept-charset="UTF-8" method='POST' name="tour_details_form" id="tour_details_form">
            <div class="form-group row mt-3 ">
              <div class="col-3 ml-3">
                <label for="point_name" class=" col-form-label " >Point name:</label>
              </div>
              <div class=" col-5 custom-control custom-control-inline ">
                <input type="text"  id="point_name" name="point_name" class="form-control border"  onkeydown="return true" value="<?php echo $_SESSION["point"]["name"] ?>" required >
              </div>
            </div>
            <div class="form-group row">
              <div class="col-3 ml-3">
                <label for="categories" class=" col-form-label " required >Point category:</label>
              </div>
              <div class=" col-5 custom-control custom-control-inline ">
                <select class='custom-select w-50' data-live-search='true' id='categories' width=50px ></select>
              </div>

            </div>

            <div class="form-group row">
              <div class="col-3 ml-3">
                <label for="point_longitude" class=" col-form-label " >Point longitude:</label>
              </div>
              <div class=" col-5 custom-control custom-control-inline ">
                <input type="text"  id="point_longitude" name="point_longitude" class="form-control w-25 border"  onkeydown="return true" value="<?php echo $_SESSION["point"]["longitude"] ?>" required >
              </div>
            </div>

            <div class="form-group row">
              <div class="col-3 ml-3">
                <label for="point_latitude" class=" col-form-label " >Point latitude:</label>
              </div>
              <div class=" col-5 custom-control custom-control-inline ">
                <input type="text"  id="point_latitude" name="point_latitude" class="form-control w-25 border"  onkeydown="return true" value="<?php echo $_SESSION["point"]["latitude"] ?>" required >
              </div>
            </div>

            <div class="form-group row">
              <div class="col-3 ml-3">
                <label for="point_average_time_minutes " class=" col-form-label " >Point average time (minutes) :</label>
              </div>
              <div class=" col-5 custom-control custom-control-inline ">
                <input type="number" id="point_average_time_minutes" name="point_average_time_minutes" class="form-control w-25 border" value="<?php echo $_SESSION["point"]["average_time_minutes"]; ?>" min="15" max="360" step="1" onKeyDown="return false" required >
              </div>
            </div>

            <div class="form-group row">
              <div class="col-3 ml-3">
                <label for="accessible_radio" class="col-3 col-form-label">Accessibility:</label>
              </div>
              <div class=" col-5 custom-control custom-control-inline">
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="accessible_yes" name="accessible" class="custom-control-input" value="1">
                  <label class="custom-control-label" for="accessible_yes" >Yes</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="accessible_no" name="accessible" class="custom-control-input" value="0"checked >
                  <label class="custom-control-label" for="accessible_no" >No</label>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-3 ml-3">
                <label for="point_description" class=" col-form-label " >Point description:</label>
              </div>
              <div class=" col-5 custom-control custom-control-inline ">
                <textarea class="form-control" id="point_description" name="point_description" rows="7"  ></textarea>
              </div>
            </div>

            <div class="row justify-content-center mb-5 mt-5">
              <button class="btn btn-primary btn-lg" id="bt" type="button" onclick="manageAdminPointValidation('edit_point',<?php echo "'".$_SESSION["point"]["point_id"]."'"; ?>)" style="width:250px;">Save changes</button>
            </div>
          </form>
      </div>
  </div>

  

  <script type="text/javascript">
  var query='select * from category where category.category_id NOT IN ("3") ';
  var user_type=<?php echo $_SESSION["user_type"]; ?>;
  callAjax(concatenateCategories,'../db_conn.php?query='+query,"categories");
  document.getElementById("point_description").value="<?php echo $_SESSION["point"]["point_description"]; ?>";

  </script>
  <script type="text/javascript">


    // function test(){
    //
    //   var select_el=document.getElementById("categories");
    //   var category_id_selected=select_el.options[select_el.selectedIndex].id;
    //   var longitude=document.getElementById('point_longitude').value;
    //   var latitude=document.getElementById('point_latitude').value;
    //
    //   var pass_validation=validationTest(longitude,latitude,category_id_selected);
    //
    //   if (pass_validation){
    //   var json_data={};
    //   json_data["point_id"]=<?php// echo $_SESSION["point"]["point_id"]; ?>;
    //   json_data["name"]=document.getElementById("point_name").value;
    //   json_data["category_id"]=category_id_selected;
    //   json_data["longitude"]=longitude;
    //   json_data["latitude"]=latitude;
    //   json_data["average_time_minutes"]=document.getElementById("point_average_time_minutes").value;
    //   json_data["is_accessible"]=document.querySelector('input[name="accessible"]:checked').value;
    //   json_data["point_description"]=document.getElementById("point_description").value;
    //
    //   sendAjax('../db_conn.php','edit_point',json_data);
    //   alert("Changes were successfully uploded to DB!");
    //   window.location.href = "points_info.php";
    //
    //   }
    //
    // }


  </script>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
