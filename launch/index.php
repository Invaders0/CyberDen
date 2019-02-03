<?php
    ob_start();
    session_start();
?>
<!-- this is notifications/ index.php file -->
<!DOCTYPE html>
<html lang='en'>
<head>
<title> InstinctMe | Launch </title>
<?php
    include_once("../php/css_files.php");
?>
</head>
<body>
<style>
body{
    overflow-x: hidden;
    height : 100%;
    width:100%;
    margin : 0px;
    padding-top : 0px !important;
}
#footer {
    #background-color:rgb(102,192,152);
    background-color : #004040;
    color: white;
    font-size: 20px;
    padding-top : 20px;
}
.friend_cursor:hover{
    cursor:pointer;
}
<!-- to hide the scroll bar -->
html{
    overflow: scroll;
    overflow-x: hidden;
}
::-webkit-scrollbar{
    width:0px;
    background:transparent;
}
.badge{
    background-color : orange;
}
@media screen and (min-width : 766px){
    #frnd_requests{
        display : none;
    }
}
</style>
</head>
<body style="background-image:url('../assets/mdb/img/back2.jpg');background-size: 100%"">
<!--                                        ************************ navigation bar starts **********************************************                       -->
<!--nav class="navbar navbar-expand-lg navbar-dark ">

     <div class="container">
      <a class="navbar-brand px-lg-4 mr-0 btn btn-outline-info" href="#">
         <img src="../assets/mdb/img/instinctme.png" height="30" alt="">
        </a>
      <button class="navbar-toggler" type="button" >
       <span class="navbar-toggler-icon" id="sidebarCollapse" style="background-color:lightblue!important"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end font-weight-bold" id="basicExampleNav">

        <ul class="navbar-nav">
            <li class="nav-item">
                <button class="btn btn-outline-info btn-sm" style="border-radius:30px">Launching!</button>
            </li>
        </ul>

       </div>

    </nav-->
<!--                                        ************************ navigation bar ends   ********************************************** -->
<br />
<div class="container">
  <div class="row">
    <div class="col-lg-8">
    </div>
    <div class="col-lg-4" style="padding-top:250px">
      <div> 
        <center><button type="button" class="btn btn-info btn-lg" onclick="launch()">Launch InstinctMe <i class='fa fa-hand-o-right'></i></button></center>
      </div>
    </div>
  </div>
</div>
  <div class="modal fade" id="launch_modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"  style="width:100%">
    <br /><br />
      <div class="modal-dialog" style="width:100%">
          <div class="modal-content">
              <div class="modal-body">
                  <h1 style='color:green'>InstinctMe has Launched.</h1>
                  <p align="center"> Thank you</p>
              </div>
          </div>
      </div>
  </div>
<!-- js files to load faster -->
<?php 
    include_once("../php/js_files.php");
?>
<script>
new WOW().init();
function launch(){
    $("#launch_modal").modal("show");
    setTimeout(function () {
       window.location.href = "https://www.instinctme.com"; 
    }, 1000);
}
</script>
</body>
</html>