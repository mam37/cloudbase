<?php
	$fail = 0;
	$firstvisit = 0;
	//Determine whether this is the first visit to this page
	if(isset($_POST["new"])||isset($_POST["update"])||isset($_POST["delete"])){
		$firstvisit = 1;
	}
	//Check if model field is null
	if($firstvisit==0&&(
		$_POST["date"]==""||
		$_POST["method"]==""||
		$_POST["amount"]=="")){
		echo "<p style='color:red'>Please submit all required fields!</p>";

		$fail = 1;
	}
?>