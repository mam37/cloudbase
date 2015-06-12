<?php
	$fail = 0;
	$firstvisit = 0;
	//Determine whether this is the first visit to this page
	if(isset($_POST["new"])||isset($_POST["update"])||isset($_POST["delete"])){
		$firstvisit = 1;
	}
	//Check if firstname field is null
	if($firstvisit==0&&($_POST["fname"]==""&&
		($_POST["mname"]!=""||
		$_POST["lname"]!=""||
		$_POST["id"]!=""))){
		echo "<p style='color:red'>Firstname Required!</p>";
		$fail = 1;
	}
	//Check if lastname field is null
	if($firstvisit==0&&($_POST["lname"]==""&&
		($_POST["mname"]!=""||
		$_POST["fname"]!=""||
		$_POST["id"]!=""))){
		echo "<p style='color:red'>Lastname Required!</p>";
		$fail = 1;
	}
?>