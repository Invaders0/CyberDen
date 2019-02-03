<?php
    ob_start();
	session_start();
	if(!(isset($_SESSION['user_name']) && isset($_SESSION['user_id']) && isset($_SESSION['user_email']) && isset($_SESSION['user_image']) && isset($_SESSION['signup_time']))){
		header("Location:../");
	}
	$user_id = $_SESSION['user_id'];
?>
<!-- this is profile index.php file -->
<!DOCTYPE html>
<html lang='en'>
<head>
<title>CYBERDEN | Profile</title>
<?php
	include_once("../php/css_files.php");
?>
<style>
body{
	overflow-x: hidden;
	background-color : rgb(250,250,250);
	padding-top: 0px;
}
#footer {
	#background-color:rgb(102,192,152);
	background-color : #004040;
	color: white;
	font-size: 20px;
	padding-top : 20px;
}
a {
	cursor : pointer;
}
a:hover{
	text-decoration:none;
}
.badge{
	background-color : orange;
}
.user-details {position: relative; padding: 0;}
.user-details .user-image {position: relative;  z-index: 1; width: 100%; text-align: center;}
 .user-image img { clear: both; margin: auto; position: relative;}
.user-details .user-info-block {width: 100%; position: absolute; top: 55px; background: rgb(255, 255, 255); z-index: 0; padding-top: 35px;}
 .user-info-block .user-heading {width: 100%; text-align: center; margin: 10px 0 0;}

 @media screen and (min-width : 766px){
	#frnd_requests{
		display : none;
	}
}

</style>
</head>
<body>
<!-- 										************************ navigation bar starts **********************************************						-->
<?php
	include_once("../php/header.php");
	include_once("../php/sidebar.php");
?>
<!-- 										************************ navigation bar ends   **********************************************						-->
<br /><br /><br /><br />
<div class="container">
	<div class="row">
		<div class='col-sm-1'></div>
		<div class="col-sm-10 user-details">
            <div class="user-image">
                <img src="<?php echo '../profile/uploads/'  . $_SESSION['user_image'] ; ?>" id='img' alt="User-Image" title="<?php echo $_SESSION['user_name']; ?>" class="rounded-circle" width='100px' height='100px' />
            </div>
            <div class="user-info-block card" style="padding-right:10px;padding-left:10px">
                <div class="user-heading">
                    <h3><?php echo $_SESSION['user_name']; ?></h3> 
                    <span class="help-block"><?php echo $_SESSION['user_email']; ?></span>
                </div>
                <hr />
                <ul class="nav nav-pills nav-justified">
                    <li class="nav-item">
                        <a data-toggle="tab" href="#user_details" class="nav-link active">
                            <span class="fa fa-user"> User Details</span>
                        </a>
                    </li>
                    <li class='nav-item'>
                        <a data-toggle="tab" href="#activity" class="nav-link">
                            <span class="fa fa-align-justify"> &nbsp;Activity</span>
                        </a>
                    </li>
                    <li class='nav-item'>
                        <a data-toggle="tab" href="#change_password" class="nav-link">
                            <span class="fa fa-cog"> Change Password</span>
                        </a>
                    </li>
					<li class='nav-item'>
						<a data-toggle="tab" href="#change_profile_image" class="nav-link">
							<span class='fa fa-user'> Update Profile Image</span>
						</a>
					</li>
                </ul>
                <div class="user-body">
                    <div class="tab-content" style="padding:20px;padding-top: 30px">
                        <div id="user_details" class="tab-pane active">
                            <p>Email : <span style='font-size:18px'><?php echo $_SESSION['user_email']; ?></span></p>
						<p>Member Since : <span style='font-size:18px'><?php $date = explode(" ", $_SESSION['signup_time']); echo $date[0];  ?></span></p>
                        </div>
                        <div id="activity" class="tab-pane row" style="padding:10px" align='center'>
							<?php
								include_once("../php/connect.php");
								$result = $conn->query("SELECT score from users WHERE user_id = ".$_SESSION['user_id']);
								if(!$result)
									die("Error at at executing");
								$row = $result->fetch_assoc();
								echo "<span class='col-lg-3'><i class='fa fa-user'></i> Total Points &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp; <b>". $row['score'] ."</b></span><br /><br />";
								$result = $conn->query("SELECT COUNT(*) as total_followers FROM followers WHERE following = ".$_SESSION['user_id'] . " AND status = 1");
								if(!$result)
									die("Error at executing");
								$row = $result->fetch_assoc();
								echo "<span class='col-lg-3'><i class='fa fa-user'></i> Followers &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp; <b>". $row['total_followers'] ."</b></span><br /><br />";
								$result = $conn->query("SELECT COUNT(*) as total_following FROM followers WHERE followed_by = ".$_SESSION['user_id']." AND status = 1");
								if(!$result)
									die("Error at executing");
								$row = $result->fetch_assoc();
								echo "<span class='col-lg-3'><i class='fa fa-user-plus'></i> Following &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp; <b>". $row['total_following'] ."</b></span><br />";
								$conn->close();
							?>
                        </div>
                        <div id="change_password" class="tab-pane">	
							<div style="padding-right:20px;padding-left:20px">
								<div class="md-form form-sm">
									<i class="fa fa-lock prefix"></i>
									<input id="current_password" type="password" class="form-control" name="current_password" />
									<label for="current_password" data-error="wrong" data-success="right">Current Password</label>
								</div>
								<div class="md-form">
									<i class="fa fa-lock prefix"></i></span>
									<input id="new_password" type="password" class="form-control" name="new_password" />
									<label for="new_password" data-error="wrong" data-success="right">New Password</label>
								 </div>
								<p id="change_password_msg" align="center">&nbsp;</p>
								<center><button class='btn btn-outline-info' onclick="change_password()">Change Password</button></center>
							 </div>
						</div>
						<div id='change_profile_image' class='tab-pane' align="center">
							<!--span style='font-size:18px'>Upload Image : </span><br /><br />
							<input type='file' name='fileToUpload' id='fileToUpload' /><br />
							<div class='col-sm-12'><b>Note : </b> Image size should not exceed 500KB.</div><br /><br />
							<button type='button' id='img_upload' class='btn btn-outline-info' align='center'> Update</button>
							<span class='col-sm-2'></span>
							<span class='col-sm-8'><p id='update_profile_msg' style='line-height:30px;font-weight:bold'></p></span-->
							<div class="input-group mb-3 col-lg-6">
							  <div class="input-group-prepend">
							    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
							  </div>
							  <div class="custom-file">
							    <input type="file" class="custom-file-input" id="fileToUpload" name="fileToUpload" aria-describedby="inputGroupFileAddon01">
							    <label class="custom-file-label" for="fileToUpload">Choose file</label>
						  		</div>
							</div>
							<div id="update_msg_sec">
								<p id="update_profile_msg"></p>
								<button type='button' id='img_upload' class='btn btn-outline-info' align='center'> Update</button>
							</div>
						</div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
<!-- js files to load faster -->
<?php
	include_once("../php/js_files.php");
?>
<script>
// function to change the profile pic
$("input[type=file]").change(function () {
  var fieldVal = $(this).val();

  // Change the node&#39;s value by removing the fake path (Chrome)
  fieldVal = fieldVal.replace("C:\\fakepath\\","" );
    
  if (fieldVal != undefined || fieldVal != "") {
    $(this).next(".custom-file-label").attr('data-content', fieldVal);
    $(this).next(".custom-file-label").text(fieldVal);
  }
});

// function to get the score of the user
function get_score(user_id){
	$.post("../php/get_score.php",{user_id:user_id},function(data){
		$(".score").html(data);
	});
}
$(document).ready(function(){
    get_score( <?php echo $_SESSION['user_id']; ?>);
    $("#img_upload").click(function(){
        var fd = new FormData();
        var files = $('#fileToUpload')[0].files[0];
		if(files){
		    $("#update_profile_msg").html("Loading...");
			fd.append('fileToUpload',files);
			$.ajax({
				url: 'upload.php',
				type: 'post',
				data: fd,
				contentType: false,
				processData: false,
				success: function(response){
					if(response == "ok"){
						$("#update_profile_msg").html("Uploaded successfully..");
						window.location.href="";
					}else{
						$("#update_profile_msg").html(response);
					}
				},
			});
		}else{
			$("#update_profile_msg").html("Please select the image.");
		}
    });
});
// function to change the password of the current user
function change_password(){
	var current_password = $("#current_password").val();
	var new_password = $("#new_password").val();
	if(current_password && new_password){
		$("#change_password_msg").html("<img src='../assets/images/loading3.gif' width='100px' style='margin-top:-20px' />");
		$.post("../php/change_password.php",{current_password : current_password, new_password : new_password},function(data){
			if(data == "ok")
				$("#change_password_msg").html("Changed successfully...");
			else if(data == "invalid current password")
				$("#change_password_msg").html("Invalid Current Password");
			else
				$("#change_password").html(data);
		});
	}else{
		$("#change_password_msg").html("Please fill out all the fields.");
	}
}
</script>
</body>
</html>
