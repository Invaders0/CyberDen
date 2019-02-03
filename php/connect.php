<?php
    $conn = new mysqli("localhost","root","","instinctme");
	// $conn = new mysqli(host, username, password, db); this is structure for above
	if(!$conn){
		die("Database connection failed.");
	}		
?>
