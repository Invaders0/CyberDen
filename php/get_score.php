<?php
session_start();
if($_SERVER["REQUEST_METHOD"]== "POST"){
	$user_id = $_SESSION['user_id'];
	if($user_id){
		include_once("connect.php");
		$stmt = $conn->prepare("SELECT score FROM users WHERE user_id = ?");
		if(!$stmt)
			die("Error at preparing statement in get_following_status");
		if(!$stmt->bind_param("i",$user_id))
			die("Error at binding parameters in get_following_status");
		if(!$stmt->execute())
			die("Error at executing in get_following_status");
		$result = $stmt->get_result();
		if(!$result)
			die("Error at getting result in get_following_status");
		$row = $result->fetch_assoc();
		if($row){
			$score = $row["score"];
			echo $score;
		}else{
			echo "not_following_yet";
		}
		$stmt->close();
		$conn->close();
	}
}
?>
