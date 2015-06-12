<?php
	//Connect to database
	$conn = open();
	
	//=========================================================================
	// This section updates an aircraft
	//=========================================================================
	if(!isset($_POST["update"])&&$_POST["id"]!=""&&$fail==0&&!isset($_POST["delete"])){	
		
		//Submit all plane fields
		if(isset($_POST["active"])){ $active = 1; }else{ $active = 0; }
		$sql = sprintf("UPDATE plane SET plane_model='%s',plane_name='%s',plane_owner='%s',plane_active='%s',plane_type='%s',plane_serial='%s' WHERE plane_id='%s'",
		mysqli_real_escape_string($conn,$_POST["model"]),
		mysqli_real_escape_string($conn,$_POST["name"]),
		mysqli_real_escape_string($conn,$_POST["owner"]),
		mysqli_real_escape_string($conn,$active),
		mysqli_real_escape_string($conn,$_POST["type"]),
		mysqli_real_escape_string($conn,$_POST["serial"]),
		mysqli_real_escape_string($conn,$_POST["id"]));
		mysqli_query($conn, $sql);		
		
		//Submit glider or engined fields
		if($_POST["type"]=="glider"){
			$sql = sprintf("UPDATE glider SET glider_hourcost='%s',glider_minutecost='%s',glider_seats='%s' WHERE plane_id='%s'",
			mysqli_real_escape_string($conn,$_POST["hour"]),
			mysqli_real_escape_string($conn,$_POST["minute"]),
			mysqli_real_escape_string($conn,$_POST["seats"]),
			mysqli_real_escape_string($conn,$_POST["id"]));
			mysqli_query($conn, $sql);
		}else{
			$sql = sprintf("UPDATE engined_rental SET er_employeecost='%s',er_customercost='%s' WHERE plane_id='%s'",
			mysqli_real_escape_string($conn,$_POST["emp"]),
			mysqli_real_escape_string($conn,$_POST["cust"]),
			mysqli_real_escape_string($conn,$_POST["id"]));
			mysqli_query($conn, $sql);
		}
		echo "<p style='color:green'>Update Successful</p>";
	}
	//=========================================================================
	// This section creates a new aircraft
	//=========================================================================	
	if($firstvisit==0&&$fail==0&&
		!isset($_POST["update"])&&
		!isset($_POST["delete"])&&
		!isset($_POST["id"])){
		
		//Submit plane fields
		if(isset($_POST["active"])){ $active = 1; }else{ $active = 0; }
		$sql = sprintf("INSERT INTO plane(plane_model,plane_name,plane_owner,plane_active,plane_type,plane_serial) VALUES ('%s','%s','%s','%s','%s','%s')",
		mysqli_real_escape_string($conn,$_POST["model"]),
		mysqli_real_escape_string($conn,$_POST["name"]),
		mysqli_real_escape_string($conn,$_POST["owner"]),
		mysqli_real_escape_string($conn,$active),
		mysqli_real_escape_string($conn,$_POST["type"]),
		mysqli_real_escape_string($conn,$_POST["serial"]));
		mysqli_query($conn, $sql);
		
		//Get plane id
		$sql = "SELECT LAST_INSERT_ID()";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result, MYSQL_BOTH);
		$plane = $row[0];
		
		//Submit glider or engined fields
		if($_POST["type"]=="glider"){
			$sql = sprintf("INSERT INTO glider(plane_id,glider_hourcost,glider_minutecost,glider_seats) VALUES ('%s','%s','%s','%s')",
			mysqli_real_escape_string($conn,$plane),
			mysqli_real_escape_string($conn,$_POST["hour"]),
			mysqli_real_escape_string($conn,$_POST["minute"]),
			mysqli_real_escape_string($conn,$_POST["seats"]));
			mysqli_query($conn, $sql);
		}else{
			$sql = sprintf("INSERT INTO engined_rental(plane_id,er_employeecost,er_customercost) VALUES ('%s','%s','%s')",
			mysqli_real_escape_string($conn,$plane),
			mysqli_real_escape_string($conn,$_POST["emp"]),
			mysqli_real_escape_string($conn,$_POST["cust"]));
			mysqli_query($conn, $sql);
		}
		$_POST["id"] = $plane;
		echo "<p style='color:green'>Aircraft Created</p>";
	}
	//Close database connection
	close($conn);
?>
