
function callAjax(func,url,id){
  var request = new XMLHttpRequest();
  request.open("GET",url);
  request.setRequestHeader('X-Requested-With','XMLHttpRequest');
  request.onreadystatechange = function() {
    if ((request.readyState==4) & (request.status==200)){
      // console.log(request.responseText);
      var json_data=JSON.parse(request.responseText);
      func(json_data,id);
    }
  }
  request.send();
}
function sendAjax(url,action,json_data={}){
  console.log("inside sendAjax");
  var request = new XMLHttpRequest();
  request.open("POST", url, true);
  request.setRequestHeader('X-Requested-With','XMLHttpRequest');
  request.setRequestHeader("Content-type","application/x-www-form-urlencoded");


  json_data=JSON.stringify(json_data);
  console.log(json_data);
  console.log(action);
  request.send("action="+action+"&json_data="+json_data);

}
// function sendAjax(url,query,use_json_data=false,json_data={}){
//   console.log("inside sendAjax");
//   var request = new XMLHttpRequest();
//   request.open("POST", url, true);
//   request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
//   if(use_json_data){
//     json_data=JSON.stringify(json_data);
//     request.send("query="+query+"&use_json_data="+use_json_data+"&json_data="+json_data);
//   }
//   else{
//     request.send("query="+query);
//   }
//
//
// }

function respond() {
  if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
    document.getElementById('result').innerHTML = xmlhttp.responseText;
  }
}

function concatenateCategories(json_data,id){

  // var el=document.getElementById("categories");
  var el=document.getElementById(id);
  // var txt="<select id='categories' width=50px >";
  var txt="<option selected disabled hidden>Choose category</option>";
  var x = document.getElementById("categories");
  for (var i = 0; i < json_data.length; i++){
    txt+="<option id='"+json_data[i].category_id+"' data-tokens='"+json_data[i].cat_name+"'>"+json_data[i].cat_name+"</option>";
  }
  // txt+="</select>";
  el.innerHTML=txt;
  console.log(json_data);
}

function showCategoryPoints(){
  var cat=document.getElementById("categories");
  var cat_id=cat.options[cat.selectedIndex].id;
  var cat_name=cat.options[cat.selectedIndex].value;
  var query="SELECT * FROM point_of_interest,category WHERE point_of_interest.category_id=category.category_id AND category.cat_name='"+cat_name+"'";
console.log(query);
  callAjax(concatenatePoints,'../db_conn.php?query='+query,"points");
}

function concatenatePoints(json_data,id){
  // var points_div=document.getElementById("points");
  var points_div=document.getElementById(id);
  // points_div.innerHTML="<p>"+JSON.stringify(json_data)+"</p>";

// ========old=================================
  // var txt="<br><br><div class'container'>";
  //   txt="<div class='card-group'>";
// ========old=================================

// ========new=================================
var txt="<br><br><div class'container'>";
  txt="<div class='card-group'>";


// ========new=================================


  console.log(json_data);
  for (var i = 0; i < json_data.length; i++) {
    // txt+="<div class='card' >";4
//===========================oldddd=========================
    txt+="<div class='col-4 mb-4 mt-4'>";
    txt+="<div class='card w-100 h-100 shadow p-3 mb-5 bg-white rounded'>";

    txt+="<img class='card-img-top embed-responsive-item text-center border' src='../images/points/"+json_data[i].point_id+".jpg' alt='Card image cap'  style='width:100%; height:250px;'>";
    txt+="<div class='card-header w-100 h-100  border'>";
    txt+="<h5 class='card-title text-center mt-3'>"+json_data[i].name+"</h5>";
    txt+="</div>";
    txt+="<div class='card-body card-footer d-flex flex-column border' >";
    txt+="<form method='POST' action='point_description.php?point="+JSON.stringify(json_data[i])+"'>";

  //card-footer text-muted text-center
    txt+="<div class=' text-muted text-center'>";
    txt+="<p class='card-text '>Average ranking: "+json_data[i].average_ranking+"</p>";
    txt+="<input class='align-self-end btn btn-primary btn-lg btn-block' type='submit' value='For more details'>";

    txt+="</div>";
    txt+="</form>";
    txt+="</div>";

    txt+="</div>";
    txt+="</div>";
    //===========================oldddd=========================

// ====================new========================================
    // txt+="<div class='col-4 mb-4'>";
    // txt+="<div class='card w-100 h-100 p-2'>";
    // txt+="<div class='card-body d-flex flex-column p-2' >";
    // txt+="<form method='POST' action='point_description.php?point="+JSON.stringify(json_data[i])+"'>";
    // txt+="<img class='card-img-top img-responsive' src='../images/points/"+json_data[i].point_id+".jpg' alt='Card image cap'  style='width:100%; height:250px;'>";
    // txt+="<br><br><h5 class='card-title'>"+json_data[i].name+"</h5>";
    // txt+="<p class='card-text'>Average ranking:   "+json_data[i].average_ranking+"</p>";
    // txt+="<input class='btn btn-primary btn-lg btn-block' type='submit' value='For more details'>";
    // txt+="</form>";
    // txt+="</div>";
    // txt+="</div>";
    // txt+="</div>";
// ====================new========================================

  }
  console.log("inside concatenatePoints");

  txt+="</div>";
  txt+="</div>";
  points_div.innerHTML=txt;
  console.log(txt);


  // <div class="col-lg-4 mb-4">
  // <div class="card h-100">
  // <h4 class="card-header">Card Title</h4>
  // <div class="card-body">
  // <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente esse necessitatibus neque.</p>
  // </div>
  //     <div class="card-footer">
  //       <a href="#" class="btn btn-primary">Learn More</a>
  //     </div>
  //   </div>
  // </div>
}



function concatenateGuidedTours(json_data,id){
  var counter=1;
  var txt="";
  if (json_data.length==0) {
    txt+="<h1 style=\"text-align: center;\"><u> There's no tours in the selected date</h1>";
  }
  for (i=0;i<json_data.length;i++){
    // console.log(json_data);
    txt+="<div class='row mt-2 border shadow p-3 mb-5 bg-white rounded'>";
    txt+="<div class='card w-100 h-50 mb-24 p-2 '>";
    txt+="<div class='card-header'><u><h5>Tour number "+counter+"</h5>  </u></div>"
    txt+="<div class='card-body align-items-center d-flex justify-content-center'>";
    txt+="<form method='POST' action='guided_info_book.php?tour="+JSON.stringify(json_data[i])+"&counter="+counter+"'>";
    // txt+="<h5 class='card-title mr-auto'><u>Tour number "+counter+"</u></h5>";
    txt+="<p class='card-text'>Date : "+json_data[i].tour_date+", Hours: "+json_data[i].Start_time+"-"+json_data[i].Finish_Time+"</p>";
    txt+="<p class='card-text'>Cost: "+json_data[i].tour_cost+"₪</p>";
    txt+="<div style=\"text-align: center;\"><input class='btn btn-primary btn-lg btn-block' type='submit' value='More information and booking'></div>";
    txt+="</form>";
    txt+="</div>";
    txt+="</div>";
    txt+="</div>";
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

function concatenateSchedule(json_data,id){
  // var independe  nt_tour_div=document.getElementById("independent_tours");
  // var txt="<div class='card-group'>";

  var txt='';


  for (var i = 0; i < json_data.length; i++) {
    var type= json_data[i].tour_type==1 ? "Independent":"Guided";
    txt+="<div class='row mt-4'>";
    txt+="<div class='card w-100 h-50 mb-24 p-2'>";
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


  document.getElementById(id).innerHTML="";

  var query_independent="SELECT user.user_id, user.email , tour.tour_id, tour.planned_date_and_time_tour, tour.tour_type ";
  query_independent+="FROM user,tour,independent_tour ";
  query_independent+="WHERE user.user_id="+user_id+" ";
  query_independent+="AND tour.tour_id=independent_tour.independent_tour_id ";
  query_independent+="AND user.user_id=independent_tour.independent_tourist_id ";
  query_independent+="AND tour.planned_date_and_time_tour"+biger_or_smaller+"NOW() ORDER BY tour.planned_date_and_time_tour ASC";

  // console.log(query_independent);
  console.log(query_independent);
  callAjax(concatenateSchedule,'../db_conn.php?query='+query_independent,id);

  var query_guided="SELECT user.user_id, user.email , tour.tour_id, tour.planned_date_and_time_tour, tour.tour_type ";
  query_guided+="FROM user, tour, guided_tour, guided_tour_registration ";
  query_guided+="WHERE user.user_id="+user_id+" ";
  query_guided+="AND user.user_id=guided_tour_registration.registered_tourist_id "
  query_guided+="AND tour.tour_id=guided_tour.guided_tour_id ";
  query_guided+="AND guided_tour.guided_tour_id=guided_tour_registration.guided_tour_id ";
  query_guided+="AND tour.planned_date_and_time_tour"+biger_or_smaller+"NOW()ORDER BY tour.planned_date_and_time_tour";
  // console.log(query_guided);
  callAjax(concatenateSchedule,'../db_conn.php?query='+query_guided,id);
}


function concatenatePointsDropDown(json_data,id){

  // var el=document.getElementById("categories");
  var el=document.getElementById(id);
  // var txt="<select id='categories' width=50px >";
  var txt="<option selected disabled hidden  >Choose point</option>";
  for (var i = 0; i < json_data.length; i++){
    txt+="<option id='"+json_data[i].point_id+"' data-tokens='"+json_data[i].name+"'>"+json_data[i].name+ " - Minutes :"+json_data[i].average_time_minutes+" - Rank :"+json_data[i].average_ranking+"</option>";
    // addElement(id,"option",json_data[i].point_id,txt);
    // txt="";
  }
  txt+="</select>";

  el.innerHTML=txt;
  // console.log(json_data);


  //   <div class="btn-group">
  //   <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  //     Action
  //   </button>
  //   <div class="dropdown-menu">
  //     <a class="dropdown-item" href="#">Action</a>
  //     <a class="dropdown-item" href="#">Another action</a>
  //     <a class="dropdown-item" href="#">Something else here</a>
  //     <div class="dropdown-divider"></div>
  //     <a class="dropdown-item" href="#">Separated link</a>
  //   </div>
  // </div>
}

function showCategory(id){
  var query_category='select * from category where category.category_id NOT IN ("3","7")';
  callAjax(concatenateCategories,'../db_conn.php?query='+query_category,id);

}

function addElement(parentId, elementTag, elementId, html) {
  // Adds an element to the document
  var p = document.getElementById(parentId);
  var newElement = document.createElement(elementTag);
  newElement.setAttribute('id', elementId);
  newElement.innerHTML = html;
  p.appendChild(newElement);
}
function removeElement(remove_id,select_id,category_id,action="") {
  // Removes an element from the document
  if (action=="table"){
    var is_accessible=document.querySelector('input[name = accessible]:checked').value;
    var select_el=document.getElementById("categories_by_points_option");
    var cat_id=select_el.options[select_el.selectedIndex].id;
    var p_average_time=parseInt(document.getElementById(remove_id).children[1].textContent);
    var current_time=parseInt(document.getElementById("time_left_label").value);
    var tour_duration_time=current_time+p_average_time;
    document.getElementById("time_left_label").innerHTML="<b>Time left (minutes) : " +tour_duration_time+"</b>";
    document.getElementById("time_left_label").value=tour_duration_time;
    var query_points='select * from point_of_interest where point_of_interest.category_id='+cat_id+' and point_of_interest.is_accessible='+is_accessible + ' and point_of_interest.average_time_minutes<="'+tour_duration_time+'" order by point_of_interest.average_time_minutes desc';
    callAjax(concatenatePointsDropDown,'../db_conn.php?query='+query_points,select_id);
  }
  console.log('remove_id : '+remove_id);
  var element = document.getElementById(remove_id);
  element.parentNode.removeChild(element);
  var select_el=document.getElementById(select_id);
  console.log("inside removeElement : category_id --> "+category_id);

  select_el.namedItem(category_id).disabled=false;
  console.log("inside removeElement: "+ category_id);


}
function setTimeLeft(){
  var time= document.getElementById("tour_duration_time").value;
  document.getElementById("time_left_label").innerHTML="<b>Time left (minutes): "+time+"</b>";
  document.getElementById("time_left_label").value=time;
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




// ================for cards!!!


// <div class="row">
//   <div class="col-sm-6 col-md-4">
//     <div class="thumbnail">
//       <img src="..." alt="...">
//       <div class="caption">
//         <h3>Thumbnail label</h3>
//         <p>...</p>
//         <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
//       </div>
//     </div>
//   </div>
// </div>


// ===============================================================



// =====================for people who already registrate==============

// <div class="panel panel-default">
//   <!-- Default panel contents -->
//   <div class="panel-heading">Panel heading</div>
//   <div class="panel-body">
//     <p>...</p>
//   </div>
//
//   <!-- Table -->
//   <table class="table">
//     ...
//   </table>
// </div>

// ==============================================================
