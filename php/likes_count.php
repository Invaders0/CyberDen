<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$story_id = $_POST["story_id"];
	if($story_id){
		include_once("connect.php");
		$stmt = $conn->prepare("SELECT COUNT(*) as total_likes FROM likes WHERE story_id = ? AND status = 1");
		if(!$stmt)
			die("Error at preparing.");
		if(!$stmt->bind_param("i",$story_id))
			die("Error at binding parameters.");
		if(!$stmt->execute())
			die("Error at executing.");
		$result = $stmt->get_result();
		if(!$result)
			die("Errro at getting result");
		$row = $result->fetch_assoc();
		if($row)
			echo $row["total_likes"];
		else
			echo 0;
		$stmt->close();
		$conn->close();
	}
}
?>