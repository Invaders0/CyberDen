<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(empty($_POST['user_id'])){
		$user_id = "";
	}else{
		$user_id = test_input($_POST['user_id']);
	}
	if(empty($_POST['feedback'])){
		$feedback = "";
	}else{
		$feedback = $_POST['feedback'];
	}
	if($user_id && $feedback){
		include_once("connect.php");
		$stmt = $conn->prepare("INSERT INTO feedback (user_id, feedback) VALUES (?,?)");
		if(!$stmt)
			die("Error at preparing statement.");
		if(!$stmt->bind_param("is",$user_id, $feedback))
			die("Error at binding parameters.");
		if(!$stmt->execute()){
			if($stmt->errno == 1062)
				die("already sent");
			die("Error at executing the statement.");
		}
		echo "ok";
		$stmt->close();
		$conn->close();
	}
}
function test_input($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>