<?php
	//Connect to database
	$conn = open();
	
	//Get salt and hashed password
	$sql = "SELECT plane_id,plane_model,plane_name,plane_type,plane_serial FROM plane";
	
	$result = mysqli_query($conn, $sql);
	
	//Close database connection
	close($conn);
?>
