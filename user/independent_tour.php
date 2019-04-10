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
      /* padding: 12px 16px;
      font-size: 16px; */
      cursor: pointer;
    }

    /* Darker background on mouse-over */
    .btn-close-custom:hover {
      background-color: RoyalBlue;
    }
    </style>


</head>

  <body>
      <script src="script.js">  </script>
    <div class="container">
      <br><br>
      <h1 ><u>Make Your Own Tour:</u></h1><br>
      <!-- <form action=""> -->
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
                <div id="div_by_categories" class="col-auto mr-auto"  >  </div>
              </div>
            </div>
          </div>

          <div class="tab-pane fade" id="by_points" role="tabpanel" aria-labelledby="tab_by_points" >
            <div class="container">
              <div class="row mt-3">
                <div class="col-auto mr-auto">
                  <select class='custom-select' id='categories_by_points_option'  onchange="createSelectPoints('categories_by_points_option','div_by_points')"><script>showCategory("categories_by_points_option");</script></select><br>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-auto mr-auto" id="div_by_points"></div>
              </div>
            </div>
          </div>

        </div>




        <br>
        <div class="form-group row">
          <div class="col-auto mr-auto">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>






        <!-- <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
          <div class="btn-group mr-2" role="group" aria-label="First group">
            <button type="button" class="btn btn-secondary">1</button>
            <button type="button" class="btn btn-secondary">2</button>
            <button type="button" class="btn btn-secondary">3</button>
            <button type="button" class="btn btn-secondary">4</button>
          </div>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text" id="btnGroupAddon">@</div>
            </div>
            <input type="text" class="form-control" placeholder="Input group example" aria-label="Input group example" aria-describedby="btnGroupAddon">
          </div>
        </div> -->
      <!-- </form> -->
      <div id="div1" class="card card-outline-danger text-center" >
      <span id="iddd"><i  class="fa fa-times"></i></span>
      <div  class="card-block">
      <blockquote  class="card-blockquote"><p>'+category_value+'</p>
      <footer  >Someone famous in <cite  id="'+cat_div_id+'" title="Source Title">Source Title</cite></footer></blockquote>
    </div>
    </div>
      <script >
// document.getElementById("iddd").addEventListener("click",function(){
//   document.getElementById("div1").style.visibility="hidden";
// });
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
    //   document.getElementById("tab_by_categories").addEventListener("click",function(){
    //     document.getElementById("div_by_points").innerHTML="";
    //     document.getElementById("div_by_categories").innerHTML="<select class='custom-select' id='categories' width=50px></select>";
    //     showCategory("div_by_categories");
    //       // callAjax(concatenateCategories,'../db_conn.php?query='+query_category,"categories");
    //   });
    //   document.getElementById("tab_by_points").addEventListener("click",function(){
    //       document.getElementById("div_by_categories").innerHTML="";
    //       document.getElementById("div_by_points").innerHTML="<select class='custom-select' id='categories' width=50px ></select>";
    //     showCategory("div_by_points");
    // });


    // ==================================This section is working=======================================================




// =================================================test section================================================
var query_category='select * from category';

        //   document.getElementById("tab_by_categories").addEventListener("click",function(){
        //     document.getElementById("div_by_points").innerHTML="";
        //     document.getElementById("div_by_categories").innerHTML="<select class='custom-select' id='categories' width=50px></select>";
        //     callAjax(concatenateCategories,'../db_conn.php?query='+query_category,"categories");
        //
        //
        //       // callAjax(concatenateCategories,'../db_conn.php?query='+query_category,"categories");
        //   });
        //   document.getElementById("tab_by_points").addEventListener("click",function(){
        //       document.getElementById("div_by_categories").innerHTML="";
        //       document.getElementById("div_by_points").innerHTML="<select class='custom-select' id='categories' width=50px ></select>";
        //     showCategory("div_by_points");
        // });

    function createSelectPoints(select_id,div_id){
      var categories_select_el=document.getElementById(select_id);
      var category_id=categories_select_el.options[categories_select_el.selectedIndex].id;
      var select_points_id="select_points_per_category";
      var query_points='select * from point_of_interest where point_of_interest.category_id='+category_id;
      document.getElementById(div_id).innerHTML="<select class='custom-select' data-live-search='true' id='"+select_points_id+"' width=50px ><option selected disabled hidden>Choose point</option></select>";
      callAjax(concatenatePointsDropDown,'../db_conn.php?query='+query_points,select_points_id);

}
    function createCategoryInput(select_id,div_id){
      var categories_select_el=document.getElementById(select_id);
      var category_id=categories_select_el.options[categories_select_el.selectedIndex].id;
      var category_value=categories_select_el.options[categories_select_el.selectedIndex].value;
      categories_select_el.options[categories_select_el.selectedIndex].disabled=true;
      var div_el=document.getElementById(div_id);
      console.log(category_id + " , " + category_value);
      // document.getElementById(div_id).innerHTML+="<label for='"+category_value+"'>"+category_value+"</label>";
      // document.getElementById(div_id).innerHTML+="<div class='col-auto mr-auto mt-2' id='div_"+category_value+"'><label class='col-auto mr-auto control-label' for='"+category_value+"'>"+category_value+"</label> <div class='col-md-10  mt-3 mb-3'><input type='number' min='0.1' max='1' step='0.1' class='form-control input-md' id='"+category_value+"' placeholder='0-1'></div></div>";

    // document.getElementById(div_id).innerHTML+="<div class='btn-toolbar mb-3' role='toolbar' >";
    // document.getElementById(div_id).innerHTML+="<button class='btn-close-custom' onlick='ff("+category_id+")'><i class='fa fa-close'></i></button>";
    // document.getElementById(div_id).innerHTML+="<div class='input-group'>";
    // document.getElementById(div_id).innerHTML+="<div class='input-group-prepend'>";
    // document.getElementById(div_id).innerHTML+="<div class='input-group-text' id='btnGroupAddon'>"+category_value+"</div></div>";
    // document.getElementById(div_id).innerHTML+="<input type='number' min='0.1' max='1' step='0.1' onkeypress='return false;' class='form-control' placeholder='0-1' aria-label='Input group example' aria-describedby='btnGroupAddon'></div></div>";
    var cat_card_id="card_"+category_id;
    var cat_div_id="div_"+category_id;

    console.log("onclick='ff("+cat_card_id+")'");


    document.getElementById(div_id).innerHTML+='<div id="'+cat_div_id+'" class="fade_div"  >';
    document.getElementById(div_id).innerHTML+='<span id="'+cat_card_id+'"  onclick="ff(\''+div_id+'\', \''+cat_div_id+'\');" ><i  class="fa fa-times"></i></span>';
    document.getElementById(div_id).innerHTML+='<div   >hhhhh</div></div>';
  }
  function ff(parent_div_id,child_div_id){

    document.getElementById("child_div_id").style.visibility="hidden";
    // var parent_div_id = document.getElementById(parent_div_id);
    // var child_div=document.getElementById(child_div_id);
    // parent_div_id.removeChild(child_div);
}

    // var o=[];
    // var options=categories_select_el.options;
    // console.log(options);
    // for ( i = 0, len = options.length; i < len;i++){
    //   o.push(options[i].id);
    //   document.getElementById(div_id).innerHTML+='<div id="div_'+o[i]+'" class="fade_div" style="visibility:hidden" >';
    //   document.getElementById(div_id).innerHTML+='<span id="'+cat_card_id+'"><i  class="fa fa-times"  style="visibility:hidden"></i></span>';
    //   document.getElementById(div_id).innerHTML+='<div   >hhhhh</div></div>';
    // }
    //
    // // document.getElementById(category_id).style.visibility="hidden";
    //
    // o.splice(0,1);
    // console.log(o);

  //   $('.fade_div').each(function(){
  //     //Set mouse handler for each content div
  //
  //     function(){
  //         $('#div_' + this.id).hide();
  //     });
  // });
// onclick="ff(\''+cat_div_id+'\');"
//     document.getElementById(cat_card_id).addEventListener('click', hideDiv, false);
//
// function hideDiv() {
//   this.style.visibility="hidden";
//     // alert(value);
// }




// document.getElementById(cat_card_id).addEventListener('click', function() {
//     foo(cat_div_id,cat_card_id);
// }, false);
//
// function foo(x,y) {
//   console.log(x);
//   document.getElementById(x).innerHTML="";
//
// }


  //   $(document).ready(function(){
  //   $("span").click(function(cat_div_id){
  //     document.getElementById(cat_div_id).style.left="-2040px";
  //   console.log("Asdasdasdasdasda");
  //   // $("#div1").remove();
  //
  //   });
  // });

    // document.getElementById(cat_card_id).addEventListener("click",function(cat_div_id){
    //   var el=document.getElementById(cat_div_id).innerHTML="";
    //   // document.getElementById(id).closest('.card').fadeOut();
    //
    //
    //   console.log(el);
    // });


    // document.getElementById(div_id).innerHTML+="<div class='row'>";
    // document.getElementById(div_id).innerHTML+="<div class='input-group-prepend'>";
    // document.getElementById(div_id).innerHTML+="<div class='col-3' id='btnGroupAddon'>"+category_value+"</div></div>";
    // document.getElementById(div_id).innerHTML+="<input type='number' min='0.1' max='1' step='0.1' onkeypress='return false;' class='col-3' placeholder='0-1' aria-label='Input group example' aria-describedby='btnGroupAddon'></div>";


    // <div class="input-group">
    //    <div class="input-group-prepend">
    //      <div class="input-group-text" id="btnGroupAddon">@</div>
    //    </div>
    //    <input type="text" class="form-control" placeholder="Input group example" aria-label="Input group example" aria-describedby="btnGroupAddon">

   //    <label for="">Another label</label>
   // <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input">




//     function ff(id){
// console.log(id);
// document.getElementById(id).innerHTML="";
//     for(var i=0; i<elems.length; i++) {
//     // elems[i].style.visibility="hidden";
//     console.log(elems[i]);
// }
    // el.style.visibility = "hidden";
    // console.log(cat_div_id);
    // // console.log(el);
    // // console.log(id);

    // }





      // var div_id="div_points_per_category";
      // var div_id="test";
      // var select_id="select_test";

      // document.getElementById("div_by_points").innerHTML+="<div id='"+div_id+"'></div>";
      // var select_id="select_points_per_category";
      // var query_points='select * from point_of_interest where point_of_interest.category_id='+category_id;
      // document.getElementById("div_by_points").innerHTML+="<br><select class='selectpicker' data-live-search='true' id='"+select_id+"' width=50px ><option selected disabled hidden>Choose point</option></select>";
      // callAjax(concatenatePointsDropDown,'../db_conn.php?query='+query_points,select_id);


    // =================================================test section================================================
    // function createCategoryInput(select_id,div_id){
    //   var categories_select_el=document.getElementById(select_id);
    //   var category_id=categories_select_el.options[categories_select_el.selectedIndex].id;
    //   var category_value=categories_select_el.options[categories_select_el.selectedIndex].value;
    //   var div_el=document.getElementById(div_id);
    //   console.log(category_id + " , " + category_value);
    //
    //   div_el.innerHTML+="<div id='div_+"category_value+"'><label for='"+category_value+"'>"+category_value+"</label> <input type='text' class='form-control' id='"+category_value+"' placeholder='Another input'></div>";
    //
    // //    <label for="">Another label</label>
    // // <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input">
    //
    // }
      </script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  </body>
</html>
