<?php
    ob_start();         // this is to start the buffering useful in header location changes
	session_start();
	if(!(isset($_SESSION['user_id'])))
		header("Location:../");
?>
<!-- CONTACT-US page -->
<!DOCTYPE html>
<html lang='en'>
<head>
<title>InstinctMe | Contact-Us</title>
<?php
	include_once("../php/css_files.php");
?>
<!-- javascript is written at bottom to load faster -->
<style>
body{
	overflow-x: hidden;
}

.badge{
	background-color: orange;
}
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
<!-- 										************************ navigation bar ends   ********************************************** -->
<!-- 										************************ Contact-Us bar starts  ********************************************* -->
<br /><br /><br />
<div class='container'>
	<div class='row'>
		<div class='col-sm-6 wow bounceInLeft'>
			<h3 class='page-header'><i class='fa fa-phone'></i> Contact - Us</h3>
			<h4><i class='fa fa-envelope'></i> e-mail : <span style='color:orange'>admin@instinctme.com</span></h4>
			<h4><i class='fa fa-whatsapp'></i> <i>whatsapp</i> : <span style='color:orange'>+91&nbsp;6301530691</span></h4>
		</div>
		<div class='col-sm-6 wow bounceInRight'>
			<h3 class='page-header'><i class='fa fa-bank'></i> Office Address</h4>
			<address>
				<p><b> GF-62 </b>,</p>
				<p><b>I1 Block</b>,</p>
				<p><b>APIIIT - RGUKT</b>,</p>
			</address>
		</div>
	</div>
	<div class='row'>
		<div class='col-sm-12 wow fadeIn'>
			<h3 class='page-header'><i class='fa fa-comments'></i> Feedback / Suggestions </h3>
			<textarea id='feedback' name='feedback' rows = "10" class='form-control' placeholder='Please give your feedback on our website functionining and also provide your valuable suggestions to improve our website.'></textarea><br />
			<button class='btn btn-info' style='margin-left:48%' onclick="feedback_send(<?php echo $_SESSION['user_id']; ?>)">Send <i class='fa fa-paper-plane'></i></button> <span id='feedback_send_msg' style='margin-left:30px'></span>
		</div>
	</div>
</div>
<!-- js files at the bottom to load the page faster -->
<?php
	include_once("../php/js_files.php");
?>
<script>
new WOW().init();
$(document).ready(function(){
	friend_requests_count();
	notifications_count();
}
);
// feedback function to send feedback
function feedback_send(user_id){
	var feedback = $("#feedback").val();
	if(user_id && feedback){
		$("#feedback_send_msg").html("<img src='../assets/images/loading3.gif' width='100px' height='100px' style='margin:-40px;margin-left:100px' />");
		$.post("../php/feedback_send.php",{user_id : user_id, feedback : feedback}, function(data){
			if(data == "ok" || data == "already sent"){
			    $("#feedback").val("");
				$("#feedback_send_msg").html("Thanks for giving your valuable feedback. Thank you.");
			}else{
				$("#feedback_send_msg").html(data);
			}
		});
	}else{
		$("#feedback_send_msg").html("Please fill all fields. Thank you.");
	}
}
function friend_requests_count(){			// to count the number of friend requests for current user.
	$.get("../php/friend_requests_count.php",function(data){
		if(data == 0)
			$(".fnd_req_count").html("");
		else if (data > 0){
			$(".fnd_req_count").html(data);
		}
	});
}
function notifications_count(){				// to display the no of notifications of current user.
	$.get("../php/notifications_count.php",function(data){
		if(data > 0){
			$(".notifications_indicator").html("<span style='color:orange;font-size:20px'><b>*</b></span>");
			$(".notifications_count").html(data);
		}
	});
}
</script>
<body>
</body>
</html>