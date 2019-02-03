<?php
ob_start();
session_start();
if(!(isset($_SESSION['admin_email']) && isset($_SESSION['admin_id'] ) && isset($_SESSION['admin_name']))){
	header("Location:index.php");
}
?>
<!DOCTYPE html>
<html lang='en'>
<head>
<title> InstinctMe | Admin</title>
<?php
	include_once("php/css_files.php");
?>
<style>
body{
	overflow-x: hidden;
}
.navbar{
	background-color : #004040;
	padding-right : 20px;
}
.navbar a{
	color : white;
	font-size : 16px;
}
.navbar .navbar-nav > li > a{
	margin-right : 1px;
	margin-left : 1px;
}
.navbar .navbar-nav > li > a:hover, .navbar .navbar-nav > li > a:focus, .navbar .active{
	box-shadow: 0px -3px 0px orange inset;
	background-color : #004040;
	color : white;
}
#footer {
	#background-color:rgb(102,192,152);
	background-color : #004040;
	color: white;
	font-size: 20px;
	padding-top : 20px;
}
.badge{
	background-color: orange;
}
.div_cursor:hover{
	cursor : pointer;
}
</style>
</head>
<body>
<!-- 										************************ navigation bar starts **********************************************						-->
<nav class='navbar navbar-fixed-top'>
	<div class='container-fluid'>
		<div class='navbar-header '>
			<button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#navbar_collapse' align='left;'>
				<span class='icon-bar' style='background-color:white'></span>
				<span class='icon-bar' style='background-color:white'></span>
				<span class='icon-bar' style='background-color:white'></span>
			</button>
			<a href='' ><img src='assets/images/instinctme_white.png'   style='height:50px' width='300px'/></a>
		</div>
		<div class='collapse navbar-collapse' id='navbar_collapse'>
			<ul class='nav navbar-nav navbar-right '>
				<li id='home'><a href="#"><i class='fa fa-user'></i> Admin Panel </a></li>
				<li ><a href='#' class='dropdown-toggle' data-toggle='dropdown'><?php echo $_SESSION['admin_name'];?><span class='notifications_indicator'></span></a>
				<li><a href='logout'>Logout</a></li>
			</ul>
		</div>
	</div>
</nav>
<!-- 										************************ navigation bar ends   ********************************************** -->
<br /><br /><br /><br /><br />
<!--div class='container-fluid'>
	<div class='row'>
		<div class='col-xs-2' style='border-right:0px solid black'>
			<div class='div_cursor' style='border-bottom:1px solid gray;display:block;height:40px;line-height:40px'><h4><i class='fa fa-book'></i> Stories Complaints</h4></div>
			<div class='div_cursor' style='border-bottom:1px solid gray;display:block;height:40px;line-height:40px'><h4><i class='fa fa-ban'></i> Block Story </h4></div>
			<div class='div_cursor' style='border-bottom:1px solid gray;display:block;height:40px;line-height:40px'><h4><i class='fa fa-bell'></i> Send Notification</h4></div>
			<div class='div_cursor' style='border-bottom:1px solid gray;display:block;height:40px;line-height:40px'><h4><i class='fa fa-comments'></i> Users Feedback</h4></div>
			<div class='div_cursor' style='border-bottom:0px solid gray;display:block;height:40px;line-height:40px'><h4><i class='fa fa-user-plus'></i> Add another admin</h4></div>
		</div>
		<div class='col-xs-10'>
			<div id='admin_div'>
			</div>
		</div>
	</div>
</div-->
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-2">
			<ul class="nav nav-pills nav-stacked" >
			  <li class="active"><a data-toggle="pill" href="#stories_complaints"><i class='fa fa-book'></i> Stories Complaints</a></li>
			  <!--li><a data-toggle="pill" href="#block_story" onclick="show_orders()" ><i class='fa fa-ban'></i> Block Story</a></li-->
			  <li><a data-toggle="pill" href="#send_notification"><i class='fa fa-bell'></i> Send Notification</a></li>
			  <li><a data-toggle="pill" href="#users_feedback"><i class='fa fa-comments'></i> Users Feedback</a></li>
			  <li><a data-toggle="pill" href="#add_admin"><i class='fa fa-user-plus'></i> Add another admin</a></li>
			</ul>
		</div><br />
		<div class="col-sm-10" style='border:1px solid #004040'>
			<div class="tab-content">
			  <!-- stories_complaints div starts -->
			  <div id="stories_complaints" class="tab-pane fade in active">
				<h3 class='page-header'>Stories Complaints</h3>
				<div class='col-sm-6'>
					<?php
					// to get the complaints on stories given by users
						include_once("php/connect.php");
						$result = $conn->query("SELECT DISTINCT complaint_user_id, story_id, story_user_id FROM stories_complaints WHERE status = 0");
						if(!$result)
							die("Error at executing the query.");
						$table = 0;
						$row = $result->fetch_assoc();
						if($row){
							$table = 1;
							echo"
								<table class='table table-bordered table-striped table-responsive'>
									<tr><th>Complaint By</th><th>Story Id</th><th>Story User Id</td><th>View</th><th>Block</th><th>Correct</th></tr>
							";
						}else{
							echo "No complaints on stories yet.";
						}
						while($row){
							$complaint_user_id = $row['complaint_user_id'];
							$story_id = $row['story_id'];
							$story_user_id = $row['story_user_id'];	// all this is one row only.
							echo "
								<tr><td>$complaint_user_id</td><td>$story_id</td><td>$story_user_id</td>
								<td><button class='btn btn-primary' onclick='view_story($story_id)'>View</button></td>
								<td><button class='btn btn-danger' onclick='block_story($complaint_user_id, $story_id, $story_user_id, this)'><i class='fa fa-ban'></i>Block</button></td>
								<td><button class='btn btn-success' onclick='remove_complaint($complaint_user_id, $story_id, $story_user_id,this)'>Correct</button></td></tr>
							";
							$row = $result->fetch_assoc();
						}
						if($table){
							echo "
								</table>
							";
						}
						//$conn->close();		it is not closed because it's need at feedback session.
					?>
				</div>
				<div class='col-sm-6'>	<!-- to view the story by the admin --->
					<div id='story_view'>
					<p>Here story is displayed by clicking the view_story button.</p>
					</div>
				</div>
			  </div>
			  <!-- stories_complaints div ends -->
			  
			  <!-- send_notification div starts -->
			  <div id="send_notification" class="tab-pane fade" style='padding:50px;padding-top:0px;'>
				<h3 class='page-header'> Send Notification</h3>
				<div class='form'>
					<div class="input-group col-xs-3">
						<span class="input-group-addon">TO</span>
						<input id="to" type="text" class="form-control" name="to" placeholder="User Id">
					</div><br />
					<textarea name='notification' id='notification' class='form-control' placeholder='Enter your message...'></textarea><br />
					<div class='col-xs-3'><button class='btn btn-primary' onclick='send_notification()'>Send <i class='fa fa-paper-plane'></i></button></div><div id='send_msg' class='col-xs-9'></div>
				</div>
			  </div>
			  <!-- send_notification div ends -->
			  
			  <!-- users feedback div starts -->
			  <div id="users_feedback" class="tab-pane fade">
				<h3 class='page-header'>Feedback...</h3>
				<div>
					<?php
						//include_once("php/connect.php");		since already conn opened in the above one.
						$result = $conn->query("SELECT * FROM feedback ORDER BY time DESC");
						if(!$result)
							die("Error at executing.");
						$table = 0;
						$row  = $result->fetch_assoc();
						if($row){
							$table = 1;
							echo "
								<table class='table table-bordered table-striped table-responsive'>
									<tr><th>User Id</th><th>Feedback</th></tr>
							";
						}
						while($row){
							$user_id = $row['user_id'];
							$feedback = $row['feedback'];
							echo "
								<tr><td>$user_id</td><td>$feedback</td></tr>
							";
							$row = $result->fetch_assoc();
						}
						if($table){
							echo "
								</table>
							";
						}
					?>
				</div>
			  </div>
			  <!-- users feedback div ends -->
			  
			  <!-- add admin div starts -->
			  <div id="add_admin" class="tab-pane fade" style='padding:50px;padding-top:0px'>
					<h3 class='page-header'>Add Admin</h3>
					<div class="input-group col-xs-4">
						<span class="input-group-addon"><i class='fa fa-envelope'></i></span>
						<input id="add_admin_email" type="text" class="form-control" name="add_admin_email" placeholder="Admin email">
					</div><br />
					<div class="input-group col-xs-4">
						<span class="input-group-addon"><i class='fa fa-user'></i></span>
						<input id="add_admin_name" type="text" class="form-control" name="add_admin_name" placeholder="Admin name">
					</div><br />
					<div class="input-group col-xs-4">
						<span class="input-group-addon"><i class='fa fa-lock'></i></span>
						<input id="add_admin_password" type="password" class="form-control" name="add_admin_password" placeholder="*****">
					</div><br />
					<div class='col-xs-4'><button class='btn btn-primary' onclick='add_admin()'>Add <i class='fa fa-paper-plane'></i></button></div><div id='add_admin_msg' class='col-xs-8'></div>
			  </div>		
			  <!-- add admin div ends -->
			  <?php /*
			  $smt->close();
			  $mysqli->close(); */
			  ?>
			</div>
		</div>
	</div>
</div>
<!-- js files at the bottom  -->
<?php
	include_once("php/js_files.php");
?>
<script>
new WOW().init();
// view_story function to view the story which have complaint
function view_story(story_id){
	$("#story_view").html("<img src='assets/images/loading3.gif' width='100px' />");
	if(story_id){
		$.post("php/view_story.php",{story_id : story_id}, function(data){
			$("#story_view").html(data);
		});
	}else{
		$("#story_view").html("No story id or error at view_story function.");
	}
}
// block_story function to block the story which is abuse by the admin
function block_story(complaint_user_id, story_id, story_user_id, id){		// id is this (js element)
	$(id).html("loading...");
	if(complaint_user_id && story_id && story_user_id){
		$.post("php/block_story.php",{complaint_user_id : complaint_user_id, story_id : story_id, story_user_id : story_user_id},function(data){
			if(data == "ok"){
				$(id).html("Blocked");
				$(id).hide(1000);
			}else{
				$("#story_view").html(data);
			}
		});
	}else{
		$(id).html("Error");
	}
}
// function to remove the complaint from the database
function remove_complaint(complaint_user_id, story_id, story_user_id, id){			// id is this (js element)
	$(id).html("loading...");
	if(complaint_user_id && story_id && story_user_id){
		$.post("php/remove_complaint.php",{complaint_user_id: complaint_user_id, story_id : story_id, story_user_id : story_user_id},function(data){
			if(data == "ok"){
				$(id).html("Removed");
				$(id).hide(1000);
			}else{
				$("#story_view").html(data);
			}
		});
	}else{
		$(id).html("Error");
	}
}
// function to send notification by admin
function send_notification(){
	var user_id = parseInt($("#to").val());
	var notification = $("#notification").val();
	$("#send_msg").html("<img src='assets/images/loading3.gif' width='100px' />");
	if(user_id && notification){
		$.post("php/send_notification.php",{user_id : user_id, notification : notification}, function(data){
			if(data == "ok"){
				$("#send_msg").html("Notification send successfully....");
				$("#to").val("");
				$("#notification").val("");
			}else{
				$("#send_msg").html(data);
			}
		});
	}else{
		$("#send_msg").html("Please enter valid data.");
	}
}
// function to add the admin by any admin
function add_admin(){
	var admin_email = $("#add_admin_email").val();
	var admin_name = $("#add_admin_name").val();
	var admin_password = $("#add_admin_password").val();
	$("#add_admin_msg").html("<img src='assets/images/loading3.gif' width='100px' style='margin-top:-20px' />");
	if(admin_email && admin_name && admin_password){
		$.post("php/add_admin.php",{admin_email : admin_email, admin_name : admin_name, admin_password : admin_password},function(data){
			if(data == "ok"){
				$("#add_admin_msg").html("Added successfully...");
				$("#add_admin_email").val("");
				$("#add_admin_name").val("");
				$("#add_admin_password").val("");
			}else if(data == "already registered"){
				$("#add_admin_msg").html("Already registered with the entered email.");
			}else{
				$("#add_admin_msg").html(data);
			}
		});
	}else{
		$("#add_admin_msg").html("Please enter valid data.");
	}
}
</script>
</body>
</html>