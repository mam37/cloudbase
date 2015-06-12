<?php
	//=========================================================================
	// This section updates the user update area
	//=========================================================================
	//Connect to database
	$conn = open();
	
	//Determine if this is the first time page is displayed
	$first_visit = 0;
	$first_visit_new = 0;
	if($_POST["new_fname"]==""&&
		$_POST["new_mname"]==""&&
		$_POST["new_lname"]==""&&
		$_POST["new_uname"]==""&&
		$_POST["new_pass1"]==""&&
		$_POST["new_pass2"]==""){
		$first_visit_new = 1;
	}
	if($_POST["fname"]==""&&
		$_POST["mname"]==""&&
		$_POST["lname"]==""&&
		$_POST["uname"]==""&&
		$_POST["pass1"]==""&&
		$_POST["pass2"]==""){
		$first_visit = 1;
	}
	if($fail==0&&$_POST["pass1"]==""&&$first_visit==0){
		//Submit fields except for password
		$sql = sprintf("UPDATE user SET user_fname='%s',user_mname='%s',user_lname='%s',user_uname='%s',user_email='%s' WHERE user_uname='%s'",
		mysqli_real_escape_string($conn,$_POST["fname"]),
		mysqli_real_escape_string($conn,$_POST["mname"]),
		mysqli_real_escape_string($conn,$_POST["lname"]),
		mysqli_real_escape_string($conn,$_POST["uname"]),
		mysqli_real_escape_string($conn,$_POST["email"]),
		mysqli_real_escape_string($conn,$_SESSION["username"]));
		mysqli_query($conn, $sql);
		$_SESSION["username"] = $_POST["uname"];
		
		echo "<p style='color:green'>Update Successful</p>";
	}
	if($fail==0&&$_POST["pass2"]!=""&&$first_visit==0){ 
		//Generate new password hash
		$salt = rand(100000000,999999999);
		$hashed = md5($_POST["pass1"].$salt);
		
		//Submit all fields
		$sql = sprintf("UPDATE user SET user_fname='%s',user_mname='%s',user_lname='%s',user_uname='%s',user_email='%s',user_salt='%s',user_hashedpwd='%s' WHERE user_uname='%s'",
		mysqli_real_escape_string($conn,$_POST["fname"]),
		mysqli_real_escape_string($conn,$_POST["mname"]),
		mysqli_real_escape_string($conn,$_POST["lname"]),
		mysqli_real_escape_string($conn,$_POST["uname"]),
		mysqli_real_escape_string($conn,$_POST["email"]),
		mysqli_real_escape_string($conn,$salt),
		mysqli_real_escape_string($conn,$hashed),
		mysqli_real_escape_string($conn,$_SESSION["username"]));
		mysqli_query($conn, $sql);
		$_SESSION["username"] = $_POST["uname"];
		$_SESSION["password"] = $hashed;
		
		echo "<p style='color:green'>Update Successful</p>";
	}
	//=========================================================================
	// This section updates the new user area
	//=========================================================================
	if($fail==0&&$_POST["new_pass2"]!=""&&$first_visit_new==0){ 
		//Generate new password hash
		$salt = rand(100000000,999999999);
		$hashed = md5($_POST["new_pass1"].$salt);
		$active = 1;
		//Submit all fields
		$sql = sprintf("INSERT INTO user(user_fname,user_mname,user_lname,user_uname,user_email,user_salt,user_hashedpwd,user_active,user_admin) VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s')",
		mysqli_real_escape_string($conn,$_POST["new_fname"]),
		mysqli_real_escape_string($conn,$_POST["new_mname"]),
		mysqli_real_escape_string($conn,$_POST["new_lname"]),
		mysqli_real_escape_string($conn,$_POST["new_uname"]),
		mysqli_real_escape_string($conn,$_POST["new_email"]),
		mysqli_real_escape_string($conn,$salt),
		mysqli_real_escape_string($conn,$hashed),
		mysqli_real_escape_string($conn,$active),
		mysqli_real_escape_string($conn,$_POST["new_admin"]));
		mysqli_query($conn, $sql);
		
		echo "<p style='color:green'>Update Successful</p>";
	}
	//=========================================================================
	// This section updates other users area
	//=========================================================================
	//Deletes user
	if($_POST["delete"]==1){
		$sql = sprintf("DELETE FROM user WHERE user_id='%s'",
		mysqli_real_escape_string($conn,$_POST["id"]));
		mysqli_query($conn, $sql);
		
		echo "<p style='color:green'>User Deleted</p>";
	}
	//Updates admin status and password
	if($_POST["update_pass"]!=""){
		$salt = rand(100000000,999999999);
		$hashed = md5($_POST["update_pass"].$salt);
		$update = 0;
		if($_POST["update_admin"]!=""){
			$update = 1;
		}
		
		$sql = sprintf("UPDATE user SET user_admin='%s',user_salt='%s',user_hashedpwd='%s' WHERE user_id='%s'",
		mysqli_real_escape_string($conn,$update),
		mysqli_real_escape_string($conn,$salt),
		mysqli_real_escape_string($conn,$hashed),
		mysqli_real_escape_string($conn,$_POST["id"]));
		mysqli_query($conn, $sql);	
		echo "<p style='color:green'>User password updated</p>";
	}
	//Updates admin status only
	if($_POST["id"]!=""&&$_POST["update_pass"]==""){
		$update = 0;
		if($_POST["update_admin"]!=""){
			$update = 1;
		}
		$sql = sprintf("UPDATE user SET user_admin='%s' WHERE user_id='%s'",
		mysqli_real_escape_string($conn,$update),
		mysqli_real_escape_string($conn,$_POST["id"]));
		mysqli_query($conn, $sql);	
		echo "<p style='color:green'>User admin status updated</p>";
	}
	//Close database connection
	close($conn);
?>