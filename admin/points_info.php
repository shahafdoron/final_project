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
        <a href="analytics.php">Statistical Analysis</a>
      </li>
      <li class="breadcrumb-item active">Points Information</li>
    </ol>
    <div class="container border shadow p-3 mb-5 bg-white rounded">
      <h2><u>Points of interest</u></h2>
      <nav class="nav nav-pills flex-column flex-sm-row mt-5">
        <a class="flex-sm-fill text-sm-center nav-link border active" data-toggle="tab"  href="#edit_point" onclick="manageAdminPointPils('points_by_category')" >Edit an exiting point</a>
        <a class="flex-sm-fill text-sm-center nav-link border" data-toggle="tab"  href="#create_point" onclick="manageAdminPointPils('edit_select')">Create new point</a>
      </nav>


        <div class="tab-content mt-3 mb-5 border">
         <div class="tab-pane active  mb-5 h-100" id="edit_point">
             <div id="admin_points" class="row mt-3 mr-3  w-100  mb-5"  >
             <div class="col-3 ml-3" for="points_by_category">
                 <h4 ><b>Choose category:</b></h4>
             </div>
             <div id="points_by_category"  class="col-3">
               <!-- <select class='custom-select'  id='categories'  onchange="showCategoryPoints()"></select> -->
             </div>
             <div id="points" class="ml-3 mr-3">
             </div>
           </div>
           </div>
         <div class="tab-pane mt-3 " id="create_point">

         <form action=""  id="point_form" name="point_form" accept-charset="UTF-8" method='POST' name="tour_details_form" id="tour_details_form">
           <div class="form-group row">
             <div class="col-3 ml-3">
                 <label for="point_name" class=" col-form-label " >Point name:</label>
             </div>
             <div class=" col-5 custom-control custom-control-inline ">
               <input type="text"  id="point_name" name="point_name" class="form-control border"  onkeydown="return true" required >
             </div>
           </div>

           <div class="form-group row">
             <div class="col-3 ml-3">
                 <label for="categories" class=" col-form-label " required >Point category:</label>
             </div>
             <div id="edit_select" class=" col-5 custom-control custom-control-inline ">
               <select class='custom-select'  id='categories'  onchange="showCategoryPoints()"></select>
             </div>

           </div>

           <div class="form-group row">
             <div class="col-3 ml-3">
                 <label for="point_longitude" class=" col-form-label " >Point longitude:</label>
             </div>
             <div class=" col-5 custom-control custom-control-inline ">
               <input type="text"  id="point_longitude" name="point_longitude" class="form-control w-25 border"  onkeydown="return true" required >
             </div>
           </div>

           <div class="form-group row">
             <div class="col-3 ml-3">
                 <label for="point_latitude" class=" col-form-label " >Point latitude:</label>
             </div>
             <div class=" col-5 custom-control custom-control-inline ">
               <input type="text"  id="point_latitude" name="point_latitude" class="form-control w-25 border"  onkeydown="return true" required >
             </div>
           </div>

           <div class="form-group row">
             <div class="col-3 ml-3">
                 <label for="point_average_time_minutes " class=" col-form-label " >Point average time (minutes) :</label>
             </div>
             <div class=" col-5 custom-control custom-control-inline ">
               <input type="number" id="point_average_time_minutes" name="point_average_time_minutes" class="form-control w-25 border"  min="15" max="360" step="1" onKeyDown="return false" required >

             </div>
           </div>
           <div class="form-group row">
             <div class="col-3 ml-3">
                 <label for="point_average_time_minutes " class=" col-form-label " >Point average ranking (1-5) :</label>
             </div>
             <div class=" col-5 custom-control custom-control-inline ">
               <input type="number" id="point_average_ranking" name="point_average_ranking" class="form-control w-25 border"  min="1" max="5" step="0.1" onKeyDown="return false" required >

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

           <div class="row justify-content-center mt-5 mb-5">
             <button class="btn btn-primary btn-lg" id="bt" type="button" onclick="manageAdminPointValidation('add_point')" style="width:250px;">Save changes</button>
           </div>
         </form>
           </div>
      </div>
      <script type="text/javascript">
        manageAdminPointPils("points_by_category");

      function manageAdminPointPils(id){
        if (id=="points_by_category"){
          document.getElementById("edit_select").innerHTML='';
          document.getElementById(id).innerHTML='<select class="custom-select"  id="categories"  onchange="showCategoryPoints()"></select>';
        }
        else if (id=="edit_select") {
          document.getElementById("points_by_category").innerHTML='';
          document.getElementById(id).innerHTML='<select class="custom-select"  id="categories"  onchange="showCategoryPoints()"></select>';
        }
        showPoints();
      }

      function showPoints(){
        var query='select * from category where category.category_id NOT IN ("3") ';
        var user_type=<?php echo $_SESSION["user_type"]; ?>;
        callAjax(concatenateCategories,'../db_conn.php?query='+query,"categories");
        // var query='select * from category';
        // callAjax(concatenateCategories,'../db_conn.php?query='+query,"categories");
        // document.getElementById("categories").addEventListener("change",showCategoryPoints);
      }


      </script>




        <script>





        </script>
      </div>
    </div>
  </div>
</div>



  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
