<?php
	//Connect to database
	$conn = open();
	
	//=========================================================================
	// This section updates a payment
	//=========================================================================
	if(!isset($_POST["update"])&&$_POST["payid"]!=""&&$fail==0&&!isset($_POST["delete"])){	
		
		//Submit all plane fields
		if(isset($_POST["active"])){ $active = 1; }else{ $active = 0; }
		$sql = sprintf("UPDATE payment SET pay_date='%s',pay_method='%s',pay_amount='%s' WHERE pay_id='%s'",
		mysqli_real_escape_string($conn,$_POST["date"]),
		mysqli_real_escape_string($conn,$_POST["method"]),
		mysqli_real_escape_string($conn,$_POST["amount"]),
		mysqli_real_escape_string($conn,$_POST["payid"]));
		mysqli_query($conn, $sql);		
		
		echo "<p style='color:green'>Update Successful</p>";
	}
	//=========================================================================
	// This section creates a new payment
	//=========================================================================	
	if($firstvisit==0&&$fail==0&&
		!isset($_POST["update"])&&
		!isset($_POST["delete"])&&
		!isset($_POST["payid"])){
		
		//Submit plane fields
		if(isset($_POST["active"])){ $active = 1; }else{ $active = 0; }
		$sql = sprintf("INSERT INTO payment(svc_id,pay_date,pay_method,pay_amount) VALUES ('%s','%s','%s','%s')",
		mysqli_real_escape_string($conn,$_POST["svcid"]),
		mysqli_real_escape_string($conn,$_POST["date"]),
		mysqli_real_escape_string($conn,$_POST["method"]),
		mysqli_real_escape_string($conn,$_POST["amount"]));
		mysqli_query($conn, $sql);
		
		$sql = "SELECT LAST_INSERT_ID()";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result, MYSQL_BOTH);
		$_POST["payid"] = $row[0];
		
		echo "<p style='color:green'>Payment Created</p>";
	}
	//=========================================================================
	// This section deletes a new payment
	//=========================================================================	
	if(isset($_POST["delete"])){
		$sql = sprintf("DELETE FROM payment WHERE pay_id='%s'",
		mysqli_real_escape_string($conn,$_POST["payid"]));
		mysqli_query($conn, $sql);
		echo "<p style='color:green'>Payment Deleted</p>";
	}
	
	//Close database connection
	close($conn);
?>