<?php
session_start();
if($_SERVER["REQUEST_METHOD"]== "POST"){
	$followed_by = $_POST["followed_by"];
	$following = $_POST["following"];
	if($followed_by && $following){
		include_once("connect.php");
		$stmt = $conn->prepare("SELECT status FROM followers WHERE followed_by = ? AND following = ?");
		if(!$stmt)
			die("Error at preparing statement in get_following_status");
		if(!$stmt->bind_param("ii",$followed_by, $following))
			die("Error at binding parameters in get_following_status");
		if(!$stmt->execute())
			die("Error at executing in get_following_status");
		$result = $stmt->get_result();
		if(!$result)
			die("Error at getting result in get_following_status");
		$row = $result->fetch_assoc();
		if($row){
			$status = $row["status"];
			if($status == 0)
				echo "not_following";
			else if($status == 1)
				echo "following";
		}else{
			echo "not_following_yet";
		}
		$stmt->close();
		$conn->close();
	}
}
?>
