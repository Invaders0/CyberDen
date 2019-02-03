<?php
    ob_start();         // this is for output buffering for redirecting the pages....
	session_start();
	if(!(isset($_SESSION['user_id']) && isset($_SESSION['user_email']) && isset($_SESSION['user_name']) && isset($_SESSION['user_image']) && isset($_SESSION['signup_time'])))
		header("Location:../");
?>
<!-- READ STORIES PAGE -->
<!DOCTYPE html>
<html lang='en'>
<head>
<title>InstinctMe</title>
<?php
	include_once("../php/css_files.php");
?>
<style>
body{
	overflow-x: hidden;
	background-color : rgb(250,250,250);
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
a {
	cursor : pointer;
}
a:hover{
	text-decoration:none;
}
.badge{
	background-color : orange;
}
</style>
</head>
<body onload='read_stories()'>
<!-- 										************************ navigation bar starts **********************************************						-->
<?php
	include_once("../php/header.php");
?>
<!-- 										************************ navigation bar ends   **********************************************						-->
<div class='container' style='margin-top:80px'>
	<div class='row'>
		<div class='alert alert-success alert-dismissable wow bounceInRight'>
		<a href='#' class='close' data-dismiss='alert' aria-lable='close'>&times;</a>
		<strong>InstinctMe</strong> provides you the successful and failure stories which can you learn from both. If it is failure story, we learn how 
		to overcome  failures. If it is success, we learn how to succeed in our life. You can the select the category to read particular stories.<br />
		<strong><u>Note  </u>  : </strong> In every story there is conclusion which gives us the key points to remember. 
		</div>
	</div>
</div>
<!-- 									*************************** stories division    ***********************************					-->
<div class='container-fluid'>
	<div class='row'>
		<div class='col-sm-1'></div>
		<div class='col-sm-8' >
			<div class='page-header'>
				<h3><strong>InstinctMe </strong>/ Read Stories</h3>
			</div><br />
			<div>
				<span id='stories_div'></span>
			</div>
		</div>
		<div class='col-sm-3'> 
			<br /><br /><br />
			<div class='input-group'>
				<select name='category' id='category' class='form-control' >
					<option value="all">All Posts</option>
					<option value='failure story'>Failure Story</option>
					<option value='success story'>Success Story</option>
					<option value='depression overcome story'>Depression overcome story</option>
					<option value='others'>Other Category</option>
				</select>
				<span class="input-group-btn">
					<button class="btn btn-success" type="button" onclick="read_stories()">Go!</button>
				</span>
			</div>	
		</div>
	</div>
</div> 
<!-- 								FOOTER SECTION STARTS  				-->
<?php
	//include_once("../php/footer.php");
?>
<!-- 								FOOTER SECTION ENDS 				-->
<!-- 					JS FILES TO LOAD FASTER   -->
<?php
	include_once("../php/js_files.php");
?>
<script>
new WOW().init();
</script>
<script>
$(document).ready(function(){
	$("#read-stories").addClass("active");
	friend_requests_count();
	notifications_count();
}
);
</script>
<!-- script to call the read_stories() function that fetches the stories posted by users  -->
<script>
// function to get the stories from the read_stories.php    
function read_stories(){
	var category = $("#category").val();
	if(category){
		$("#stories_div").html("<center><img src='../assets/images/loading.gif' width='100px' height='100px' style='margin:0px' /></center>");
		$.get("../php/read_stories.php",{category : category}, function(data){
			$("#stories_div").html(data);
		});
	}
}
// function to update the views and get the total number of views from the views.php
function views(story_id, user_id=""){
	if(!user_id)
		$("#"+story_id+"_views").html("...");
	$.post("../php/views.php", {story_id : story_id, user_id : user_id},function(data){
		if(data != "Already viewed")
			$("#"+story_id+"_views").html(data);
	});
}
// function to get the friendship status between the current logged person and story person
function get_status(sent_by, sent_to, story_id){
	if(sent_by && sent_to && story_id && sent_by != sent_to){
		$.post("../php/get_status.php",{sent_by : sent_by, sent_to : sent_to},function(data){
			if(data == "send_request"){
				$("#"+story_id+"_friend").html("<button class='btn btn-success' onclick='send_request("+sent_by+","+sent_to+","+story_id+")'>Send Friend Request</button>");
			}else if(data == "processing" || data == "accepted" || data == "rejected"){
				$("#"+story_id+"_friend").html("");
			}else{
				$("#"+story_id+"_friend").html(data);
			}
		});
	}
}
// function to send the friend request
function send_request(sent_by, sent_to, story_id){		// story_id is for identification of element with particular id
	if(sent_by && sent_to && story_id){
		$("#"+story_id+"_friend").html("processing...");
		$.post("../php/send_request.php",{sent_by : sent_by, sent_to : sent_to},function(data){
			if(data == "ok")
				$("#"+story_id+"_friend").html("Request sent successfully...");
			else if(data == "already sent")
				$("#"+story_id+"_friend").html("Already sent.");
			else
				$("#"+story_id+"_friend").html(data);
		});
	}
}
function friend_requests_count(){
	$.get("../php/friend_requests_count.php",function(data){
		if(data == 0)
			$(".fnd_req_count").html("");
		else if (data > 0){
			$(".fnd_req_count").html(data);
		}
	});
}
function notifications_count(){				// this is to count the notifications to current users which are unseen
	$.get("../php/notifications_count.php",function(data){
		if(data > 0){
			$(".notifications_indicator").html("<span style='color:orange;font-size:20px'><b>*</b></span>");
			$(".notifications_count").html(data);
		}
	});
}
function story_complaint(user_id, story_id, story_user_id,id){			// id is this
	$(id).html("processing...");
	if(user_id && story_id && story_user_id){
		$.post("../php/story_complaint.php",{user_id : user_id, story_id : story_id, story_user_id : story_user_id},function(data){
			if(data == "ok"){
				$(id).html("Success...");
				$(id).hide(1000);
			}else{
				$(id).html(data);
			}
		});
	}
}
</script>
</body>
</html>
	