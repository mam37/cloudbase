<?php
	//Connect to database
	$conn = open();

	//Get glider pilots
	$sql = sprintf("SELECT person_id FROM role WHERE role_type='%s' AND role_active='%s'",
	mysqli_real_escape_string($conn,"glide"),
	mysqli_real_escape_string($conn,"1"));
	$result = mysqli_query($conn, $sql);
	$pilots = Array();
	$glider_pilots = Array();
	while($row = mysqli_fetch_array($result, MYSQL_BOTH)){
		array_push($pilots,$row[0]);
	}
	for($i=0;$i<count($pilots);$i++){
		//Get glider pilots
		$sql = sprintf("SELECT person_id,person_fname,person_lname FROM person WHERE person_id='%s'",
		mysqli_real_escape_string($conn,$pilots[$i]));
		$result = mysqli_query($conn, $sql);
		array_push($glider_pilots, mysqli_fetch_array($result, MYSQL_BOTH));
	}
	
	//Get tow pilots
	$sql = sprintf("SELECT person_id FROM role WHERE role_type='%s' AND role_active='%s'",
	mysqli_real_escape_string($conn,"tow"),
	mysqli_real_escape_string($conn,"1"));
	$result = mysqli_query($conn, $sql);
	$pilots = Array();
	$tow_pilots = Array();
	while($row = mysqli_fetch_array($result, MYSQL_BOTH)){
		array_push($pilots,$row[0]);
	}
	for($i=0;$i<count($pilots);$i++){
		//Get tow pilots
		$sql = sprintf("SELECT person_id,person_fname,person_lname FROM person WHERE person_id='%s'",
		mysqli_real_escape_string($conn,$pilots[$i]));
		$result = mysqli_query($conn, $sql);
		array_push($tow_pilots,mysqli_fetch_array($result, MYSQL_BOTH));
	}
	
	//Get operations director
	$sql = sprintf("SELECT person_id FROM role WHERE role_type='%s' AND role_active='%s'",
	mysqli_real_escape_string($conn,"od"),
	mysqli_real_escape_string($conn,"1"));
	$result = mysqli_query($conn, $sql);
	$pilots = Array();
	$od = Array();
	while($row = mysqli_fetch_array($result, MYSQL_BOTH)){
		array_push($pilots,$row[0]);
	}
	for($i=0;$i<count($pilots);$i++){
		//Get operations directors
		$sql = sprintf("SELECT person_id,person_fname,person_lname FROM person WHERE person_id='%s'",
		mysqli_real_escape_string($conn,$pilots[$i]));
		$result = mysqli_query($conn, $sql);
		array_push($od,mysqli_fetch_array($result, MYSQL_BOTH));
	}

	//Get instructors
	$sql = sprintf("SELECT person_id FROM role WHERE role_type='%s' AND role_active='%s'",
	mysqli_real_escape_string($conn,"instructor"),
	mysqli_real_escape_string($conn,"1"));
	$result = mysqli_query($conn, $sql);
	$pilots = Array();
	$instructors = Array();
	while($row = mysqli_fetch_array($result, MYSQL_BOTH)){
		array_push($pilots,$row[0]);
	}
	for($i=0;$i<count($pilots);$i++){
		//Get instructors
		$sql = sprintf("SELECT person_id,person_fname,person_lname FROM person WHERE person_id='%s'",
		mysqli_real_escape_string($conn,$pilots[$i]));
		$result = mysqli_query($conn, $sql);
		array_push($instructors,mysqli_fetch_array($result, MYSQL_BOTH));
	}
	//Close database connection
	close($conn);
?>