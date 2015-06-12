<?php
	//Connect to database
	$conn = open();

	//Get towplane landing time
	$sql = sprintf("SELECT flight_landing FROM flight WHERE flight_type='glider' AND svc_id='%s'",
	mysqli_real_escape_string($conn,$_POST["id"]));
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result, MYSQL_BOTH);
	if($row[0]!="00:00:00"){
		$_POST["glanding"] = $row[0];
	}
	//Close database connection
	close($conn);
?>