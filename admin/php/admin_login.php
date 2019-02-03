<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
		if(empty($_POST['admin_email'])){
			$admin_email = "";
		}else{
			$admin_email = test_input($_POST['admin_email']);
		}
		if(empty($_POST['admin_password'])){
			$admin_password = "";
		}else{
			$admin_password = test_input($_POST['admin_password']);
		}
		if($admin_email && $admin_password){
			include_once("connect.php");
			$stmt = $conn->prepare("SELECT admin_id, admin_name, password FROM admin WHERE admin_email = ?");
			if(!$stmt)
				die("Error at preparing statement.");
			if(!$stmt->bind_param("s",$admin_email))
				die("Error at binding parameters.");
			if(!$stmt->execute())
				die("Error at executing statement.");
			$result = $stmt->get_result();
			if(!$result)
				die("Error at getting result.");
			if($result->num_rows == 1){
				$row = $result->fetch_assoc();
				if($row['password'] == md5($admin_password)){
					session_start();
					$_SESSION['admin_id'] = $row['admin_id'];
					$_SESSION['admin_name'] = $row['admin_name'];
					$_SESSION['admin_email'] = $admin_email;
					echo "success";
				}else{
					echo "invalid password";
				}
			}else{
				echo "invalid username";
			}
		}else{
			echo "fail";
		}
		$stmt->close();
		$conn->close();
}
function test_input($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>