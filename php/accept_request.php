<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$sent_by_id = $_POST['sent_by'];
	$accept_by_id = $_POST['accept_by'];		// current user id
	if($sent_by_id && $accept_by_id){
		include_once("connect.php");
		$result = $conn->query("UPDATE friend_requests SET status = 1 WHERE sent_by = $sent_by_id AND sent_to = $accept_by_id");
		if($result)
			echo "ok";
		else
			die("Error at executing the query.");
		//for notifications
		$result = $conn->query("SELECT user_name FROM users WHERE user_id = $sent_by_id");
		$row = $result->fetch_assoc();
		if(!$row)
			die("No username for given id. accept_request.php file.");
		$user_name = $row['user_name'];				// this user name is the one who has been accepted by the current user
		$notification_msg = "Dear ".$user_name. ", your friend request has been accepted sent to ".$_SESSION['user_name']." by him. Stay connected.";
		$stmt = $conn->prepare("INSERT INTO notifications (user_id, notification) VALUES (?, ?)");
		if(!$stmt)
			die("Error at preparing statements->notifications");
		if(!$stmt->bind_param("is",$sent_by_id,$notification_msg))
			die("Error at binding parameters->notifications");
		if(!$stmt->execute())
			die("Error at executing parameters->notifications");
		$stmt->close();
		$conn->close();
	}
}
?>