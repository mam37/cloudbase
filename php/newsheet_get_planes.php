<?php
	//Connect to database
	$conn = open();

	//Get gliders
	$sql = sprintf("SELECT plane_id,plane_model,plane_name FROM plane WHERE plane_active='%s' AND plane_type='%s'",
	mysqli_real_escape_string($conn,"1"),
	mysqli_real_escape_string($conn,"glider"));
	$result = mysqli_query($conn, $sql);
	$gliders = Array();
	while($row = mysqli_fetch_array($result, MYSQL_BOTH)){
		array_push($gliders,$row);
	}
	
	//Get tow planes
	$sql = sprintf("SELECT plane_id,plane_model,plane_name FROM plane WHERE plane_active='%s' AND plane_type='%s'",
	mysqli_real_escape_string($conn,"1"),
	mysqli_real_escape_string($conn,"tow"));
	$result = mysqli_query($conn, $sql);
	$towplanes = Array();
	while($row = mysqli_fetch_array($result, MYSQL_BOTH)){
		array_push($towplanes,$row);
	}
	//Close database connection
	close($conn);
?>