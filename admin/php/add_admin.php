<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == "POST"){
	if(empty($_POST['admin_email'])){
		$admin_email = "";
	}else{
		$admin_email = $_POST['admin_email'];
	}
	if(empty($_POST['admin_name'])){
		$admin_name = "";
	}else{
		$admin_name = $_POST['admin_name'];
	}
	if(empty($_POST['admin_password'])){
		$admin_password = "";
	}else{
		$admin_password = md5($_POST['admin_password']);
	}
	if($admin_email && $admin_name && $admin_password){
		include_once("connect.php");
		$result = $conn->query("INSERT INTO admin (admin_email, admin_name, password) VALUES ('$admin_email', '$admin_name', '$admin_password')");
		if(!$result){
			if($conn->errno == 1062)
				die("already registered");
			die("Error at executing.".$conn->error);
		}
		echo "ok";
		$conn->close();
	}
}
?>