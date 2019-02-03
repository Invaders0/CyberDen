<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == "POST"){
	if(empty($_POST['story_id'])){
		$story_id = "";
	}else{
		$story_id = $_POST['story_id'];
	}
	if($story_id){
		include_once("connect.php");
		$result = $conn->query("SELECT story FROM stories WHERE story_id = $story_id");
		if(!$result)
			die("Error at executing.");
		if($result->num_rows == 1){
			$row = $result->fetch_assoc();
			$story = html_entity_decode($row['story']);
			echo $story;
		}else{
			echo "result is ambiguous.";
		}
		$conn->close();
	}
}
?>