
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
function concatenateGuides(json_data,id){

  // var el=document.getElementById("categories");
  var el=document.getElementById(id);
  // var txt="<select id='categories' width=50px >";
  var txt="<option selected disabled hidden>Choose Guide</option>";
  // var x = document.getElementById("guides_select");
  for (var i = 0; i < json_data.length; i++){
    txt+="<option id='"+json_data[i].user_id+"' name='guided_id' data-tokens='"+json_data[i].first_name+" "+json_data[i].last_name+"'>"+json_data[i].first_name+" "+json_data[i].last_name+"</option>";
  }
  // txt+="</select>";
  el.innerHTML=txt;
  console.log(json_data);
}


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

  user_type_here=user_type;
  var points_div=document.getElementById(id);
  // points_div.innerHTML="<p>"+JSON.stringify(json_data)+"</p>";

// ========old=================================
  // var txt="<br><br><div class'container'>";
  //   txt="<div class='card-group'>";
// ========old=================================

// ========new=================================
var txt="<br><br><div class'container'>";
txt="<div class='card-group'>";
var action="point_description.php?point=";

// ========new=================================


  console.log(json_data);
  for (var i = 0; i < json_data.length; i++) {
    // txt+="<div class='card' >";4
//===========================oldddd=========================
    txt+="<div class='col-4 mb-4 mt-4'>";
    txt+="<div class='card w-100 h-100 shadow p-3 mb-5 bg-white rounded'>";
    if (user_type_here=='3'){
    j=JSON.stringify(json_data[i]);
    txt+="<form method='POST' action='edit_point.php?point="+j+"'>";
    txt+="<button class='btn w-25 btn-rounded btn-primary' type='submit'><i class='fas fa-edit'></i></button>";
    txt+="</form>";
  }
    txt+="<img class='card-img-top embed-responsive-item text-center border' src='../images/points/"+json_data[i].point_id+".jpg' alt='Card image cap'  style='width:100%; height:250px;'>";
    txt+="<div class='card-header w-100 h-100  border'>";
    txt+="<h5 class='card-title text-center mt-3'>"+json_data[i].name+"</h5>";
    txt+="</div>";
    txt+="<div class='card-body card-footer d-flex flex-column border' >";
    txt+="<form  method='POST' action='"+action+JSON.stringify(json_data[i])+"'>";

    j=JSON.stringify(json_data[i]);
    txt+="<div class=' text-muted text-center'>";
    txt+="<p class='card-text '>Average ranking: "+json_data[i].average_ranking+"</p>";
    txt+="<input class='align-self-end btn btn-primary btn-lg btn-block' type='submit' value='For more details'>";

    txt+="</div>";
    txt+="</form>";
    txt+="</div>";

    txt+="</div>";
    txt+="</div>";


  }
  console.log("inside concatenatePoints");

  txt+="</div>";
  txt+="</div>";
  points_div.innerHTML=txt;


}
// function setFormAction(j){
//
//   console.log("t.php?point="+j);
//   var form_el=document.getElementById("point_card_form");
//   form_el.action=action="t.php?point="+j;
//   // form_el.submit();
// }


function concatenateGuidedTours(json_data,user_type){
  console.log(json_data);
  var counter=1;
  var txt="";
  if (json_data.length==0) {
    txt+="<h1 style=\"text-align: center;\"><u> There's no tours in the selected date</h1>";
  }
  if (user_type==1) {
    for (i=0;i<json_data.length;i++){
      txt+="<div class='row mt-2 border shadow p-3 mb-5 bg-white rounded'>";
      txt+="<div class='card w-100 h-50 mb-24 p-2 '>";
      txt+="<div class='card-header'><u><h5>Tour number "+counter+"</h5>  </u></div>"
      txt+="<div class='card-body align-items-center d-flex justify-content-center'>";
      txt+="<form method='POST' action='guided_info_book.php?tour="+JSON.stringify(json_data[i])+"&counter="+counter+"'>";
      txt+="<p class='card-text'><u>Date</u>: "+json_data[i].tour_date+", <u>Hours</u>: "+json_data[i].Start_time+"-"+json_data[i].Finish_Time+"</p>";
      txt+="<p class='card-text'><u>Cost</u>: "+json_data[i].tour_cost+"₪</p>";
      txt+="<div style=\"text-align: center;\"><input class='btn btn-primary btn-lg btn-block' type='submit' value='More information and booking'></div>";
      txt+="</form>";
      txt+="</div>";
      txt+="</div>";
      txt+="</div>";
      counter+=counter;
    }
  }
  else if (user_type==3)
  {
    for (i=0;i<json_data.length;i++){
      txt+="<div class='row mt-2 border shadow p-3 mb-5 bg-white rounded'>";
      txt+="<div class='card w-100 h-50 mb-24 p-2 '>";
      txt+="<form method='POST' action='admin_edit_guided.php?tour="+JSON.stringify(json_data[i])+"&counter="+counter+"'>";
      txt+="<div class='card-header'><div class='row '><div class='col'><u><h5>Tour Number "+counter+"</h5></u></div><div class='.col-6 .col-md-4'><button type=\"submit\" class=\"btn btn-primary \"><i class='fas fa-pencil-alt'></i></button></div></div></form></div>";
      txt+="<div class='card-body '>";
      txt+="<div class='container'><div class='row justify-content-md-center'><div class='col-6 col-md-4'>";
      txt+="<p class='card-text '><u>Date</u>: "+json_data[i].tour_date+", <u>Hours</u>: "+json_data[i].Start_time+"-"+json_data[i].Finish_Time+"</p>";
      txt+="<p class='card-text'><u>Tour Cost</u>: "+json_data[i].tour_cost+"₪</p></div></div></div> ";
      txt+="<form method='POST' action='admin_guided_table.php?remaining="+JSON.stringify(json_data[i].remaining_tickets)+"&tour_id="+JSON.stringify(json_data[i].guided_tour_id)+"'>";
      txt+="<div style=\"text-align: center;\"><input class='btn btn-primary mt-3 ' type='submit' value='Show Current Participants List'></div>";
      txt+="</form>";
      txt+="</div>";
      txt+="</div>";
      txt+="</div>";
      counter+=counter;
    }
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
    var tour_id=json_data[i].tour_id;
    txt+="<div class='row mt-4 ml-3 mr-3'>";
    txt+="<div class='card w-100 shadow p-3 bg-white rounded '>";

    txt+="<div class='card-body d-flex flex-column p-2'>";
    txt+="<form method='POST' action='start_tour_map.php?json_tour="+JSON.stringify(json_data[i])+"'>";
    txt+="<div class='row justify-content-between'>"  ;
    txt+="<div class='col-6'>";
    txt+="<h5 class='card-title mr-auto'>Tour number "+json_data[i].tour_id+" ("+type+") </h5>";
    txt+="</div>";
    txt+="<div class='col-1'>";
    txt+="<span ><button class='btn btn-primary' type='button' onclick='removeTourFromSchedule("+tour_id+","+json_data[i].tour_type+")'><i class='fas fa-trash-alt'></i></button></span>";
    txt+="</div>";
    txt+="</div>";
    txt+="<p class='card-text'>Date: "+json_data[i].planned_date_and_time_tour+"</p>";
    if (json_data[i].has_started=='0'){
        txt+="<input class='btn btn-primary btn-lg btn-block' type='submit' value='Start Tour'>";
    }
    else{
        txt+="<input class='btn btn-primary btn-lg btn-block' type='submit' value='Show Tour Map'>";
    }

    txt+="</form>";
    txt+="</div>";
    txt+="</div>";
    txt+="</div>";
    console.log(json_data[i]);
  }
  // document.getElementById("my_tours_schedule").innerHTML+=txt;
  document.getElementById(id).innerHTML+=txt;
}
function removeTourFromSchedule(tour_id,tour_type){
  var action='';
  var json_data={}
  json_data["tour_id"]=tour_id;
  if (tour_type=='2'){
    action='remove_guided_from_schedule';
  }
  else{
    action='remove_independent_from_schedule';

  }
  sendAjax('../db_conn.php',action,json_data);
  // window.location.reload();
  console.log(tour_id);
  console.log(action);
  console.log(tour_type);
}

function showMySchedule(biger_or_smaller, has_started,user_id,id){


  var condition='AND';
  if (has_started=='1'){
    condition='OR';
  }
  document.getElementById(id).innerHTML="";

  var query_get_tours ="SELECT tour.tour_id,tour.tour_type,tour.planned_date_and_time_tour,tour.tour_duration,tour.has_started,user.user_id ";
  query_get_tours+="FROM user,tour,independent_tour ";
  query_get_tours+="WHERE tour.tour_id=independent_tour.independent_tour_id ";
  query_get_tours+="AND user.user_id=independent_tour.independent_tourist_id ";
  query_get_tours+="AND user.user_id='"+user_id+"' ";
  query_get_tours+="AND (tour.planned_date_and_time_tour"+biger_or_smaller+"NOW() "+condition+" tour.has_started="+has_started+") UNION ";
  query_get_tours+="SELECT tour.tour_id,tour.tour_type,tour.planned_date_and_time_tour,tour.tour_duration,tour.has_started,user.user_id ";
  query_get_tours+="FROM user,tour,guided_tour,guided_tour_registration ";
  query_get_tours+="WHERE guided_tour.guided_tour_id=tour.tour_id ";
  query_get_tours+="AND guided_tour_registration.guided_tour_id=tour.tour_id ";
  query_get_tours+="AND guided_tour_registration.registered_tourist_id=user.user_id ";
  query_get_tours+="AND user.user_id='"+user_id+"' ";
  query_get_tours+="AND (tour.planned_date_and_time_tour"+biger_or_smaller+"NOW() "+condition+" tour.has_started="+has_started+")";
  query_get_tours+="ORDER BY planned_date_and_time_tour ASC ";
  console.log(query_get_tours);
  callAjax(concatenateSchedule,'../db_conn.php?query='+query_get_tours,id);

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
function showGuides(id){
  var query_guided='select user_id,first_name,last_name from user where user_type=2';
  callAjax(concatenateGuides,'../db_conn.php?query='+query_guided,id);

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
function removeElement(remove_id,select_id,category_id,action="",step=0) {
  // Removes an element from the document
  if (action=="table"){
    var is_accessible=document.querySelector('input[name = accessible]:checked').value;
    var select_el=document.getElementById("categories_by_points_option");
    var cat_id=select_el.options[select_el.selectedIndex].id;
    var p_average_time=parseInt(document.getElementById(remove_id).children[1].textContent)*(-1);
    manageTimeIncrement('positive',step,'time_left_label');
    var tour_duration_time=document.getElementById("time_left_label").value;
    var query_points='select * from point_of_interest where point_of_interest.category_id='+cat_id+' and point_of_interest.is_accessible='+is_accessible + ' and point_of_interest.average_time_minutes<="'+tour_duration_time+'" order by point_of_interest.average_time_minutes desc';
    console.log(query_points);
    callAjax(concatenatePointsDropDown,'../db_conn.php?query='+query_points,select_id);
  }
  // console.log('remove_id : '+remove_id);
  var element = document.getElementById(remove_id);
  element.parentNode.removeChild(element);
  var select_el=document.getElementById(select_id);
  // console.log("inside removeElement : category_id --> "+category_id);
  select_el.namedItem(category_id).disabled=false;
  // console.log("inside removeElement: "+ category_id);


}
function setTimeLeft(){
  var time= parseInt(document.getElementById("tour_duration_time").value);
  document.getElementById("time_left_label").innerHTML="<b>Time left (minutes): "+time+"</b>";
  document.getElementById("time_left_label").value=time;
}

function setCurrentValue(lable_to_manage,new_val){
    var current_time=parseInt(document.getElementById(lable_to_manage).value);
    document.getElementById(lable_to_manage).innerHTML="<b>Time left (minutes) : " +new_val+"</b>";
    document.getElementById(lable_to_manage).value=new_val;
    // return tour_duration_time;


}
function manageTimeIncrement(increment_type,step,lable_to_manage){
  // var previous_val=document.getElementById("time_left_label").value;

  // incrementInputOnly(input_id,increment_type,step);
  var lable_el=document.getElementById(lable_to_manage);
  var current_lable_val=parseInt(lable_el.value);
  var new_val=0;
  switch (increment_type){

    case "negative":
    new_val=current_lable_val-step;
    break;

    case "positive":
    new_val=current_lable_val+step;
    break;
  }
  console.log('new_val ' + new_val);
if (new_val>=0){
  setCurrentValue(lable_to_manage,new_val);
}



  // var input_val = parseInt(document.getElementById(input_id).value);

   // if (current_val > previous_val) {
   //   setCurrentTime(step);
   //   console.log("++++");
   // } else if (current_val < previous_val) {
   //   setCurrentTime(-step);
   //   console.log("---");
   // }
   // previous_val = current_val;
}

function incrementInput(input_id,min_val,max_val,step,increment_type,lable_to_manage){
    var input_el=document.getElementById(input_id);
    var numeric_input_val = parseInt(input_el.value);
    var numeric_min_val=parseInt(min_val);
    var numeric_max_val=parseInt(max_val);
    var numeric_step=parseInt(step);
    var was_changed=false;


    if( numeric_input_val< numeric_max_val && numeric_input_val>numeric_min_val){
      input_el.value=numeric_input_val+numeric_step;
      was_changed=true;
    }
    else if (numeric_input_val==numeric_min_val) {
      if (numeric_step>0){
        input_el.value=numeric_input_val+numeric_step;
        was_changed=true;
      }
    }
    else if (numeric_input_val==numeric_max_val) {
      if (numeric_step<0){
        input_el.value=numeric_input_val+numeric_step;
        was_changed=true;
      }
    }

    if(was_changed){
      manageTimeIncrement(increment_type,numeric_step,lable_to_manage);
    }



}





function loadTourData(algo_key='',total_tour_duration,points_json,category_json={}){
  var data_div_el=document.getElementById("data");
  var ht='';
  if(algo_key=='1'){
    console.log('loadTourData');
    for (var category in category_json ){
      var cat_time=parseFloat(total_tour_duration)*parseFloat(category_json[category]['category_weight']);
      ht+='<div class="container mt-2 ml-1 mr-1 mb-1 border shadow" style="width:95%; height:23%;">';
      ht+='<div class="row ml-1 mt-1">';
      ht+='<h5>'+category+'</h5>';
      ht+='</div>';

      cat_points='';
      cat_actual_time=0;
      for (var i=0; i<points_json.length; i++){
        if (points_json[i]["category_id"]==category_json[category]["category_id"]){
          cat_points+=points_json[i]["point_id"] + ' , ';
          cat_actual_time+=parseInt(points_json[i]["average_time_minutes"]);
        }
      }
      cat_points=cat_points.slice(0,-2);
      ht+='<div class="row ml-1">';
      ht+='<h7>Time : '+cat_actual_time+ '/' +cat_time+'</h7>';
      ht+='</div> ';
      ht+='<div class="row ml-1">';
      ht+='<h7 >Points: '+cat_points+'</h7>';
      ht+='</div> ';
      ht+='</div>';
      ht+='</div>';
      data_div_el.innerHTML=ht;
      }
    }

    else if(algo_key=='0'){
      ht+='<div class="container mt-2 ml-1 mr-1 mb-2 border shadow" style="width:95%; height:90%;">';
      ht+='<div class="row ml-1 mt-1">';
      ht+='<h7><b>Planned Tour Duration : <br></b>'+total_tour_duration+' (minutes)</h7>';
      ht+='</div> ';

      cat_points='';
      var total_time=0;
      for (var i=0; i<points_json.length;i++){
        cat_points+=points_json[i]["point_id"] + ' , ';
        total_time+=parseInt(points_json[i]["average_time_minutes"]);
      }
      cat_points=cat_points.slice(0,-2);
      ht+='<div class="row ml-1 mt-1">';
      ht+='<h7><b>Points : </b><br>'+cat_points+'</h7>';
      ht+='</div> ';
      ht+='<div class="row ml-1 mt-3">';
      ht+='<h5 class="text-danger align-text-bottom"><b>Actual Total Time: </b><br>'+total_time+' (minutes)</h5>';
      ht+='</div> ';
      ht+='</div> ';
    }



    // ht+='<ul class="list-group">';
    // ht+='<li class="list-group-item">Cras justo odio</li>';
    // ht+='<li class="list-group-item">Dapibus ac facilisis in</li></ul>';
    data_div_el.innerHTML=ht;

  }



  function createSelectPoints(select_id,div_id,table_id){

    // var categories_select_el=document.getElementById(select_id);
    var categories_select_el=document.getElementById(select_id);
    var tour_duration_time=document.getElementById("time_left_label").value;
    var is_accessible=document.querySelector('input[name = accessible]:checked').value;
    var category_id=categories_select_el.options[categories_select_el.selectedIndex].id;
    var select_points_id="select_points_per_category";
    var query_points='select * from point_of_interest where point_of_interest.category_id='+category_id+' and point_of_interest.is_accessible='+is_accessible + ' and point_of_interest.average_time_minutes<="'+tour_duration_time+'" order by point_of_interest.average_time_minutes desc ';
    console.log(query_points);
    // var ht='<select class="custom-select" id="'+select_points_id+'" width=50px ><option selected  >Choose point</option></select>';

    // addElement(div_id,"select",select_points_id,ht);                                                                                               table_id table_id
    document.getElementById(div_id).innerHTML='<select class="custom-select" id="'+select_points_id+'" name="'+select_points_id+'" onchange="addPointToTable( \''+select_points_id+'\' ,\''+table_id+'\',\''+category_id+'\',\''+is_accessible+'\')" width=50px ><option selected  >Choose point</option></select>';
    callAjax(concatenatePointsDropDown,'../db_conn.php?query='+query_points,select_points_id);


  }

  function addPointToTable(select_points_id,table_id,category_id,is_accessible){
    console.log(select_points_id);
    console.log(table_id);
    var tour_duration=document.getElementById("tour_duration_time").value;
    var points_select_el=document.getElementById(select_points_id);
    points_select_el.options[points_select_el.selectedIndex].disabled=true;
    // var selected_point_val=points_select_el.options[points_select_el.selectedIndex].value.split("-").map(function(item) {
    //   return item.trim();
    // });
    var selected_point_val=points_select_el.options[points_select_el.selectedIndex].value.split("-");

    for (var i=1; i<selected_point_val.length; i++){
      selected_point_val[i]=selected_point_val[i].split(":")[1];
    }
    var selected_point_id=points_select_el.options[points_select_el.selectedIndex].id;
    var j_point={"p_id":selected_point_id,"p_name":selected_point_val[0], "p_average_time":selected_point_val[1],"p_average_ranking":selected_point_val[2]};
    var tr_id="tr_p"+j_point["p_id"];
    var step=parseInt(j_point["p_average_time"]);
    var categories_select_el=document.getElementById("categories_by_points_option");
    var category_name=categories_select_el.options[categories_select_el.selectedIndex].value;

    var ht=' <td id="' + j_point["p_id"] + '" "class="pt-3-half" >'+j_point["p_name"]+'</td> <td id='+category_id+' value='+category_name+'>'+category_name+'</td><td class="pt-3-half" >'+j_point["p_average_time"]+'</td><td class="pt-3-half" >'+j_point["p_average_ranking"]+'</td>';
    ht+='<td><span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0" onclick="removeElement( \''+tr_id+'\' ,\''+select_points_id+'\', \''+j_point["p_id"]+'\',\'table\','+step+');">Remove</button></span></td>';


    var p_average_time=parseInt(j_point["p_average_time"]);

    addElement(table_id,"tr",tr_id,ht);
    manageTimeIncrement('negative',step,'time_left_label');
    var tour_duration_time=document.getElementById("time_left_label").value;
    // add here function call for disabllling all point ids which already inside the table and than add them as "not in()" to the query.
    var query_points='select * from point_of_interest where point_of_interest.category_id='+category_id+' and point_of_interest.is_accessible='+is_accessible + ' and point_of_interest.average_time_minutes<="'+tour_duration_time+'" order by point_of_interest.average_time_minutes desc';
    callAjax(concatenatePointsDropDown,'../db_conn.php?query='+query_points,select_points_id);

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
    ht+='<div class="card bg-light mb-3 border shadow rounded ">';
    ht+='<button  class="btn-close-custom"  type="button" onclick="removeElement( \''+cat_div_id+'\' ,\''+select_id+'\', \''+category_id+'\');"><i>Remove</i></button>';
    ht+='<div class="card-header">'+category_value+'</div>';
    ht+='<div class="card-body">';
    ht+='<input id="'+category_id+'"  type="number" value="0" min="0" max="1" step="0.05"  class="form-control" placeholder="0-1"  aria-describedby="btnGroupAddon" required >';
    ht+='</div></div></div>';
    addElement(div_id,"div",cat_div_id,ht);
  }

  function validateGeneralInputs(){
    var pass_validation=true;
    var now=new Date(new Date(new Date().toString().split('GMT')[0]+' UTC').toISOString().split('.')[0]);
    var d_user=new Date(document.getElementById("planned_tour_date_time").value);
    console.log(typeof(now));
    console.log(typeof(d_user));
    var tour_duration_time=document.getElementById("tour_duration_time").value;
    var cafeteria_is_selected=document.querySelector('input[name = cafeteria]:checked').value;
    console.log(cafeteria_is_selected);

    if(d_user < now){
      pass_validation=false;
      alert("Please enter valid date and time");
    }
    else if (tour_duration_time=="" || tour_duration_time=="0"){
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

    var js={};
    var category_id_js={};
    var js_point_category={};
    for (var i=1; i<child.length;i++){
      console.log("inside loop");
      var p_id=child[i].children[0].id
      var cat_id=child[i].children[1].id;
      var cat_name=child[i].children[1].textContent;

      js_point_category[p_id]=cat_id;
      if(!(cat_name in js)){
        js[cat_name]={};
        js[cat_name]["category_id"]=cat_id;
        js[cat_name]["points"]=[];
        console.log("inside the first if");
        // category_id_js[cat_id]=cat_name;
      }
      js[cat_name]["points"].push(p_id);
    }

    console.log("final_json");
    console.log(js);
    result["json_data"]=JSON.stringify(js);

    return result;
  }
