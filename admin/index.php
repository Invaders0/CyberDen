<!DOCTYPE html>
<html lang='en'>
<head>	
<title> InstinctMe | Admin </title>
<?php
	include_once("php/css_files.php");
?>
</head>
<body style="background:url('assets/images/login_bg1.jpg');background-size:100% 678px">
<!-- container1 page header starts -->
<div class='container'>
	<!-- first container row starts -->
	<div class='row'>
		<div class='col-xs-2'></div>
		<div class='col-xs-8' >
			<div class='page-header' align='center'>
				<img src='assets/images/instinctme2.png'  class='wow bounceIn' height='70px'/>
			</div>
		</div>
		<div class='col-xs-2'></div>
	</div>
</div>
<br /><br /><br />
<div class='container'>
	<div class='row'>
		<div 
		<div class='col-xs-4'></div>
		<div class='col-xs-4'>
			<div class='form panel panel-default'>
				<div class='panel-heading'>
					<center><span style='font-size:20px;'><i class='fa fa-lock'></i> Admin - Login</span></center>
				</div><br />
				<div class='panel-body' style='padding:20px;padding-top:5px'>
					<p id='admin_login_msg' style='height:30px;text-align:center'></p>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-user"></i></span>
						<input id="admin_email" type="text" class="form-control input-lg" name="email" placeholder="Email" >
					</div><br /><br />
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-lock"></i></span>
						<input id="admin_password" type="password" class="form-control input-lg" name="password" placeholder="******">
					</div><br /><br />
					<button type='button' class='btn btn-primary' style='margin-left:40%' onclick='admin_login()'>Login</button>
				</div>
			</div>
		</div>
		<div class='col-xs-4'></div>
	</div>
</div>
<!-- js files at the bottom to load page fast -->
<?php
	include_once("php/js_files.php");
?>
<script>
	new WOW().init();
//function to login admin
function admin_login(){
	var admin_email = $("#admin_email").val();
	var admin_password = $("#admin_password").val();
	if(admin_email && admin_password){
		$("#admin_login_msg").html("<img src='assets/images/loading3.gif' width='100px' style='margin-top:-20px' />");
		$.post("php/admin_login.php",{admin_email : admin_email, admin_password : admin_password},function(data){
			if(data == "success"){
				$("#admin_login_msg").html("Login success...");
				window.location.href = "admin.php";
			}else if(data == "invalid password"){
				$("#admin_login_msg").html("Invalid Password");
			}else if(data == "invalid username"){
				$("#admin_login_msg").html("Invalid Username");
			}else if(data == "fail"){
				$("#admin_login_msg").html("Please enter valid details.");
			}else{
				$("#admin_login_msg").html(data);
			}
		});
	}else{
		$("#admin_login_msg").html("Please fill out all the fields.");
	}
}
</script>
</body>
</html>