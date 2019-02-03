<?php
session_start();
if($_SERVER["REQUEST_METHOD"]== "POST"){
	$story_id = $_POST["story_id"];
	$user_id = $_POST["user_id"];
	if($story_id && $user_id){
		include_once("connect.php");
		$stmt = $conn->prepare("SELECT status FROM likes WHERE story_id = ? AND user_id = ?");
		if(!$stmt)
			die("Error at preparing statement in get_like_status");
		if(!$stmt->bind_param("ii",$story_id, $user_id))
			die("Error at binding parameters in get_like_status");
		if(!$stmt->execute())
			die("Error at executing in get_like_status");
		$result = $stmt->get_result();
		if(!$result)
			die("Error at getting result in get_like_status");
		$row = $result->fetch_assoc();
		if($row){
			$status = $row["status"];
			if($status == 0)
				echo "not_liked";
			else if($status == 1)
				echo "liked";
		}else{
			echo "not_liked_yet";
		}
		$stmt->close();
		$conn->close();
	}
}
?>