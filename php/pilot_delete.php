<?php
	//Connect to database
	$conn = open();
	//=========================================================================
	// This section deletes a person
	//=========================================================================	
	if(isset($_POST["delete"])){
		$sql = sprintf("DELETE FROM flight_role WHERE role_id='%s'",
		mysqli_real_escape_string($conn,$_POST["id"]));
		mysqli_query($conn, $sql);

		$sql = sprintf("DELETE FROM role WHERE person_id='%s'",
		mysqli_real_escape_string($conn,$_POST["id"]));
		mysqli_query($conn, $sql);

		$sql = sprintf("DELETE FROM person WHERE person_id='%s'",
		mysqli_real_escape_string($conn,$_POST["id"]));
		mysqli_query($conn, $sql);
		
		echo "<p style='color:green'>Pilot Deleted</p>";
	}
	//Close database connection
	close($conn);
?>