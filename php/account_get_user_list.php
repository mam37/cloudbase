<?php
	//Connect to database
	$conn = open();
	
	//Get salt and hashed password
	$sql = "SELECT user_id,user_fname,user_lname,user_admin,user_active,user_uname FROM user ORDER BY user_id";
	
	$result = mysqli_query($conn, $sql);
	
	//Close database connection
	close($conn);
?>