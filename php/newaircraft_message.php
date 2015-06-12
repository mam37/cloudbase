<?php
	$fail = 0;
	$firstvisit = 0;
	//Determine whether this is the first visit to this page
	if(isset($_POST["new"])||isset($_POST["update"])||isset($_POST["delete"])){
		$firstvisit = 1;
	}
	//=========================================================================
	// Aircraft Table
	//=========================================================================
	//Check if model field is null
	if($firstvisit==0&&($_POST["model"]==""&&
		($_POST["name"]!=""||
		$_POST["owner"]!=""||
		$_POST["type"]!=""||
		$_POST["id"]!=""))){
		echo "<p style='color:red'>Model Required!</p>";
		$fail = 1;
	}
	//Check if serial field is null
	if($firstvisit==0&&($_POST["serial"]==""&&
		($_POST["name"]!=""||
		$_POST["owner"]!=""||
		$_POST["type"]!=""||
		$_POST["id"]!=""))){
		echo "<p style='color:red'>Serial # Required!</p>";
		$fail = 1;
	}
	//Check if name field is null
	if($firstvisit==0&&($_POST["name"]==""&&
		($_POST["model"]!=""||
		$_POST["owner"]!=""||
		$_POST["type"]!=""||
		$_POST["id"]!=""))){
		echo "<p style='color:red'>Name Required!</p>";
		$fail = 1;
	}
	//Check if type field is null
	if($firstvisit==0&&($_POST["type"]=="select"&&
		($_POST["model"]!=""||
		$_POST["owner"]!=""||
		$_POST["name"]!=""||
		$_POST["id"]!=""))){
		echo "<p style='color:red'>Type Required!</p>";
		$fail = 1;
	}
	//=========================================================================
	// Glider Table
	//=========================================================================
	//Check if hourcost, minutecost or seats fields are null
	if($firstvisit==0&&($_POST["type"]=="glider"&&
		($_POST["hour"]==""||
		$_POST["minute"]==""||
		$_POST["seats"]==""))){
		echo "<p style='color:red'>Hour cost, minute cost and seats Required!</p>";
		$fail = 1;
	}
	//=========================================================================
	// Towplane Table
	//=========================================================================
	//Check if employeecost or customercost fields are null
	if($firstvisit==0&&($_POST["type"]=="tow"&&
		($_POST["emp"]==""||
		$_POST["cust"]==""))){
		echo "<p style='color:red'>Employee cost and customer cost Required!</p>";
		$fail = 1;
	}
?>
