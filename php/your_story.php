<?php
session_start();
$title = "";
$story = "";
$plain_story = "";
$story_type = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(empty($_POST["title"]))
		$title = "";
	else
		$title = test_input($_POST["title"]);
	if(count($_POST["category_arr"]) == 0)
		$category_arr = array();
	else
		$category_arr = $_POST["category_arr"];
	if(empty($_POST["story"]))
		$story = "";
	else
		$story = test_input($_POST["story"]);
	if(empty($_POST["plain_story"]))
		$plain_story = "";
	else
		$plain_story = test_input($_POST["plain_story"]);
	if(empty($_POST["story_type"]))
		$story_type = "";
	else
		$story_type = test_input($_POST["story_type"]);
	if($title && count($category_arr) > 0 && $story && $plain_story && $story_type && str_word_count($plain_story) >= 25){
		include_once("connect.php");
		$story_unique_hash = md5($story);	// to create unique hash for each story to prevent duplicate entry of stories
		$stmt = $conn->prepare("INSERT INTO stories (user_id, title, story, plain_story, story_unique_hash, category, story_type) VALUES (?,?,?, ?,?,?,?)");
		if(!$stmt)
			die("Error at preparing statements " . $conn->error);
		if(!$stmt->bind_param("issssss",$_SESSION['user_id'],$title, $story, $plain_story, $story_unique_hash, $category_arr[0], $story_type))
			die("Error at binding parameters");
		if(!$stmt->execute()){
			if($stmt->errno == 1062)	// to check the duplicate entery of story into the database table
				die("Already existed story");
			die("Error at executing statement");
		}
		$last_id = $stmt->insert_id;
		//echo $last_id;
		// for inserting categories
		$stmt2 = $conn->prepare("INSERT INTO story_categories (story_id, category) VALUES ($last_id, ?)");
		if(!$stmt2)
			die("Error at preparing statement.");
		foreach ($category_arr as $category ){
			if(!$stmt2->bind_param("s", $category))
				die("Error at binding.");
			if(!$stmt2->execute())
				die("Error at executing.");
		}
		echo "success";
		$stmt->close();
		$conn->close();
	}else if($title && count($category_arr) > 0 && $story && $story_type && str_word_count($story) < 25){
		echo "too short";
	}else{
		echo "fail";
	}
}
function test_input($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>