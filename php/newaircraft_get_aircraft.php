<?php
	//Connect to database
	$conn = open();

	//Gets selected aircraft
	if(isset($_POST["id"])){
		$sql = sprintf("SELECT plane_id,plane_model,plane_name,plane_owner,plane_active,plane_type,plane_serial FROM plane WHERE plane_id='%s'",
		mysqli_real_escape_string($conn,$_POST["id"]));
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result,MYSQLI_BOTH);
		
		$sql = sprintf("SELECT plane_id,glider_hourcost,glider_minutecost,glider_seats FROM glider WHERE plane_id='%s'",
		mysqli_real_escape_string($conn,$_POST["id"]));
		$result2 = mysqli_query($conn, $sql);
		$row2 = mysqli_fetch_array($result2,MYSQLI_BOTH);
		
		$sql = sprintf("SELECT plane_id,er_employeecost,er_customercost FROM engined_rental WHERE plane_id='%s'",
		mysqli_real_escape_string($conn,$_POST["id"]));
		$result3 = mysqli_query($conn, $sql);
		$row3 = mysqli_fetch_array($result3,MYSQLI_BOTH);
	}
	//Close database connection
	close($conn);
?>
