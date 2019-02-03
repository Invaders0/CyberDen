
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>InstinctMe | Contact</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="../assets/mdb/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="../assets/mdb/css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="../assets/mdb/css/style.css" rel="stylesheet">
    <link href="../assets/mdb/css/sidebar.css" rel="stylesheet">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <style>
    body{
        padding-top : 0px !important;
    }
    </style>
</head>

<body style="background:#fafafa!important">
    <!-- Start your project here-->
    <div class="wrapper">
        <!-- Sidebar  -->
       <nav id="sidebar">
       		<div id="sibebar_content_opacity">
       		</div>
       		<div id="sidebar_content">
		        <div id="dismiss">
		            <i class="fa fa-arrow-left"></i>
		        </div>
		        <!--h3 align="center">InstinctMe</h3-->
		        <!--ul id="sidebar_list">
		            <li class="sidebar_item">HOme</li>
		            <li class="sidebar_item">SIgnup</li>
		        </ul-->
                <!--div id="user_div" align="center" style="border-bottom:1px solid lightblue">
                    <img src="assets/mdb/img/sidebar_3.jpg" width="100px" height="100px" style="border-radius: 50%"/>
                    <h3 style="color:lightblue"><i class="fa fa-user"></i>UserName</h3>
                </div-->
                <div id="instinctme_brand" style="border-bottom: 1px solid lightblue">
                    <br /><br />
                    <img src="../assets/mdb/img/instinctme.png" width="100%" height="60px" />
                </div>
                <div id="sidebar_list">
                    <ul type="none" style="width : 100%;padding:0px;margin:0px">
                        <li class="btn"><a href="#"><i class="fa fa-home"></i> Contact Us</a></li>
                        <li class="btn"><a href="#"><i class="fa fa-user-plus"></i> About Us</a></li>
                        <li class="btn"><a href="#"><i class="fa fa-home"></i> Support Us</a></li>
                    </ul>
                </div>
                <div id="sidebar_logout" align="center" style="margin-top : 20px">
                    <button type="button" class="btn btn-info" onclick="window.location.href='../'"><a href="#" style="color:white   ">Login</a></button>
                </div>
                <div id="sidebar_logout" align="center" style="margin-top : 20px">
                    <button type="button" class="btn btn-info" onclick="window.location.href='../register'"><a href="#" style="color:white   ">Register</a></button>
                </div>
            </div>
        </nav>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark ">

     <div class="container">
      <a class="navbar-brand px-lg-4 mr-0 btn btn-outline-info" href="#">
         <img src="../assets/mdb/img/instinctme.png" height="30" alt="">
        </a>
      <!-- Collapse button -->
      <button class="navbar-toggler" type="button" >
       <span class="navbar-toggler-icon" id="sidebarCollapse" style="background-color:lightblue!important"></span>
      </button>
      <!-- Collapsible content -->
      <div class="collapse navbar-collapse justify-content-end font-weight-bold" id="basicExampleNav">

        <!-- Navbar brand -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <button class="btn btn-outline-info btn-sm" style="border-radius:30px" onclick="window.location.href='../'"><a href="#">Login</a></button>
            </li>
            <li class="nav-item">
                <button class="btn btn-outline-info btn-sm" style="border-radius:30px" onclick="window.location.href='../register'"><a href="#">Register</a></button>
            </li>
        </ul>

       </div>

    </nav>
    <div class='container'>
        <div class='row'>
            <div class='col-sm-6 wow bounceInLeft'>
                <h3 class='page-header'><i class='fa fa-phone'></i> Contact - Us</h3>
                <h4><i class='fa fa-envelope'></i> e-mail : <span style='color:orange'>admin@instinctme.com</span></h4>
                <h4><i class='fa fa-whatsapp'></i> <i>whatsapp</i> : <span style='color:orange'>+91&nbsp;6301530691</span></h4>
            </div>
            <div class='col-sm-6 wow bounceIn'>
                <h3 class='page-header'><i class='fa fa-bank'></i> Office Address</h3>
                <address>
                    <p><b> GF-62 </b>,</p>
                    <p><b>I1 Block</b>,</p>
                    <p><b>APIIIT - RGUKT</b>,</p>
                </address>
            </div>
        </div>
        <!--div class='row'>
            <div class='col-sm-12 wow fadeIn'>
                <h3 class='page-header'><i class='fa fa-comments'></i> Feedback / Suggestions </h3>
                <textarea id='feedback' name='feedback' rows = "10" class='form-control' placeholder='Please give your feedback on our website functionining and also provide your valuable suggestions to improve our website.'></textarea><br />
                <button class='btn btn-info' style='margin-left:48%' >Send <i class='fa fa-paper-plane'></i></button> <span id='feedback_send_msg' style='margin-left:30px'></span>
            </div>
        </div-->
    </div>
    <!-- js files at the bottom to load the page faster -->
    <?php
        include_once("../php/js_files.php");
    ?>
    <script>
    new WOW().init();
    </script>
<body>
</body>
</html>