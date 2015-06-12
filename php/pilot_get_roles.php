<?php
	//Connect to database
	$conn = open();
	
	//Get salt and hashed password
	$sql = sprintf("SELECT * FROM role WHERE person_id='%s'",
    mysqli_real_escape_string($conn,$row[0]));
	
	$result2 = mysqli_query($conn, $sql);
	
	//Close database connection
	close($conn);
?>