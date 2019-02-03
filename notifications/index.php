<?php
    ob_start();
	session_start();
?>
<!-- this is notifications/ index.php file -->
<!DOCTYPE html>
<html lang='en'>
<head>
<title> InstinctMe | Notifications </title>
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
<body style="background:#fafafa!important">
<!-- 										************************ navigation bar starts **********************************************						-->
<?php
	include_once("../php/header.php");
	include_once("../php/sidebar.php");
?>
<!-- 										************************ navigation bar ends   ********************************************** -->
<br />
<div class='conatiner-fluid'>
	<div class='row'>
		<div class='col-sm-1'></div>
		<div class='col-sm-7'>
			<!--h3 class='page-header'  style='color : #004040'><b>InstinctMe / Notifications </b></h3-->
			<div id='notifications' style='padding-left:20px'>
				<?php
					// here notifications are fetched from the database and shown to the users.
					include_once("../php/connect.php");
					// getting the notifications from the notifications table  
					$stmt = $conn->prepare("SELECT * FROM notifications WHERE user_id = ? OR user_id = -1 ORDER BY time DESC ");
					if(!$stmt)
						die("Error at preparing statement." .$conn->error);
					if(!$stmt->bind_param("i",$_SESSION['user_id']))
						die("Error at binding parameters." . $stmt->error);
					if(!$stmt->execute())
						die("Error at executing parameters." . $stmt->error);
					$result = $stmt->get_result();
					if(!$result)
						die("Error at getting result.");
					$row = $result->fetch_assoc();
					$count = 1;
					$table = 0;				// to know where table is opened or not
					if(!$row){
						echo " 
							Your notifications box is empty. Thank you. - InstinctMe.
						";
					}
					while($row){
						$notification_msg = $row['notification'];
						$time = $row['time'];
						$seen = $row['seen'];
						if($seen){
							echo "
								<p><b><i class='fa fa-bell'></i> $notification_msg </b></p><hr />
							";
						}else{
							echo "
								<p><b><i class='fa fa-bell'></i> $notification_msg <span style='height:12px;width:12px;border-radius:50%;background-color:green;color:green;display:inline-block'></span></b></p><hr />
							";
						}
						$row = $result->fetch_assoc();
					}
					$stmt->close();
					// updating the seen column in the notifications table
					$stmt = $conn->prepare("UPDATE notifications set seen = 1 WHERE user_id = ? OR user_id = -1");
					if(!$stmt)
						die("Error at preparing statements.". $conn->error);
					if(!$stmt->bind_param("i",$_SESSION['user_id']))
						die("Error at binding parameters.");
					if(!$stmt->execute())
						die("Error at executing the parameters.");
					$stmt->close();
					$conn->close();
				?>
			</div>
		</div>
		<div class='col-sm-4'>
			
		</div>
	</div>
</div>
<!-- js files to load faster -->
<?php 
	include_once("../php/js_files.php");
?>
<script>
new WOW().init();
$(document).ready(function(){
	$("#notifications").addClass("active");
	friend_requests_count();
	notifications_count();
});
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