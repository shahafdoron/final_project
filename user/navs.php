<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">


<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark navbar-static-top shadow">
  <div class="container">
    <div id="sideNavigation" class="sidenav">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
      <a href="homepage_user.php"><i class="fas fa-home"></i> Home</a>
      <a href="points_info.php"><i class="fas fa-info-circle"></i> Points Info</a>
      <a href="enter_dates_guided.php"><i class="fas fa-map-signs"></i> Guided Tours</a>
      <a href="independent_tour.php"><i class="fas fa-route"></i> Build A Tour</a>
      <a href="my_tours.php"><i class="fas fa-map"></i> My Tours</a>
      <a href="contact.php"><i class="fas fa-envelope-open-text"></i> Contact Us</a>

    </div>


    <nav class="topnav">

      <a onclick="openNav()" class="ham" href="#">
        <svg width="30" height="30" id="icoOpen" >
          <path d="M0,5 30,5" stroke="#818181" stroke-width="5"/>
          <path d="M0,14 30,14" stroke="#818181" stroke-width="5"/>
          <path d="M0,23 30,23" stroke="#818181" stroke-width="5"/>
        </svg>
      </a>
    </nav>


    <script>
    function openNav() {
      document.getElementById("sideNavigation").style.width = "250px";
      document.body.style.marginLeft = '250px';
    }

    function closeNav() {
      document.getElementById("sideNavigation").style.width = "0";
      document.body.style.marginLeft = '0';
    }
  </script>


  <a class="navbar-brand" href="homepage_user.php">Weizmann Institute of Science Tour Planing System</a>

</div>
<form  action="../index.php" method="POST">
  <button type="submit" name="logout" class="btn btn-light">
    <i class="fas fa-sign-out-alt"></i> Log out
  </button>
</form>
  </nav><br><br><br><br>



<style media="screen">
/* The side navigation menu */
.sidenav {
  height: 100%; /* 100% Full-height */
  width: 0; /* 0 width - change this with JavaScript */
  position: fixed; /* Stay in place */
  z-index: 1; /* Stay on top */
  top: 0;
  left: 0;
  background-color: #2e2eb8 ;
  overflow-x: hidden; /* Disable horizontal scroll */
  padding-top: 60px; /* Place content 60px from the top */
  transition: 0.5s; /* 0.5 second transition effect to slide in the sidenav */
}
.ham {
    color: #007bff;
    text-decoration: none;
    background-color: #2e2eb8;
}
.bg-dark {
    background-color: #2e2eb8 !important;
}/* The navigation menu links */
.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #c5c6c8fa;
  display: block;
  transition: 0.3s
}

/* When you mouse over the navigation links, change their color */
.sidenav a:hover, .offcanvas a:focus{
  color: #f1f1f1;
}

/* Position and style the close button (top right corner) */
.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

/* Style page content - use this if you want to push the page content to the right when you open the side navigation */
#main {
  transition: margin-left .5s;
  padding: 20px;
  overflow:hidden;
  width:100%;
}
body {

    background-color: #eff4f7;
    color: #777;
    font-family: 'Titillium Web', Arial, Helvetica, sans-serif;
    overflow-x: hidden;
}

/* Add a black background color to the top navigation */
.topnav {
  background-color: #333;
  overflow: hidden;
}

/* Style the links inside the navigation bar */
.topnav a {
  float: left;
  display: block;
  color: #c5c6c8fa;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

/* Change the color of links on hover */
.topnav a:hover {
  background-color: #ddd;
  color: black;
}

/* Add a color to the active/current link */
.topnav a.active {
  background-color: #4CAF50;
  color: white;
}

/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}

a svg{
  transition:all .5s ease;

  &:hover{
    #transform:rotate(180deg);
  }
}

#ico{
  display: none;
}

.menu{
  background: #000;
  display: none;
  padding: 5px;
  width: 320px;
  @include border-radius(5px);

  #transition: all 0.5s ease;

  a{
    display: block;
    color: #fff;
    text-align: center;
    padding: 10px 2px;
    margin: 3px 0;
    text-decoration: none;
    background: #444;

    &:nth-child(1){
      margin-top: 0;
      @include border-radius(3px 3px 0 0 );
    }
    &:nth-child(5){
      margin-bottom: 0;
      @include border-radius(0 0 3px 3px);
    }

    &:hover{
      background: #555;
    }

  }
}
</style>
<!-- an example for new navbar -->
<!-- <div class="pos-f-t">
<div class="collapse" id="navbarToggleExternalContent">
<div class="bg-dark p-4">
<h4 class="text-white">Collapsed content</h4>
<span class="text-muted">Toggleable via the navbar brand.</span>
</div>
</div>
<nav class="navbar navbar-dark bg-dark">
<button class="navbar-toggler" type="button" data-toggle="collapse"
data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent"
aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
</nav>
</div> -->
