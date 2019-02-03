<?php
ob_start();
session_start();
if(!(isset($_SESSION['user_id'])))
	header("Location:../");
$user_id = $_SESSION['user_id'];
if($user_id){
	include_once("connect.php");
	$result = $conn->query("SELECT COUNT(*) as total FROM notifications WHERE (user_id = $user_id OR user_id = -1) AND seen = 0");
	if($result){
		$row = $result->fetch_assoc();
		$count = (int)$row['total'];
		echo $count;
	}else{
		die("Error at notifications.php");
	}
	$conn->close();
}
?>