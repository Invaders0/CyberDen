<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$story_id = $_POST["story_id"];
	$user_id = $_POST["user_id"];
	$current_status  = $_POST["current_status"];
	if($story_id && $user_id && ($current_status == -1 || $current_status == 0 || $current_status == 1)){
		include_once("connect.php");
		if($current_status == -1){
			$stmt = $conn->prepare("INSERT INTO likes(story_id, user_id, status) VALUES(?,?,1)");
			if(!$stmt)
				die("Error at preparing statement.");
		}else if($current_status == 0){
			$stmt = $conn->prepare("UPDATE likes SET status = 1 WHERE story_id = ? AND user_id = ?");
			if(!$stmt)
				die("Error at preparing statement.");
		}else if($current_status == 1){
			$stmt = $conn->prepare("UPDATE likes SET status = 0 WHERE story_id = ? AND user_id = ?");
			if(!$stmt)
				die("Error at preparing statement.");
		}
		if(!$stmt->bind_param("ii",$story_id,$user_id))
			die("Error at binding.");
		if(!$stmt->execute())
			die("Error at executing.");
		echo "ok";
		$stmt->close();
		$conn->close();
	}
}
?>