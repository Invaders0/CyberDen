<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == "POST"){
	if(empty($_POST['user_id'])){
		$user_id = "";
	}else{
		$user_id = $_POST['user_id'];
	}
	if(empty($_POST['story_id'])){
		$story_id = "";
	}else{
		$story_id = $_POST['story_id'];
	}
	if(empty($_POST['story_user_id'])){
		$story_user_id = "";
	}else{
		$story_user_id = $_POST['story_user_id'];
	}
	if($user_id && $story_id && $story_user_id){
		include_once("connect.php");
		$result = $conn->query("INSERT INTO stories_complaints (complaint_user_id, story_id, story_user_id) VALUES($user_id, $story_id, $story_user_id)");
		if($result)
			echo "ok";
		else
			die("Error. " . $conn->error);
		$conn->close();
	}else{
		echo "Enter valid details.";
	}
}
?>