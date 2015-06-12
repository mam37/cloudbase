<?php
	//Connect to database
	$conn = open();

	//Get pilot
	$sql = sprintf("SELECT person_id,person_fname,person_mname,person_lname FROM person WHERE person_id='%s'",
	mysqli_real_escape_string($conn,$_POST["id"]));
		
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result, MYSQL_BOTH);
		
	//Get roles
	$sql = sprintf("SELECT role_type,role_active FROM role WHERE person_id='%s'",
	mysqli_real_escape_string($conn,$_POST["id"]));
	
	$result2 = mysqli_query($conn, $sql);

	//Close database connection
	close($conn);
?>