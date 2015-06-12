<?php
	ob_start();
	session_start();
	
	//Store username in session variables
	if($_POST["username"]!=""){
		$_SESSION["username"] = $_POST["username"];
	}
	
	$conn = open();
	
	//Get salt and hashed password
	$sql = sprintf("SELECT user_salt,user_hashedpwd,user_admin, user_fname, user_lname FROM user WHERE user_uname='%s'",
    mysqli_real_escape_string($conn,$_SESSION["username"]));
	
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result, MYSQL_NUM);
	
	//Close database connection
	close($conn);
	
	//Store password in session variable
	if($_POST["password"]!=""){
		$_SESSION["password"] = md5($_POST["password"].$row[0]);
	}
	//Hash session password and compare to retrieved hashed password
	if($_SESSION["password"]!=$row[1]||$_SESSION["password"]==""){
		header( 'Location: index.html' ) ;	
	}
	//Store admin value in session variable
	$_SESSION["admin"]=$row[2];
	
	//Store first name in session variable
	$_SESSION["fname"]=$row[3];

	//Store last name in session variable
	$_SESSION["lname"]=$row[4];


?>
