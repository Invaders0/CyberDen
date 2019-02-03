<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == "POST"){
	if(empty($_POST['user_id'])){
		$user_id = "";
	}else{
		$user_id = (int)$_POST['user_id'];
	}
	if(empty($_POST['notification'])){
		$notification = "";
	}else{
		$notification = $_POST['notification'];
	}
	if($user_id && $notification){
		include_once("connect.php");
		$stmt = $conn->prepare("INSERT INTO notifications (user_id, notification) VALUES (?, ?) ");
		if(!$stmt)
			die("Error at preparing statement.".$conn->error);
		if(!$stmt->bind_param("is",$user_id, $notification))
			die("Error at binding parameters. " . $stmt->error);
		if(!$stmt->execute())
			die("Error at executing. " . $stmt->error);
		echo "ok";
		$conn->close();
	}else{
		echo "enter valid data.";
	}
}
?>
