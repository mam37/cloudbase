<?php
	//Connect to database
	$conn = open();
	//=========================================================================
	// This section deletes a service record
	//=========================================================================	
	if(isset($_POST["delete"])){
		// Delete flights and flight roles
		$sql = sprintf("DELETE f,fr FROM flight f INNER JOIN flight_role  fr
			WHERE f.flight_id=fr.flight_id
			AND f.svc_id='%s'",
		mysqli_real_escape_string($conn,$_POST["id"]));
		
		// Delete from service category tables
		mysqli_query($conn, $sql);
		$sql = sprintf("DELETE FROM soar
			where svc_id='%s'",
		mysqli_real_escape_string($conn,$_POST["id"]));
		mysqli_query($conn, $sql);
		mysqli_query($conn, $sql);
		$sql = sprintf("DELETE FROM rope_break
			where svc_id='%s'",
		mysqli_real_escape_string($conn,$_POST["id"]));
		mysqli_query($conn, $sql);
		mysqli_query($conn, $sql);
		$sql = sprintf("DELETE FROM aerotow
			where svc_id='%s'",
		mysqli_real_escape_string($conn,$_POST["id"]));
		mysqli_query($conn, $sql);
		mysqli_query($conn, $sql);
		$sql = sprintf("DELETE FROM plane_rental
			where svc_id='%s'",
		mysqli_real_escape_string($conn,$_POST["id"]));
		mysqli_query($conn, $sql);
		
		//Delete Flight Roles
		$sql = sprintf("SELECT fr.flight_id FROM flight_role fr,flight f WHERE f.svc_id='%s' AND fr.flight_id=f.flight_id",
		mysqli_real_escape_string($conn,$_POST["id"]));
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result, MYSQL_BOTH)){
			$sql = sprintf("DELETE FROM flight_role
			where flight_id='%s'",
			mysqli_real_escape_string($conn,$row[0]));
			mysqli_query($conn, $sql);
			
			$sql = sprintf("DELETE FROM flight
			where flight_id='%s'",
			mysqli_real_escape_string($conn,$row[0]));
			mysqli_query($conn, $sql);
		}
		
		//Delete payments
		mysqli_query($conn, $sql);
		$sql = sprintf("DELETE FROM payment
			where svc_id='%s'",
		mysqli_real_escape_string($conn,$_POST["id"]));
		mysqli_query($conn, $sql);
		
		//Delete service
		mysqli_query($conn, $sql);
		$sql = sprintf("DELETE FROM service
			where svc_id='%s'",
		mysqli_real_escape_string($conn,$_POST["id"]));
		mysqli_query($conn, $sql);
		
		echo "<p style='color:green'>Record Deleted</p>";
	}
	//Close database connection
	close($conn);
?>