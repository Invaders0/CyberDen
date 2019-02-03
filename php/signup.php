<?php
/* This is signup php file to send the result data from the database */
$email = "";
$password = "";
$user_name = "";
$user_name_error = ""; 
$email_error = "";
$password_error = "";
if($_SERVER["REQUEST_METHOD"]=="POST"){
	if(empty($_POST['user_name'])){
		$user_name_error = "User Name is empty";
	}else{
		$user_name = test_input($_POST['user_name']);
	}
	if(empty($_POST["email"])){
		$email_error = "Email is empty";
	}else{
		$email = test_input($_POST["email"]);		// taking email from the form using post method
	}
	if(empty($_POST["password"])){
		$password_error = "Password is empty";
	}else{
		$password = test_input($_POST["password"]);
		$password = md5($password);				// taking password from the form using post method
	}
	if($email_error || $password_error)
		echo "fail";	// username or  password is empty
	else{
		include_once("connect.php");
		$stmt = $conn->prepare("INSERT INTO users(user_name, user_email, password) VALUES (?, ?,?)");
		if(!$stmt)
			die("Error at preparing statements");
		if(!$stmt->bind_param("sss",$user_name, $email,$password))
			die("Error at binding parameters");
		if(!$stmt->execute()){
			if($stmt->errno == 1062)	// to check duplicate entry
				die("Already registered");
			die("Error at executing" . $stmt->error);
		}
		echo "success";	// insertion success
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