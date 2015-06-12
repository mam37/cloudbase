<?php
	//Connect to database
	$conn = open();
	//=========================================================================
	// This section deletes an aircraft
	//=========================================================================	
	if(isset($_POST["delete"])){
		$sql = sprintf("DELETE FROM glider WHERE plane_id='%s'",
		mysqli_real_escape_string($conn,$_POST["id"]));
		mysqli_query($conn, $sql);
		
		$sql = sprintf("DELETE FROM engined_rental WHERE plane_id='%s'",
		mysqli_real_escape_string($conn,$_POST["id"]));
		mysqli_query($conn, $sql);

		$sql = sprintf("DELETE FROM plane WHERE plane_id='%s'",
		mysqli_real_escape_string($conn,$_POST["id"]));
		mysqli_query($conn, $sql);
		

		
		echo "<p style='color:green'>Aircraft Deleted</p>";
	}
	//Close database connection
	close($conn);
?>