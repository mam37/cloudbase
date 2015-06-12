<?php
	//Connect to database
	$conn = open();
	
	if(isset($_POST["payid"])){
		//Get payment
		$sql = sprintf("SELECT pay_id,pay_date,pay_method,pay_amount FROM payment WHERE pay_id='%s'",
		mysqli_real_escape_string($conn,$_POST["payid"]));
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result, MYSQL_BOTH);
	}
	//Close database connection
	close($conn);
?>