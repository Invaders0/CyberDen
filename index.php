<?php
    ob_start();         // this is output buffering useful in re-directing header locations
	session_start();
	if((isset($_SESSION['user_id'])  && isset($_SESSION['user_email']) && isset($_SESSION['user_name']) && isset($_SESSION['user_image']) && isset($_SESSION['signup_time'])))
		header("Location:home");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>CYBERDEN | Login</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="assets/mdb/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="assets/mdb/css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="assets/mdb/css/style.css" rel="stylesheet">
    <link href="assets/mdb/css/sidebar.css" rel="stylesheet">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <style>
    body{
        padding-top : 0px !important;
    }
    </style>
</head>

<body>
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
		    <span style="font-style:bold;font-size:20px">CYBERDEN</span>
                </div>
                <div id="sidebar_list">
                    <ul type="none" style="width : 100%;padding:0px;margin:0px">
                        <li class="btn"><a href="contact"><i class="fa fa-home"></i> Contact Us</a></li>
                        <li class="btn"><a href="#"><i class="fa fa-user-plus"></i> About Us</a></li>
                        <li class="btn"><a href="#"><i class="fa fa-home"></i> Support Us</a></li>
                    </ul>
                </div>
                <div id="sidebar_logout" align="center" style="margin-top : 20px">
                    <button type="button" class="btn btn-info" onclick="window.location.href='register'"><a href="#" style="color:white   ">Register</a></button>
                </div>
            </div>
        </nav>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark ">

     <div class="container">
      <a class="navbar-brand px-lg-4 mr-0 btn btn-outline-info" href="#">
	 <span style="font-style:bold;font-size:20px">CYBERDEN</span>
        </a>
      <!-- Collapse button -->
      <button class="navbar-toggler" type="button" id="sidebarCollapse" >
       <span class="navbar-toggler-icon"  style="background-color:lightblue!important"></span>
      </button>
      <!-- Collapsible content -->
      <div class="collapse navbar-collapse justify-content-end font-weight-bold" id="basicExampleNav">

        <!-- Navbar brand -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <button class="btn btn-outline-info btn-sm" style="border-radius:30px" onclick="window.location.href='register'">Register</button>
            </li>
        </ul>

       </div>

    </nav>
    <!-- /Start your project here-->

    <div class="container">
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
            <!-- Default form login -->
                <div class=" p-3 card">
                    <p class="h4 mb-4 text-center" style="margin-bottom:0px;padding-bottom:0px;">Sign in</p>
                    <!-- Email -->
                    <!--input type="email" id="defaultLoginFormEmail" class="form-control mb-4" placeholder="E-mail"-->
                    <p id="login_msg" align="center">&nbsp;</p>
                    <div class="md-form">
                        <i class="fa fa-envelope prefix"></i>
                        <input type="email" id="email_login" name="email" class="form-control">
                        <label for="email" > Email </label>
                    </div>
                    <!-- Password -->
                    <!--input type="password" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Password"-->
                    <div class="md-form">
                        <i class="fa fa-lock prefix"></i>
                        <input type="password" id="password_login" name="password" class="form-control">
                        <label for="password" > Password </label>
                    </div>
                    <div class="d-flex justify-content-around">
                        <div>
                            <!-- Remember me -->
                            <!--div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="defaultLoginFormRemember">
                                <label class="custom-control-label" for="defaultLoginFormRemember" style="font-size:13px">Remember me</label>
                            </div-->
                        </div>
                    </div>

                    <!-- Sign in button -->
                    <button class="btn btn-info btn-block my-4" type="submit" onclick="login()">Sign in</button>

                    <!-- Register -->
                    <p style="font-size:11px" align="center">Not a member?
                        <a href="register" class="text text-info" ><b>Register</b></a>
                    </p>
                    <div align="center">
                        <!-- Forgot password -->
                        <a href="#" id='forgot_password' style="font-size:11px;" class="text text-info"><b>Forgot password?</b></a>
                    </div>
                </div>
        <!-- Default form login -->
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12" align="center" style="padding-top:20px;font-size:12px">
                    <p><a href="#" style="padding-right:20px!important">About Us</a> | <a href="contact" style="padding-left:10px;padding-right:10px">Contact Us</a> | <a href="#" style="padding-left:10px">Support Us</a></p>
            </div>
            <div class="col-sm-12" align="center">
                <span style="font-size:10px">&copy;InstinctMe 2018</span>
            </div>
        </div>
        <!-- modal for engineering day wishes -->
        <!--div class="modal fade" id="wishes_modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"  style="width:100%">
            <div class="modal-dialog modal-lg" style="width:100%">
                <div class="modal-content">
                    <div class="modal-body">
                        <img src="assets/mdb/img/e.jpg"  width="100%" height="100%"/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
                    </div>
                </div>
            </div>
        </div-->
    </div>
    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="assets/mdb/js/jquery-3.3.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="assets/mdb/js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="assets/mdb/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="assets/mdb/js/mdb.min.js"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>


    <script type="text/javascript">
  	    $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#dismiss, .overlay').on('click', function () {
                $('#sidebar').removeClass('active');
                $('.overlay').removeClass('active');
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').addClass('active');
                $('.overlay').addClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
			var sidebar_parent_height = $("#sidebar")[0].scrollHeight;
            var sidebar_child_height = $("#sidebar_content").height();
            //alert(sidebar_parent_height + " " + sidebar_child_height);
            if(sidebar_parent_height > sidebar_child_height){
            	$("#sidebar_content").height(sidebar_parent_height);
            }else{
  
            }
            // to launch the modal
            //\$("#wishes_modal").modal("show");
            // to throw message when forgot paswd is clicked
           	$("#forgot_password").on('click',function(){
            	$("#login_msg").html("Please throw a mail to admin@instinctme.com");
        	});
        });
		function login(){
			var email = $("#email_login").val();
			var password = $("#password_login").val();
            if(!(validateEmail(email))){
                $("#login_msg").html("<span style='color:red;font-size:12px'>Enter valid email</span>")
                return;
            }
			if(email && password){
				$("#login_msg").html("<b><i class='fa fa-spinner fa-spin'></i></b>");
				$.post("php/login.php",{email : email, password : password},function(data){
					if(data == "success"){
						$("#login_msg").html("<span>Login success....</span>");
						window.location.href="home";
					}else if(data == "invalid password"){
						$("#login_msg").html("<span style='color:red;font-size:12px'>Invalid username or password</span>");
					}else if(data == "invalid email"){
						$("#login_msg").html("<span style='color:red;font-size:12px'>Invalid username or password</span>");	// invalid email
					}else if(data == "fail"){
						$("#login_msg").html("<span style='color;font-size:12px'>Invalid details.</span>");
					}else{
						$("#login_msg").html(data);
					}
				});
			}else{
				$("#login_msg").html("<span style='color:red;font-size:12px'>Please fill out all the fields.</span>");
			}
		}
        function validateEmail(email){
            var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
            if (filter.test(email)) {
                return true;
            }
            else {
                return false;
            }
        }
        // this is for enabling login by pressing the ENTER button and signup also just by pressing the enter
        document.getElementById("password_login").addEventListener('keydown',function(e){if (e.keyCode == 13){login();}});
    </script>
</body>

</html>
