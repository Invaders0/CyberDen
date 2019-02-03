<?php
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST"){
	$sent_by = $_POST['sent_by'];
	$sent_to = $_POST['sent_to'];
	if($sent_by && $sent_to){
		include_once("connect.php");
		$stmt = $conn->prepare("SELECT status FROM friend_requests WHERE (sent_by = ? AND  sent_to = ?) OR (sent_by = ? AND sent_to = ?) LIMIT 1");
		if(!$stmt)
			die("Error at preparing the statement.");
		if(!$stmt->bind_param("iiii",$sent_by,$sent_to,$sent_to,$sent_by))
			die("Error at binding the parameters.");
		if(!$stmt->execute())
			die("Error at executing the statement.");
		$result = $stmt->get_result();
		if(!$result)
			die("Error at getting the result.");
		$row = $result->fetch_assoc();
		if($row){
			$status = $row['status'];
			if($status == 0)
				echo "processing";
			else if($status == 1)
				echo "accepted";
			else if($status == 2)
				echo "rejected";
		}else{
			echo "send_request";
		}
		$stmt->close();
		$conn->close();
	}
}
?>