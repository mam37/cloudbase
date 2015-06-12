<?php
	//Connect to database
	$conn = open();
	
	//Initialize variables
	$tow = 0;
	$glide = 0;
	$instructor = 0;
	$od = 0;
	
	//=========================================================================
	// This section updates the person and role tables
	//=========================================================================
	if(!isset($_POST["update"])&&$_POST["id"]!=""&&$fail==0&&!isset($_POST["delete"])){	
		//Submit all person fields
		$sql = sprintf("UPDATE person SET person_fname='%s',person_mname='%s',person_lname='%s' WHERE person_id='%s'",
		mysqli_real_escape_string($conn,$_POST["fname"]),
		mysqli_real_escape_string($conn,$_POST["mname"]),
		mysqli_real_escape_string($conn,$_POST["lname"]),
		mysqli_real_escape_string($conn,$_POST["id"]));
		mysqli_query($conn, $sql);
		
		//Submit all role fields
		if(isset($_POST["tow"])){ $tow = 1; }else{ $tow = 0; }
		if(isset($_POST["glide"])){ $glide = 1; }else{ $glide = 0; }
		if(isset($_POST["instructor"])){ $instructor = 1; }else{ $instructor = 0; }
		if(isset($_POST["od"])){ $od = 1; }else{ $od = 0; }
		
		$sql = sprintf("UPDATE role SET role_active='%s' WHERE person_id='%s' AND role_type='%s'",
		mysqli_real_escape_string($conn,$tow),
		mysqli_real_escape_string($conn,$_POST["id"]),
		mysqli_real_escape_string($conn,"tow"));
		mysqli_query($conn, $sql);		
		
		$sql = sprintf("UPDATE role SET role_active='%s' WHERE person_id='%s' AND role_type='%s'",
		mysqli_real_escape_string($conn,$glide),
		mysqli_real_escape_string($conn,$_POST["id"]),
		mysqli_real_escape_string($conn,"glide"));
		mysqli_query($conn, $sql);	
		
		$sql = sprintf("UPDATE role SET role_active='%s' WHERE person_id='%s' AND role_type='%s'",
		mysqli_real_escape_string($conn,$instructor),
		mysqli_real_escape_string($conn,$_POST["id"]),
		mysqli_real_escape_string($conn,"instructor"));
		mysqli_query($conn, $sql);	
		
		$sql = sprintf("UPDATE role SET role_active='%s' WHERE person_id='%s' AND role_type='%s'",
		mysqli_real_escape_string($conn,$od),
		mysqli_real_escape_string($conn,$_POST["id"]),
		mysqli_real_escape_string($conn,"od"));
		mysqli_query($conn, $sql);	
		
		echo "<p style='color:green'>Update Successful</p>";
	}
	//=========================================================================
	// This section creates a new person and roles
	//=========================================================================	
	if($firstvisit==0&&$fail==0&&
		!isset($_POST["update"])&&
		!isset($_POST["delete"])&&
		!isset($_POST["id"])){
		
		if(isset($_POST["tow"])){ $tow = 1; }else{ $tow = 0; }
		if(isset($_POST["glide"])){ $glide = 1; }else{ $glide = 0; }
		if(isset($_POST["instructor"])){ $instructor = 1; }else{ $instructor = 0; }
		if(isset($_POST["od"])){ $od = 1; }else{ $od = 0; }
		
		//Submit person fields
		$sql = sprintf("INSERT INTO person(person_fname,person_mname,person_lname) VALUES ('%s','%s','%s')",
		mysqli_real_escape_string($conn,$_POST["fname"]),
		mysqli_real_escape_string($conn,$_POST["mname"]),
		mysqli_real_escape_string($conn,$_POST["lname"]));
		mysqli_query($conn, $sql);
		
		//Submit role fields
		$sql = "SELECT LAST_INSERT_ID()";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result, MYSQL_BOTH);
		$person = $row[0];
		
		if(isset($_POST["tow"])){ $tow = 1; }else{ $tow = 0; }
		if(isset($_POST["glide"])){ $glide = 1; }else{ $glide = 0; }
		if(isset($_POST["instructor"])){ $instructor = 1; }else{ $instructor = 0; }
		if(isset($_POST["od"])){ $od = 1; }else{ $od = 0; }
		
		$sql = sprintf("INSERT INTO role(person_id,role_type,role_active) VALUES ('%s','%s','%s')",
		mysqli_real_escape_string($conn,$person),
		mysqli_real_escape_string($conn,"tow"),
		mysqli_real_escape_string($conn,$tow));
		mysqli_query($conn, $sql);
		
		$sql = sprintf("INSERT INTO role(person_id,role_type,role_active) VALUES ('%s','%s','%s')",
		mysqli_real_escape_string($conn,$person),
		mysqli_real_escape_string($conn,"glide"),
		mysqli_real_escape_string($conn,$glide));
		mysqli_query($conn, $sql);
		
		$sql = sprintf("INSERT INTO role(person_id,role_type,role_active) VALUES ('%s','%s','%s')",
		mysqli_real_escape_string($conn,$person),
		mysqli_real_escape_string($conn,"instructor"),
		mysqli_real_escape_string($conn,$instructor));
		mysqli_query($conn, $sql);
		
		$sql = sprintf("INSERT INTO role(person_id,role_type,role_active) VALUES ('%s','%s','%s')",
		mysqli_real_escape_string($conn,$person),
		mysqli_real_escape_string($conn,"od"),
		mysqli_real_escape_string($conn,$od));
		mysqli_query($conn, $sql);
		
		echo "<p style='color:green'>Pilot Created</p>";
		
		$_POST["update"] = 1;
		$_POST["id"] = $person;
	}
	//Close database connection
	close($conn);
?>