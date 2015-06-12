<?php
	//Connect to database
	$conn = open();
	
	//Get salt and hashed password
	$sql = "SELECT person_id,person_fname,person_lname FROM person";
	
	$result = mysqli_query($conn, $sql);
	
	//Close database connection
	close($conn);
?>