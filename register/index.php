<?php
    ob_start();         // this is output buffering useful in re-directing header locations
	session_start();
	if((isset($_SESSION['user_id'])  && isset($_SESSION['user_email']) && isset($_SESSION['user_name']) && isset($_SESSION['user_image']) && isset($_SESSION['signup_time'])))
		header("Location:../home");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>CYBERDEN | Register</title>
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
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <style>
    body{
        padding-top:0px !important;
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
                    <img src="../assets/mdb/img/sidebar_3.jpg" width="100px" height="100px" style="border-radius: 50%"/>
                </div-->
                <div id="instinctme_brand" style="border-bottom: 1px solid lightblue">
                    <br /><br />
    		    <span style="font-style:bold;font-size:20px">CYBERDEN</span>
                </div>
                <div id="sidebar_list">
                    <ul type="none" style="width : 100%;padding:0px;margin:0px">
                        <li class="btn"><a href="#"><i class="fa fa-home"></i> Contact Us</a></li>
                        <li class="btn"><a href="#"><i class="fa fa-user-plus"></i> About Us</a></li>
                        <li class="btn"><a href="#"><i class="fa fa-home"></i> Support Us</a></li>
                    </ul>
                </div>
                <div id="sidebar_logout" align="center" style="margin-top : 20px">
                    <button type="button" class="btn btn-info" onclick="window.location.href='../'"><a href="#" style="color:white;display:block;">Login</a></button>
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
                <button class="btn btn-outline-info btn-sm" style="border-radius:30px" onclick="window.location.href='../'">Login</button>
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
                <div class="card p-3">

                    <p class="h4 mb-4 text-center">Register</p>
 					<p id="signup_msg" align="center">&nbsp;</p>
                    <div class="form-row mb-4">
                            <!-- First name -->
                            <input type="text" id="user_name_signup" name="user_name_signup" class="form-control" placeholder="Name">
                    </div>

                    <!-- E-mail -->
                    <input type="email" id="email_signup" name="email_signup" class="form-control mb-4" placeholder="E-mail">

                    <!-- Password -->
                    <input type="password" id="password_signup" name="password_signup" class="form-control" placeholder="Password" aria-describedby="password_help_block">
                    <small id="password_help_block" class="form-text text-muted text-center mb-4">
                        At least 8 characters and 1 digit
                    </small>

                    <!-- Phone number -->
                    <input type="password" id="confirm_password_signup" name="confirm_password_signup" class="form-control" placeholder="Confirm Password" aria-describedby="password_help_block">

                    <!-- Newsletter >
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="newsletter">
                        <label class="custom-control-label" for="newsletter">Subscribe to our newsletter</label>
                    </div-->

                    <!-- Sign up button -->
                    <button class="btn btn-info my-4 btn-block" type="submit" onclick="signup()">Sign in</button>
                    <hr>

                    <!-- Terms of service -->
                    <p style="font-size:12px">By clicking
                        <em>Sign up</em> you agree to our terms of services and conditions of InsticntMe.</p>

                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-12" align="center" style="padding-top:20px;font-size:12px">
                    <p><a href="#" style="padding-right:20px!important">About Us</a> | <a href="#" style="padding-left:10px;padding-right:10px">Contact Us</a> | <a href="#" style="padding-left:10px">Support Us</a></p>
            </div>
            <div class="col-sm-12" align="center">
                <span style="font-size:10px">&copy;InstinctMe 2018</span>
            </div>
        </div>
    </div>
    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="../assets/mdb/js/jquery-3.3.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="../assets/mdb/js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="../assets/mdb/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="../assets/mdb/js/mdb.min.js"></script>
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
        });
		// function for sign up and login
		function signup(){
			var user_name = $("#user_name_signup").val();
			var email = $("#email_signup").val();
			var password = $("#password_signup").val();
			var confirm_password = $("#confirm_password_signup").val();
			if(email && password && confirm_password){
			    if(!(validateEmail(email))){
			        $("#signup_msg").html("<span style='font-size:12px;color:red'>Enter valid email.</span>");
			        return;
			    }
				$("#signup_msg").html("<i class='fa fa-spinner fa-spin></i>");
				if(password == confirm_password){
					//alert(validatePassword(password));
					if(!(validatePassword(password))){
						$("#signup_msg").html("<b>Please choose strong passwrod.</b>");
						return;
					}
					$.post("../php/signup.php",{user_name : user_name, email : email, password : password},function(data){
						if(data == "success"){
							$("#signup_msg").html("<span style='font-size:14px'>Registered successfully. Please Login</span>");
							//$("#login_modal").modal("show");
						}
						else if(data == "fail"){
							$("#signup_msg").html("<span style='color:red;font-size:12px'>Please enter valid details.</span>");
						}
						else if(data == "Already registered"){
							$("#signup_msg").html("<span style='color:red;font-size:12px'>User already registered. Please Login.</span>");
							//$("#login_modal").modal("show");
						}
						else{
							$("#signup_msg").html(data + ". Please try again." );
						}
					});
				}else{
					$("#signup_msg").html("<span style='color:red;font-size:12px'>Password and Confirm password must match.</span>");
				}
				$("#user_name_signup").val("");
				$("#email_signup").val("");
				$("#password_signup").val("");
				$("#confirm_password_signup").val("");
			}else{
				$("#signup_msg").html("<span style='color:red;font-size:12px'>Please fill out all the fields.</span>");
			}
		}
		document.getElementById("confirm_password_signup").addEventListener('keydown',function(e){if (e.keyCode == 13){signup();}});
		function validateEmail(email){
		    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
		    if (filter.test(email)) {
		        return true;
		    }
		    else {
		        return false;
		    }
		}
		function validatePassword(password){
			var regexp = /\d/g;
			if(password.length >= 8 && regexp.test(password)){
				return true;
			}
			else{
				return false;
			}
		}
    </script>
</body>

</html>
