<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == "POST"){
	if(empty($_POST['complaint_user_id'])){
		$complaint_user_id = "";
	}else{
		$complaint_user_id = $_POST['complaint_user_id'];
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
	if($complaint_user_id && $story_id && $story_user_id){
		include_once("connect.php");
		$result = $conn->query("UPDATE stories_complaints SET status = 1 WHERE complaint_user_id = $complaint_user_id AND story_id = $story_id AND story_user_id = $story_user_id");
		if(!$result)
			die("Error at updating complaints table.");
		echo "ok";
		$conn->close();
	}
}
?>