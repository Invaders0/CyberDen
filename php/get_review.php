<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$write_id = $_POST['write_id'];
	if($write_id){
		include_once("connect.php");
		$stmt = $conn->prepare("SELECT COUNT(*) as total FROM writeups WHERE write_id = ? AND status = 0");
		if(!$stmt)
			die("Error at preparing.");
		if(!$stmt->bind_param("i",$write_id))
			die("Error at binding parameters.");
		if(!$stmt->execute())
			die("Error at executing.");
		$result = $stmt->get_result();
		if(!$result)
			die("Errro at getting result");
		$row = $result->fetch_assoc();
		if($row)
			echo $row["total"];
		else
			echo 0;
		$stmt->close();
		$conn->close();
	}
}
?>
