<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])){
	$current_password = md5($_POST["current_password"]);
	$new_password = md5($_POST["new_password"]);
	$user_id = $_SESSION['user_id'];
	if($current_password && $new_password){
		include_once("connect.php");
		$result = $conn->query("SELECT password FROM users WHERE user_id = $user_id");
		if(!$result)
			die("Error at executing " . $conn->error);
		if($result->num_rows == 1){
			$row = $result->fetch_assoc();
			if($row['password'] == $current_password){
				$stmt = $conn->prepare("UPDATE users SET password = ? WHERE user_id = ?");
				if(!$stmt)
					die("Error at updating password.");
				if(!$stmt->bind_param("si",$new_password, $user_id))
					die("Error at binding parameters " . $stmt->error);
				if(!$stmt->execute())
					die("Error at executing.");
				echo "ok";
				$stmt->close();
				$conn->close();
			}else{
				echo "invalid current password";
			}
		}else{
			die("Error at fetching user details ");
		}
	}
}
?>
