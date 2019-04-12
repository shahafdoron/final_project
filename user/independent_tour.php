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
                        
                          <!-- This is our clonable table line -->

                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>




        <br>
        <div class="form-group row">
          <div class="col-auto mr-auto">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>

      </form>



      <script >

      var query_category='select * from category';

      function createSelectPoints(select_id,div_id,table_id){

        // var categories_select_el=document.getElementById(select_id);
        var categories_select_el=document.getElementById(select_id);

        var category_id=categories_select_el.options[categories_select_el.selectedIndex].id;
        var select_points_id="select_points_per_category";
        var query_points='select * from point_of_interest where point_of_interest.category_id='+category_id;
        var ht='<select class="custom-select" id="'+select_points_id+'" width=50px ><option selected  >Choose point</option></select>"';

        // addElement(div_id,"select",select_points_id,ht);                                                                                               table_id table_id
        document.getElementById(div_id).innerHTML='<select class="custom-select" id="'+select_points_id+'" onchange="gg( \''+select_points_id+'\' ,\''+table_id+'\',\''+query_points+'\')" width=50px ><option selected  >Choose point</option></select>"';
        var json_data_points=callAjax(concatenatePointsDropDown,'../db_conn.php?query='+query_points,select_points_id);


           }

      function gg(select_points_id,table_id,c){
         console.log(select_points_id);
         console.log(table_id);
         var tour_duration=document.getElementById("tour_duration").value;
         var points_select_el=document.getElementById(select_points_id);
         var selected_point_val=points_select_el.options[points_select_el.selectedIndex].value.split("-").map(function(item) {
           return item.trim();
          });

         var selected_point_id=points_select_el.options[points_select_el.selectedIndex].id;
         console.log(selected_point_id + " : " + typeof selected_point_val);
         var j_point={"p_id":selected_point_id,"p_name":selected_point_val[0], "p_average_time":selected_point_val[1],"p_average_ranking":selected_point_val[2]};
         var tr_id="tr_p_"+j_point["p_id"];
         var ht=' <td class="pt-3-half" >'+j_point["p_name"]+'</td> <td class="pt-3-half">'+j_point["p_average_time"]+'</td><td class="pt-3-half" >'+j_point["p_average_ranking"]+'</td>';
         ht+='<td><span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0" onclick="removeElement( \''+tr_id+'\' ,\''+select_points_id+'\', \''+j_point["p_id"]+'\');">Remove</button></span></td>';

         addElement(table_id,"tr",tr_id,ht);

         points_select_el.options[points_select_el.selectedIndex].disabled=true;



         // <tr>
         //   <td class="pt-3-half" >Aurelia Vega</td>
         //   <td class="pt-3-half">30</td>
         //   <td class="pt-3-half" >Deepends</td>
         //   <td>
         //     <span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">Remove</button></span>
         //   </td>
         // </tr>
         //

           }



      function createCategoryInput(select_id,div_id){
        var categories_select_el=document.getElementById(select_id);
        var category_id=categories_select_el.options[categories_select_el.selectedIndex].id;
        var category_value=categories_select_el.options[categories_select_el.selectedIndex].value;
        categories_select_el.options[categories_select_el.selectedIndex].disabled=true;
        var div_el=document.getElementById(div_id);
        console.log(category_id + " , " + category_value);
        var cat_div_id="div_"+category_id;
        // console.log(cat_div_id);

        // console.log("onclick='ff("+cat_card_id+")'");

        var ht='<div id="'+cat_div_id+'"  class="col">';
        ht+='<div class="card bg-light mb-3" style="max-width: 18rem;">';
         ht+='<button  class="btn-close-custom"  type="button" onclick="removeElement( \''+cat_div_id+'\' ,\''+select_id+'\', \''+category_id+'\');"><i>Remove</i></button>';
         // ht+=" <button type="button" class="close"  ></button>";
        ht+='<div class="card-header">'+category_value+'</div>';
        // ht+='<span id="'+cat_card_id+'" onclick="removeElement( \''+cat_div_id+'\' ,\''+select_id+'\', \''+category_id+'\');"><i class="fa fa-times"></i></span>';
        // ht+='<blockquote class="card-blockquote"><p>'+category_value+'</p></blockquote>';
        ht+='<div class="card-body">';
        // ht+='<h6 class="card-title">Set weight</h5>';
        ht+='<input type="number" min="0.1" max="1" step="0.1" onkeypress="return false;" class="form-control" placeholder="0-1"  aria-describedby="btnGroupAddon">'
        ht+='</div></div></div>';
        addElement(div_id,"div",cat_div_id,ht);

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
