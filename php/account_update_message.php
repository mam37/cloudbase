<?php
	$fail = 0; 
	//=========================================================================
	// This section checks errors for the user update section
	//=========================================================================
	//Check if entered passwords are the same
	if(!is_null($_POST["pass1"])||!is_null($_POST["pass2"])){
		if($_POST["pass1"]!=$_POST["pass2"]){
			echo "<p style='color:red'>Passwords do not match!</p>";
			$fail = 1;
		}
	}
	//Check if username field is null
	if($_POST["uname"]==""&&
		($_POST["fname"]!=""||
		$_POST["mname"]!=""||
		$_POST["lname"]!=""||
		$_POST["email"]!=""||
		$_POST["pass1"]!=""||
		$_POST["pass2"]!="")){
		echo "<p style='color:red'>Username Required!</p>";
		$fail = 1;
	}else{
		//Connect to database
		$conn = open();
		
		//Check if submitted username is a duplicate of one in the database
		//Get submitted username if it exists in the database
		$sql = sprintf("SELECT user_uname FROM user WHERE user_uname='%s'",
		mysqli_real_escape_string($conn,$_POST["uname"]));
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result, MYSQL_NUM);
		
		//Close database connection
		close($conn);
		
		if($_POST["uname"]!=$_SESSION["username"]){
			if(!is_null($row[0])){
				echo "<p style='color:red'>Username already taken!</p>";
				$fail = 1;
			}
		}
	}
	//Check if email field is null
	if($_POST["email"]==""&&
		($_POST["fname"]!=""||
		$_POST["mname"]!=""||
		$_POST["lname"]!=""||
		$_POST["uname"]!=""||
		$_POST["pass1"]!=""||
		$_POST["pass2"]!="")){
		echo "<p style='color:red'>Email address Required!</p>";
		$fail = 1;
	}
	//=========================================================================
	// This section checks errors for the new user section
	//=========================================================================
	//Check if entered passwords are the same
	if(!is_null($_POST["new_pass1"])||!is_null($_POST["new_pass2"])){
		if($_POST["new_pass1"]!=$_POST["new_pass2"]){
			echo "<p style='color:red'>Passwords do not match!</p>";
			$fail = 1;
		}
	}
	//Check if username field is null
	if($_POST["new_uname"]==""&&
		($_POST["new_fname"]!=""||
		$_POST["new_mname"]!=""||
		$_POST["new_lname"]!=""||
		$_POST["new_email"]!=""||
		$_POST["new_pass1"]!=""||
		$_POST["new_pass2"]!="")){
		echo "<p style='color:red'>Username Required!</p>";
		$fail = 1;
	}else{
		//Connect to database
		$conn = open();
		
		//Check if submitted username is a duplicate of one in the database
		//Get submitted username if it exists in the database
		$sql = sprintf("SELECT user_uname FROM user WHERE user_uname='%s'",
		mysqli_real_escape_string($conn,$_POST["new_uname"]));
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result, MYSQL_NUM);
		
		//Close database connection
		close($conn);
		
		if(!is_null($row[0])){
			echo "<p style='color:red'>Username already taken!</p>";
			$fail = 1;
		}
	}
	//Check if email field is null
	if($_POST["new_email"]==""&&
		($_POST["new_fname"]!=""||
		$_POST["new_mname"]!=""||
		$_POST["new_lname"]!=""||
		$_POST["new_uname"]!=""||
		$_POST["new_pass1"]!=""||
		$_POST["new_pass2"]!="")){
		echo "<p style='color:red'>Email address Required!</p>";
		$fail = 1;
	}
	//Check if password field is null
	if($_POST["new_pass1"]==""&&
		($_POST["new_fname"]!=""||
		$_POST["new_mname"]!=""||
		$_POST["new_lname"]!=""||
		$_POST["new_uname"]!=""||
		$_POST["new_email"]!="")){
		echo "<p style='color:red'>Password Required!</p>";
		$fail = 1;
	}
?>