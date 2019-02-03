<!DOCTYPE html>
<html lang='en'>
<head>
	<?php
		include_once("css_files.php");
		include_once("connect.php");
	?>
</head>
<style>
<!-- to hide the scroll bar -->
html{
	overflow: scroll;
	overflow-x: hidden;
}
::-webkit-scrollbar{
	width:0px;
	background:transparent;
}
</style>
<body>
	<div id='main' style='height:530px;border:0px solid red;overflow-y:scroll'>
		<?php
		session_start();
		$user_id=$_SESSION['user_id'];
		if($_SERVER["REQUEST_METHOD"] == "GET"){
			$friend_id = $_GET['friend_id'];
			$msg = $_GET['msg'];
			include_once("connect.php");
			// to check whether they are friends or not
			if($friend_id){
				$stmt = $conn->prepare("SELECT status FROM friend_requests WHERE (sent_by = ? AND sent_to = ?) OR (sent_by = ? AND sent_to = ?)");
				if(!$stmt)
					die("Error at checking whether friends or not");
				if(!$stmt->bind_param("iiii",$user_id, $friend_id, $friend_id, $user_id))
					die("Error at binding checking friends.");
				if(!$stmt->execute())
					die("Error at executing checking friends.");
				$result = $stmt->get_result();
				if(!$result)
					die("Error at getting result checking friends.");
				if($result->num_rows > 1)
					die("Error at friend request table insertion.");
				$row = $result->fetch_assoc();
				if($row){
					$status = $row['status'];
					if($status != 1)
						die("<h3 align='center'>You are not friends.</h3>");
				}else{
					die("<h3 align='center'>You are not friends.</h3>");
				}
				$stmt->close();
			}
			if($msg && $friend_id){
				$stmt = $conn->prepare("INSERT INTO chat(sent_by, sent_to, msg) VALUES (?, ?, ?)");
				if(!$stmt)
					die("Error at preparing statements while inserting msg.");
				if(!$stmt->bind_param("iis",$user_id, $friend_id, $msg))
					die("Error at binding parameters.");
				if(!$stmt->execute())
					die("Error at executing". $stmt->error);
				$stmt->close();
			}
			if($friend_id){
				$stmt = $conn->prepare("SELECT sent_by, sent_to, msg FROM chat WHERE (sent_by = ? AND sent_to = ?) OR (sent_by = ? AND sent_to = ?) ORDER BY time DESC");
				if(!$stmt)
					die("Error at preparing statement.");
				if(!$stmt->bind_param("iiii",$user_id, $friend_id, $friend_id, $user_id))
					die("Error at binding parameters.");
				if(!$stmt->execute())
					die("Error at executing.");
				$result = $stmt->get_result();
				if(!$result)
					die("Error at getting results.");
				$row = $result->fetch_assoc();
				while($row){
					$msg = $row['msg'];
					if($row['sent_by'] == $user_id){
						echo "<p><span style='background-color:#004040;color:white;margin-left:50px;border-radius:10px;font-size:18px;padding-right:20px;padding-left:20px'>$msg</span></p>";
					}else{
						echo "<p align='right' style='padding-right:50px'><span style='background-color:#004040;color:white;margin-left:30px;border-radius:10px;font-size:18px;padding-right:20px;padding-left:20px;'>$msg</span></p>";
					}
					$row = $result->fetch_assoc();
				}
				$stmt->close();
			}
			$conn->close();
		}
		?>
	</div>
</body>
<!-- js files to load fast -->
<?php
	include_once("js_files.php");
?>
<script>
$(document).ready(function(){
	//$("#main").scrollTop($("#main")[0].scrollHeight);
});
</script>
</html>