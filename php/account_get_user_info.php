<?php
	ob_start();
	
	//Connect to database
	$conn = open();
	
	//Get salt and hashed password
	$sql = sprintf("SELECT user_fname,user_mname,user_lname,user_email FROM user WHERE user_uname='%s'",
    mysqli_real_escape_string($conn,$_SESSION["username"]));
	
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result, MYSQL_NUM);
	
	//Close database connection
	close($conn);
?>