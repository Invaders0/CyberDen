<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$followed_by = $_POST["followed_by"];
	$following = $_POST["following"];
	$current_status  = $_POST["current_status"];
	if($followed_by && $following && ($current_status == -1 || $current_status == 0 || $current_status == 1)){
		include_once("connect.php");
		if($current_status == -1){
			$stmt = $conn->prepare("INSERT INTO followers(followed_by, following, status) VALUES(?,?,1)");
			if(!$stmt)
				die("Error at preparing statement.");
		}else if($current_status == 0){
			$stmt = $conn->prepare("UPDATE followers SET status = 1 WHERE followed_by = ? AND following = ?");
			if(!$stmt)
				die("Error at preparing statement.");
		}else if($current_status == 1){
			$stmt = $conn->prepare("UPDATE followers SET status = 0 WHERE followed_by = ? AND following = ?");
			if(!$stmt)
				die("Error at preparing statement.");
		}
		if(!$stmt->bind_param("ii",$followed_by,$following))
			die("Error at binding.");
		if(!$stmt->execute())
			die("Error at executing.");
		echo "ok";
		$stmt->close();
		$conn->close();
	}
}
?>