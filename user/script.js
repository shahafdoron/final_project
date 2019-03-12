
function callAjax(func,url,id){
  var request = new XMLHttpRequest();
  request.open("GET",url);
  request.setRequestHeader('X-Requested-With','XMLHttpRequest');
  request.onreadystatechange = function() {
    if ((request.readyState==4) & (request.status==200)){
      // console.log(request.responseText);
      var json_data=JSON.parse(request.responseText);
      // console.log(json_data);
      func(json_data,id);
        }
    }
    request.send();
  }


function concatenateCategories(json_data,id){

  // var el=document.getElementById("categories");
  var el=document.getElementById(id);
  // var txt="<select id='categories' width=50px >";
  var txt="<option selected disabled hidden>Choose category</option>";
  var x = document.getElementById("categories");
  for (var i = 0; i < json_data.length; i++){
    txt+="<option id='"+json_data[i].category_id+"' >"+json_data[i].cat_name+"</option>";
  }
  // txt+="</select>";
  el.innerHTML=txt;
}

function showCategoryPoints(){
  var cat=document.getElementById("categories");
  var cat_id=cat.options[cat.selectedIndex].id;
  var cat_name=cat.options[cat.selectedIndex].value;
  var query="SELECT * FROM point_of_interest,category WHERE point_of_interest.category_id=category.category_id AND category.cat_name='"+cat_name+"'";
  callAjax(concatenatePoints,'../db_conn.php?query='+query,"points");
}

function concatenatePoints(json_data,id){
  // var points_div=document.getElementById("points");
  var points_div=document.getElementById(id);
  // points_div.innerHTML="<p>"+JSON.stringify(json_data)+"</p>";
  var txt="<br><br><div class'container'>";
  txt+="<div class='card-group'>";

  console.log(json_data);
  for (var i = 0; i < json_data.length; i++) {
    // txt+="<div class='card' >";4
    txt+="<div class='col-4 mb-4'>";
    txt+="<div class='card w-100 h-100 p-2'>";
    txt+="<div class='card-body d-flex flex-column p-2'>";
    txt+="<form method='POST' action='point_description.php?point="+JSON.stringify(json_data[i])+"'>";
    txt+="<img class='card-img-top img-responsive text-center' src='wolfson.jpg' alt='Card image cap'>";
    txt+="<br><br><h5 class='card-title'>"+json_data[i].name+"</h5>";
    txt+="<p class='card-text'>Short description:</p>";
    txt+="<input class='btn btn-primary btn-lg btn-block' type='submit' value='For more details'>";
    txt+="</form>";
    txt+="</div>";
    txt+="</div>";
    txt+="</div>";


      }

  txt+="</div>";
  txt+="</div>";
  points_div.innerHTML=txt;
}


function concatenateGuidedTours(json_data,id){

  var counter=1;
  var txt="";
  for (i=0;i<json_data.length;i++){
    txt+="<form method='POST' action='guided_info_book.php?tour="+JSON.stringify(json_data[i])+"'>";
    txt+="<div class='row' style='border-style: solid; border-width: 1px; padding: 1px 4px'>";
    txt+="<table style='width: 100%'>";
    txt+="<tr>";
    txt+="<td style='text-align: center; text-decoration: underline;'>Tour number "+counter+"</td>";
    txt+="<td style='text-align: center'>Date : "+json_data[i].tour_date+", Hours: "+json_data[i].Start_time+"-"+json_data[i].Finish_Time+"</td></tr>";
    txt+="<tr><td>&nbsp;</td>";
    txt+="<td style='text-align: center'>Cost: "+json_data[i].tour_cost+"₪ <br><br>Remaining tickets: "+json_data[i].remaining_tickets+" Tickets</td></tr></table>";
    txt+="<div class='btn btn-primary' style='text-align: center'><input name='Submit1' type='submit' value='More information and booking' ></div>";
    txt+="</div><div class='clear'></div></form>";
    counter+=counter;

  }
    document.getElementById("container").innerHTML=txt;

}

// function showGuidedAndIndependentTours(user_id){
//   // query_independent="SELECT * FROM user,tour,independent_tour WHERE user.user_id='"+user_id+"' AND tour.tour_id=independent_tour.independent_tour_id AND user.user_id=independent_tour.independent_tourist_id ";
//   // query_guided="SELECT * FROM user, tour, guided_tour, guided_tour_registration WHERE user.user_id='"+user_id+"' AND user.user_id=guided_tour_registration.registered_tourist_id AND tour.tour_id=guided_tour.guided_tour_id AND guided_tour.guided_tour_id=guided_tour_registration.guided_tour_id ";
//   var txt_independent="";
//   var txt_guided="";
//   txt_independent=callAjax(concatenateIndependentSchedule,'../db_conn.php?query='+query_independent);
//   txt_guided=callAjax(concatenateIndependentSchedule,'../db_conn.php?query='+query_guided);
//
// }

function concatenateIndependentSchedule(json_data,id){
  // var independe  nt_tour_div=document.getElementById("independent_tours");
  // var txt="<div class='card-group'>";

  var txt='';


  for (var i = 0; i < json_data.length; i++) {
    var type= json_data[i].tour_type==1 ? "Independent":"Guided";
    txt+="<div class='row mt-4'>";
    txt+="<div class='card w-50 h-50 mb-24 p-2'>";
    txt+="<div class='card-body d-flex flex-column p-2'>";
    txt+="<form method='POST' action='tour_map?point="+JSON.stringify(json_data[i])+"'>";
    txt+="<h5 class='card-title mr-auto'>Tour number "+json_data[i].tour_id+" ("+type+") </h5>";
    txt+="<p class='card-text'>Date: "+json_data[i].planned_date_and_time_tour+"</p>";
    txt+="<input class='btn btn-primary btn-lg btn-block' type='submit' value='Show on map'>";
    txt+="</form>";
    txt+="</div>";
    txt+="</div>";
    txt+="</div>";
      }
  // document.getElementById("my_tours_schedule").innerHTML+=txt;
  document.getElementById(id).innerHTML+=txt;
}

function showMySchedule(biger_or_smaller, user_id,id){

  console.log(biger_or_smaller,user_id);

  // var test="SELECT user.user_id, user.email , tour.tour_id, tour.planned_date_and_time_tour, tour.tour_type FROM user ";
  // test+="JOIN independent_tour  ON user.user_id=independent_tour.independent_tourist_id ";
  // test+="JOIN guided_tour_registration ON user.user_id=guided_tour_registration.registered_tourist_id ";
  // test+="JOIN tour ON (tour.tour_id=independent_tour.independent_tour_id OR tour.tour_id=guided_tour_registration.guided_tour_id) ";
  // test+="WHERE user.user_id="+user_id +" AND tour.planned_date_and_time_tour "+biger_or_smaller+"NOW()";
  // test+=" ORDER BY tour.planned_date_and_time_tour ASC";
  // console.log(test);
  // var query_independent="SELECT * FROM user,tour,independent_tour WHERE user.user_id='"+user_id+"' AND tour.tour_id=independent_tour.independent_tour_id AND user.user_id=independent_tour.independent_tourist_id ";
  // callAjax(concatenateIndependentSchedule,'../db_conn.php?query='+test);
// document.getElementById("my_tours_schedule").innerHTML="";
document.getElementById(id).innerHTML="";

  var query_independent="SELECT user.user_id, user.email , tour.tour_id, tour.planned_date_and_time_tour, tour.tour_type ";
  query_independent+="FROM user,tour,independent_tour ";
  query_independent+="WHERE user.user_id="+user_id+" ";
  query_independent+="AND tour.tour_id=independent_tour.independent_tour_id ";
  query_independent+="AND user.user_id=independent_tour.independent_tourist_id ";
  query_independent+="AND tour.planned_date_and_time_tour"+biger_or_smaller+"NOW() ORDER BY tour.planned_date_and_time_tour ASC";

  // console.log(query_independent);
  callAjax(concatenateIndependentSchedule,'../db_conn.php?query='+query_independent,id);

  var query_guided="SELECT user.user_id, user.email , tour.tour_id, tour.planned_date_and_time_tour, tour.tour_type ";
  query_guided+="FROM user, tour, guided_tour, guided_tour_registration ";
  query_guided+="WHERE user.user_id="+user_id+" ";
  query_guided+="AND user.user_id=guided_tour_registration.registered_tourist_id "
  query_guided+="AND tour.tour_id=guided_tour.guided_tour_id ";
  query_guided+="AND guided_tour.guided_tour_id=guided_tour_registration.guided_tour_id ";
  query_guided+="AND tour.planned_date_and_time_tour"+biger_or_smaller+"NOW()ORDER BY tour.planned_date_and_time_tour";
  // console.log(query_guided);
  callAjax(concatenateIndependentSchedule,'../db_conn.php?query='+query_guided,id);
}


//   <select id="categories" onchange="showCategories()">
//     <option value="">Choose an option:</option>
//     <option value="customers">Customers</option>
//     <option value="products">Products</option>
//     <option value="suppliers">Suppliers</option>
//   </select>

//jquery :

// $.ajax({
//   type:"GET",
//   url:"file.php",
//   async: true,
//   data:{},
//   dataType: "JSON",
//   success: function(data) {
//       $("#main").html(data);
//   },
//   error: function()
// });
//
// //shortcut :
// $.get({
//   url:'file.php',
//   dataType:'JSON',
//   success: function(data){
//     $("#main").html(data);
//   }
// });


// json_encode:
//$assoc=array("a"=>1,"b"=>2,"c"=>3);
//json_encode($assoc); -----> this is the most recomand implementation ----> result will be: '{"a":1,"b":2,"c":300}'
// also can : $assoc=array("a","b","c"3);
//            json_encode($assoc,JSON_FORCE_OBJECT); ------> result  wil bee: '{0:"a",1:"b",2:"c"}'
