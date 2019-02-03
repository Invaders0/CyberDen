<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$user_id = $_POST['user_id'];
	$story_id = $_POST['story_id'];
	include_once("connect.php");
	if($user_id && $story_id){
		$stmt = $conn->prepare("INSERT INTO views (story_id, user_id) VALUES(?,?)");
		if(!$stmt)
			die("Error at preparing statements.");
		if(!$stmt->bind_param("ii",$story_id, $user_id))
			die("Error at binding parameters.");
		if(!$stmt->execute()){
			if($stmt->errno != 1062)	
				die("Error at executing the statement.");
		}
		$stmt->close();
	}
	$stmt = $conn->prepare("SELECT * FROM views WHERE story_id = ?");
	if(!$stmt)
		die("Error at preparing statements for number of views.");
	if(!$stmt->bind_param("i",$story_id))
		die("Error at binding parameters for number of views.");
	if(!$stmt->execute())
		die("Error at executing parameters for number of views.");
	$result = $stmt->get_result();
	if(!$result)
		die("Error at getting results.");
	$views = $result->num_rows;
	echo $views;
}
?>