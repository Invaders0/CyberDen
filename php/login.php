<?php
$email = "";
$password = "";
$email_error = "";
$password_error = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(empty($_POST["email"])){
		$email_error = "email is empty";
	}else{
		$email = test_input($_POST["email"]);
	}
	if(empty($_POST["password"])){
		$password_error = "password is empty";
	}else{
		$password = test_input($_POST["password"]);
	}
	if($email_error || $password_error){
		echo "fail";
	}else{
		include_once("connect.php");
		$stmt = $conn->prepare("SELECT user_name, user_id, password, signup_time, user_image FROM users WHERE user_email = ?");
		if(!$stmt)
			die("Error at preparing statements" . $conn->error);
		if(!$stmt->bind_param("s",$email))
			die("Error at binding parameters");
		if(!$stmt->execute())
			die("Error at executing the statements");
		$result = $stmt->get_result();	// getting result set from stmt object
		if(!$result)
			die("Error at getting results" . $stmt->error);
		if($result->num_rows == 1){
			$row = $result->fetch_assoc();
			if($row["password"] == md5($password)){
				session_start();
				$_SESSION['user_name'] = $row['user_name'];
				$_SESSION['user_id'] = $row['user_id'];
				$_SESSION['user_email'] = $email;
				$_SESSION['signup_time'] = $row['signup_time'];
				$_SESSION['user_image'] = $row['user_image'];
				echo "success";
				//exit();
			}else{
				echo "invalid password";
			}
		}else{
			echo "invalid email";
		}
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