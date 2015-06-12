<?php
	$fail = 0;
	$firstvisit = 0;
	//Determine whether this is the first visit to this page
	if(isset($_POST["new"])||isset($_POST["update"])||isset($_POST["delete"])){
		$firstvisit = 1;
	}
	//Check if all required fields are filled
	if($_POST["svctype"]=="soar"){
		if($firstvisit==0&&(
			$_POST["date"]==""||
			$_POST["od"]==""||
			$_POST["svctype"]==""||
			$_POST["towpilot"]==""||
			$_POST["towplane"]==""||
			$_POST["gliderpilot"]==""||
			$_POST["gliderplane"]==""||
			$_POST["takeoff"]==""||
			$_POST["altitude"]=="")){
			echo "<p style='color:red'>Please enter all required fields!</p>";
			$fail = 1;
		}
	}else if($_POST["svctype"]=="pr"){
		if($firstvisit==0&&(
			$_POST["date"]==""||
			$_POST["od"]==""||
			$_POST["svctype"]==""||
			$_POST["towpilot"]==""||
			$_POST["towplane"]==""||
			$_POST["takeoff"]=="")){
			echo "<p style='color:red'>Please enter all required fields!</p>";
			$fail = 1;
		}
	}else if($_POST["svctype"]=="rb"||$_POST["svctype"]=="at"){
		if($firstvisit==0&&(
			$_POST["date"]==""||
			$_POST["od"]==""||
			$_POST["svctype"]==""||
			$_POST["towpilot"]==""||
			$_POST["towplane"]==""||
			$_POST["gliderpilot"]==""||
			$_POST["gliderplane"]==""||
			$_POST["takeoff"]=="")){
			echo "<p style='color:red'>Please enter all required fields!</p>";
			$fail = 1;		
		}
	}
	//Ensure landing time(s) occur after takeoff time
	if($_POST["tlanding"]!=""&&$_POST["takeoff"]>$_POST["tlanding"]){
		echo "<p style='color:red'>Towplane landing time must occur after takeoff!</p>";
		$fail = 1;
	}
	if($_POST["glanding"]!=""&&$_POST["takeoff"]>$_POST["glanding"]){
		echo "<p style='color:red'>Glider landing time must occur after takeoff!</p>";
		$fail = 1;
	}
?> 