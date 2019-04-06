<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  </head>
  <script src="script.js">  </script>
  <body>
    <div class="container">
      <br><br>
      <h1 ><u>Make Your Own Tour:</u></h1><br>
      <form action="tour_map.php">
        <div class="form-group row">
          <label for="tour_duration" class="col-sm-2 col-form-label">Tour duration:</label>
          <div class="col-sm-2.5">
            <input type="text" class="form-control" id="tour_duration" placeholder="Enter time in minutes...">
          </div>
        </div>
        <div class="form-group row">
          <label for="cafiteria_radio" class="col-sm-2 col-form-label">Cafiteria:</label>
          <div class="col-sm-2.5" id="cafiteria_radio">
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="cafiteria_yes" name="cafiteria" class="custom-control-input">
              <label class="custom-control-label" for="cafiteria_yes">Yes</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="cafiteria_no" name="cafiteria" class="custom-control-input">
              <label class="custom-control-label" for="cafiteria_no">No</label>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="accessible_radio" class="col-sm-2 col-form-label">Accessible:</label>
          <div class="col-sm-2.5" id="accessible_radio">
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="accessible_yes" name="accessible" class="custom-control-input">
              <label class="custom-control-label" for="accessible_yes">Yes</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="accessible_no" name="accessible" class="custom-control-input">
              <label class="custom-control-label" for="accessible_no">No</label>
            </div>
          </div>
        </div>


        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link" id="tab_by_categories" data-toggle="tab" href="#by_categories" role="tab" aria-controls="by_categories" aria-selected="true">By Categories</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="tab_by_points" data-toggle="tab" href="#by_points" role="tab" aria-controls="by_points" aria-selected="false">By Points Of Interest</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="by_categories" role="tabpanel" aria-labelledby="tab_by_categories"><br>
            <div class="btn-group" id="div_by_categories">  </div>

          </div>
          <div class="tab-pane fade" id="by_points" role="tabpanel" aria-labelledby="tab_by_points"><br>
            <div class="btn-group" id="div_by_points"></div>

          </div>
        </div>

        <br><br><br>
        <div class="form-group row">
          <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </form>
      <script type="text/javascript">

      //   var tab_data={"cat_tab_data":
      //     {"tab_id":"tab_by_categories","fill_div":"div_by_categories","clean_div":"div_by_points"},
      //   "opt_tab_data":
      //     {"tab_id":"tab_by_points","fill_div":"div_by_points","clean_div":"div_by_categories"}
      //   };
      //
      //
      //   for (key in tab_data) {
      //     let tab_id=tab_data[key]["tab_id"];
      //     document.getElementById(tab_id).addEventListener("click",function(){
      //       let fill_div_id=tab_data[key]["fill_div"];
      //       let clean_div_id=tab_data[key]["clean_div"];
      //       console.log(tab_id + " , " +clean_div_id + " , "+ fill_div_id );
      //       document.getElementById(clean_div_id).innerHTML="";
      //       document.getElementById(fill_div_id).innerHTML="<select class='custom-select' id='categories' width=50px></select>";
      //       showCategory(fill_div_id);
      //     });
      //
      // }

      // callAjax(concatenateCategories,'../db_conn.php?query='+query_category,"categories");


// ===============================This section is working=============================================================================
      document.getElementById("tab_by_categories").addEventListener("click",function(){
        document.getElementById("div_by_points").innerHTML="";
        document.getElementById("div_by_categories").innerHTML="<select class='custom-select' id='categories' width=50px></select>";
        showCategory("div_by_categories");
          // callAjax(concatenateCategories,'../db_conn.php?query='+query_category,"categories");
      });
      document.getElementById("tab_by_points").addEventListener("click",function(){
          document.getElementById("div_by_categories").innerHTML="";
          document.getElementById("div_by_points").innerHTML="<select class='custom-select' id='categories' width=50px ></select>";
        showCategory("div_by_points");
    });

    function showCategory(id){
      var query_category='select * from category';
      callAjax(concatenateCategories,'../db_conn.php?query='+query_category,"categories");

      var div_id="points_"+id;
      var select_id="select_"+id;
      document.getElementById(id).innerHTML+="<div id='"+div_id+"'></div>";
      document.getElementById("categories").addEventListener("change", function(){

      var categories_select_el=document.getElementById("categories");
      var category_id=categories_select_el.options[categories_select_el.selectedIndex].id;

      if(id=="div_by_points"){
        document.getElementById(div_id).innerHTML="<br><select class='custom-select' ' id='"+select_id+"' width=50px ><option selected disabled hidden>Choose point</option></select>";
        console.log(category_id);
        var query_points='select * from point_of_interest where point_of_interest.category_id='+category_id;
        console.log(query_points);
        callAjax(concatenatePointsDropDown,'../db_conn.php?query='+query_points,select_id);
        // createSelectPoints(category_id,id);
        }

      else{
        document.getElementById(div_id).innerHTML="<br><br><div"

      }
      });
    }
    // ==================================This section is working=======================================================


          // callAjax(concatenateCategories,'../db_conn.php?query='+query_category,"categories");
        //   document.getElementById("categories").addEventListener("change", function(){
        //
        //
        //   // var div_id="test";
        // createSelectPoints();
        // });


          //
          // var categories_select_el=document.getElementById("categories");
          // categories_select_el.addEventListener("change", function(){
          //   var category_id=categories_select_el.options[categories_select_el.selectedIndex].id;
          //   createSelectPoints(category_id);
          // });


    function createSelectPoints(){
      var categories_select_el=document.getElementById("categories");
      var category_id=categories_select_el.options[categories_select_el.selectedIndex].id;
      console.log(category_id);
      // var div_id="div_points_per_category";
      // var div_id="test";
      // var select_id="select_test";

      // document.getElementById("div_by_points").innerHTML+="<div id='"+div_id+"'></div>";
      // var select_id="select_points_per_category";
      // var query_points='select * from point_of_interest where point_of_interest.category_id='+category_id;
      // document.getElementById("div_by_points").innerHTML+="<br><select class='selectpicker' data-live-search='true' id='"+select_id+"' width=50px ><option selected disabled hidden>Choose point</option></select>";
      // callAjax(concatenatePointsDropDown,'../db_conn.php?query='+query_points,select_id);

    }

      </script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  </body>
</html>
