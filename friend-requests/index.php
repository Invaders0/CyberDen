<?php
    ob_start();
	session_start();
	if(!(isset($_SESSION['user_id']) && isset($_SESSION['user_email'])))
		header("Location:../");
?>
<!-- Friend Requests PAGE -->
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
</style>
</head>
<body onload='get_friend_requests()'>
<!-- 										************************ navigation bar starts **********************************************						-->
<?php
	include_once("../php/header.php");
?>
<!-- 										************************ navigation bar ends   ********************************************** -->
<br /><br />
<div class='container-fluid'>
	<div class='col-sm-8'>
		<div class='page-header'>
			<h3><b>InstinctMe </b> / Friend Requests </h3>
		</div>
		<span id='request_msg'></span>
		<div id='friend_requests_div'>
		</div>
	</div>
	<div class='col-sm-4'>
		<div class='page-header'>
			<h3> Links .....</h3>
		</div>
	</div>
</div>
<!-- 			js files to load fast     -->
<?php
	include_once("../php/js_files.php");
?>
<script>
new WOW().init();
</script>
<script>
$(document).ready(function(){
	$("#friend-requests").addClass("active");			// this is in header file
	friend_requests_count();
	notifications_count();
});
// function to get the friend requests from the friend_requests.php
function get_friend_requests(){
	$("#friend_requests_div").html("<center><img src='../assets/images/loading.gif' width='100px' height='100px' style='margin:0px' /></center>");
	$.get("../php/friend_requests.php", function(data){
		$("#friend_requests_div").html(data);
	});
}
// function to send the acceptance of the request by the user
function accept_request(sent_by, accept_by,this_id){
	$(this_id).html("processing.......");
	$.post("../php/accept_request.php",{sent_by : sent_by, accept_by : accept_by},function(data){
		if(data == "ok"){
			$("#"+sent_by+"_request").hide(1000);
		}else{
			$("#request_msg").html(data);
		}
	});
}
function reject_request(sent_by, accept_by,this_id){
	$(this_id).html("processing.......");
	$.post("../php/reject_request.php",{sent_by : sent_by, accept_by : accept_by},function(data){
		if(data == "ok"){
			$("#"+sent_by+"_request").hide(1000);
		}else{
			$("#request_msg").html(data);
		}
	});
}
function friend_requests_count(){			// to count the friend requests		
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
</script>
</body>
</html>