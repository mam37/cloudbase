<?php
	//Connect to database
	$conn = open();
	$payments = Array();
	$paid = 0;
	
	if(isset($_POST["id"])){
		//Get payments
		$sql = sprintf("SELECT pay_id,pay_date,pay_method,pay_amount FROM payment WHERE svc_id='%s'",
		mysqli_real_escape_string($conn,$_POST["id"]));
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result, MYSQL_BOTH)){
			array_push($payments,$row);
		}
	}
	for($i=0;$i<count($payments);$i++){
		$paid += $payments[$i][3];
	}
	
	//Close database connection
	close($conn);
?>