<?php
    $conn = new mysqli("localhost","instinct_user","DKR1516147767","instinct_instinctme");
	// $conn = new mysqli(host, username, password, db); this is structure for above
	if(!$conn){
		die("Database connection failed.");
	}		
?>