<!DOCTYPE html>

<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <style>
  .btn-close-custom {
    background-color: DodgerBlue;
    border: none;
    color: white;
    padding: 12px 16px;
    font-size: 16px;
    cursor: pointer;
  }

  /* Darker background on mouse-over */
  .btn-close-custom:hover {
    background-color: RoyalBlue;
  }
  .pt-3-half {
    padding-top: 1.4rem;
  }
  </style>


</head>

<body>
  <script src="script.js">  </script>
  <?php include('navs.php'); ?>

  <div class="container" >
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="homepage_user.php">Home</a>
      </li>
      <li class="breadcrumb-item active">Independent Tour</li>
    </ol>

    <div class="container border">


      <h1 ><u>Make Your Own Tour:</u></h1><br>
      <form action=""  accept-charset="UTF-8" method='POST' name="tour_details_form" id="tour_details_form">

        <!-- <form action="tour_map.php"> -->
        <div class="form-group row">
          <label for="planned_tour_date_time" class="col-sm-2 col-form-label">Date and Time:</label>
          <div class="col-sm-2.5">
            <input type="datetime-local" class="form-control" id="planned_tour_date_time" name="planned_tour_date_time"   required>
          </div>
        </div>

          <div class="form-group row">
          <label for="tour_duration" class="col-sm-2 col-form-label">Tour duration:</label>
          <div class="col-sm-2.5">
            <input type="text" class="form-control" id="tour_duration_time" name="tour_duration_time" placeholder="Enter time in minutes..."  required>
          </div>
        </div>
        <div class="form-group row">
          <label for="cafeteria_radio" class="col-sm-2 col-form-label">cafeteria:</label>
          <div class="row">

            <div class="col-sm-2.5" id="cafeteria_radio">
              <div class="custom-control custom-radio custom-control-inline ">
                <input type="radio" id="cafeteria_yes" name="cafeteria" class="custom-control-input" onchange="document.getElementById('cafeteria_time').style.visibility='visible' ;" value="1" >
                <label class="custom-control-label" for="cafeteria_yes">Yes</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="cafeteria_no" name="cafeteria" class="custom-control-input" checked onchange="document.getElementById('cafeteria_time').style.visibility='hidden';" value="0">
                <label class="custom-control-label" for="cafeteria_no">No</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="number" id="cafeteria_time" name="cafeteria_time" class="form-control" value="0" min="0" max="25" step="5"  style="visibility:hidden" required >

              </div>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="accessible_radio" class="col-sm-2 col-form-label">Accessible:</label>
          <div class="col-sm-2.5" id="accessible_radio">
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="accessible_yes" name="accessible" class="custom-control-input" value="1">
              <label class="custom-control-label" for="accessible_yes" >Yes</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="accessible_no" name="accessible" class="custom-control-input" value="1"checked >
              <label class="custom-control-label" for="accessible_no" >No</label>
            </div>
          </div>
        </div>


        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link" id="tab_by_categories" data-toggle="tab" href="#by_categories" role="tab" aria-controls="by_categories" aria-selected="true" onclick="document.getElementById('selected_tab').value=1;">By Categories</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="tab_by_points" data-toggle="tab" href="#by_points" role="tab" aria-controls="by_points" aria-selected="false" onclick="document.getElementById('selected_tab').value=0;">By Points Of Interest</a>
          </li>
          <input type="hidden" id="selected_tab" name="sel_tab" value="1" />
        </ul>

        <div class="tab-content" id="myTabContent">

          <div class="tab-pane fade show active" id="by_categories" role="tabpanel" aria-labelledby="tab_by_categories" >

            <div class="container">
              <div class="row mt-3">
                <div class="col-auto mr-auto">
                  <select class='custom-select' id='categories_by_categories_option'  onchange="createCategoryInput('categories_by_categories_option','div_by_categories')"><script>showCategory("categories_by_categories_option");</script></select><br>
                </div>
              </div>
              <div class="row mt-3">
                <div id="div_by_categories" class="row"  >  </div>
                <!-- <div id="div_by_categories" class="col-auto mr-auto"  >  </div> -->
              </div>
            </div>
          </div>

          <div class="tab-pane fade" id="by_points" role="tabpanel" aria-labelledby="tab_by_points" >
            <div class="container">
              <div class="row mt-3">
                <div class="col-auto mr-auto">
                  <select class='custom-select' id='categories_by_points_option'  onchange="createSelectPoints('categories_by_points_option','div_by_points','table_points')"><script>showCategory("categories_by_points_option");</script></select><br>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-auto mr-auto" id="div_by_points"></div>
              </div>
              <div class="row mt-3">
                <div class="col-auto mr-auto" id="divpoints_ta">
                  <div class="card">

                    <div class="card-body">
                      <div id="table" class="table">
                        <table class="table table-bordered table-responsive-md table-striped text-center" id="table_points">
                          <tr>
                            <th class="text-center">Point Name</th>
                            <th class="text-center">Average Time (Minutes)</th>
                            <th class="text-center">Average Ranking</th>
                            <th class="text-center">Remove</th>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div><br><br>
                </div>
              </div>
            </div>
          </div>

        </div>
        <br>
        <div class="form-group row" >
          <div class="col-auto mr-auto">
            <button type="button" class="btn btn-primary" onclick="formHandler()">Submit</button>
          </div>
        </div>
        </form>

      </div>
<br>
    </div>



      <script >

      var query_category='select * from category';
      var cat_ids=[];



      function createSelectPoints(select_id,div_id,table_id){

        // var categories_select_el=document.getElementById(select_id);
        var categories_select_el=document.getElementById(select_id);

        var category_id=categories_select_el.options[categories_select_el.selectedIndex].id;
        var select_points_id="select_points_per_category";
        var query_points='select * from point_of_interest where point_of_interest.category_id='+category_id;
        // var ht='<select class="custom-select" id="'+select_points_id+'" width=50px ><option selected  >Choose point</option></select>';

        // addElement(div_id,"select",select_points_id,ht);                                                                                               table_id table_id
        document.getElementById(div_id).innerHTML='<select class="custom-select" id="'+select_points_id+'" name="'+select_points_id+'" onchange="addPointToTable( \''+select_points_id+'\' ,\''+table_id+'\',\''+query_points+'\')" width=50px ><option selected  >Choose point</option></select>';
        var json_data_points=callAjax(concatenatePointsDropDown,'../db_conn.php?query='+query_points,select_points_id);


      }

      function addPointToTable(select_points_id,table_id,c){
        console.log(select_points_id);
        console.log(table_id);
        var tour_duration=document.getElementById("tour_duration_time").value;
        var points_select_el=document.getElementById(select_points_id);
        points_select_el.options[points_select_el.selectedIndex].disabled=true;
        var selected_point_val=points_select_el.options[points_select_el.selectedIndex].value.split("-").map(function(item) {
          return item.trim();
        });

        var selected_point_id=points_select_el.options[points_select_el.selectedIndex].id;
        console.log(selected_point_id + " : " + typeof selected_point_val);
        var j_point={"p_id":selected_point_id,"p_name":selected_point_val[0], "p_average_time":selected_point_val[1],"p_average_ranking":selected_point_val[2]};
        var tr_id="tr_p"+j_point["p_id"];
        var ht=' <td id="' + j_point["p_id"] + '" "class="pt-3-half" >'+j_point["p_name"]+'</td> <td class="pt-3-half">'+j_point["p_average_time"]+'</td><td class="pt-3-half" >'+j_point["p_average_ranking"]+'</td>';
        ht+='<td><span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0" onclick="removeElement( \''+tr_id+'\' ,\''+select_points_id+'\', \''+j_point["p_id"]+'\');">Remove</button></span></td>';

        addElement(table_id,"tr",tr_id,ht);

      }



      function createCategoryInput(select_id,div_id){
        var categories_select_el=document.getElementById(select_id);
        var category_id=categories_select_el.options[categories_select_el.selectedIndex].id;
        var category_value=categories_select_el.options[categories_select_el.selectedIndex].value;
        categories_select_el.options[categories_select_el.selectedIndex].disabled=true;
        var div_el=document.getElementById(div_id);
        console.log(category_id + " , " + category_value);
        var cat_div_id="div_"+category_id;

        var ht='<div id="'+cat_div_id+'"  class="col">';
        ht+='<div class="card bg-light mb-3">';
        ht+='<button  class="btn-close-custom"  type="button" onclick="removeElement( \''+cat_div_id+'\' ,\''+select_id+'\', \''+category_id+'\');"><i>Remove</i></button>';
        ht+='<div class="card-header">'+category_value+'</div>';
        ht+='<div class="card-body">';
        ht+='<input id="'+category_id+'"  type="number" value="0" min="0" max="1" step="0.1"  class="form-control" placeholder="0-1"  aria-describedby="btnGroupAddon" required >'
        ht+='</div></div></div>';
        addElement(div_id,"div",cat_div_id,ht);
      }


      function formHandler(){

        var sel_cat=document.getElementById("selected_tab").value;
        console.log(sel_cat);
        var json_data="";
        var ready_for_submit=true;
        var validation={};

        if (validateGeneralInputs()){
          if(sel_cat=="1"){
            validation=validateByCategories();
            console.log("formHandler: inside if category " + validation["json_data"]);
          }

          else{
            validation=validateBypoints();
            console.log("formHandler: inside else ( by points) : " +validation["json_data"]);
          }

          if (validation["validation_test"]){
            console.log("formHandler: test is true, sending form: ");
            console.log(validation["json_data"]);
            document.tour_details_form.action='tour_map.php?json_data='+ validation["json_data"];
            document.getElementById("tour_details_form").submit();
          }
        }
      }



      function validateGeneralInputs(){
        var pass_validation=true;

        var tour_duration_time=document.getElementById("tour_duration_time").value;
        var cafeteria_is_selected=document.querySelector('input[name = cafeteria]:checked').value;
        console.log(cafeteria_is_selected);
        if (tour_duration_time=="" || tour_duration_time=="0"){
          pass_validation=false;
          alert("Please insert tour duration time in minutes");
        }

        if (cafeteria_is_selected=="1"){

          var cafeteria_time=parseFloat(document.getElementById("cafeteria_time").value);
          if (cafeteria_time==0){
            pass_validation=false;
            alert("Please insert cafeteria time in minutes");
          }
        }

        return pass_validation;
      }

      function validateByCategories(){
        var result={};
        result["validation_test"]=true;
        result["json_data"]='';
        var parent = document.getElementById("div_by_categories");
        var child = parent.children;
        var data={};
        var cat_val="";
        var cat_id="";
        var cat_name="";
        var toal_weight=0;

        if (child.length==0){
          result["validation_test"]=false;
          alert("Please chose category")
          return result;
        }

        for (var i=0; i<child.length;i++){
          cat_name=child[i].children[0].children[0].children[1].innerHTML;
          cat_val=child[i].children[0].children[0].children[2].children[0].value;
          cat_id=child[i].children[0].children[0].children[2].children[0].id;
          data[cat_name]={"category_id":cat_id, "category_weight":cat_val};
          toal_weight+=parseFloat(cat_val);
        }
        if (toal_weight>1){
          result["validation_test"]=false;
          console.log("hererere");
          alert("Total is bigger than 1!");
          return result;
        }

        else if (toal_weight<1) {
          result["validation_test"]=false;
          alert("Total is smaller than 1!");
          return result;
        }

        result["validation_test"]=true;
        data=JSON.stringify(data);
        result["json_data"]=data;

        return result;
      }

      function validateBypoints(){
        var result={};
        result["validation_test"]=true;
        result["json_data"]='';

        var parent = document.getElementById("table_points");
        var child = parent.children;

        if (child.length==1){
          result["validation_test"]=false;
          alert("Please chose points")
          return result;
        }

        js={"ids":[]};
        for (var i=1; i<child.length;i++){
          console.log("inside loop");
          js["ids"].push(child[i].children[0].id);
        }

        result["json_data"]=JSON.stringify(js["ids"]);
        console.log(typeof result["json_data"]);
        return result;
      }







      // var tab_data={"cat_tab_data":
      //   {"tab_id":"tab_by_categories","fill_div":"div_by_categories","clean_div":"div_by_points"},
      // "opt_tab_data":
      //   {"tab_id":"tab_by_points","fill_div":"div_by_points","clean_div":"div_by_categories"}
      // };
      //
      //
      // for (key in tab_data) {
      //   let tab_id=tab_data[key]["tab_id"];
      //   document.getElementById(tab_id).addEventListener("click",function(){
      //     let fill_div_id=tab_data[key]["fill_div"];
      //     let clean_div_id=tab_data[key]["clean_div"];
      //     console.log(tab_id + " , " +clean_div_id + " , "+ fill_div_id );
      //     document.getElementById(clean_div_id).innerHTML="";
      //     document.getElementById(fill_div_id).innerHTML="<select class='custom-select' id='categories' width=50px></select>";
      //     showCategory(fill_div_id);
      //   });
      //
      // }
      //
      // callAjax(concatenateCategories,'../db_conn.php?query='+query_category,"categories");

      </script>


      <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    </body>
    </html>
