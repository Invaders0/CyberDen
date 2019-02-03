<?php
session_start();
$title = "";
$story = "";
$plain_story = "";
$story_type = "";
$user_id = $_SESSION['user_id'];
if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(empty($_POST["write_id"]))
		$write_id = "";
	else
		$write_id = test_input($_POST["write_id"]);
	if(empty($_POST["story"]))		// story is actual writeup
		$story = "";
	else
		$story = test_input($_POST["story"]);
	if( $story && $write_id &  $user_id){
		include_once("connect.php");
		$stmt = $conn->prepare("INSERT INTO writeups (write_id,  story, user_id) VALUES (?,?,?)");
		if(!$stmt)
			die("Error at preparing statements " . $conn->error);
		if(!$stmt->bind_param("isi",$write_id,$story, $user_id))
			die("Error at binding parameters");
		if(!$stmt->execute()){
			if($stmt->errno == 1062)	// to check the duplicate entery of story into the database table
				die("Already existed story");
			die("Error at executing statement");
		}
		echo "success";
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
