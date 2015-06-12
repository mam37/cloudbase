<?php
	//Connect to database
	$conn = open();
	
	//=========================================================================
	// This section updates flightsheets
	//=========================================================================
	//////////////////////
	// All services
	//Get Cost
	$cost = 0;
	$member = 0;
	$nonmember = 0;
	if(!isset($_POST["update"])&&$_POST["id"]!=""&&$fail==0&&!isset($_POST["delete"])){	
		if($_POST["svctype"]=="soar"){
			//Get business rules
			$sql = "SELECT br_value FROM business_rule WHERE br_svctype='soar' AND br_rule='basetow_ft'";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result, MYSQL_BOTH);
			$basetow_ft = $row[0];
			$sql = "SELECT br_value FROM business_rule WHERE br_svctype='soar' AND br_rule='basetow_cost'";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result, MYSQL_BOTH);
			$basetow_cost = $row[0];
			$sql = "SELECT br_value FROM business_rule WHERE br_svctype='soar' AND br_rule='cost_100ft'";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result, MYSQL_BOTH);
			$cost_100ft = $row[0];
			
			//Calculate penalty
			if(isset($_POST["glanding"])&&$_POST["glanding"]!=""){
				list($hour, $min) = explode(':', $_POST["takeoff"]);
				$interval = new DateInterval("PT{$hour}H{$min}M");
				$x = new DateTime($_POST["glanding"]);
				$hours = $x->sub($interval);
				
				$h = $hours->format('H');
				$m = $hours->format('i');
				$time = ($h*60)+$m;
				
				$sql = sprintf("SELECT g.glider_seats FROM glider g,flight f
				WHERE f.svc_id='%s'
				AND g.plane_id=f.plane_id",
				mysqli_real_escape_string($conn,$_POST["id"]));
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_array($result, MYSQL_BOTH);
				$seats = $row[0];
				
				if($seats==1){
					if(($time-120)>0){
						$_POST["penalty"]=($time-120);
					}
				}else if($seats==2){
					if(($time-60)>0){
						$_POST["penalty"]=($time-60);
					}
				}
			}
			
			//Calculate Cost
			if ($_POST["altitude"] > $basetow_ft){
				$_POST["cost"] = $basetow_cost + (($_POST["altitude"]-$basetow_ft)/100)*$cost_100ft;
			}else{
				$_POST["cost"] = $basetow_cost ;
			}
		}else if($_POST["svctype"]=="pr"){
			$sql = sprintf("SELECT pr.pr_tach_hours,er.er_employeecost,er.er_customercost FROM plane_rental pr,service s,flight f,engined_rental er 
				WHERE pr.svc_id='%s'
				AND pr.svc_id=s.svc_id
				AND f.svc_id=s.svc_id
				AND f.plane_id=er.plane_id",
			mysqli_real_escape_string($conn,$_POST["id"]));
			$result = mysqli_query($conn, $sql);
			$cost = mysqli_fetch_array($result, MYSQL_BOTH);
			$member = (float)$cost[0] * (float)$cost[1];
			$nonmember = (float)$cost[0] * (float)$cost[2];
			if(isset($_POST["member"])){
				$_POST["cost"] = $member;
			}else{
				$_POST["cost"] = $nonmember;
			}
		}else if($_POST["svctype"]=="rb"){
			//Get business rules
			$sql = "SELECT br_value FROM business_rule WHERE br_svctype='ropebreak' AND br_rule='cost'";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result, MYSQL_BOTH);
			$rbcost = $row[0];
			
			//Calculate Cost
			if (isset($_POST["sim"])){
				$_POST["cost"] = $rbcost/100;
			}else{
				$_POST["cost"] = 0;
			}
		}else if($_POST["svctype"]=="at"){
			//Calculate Aerotow Cost
			//Get business rules
			$sql = "SELECT br_value FROM business_rule WHERE br_svctype='aerotow' AND br_rule='cost_mile'";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result, MYSQL_BOTH);
			$cost_mile = $row[0];
			$sql = "SELECT br_value FROM business_rule WHERE br_svctype='aerotow' AND br_rule='min_cost'";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result, MYSQL_BOTH);
			$min_cost = (float)$row[0];
			
			if($_POST["cost"]==""){
				$_POST["cost"] = (float)$min_cost+((float)$cost_mile*$_POST["miles"]);
			}else{
				$_POST["cost"]=$_POST["cost"]*100;
			}
		}
		
		//Update plane rental table
		if($_POST["svctype"]=="pr"){		
			//Check if landing time is set
			if($_POST["tlanding"]!="00:00"){
				list($hour, $min) = explode(':', $_POST["takeoff"]);
				$interval = new DateInterval("PT{$hour}H{$min}M");
				$x = new DateTime($_POST["tlanding"]);
				$hours = $x->sub($interval);
				
				$h = $hours->format('H');
				$m = $hours->format('i');
				$tach = $h+($m/60);
				
				//Check if plane rental has been set already
				$sql = sprintf("SELECT * FROM plane_rental WHERE svc_id='%s'",
				mysqli_real_escape_string($conn,$_POST["id"]));
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_array($result, MYSQL_BOTH);
				
				if(isset($_POST["member"])){
					$_POST["member"]=1;
				}else{
					$_POST["member"]=0;
				}
				
				$sql = sprintf("UPDATE plane_rental SET pr_tach_hours='%s',pr_member='%s' WHERE svc_id='%s'",
				mysqli_real_escape_string($conn,$tach),
				mysqli_real_escape_string($conn,$_POST["member"]),
				mysqli_real_escape_string($conn,$_POST["id"]));
				mysqli_query($conn, $sql);
			}
		}
		//Update soar table
		$sql = sprintf("UPDATE soar SET soar_altitude='%s',soar_penalty='%s',soar_passenger='%s' WHERE svc_id='%s'",
		mysqli_real_escape_string($conn,$_POST["altitude"]),
		mysqli_real_escape_string($conn,$_POST["penalty"]),
		mysqli_real_escape_string($conn,$_POST["instructor"]),
		mysqli_real_escape_string($conn,$_POST["id"]));
		mysqli_query($conn, $sql);
			
		//Update Aerotow table
		$sql = sprintf("UPDATE aerotow SET aerotow_miles='%s',aerotow_pickup='%s' WHERE svc_id='%s'",
		mysqli_real_escape_string($conn,$_POST["miles"]),
		mysqli_real_escape_string($conn,$_POST["pickup"]),
		mysqli_real_escape_string($conn,$_POST["id"]));
		mysqli_query($conn, $sql);
	
		//Update Rope Break table
		if(isset($_POST["sim"])){
			$sim=1;
		}else{
			$sim=0;
		}
		$sql = sprintf("UPDATE rope_break SET rb_sim='%s' WHERE svc_id='%s'",
		mysqli_real_escape_string($conn,$sim),
		mysqli_real_escape_string($conn,$_POST["id"]));
		mysqli_query($conn, $sql);
		
		//Update service table
		$sql = sprintf("UPDATE service SET svc_date='%s',svc_cost='%s',svc_comment='%s',svc_od='%s' WHERE svc_id='%s'",
		mysqli_real_escape_string($conn,$_POST["date"]),
		mysqli_real_escape_string($conn,$_POST["cost"]),
		mysqli_real_escape_string($conn,$_POST["comment"]),
		mysqli_real_escape_string($conn,$_POST["od"]),
		mysqli_real_escape_string($conn,$_POST["id"]));
		mysqli_query($conn, $sql);
		
		//Update flight table (glider)
		$sql = sprintf("UPDATE flight SET plane_id='%s',flight_takeoff='%s',flight_landing='%s' WHERE svc_id='%s' AND flight_type='glider'",
		mysqli_real_escape_string($conn,$_POST["gliderplane"]),
		mysqli_real_escape_string($conn,$_POST["takeoff"]),
		mysqli_real_escape_string($conn,$_POST["glanding"]),
		mysqli_real_escape_string($conn,$_POST["id"]));
		mysqli_query($conn, $sql);
		
		//Update flight table (tow)
		$sql = sprintf("UPDATE flight SET plane_id='%s',flight_takeoff='%s',flight_landing='%s' WHERE svc_id='%s' AND flight_type='tow'",
		mysqli_real_escape_string($conn,$_POST["towplane"]),
		mysqli_real_escape_string($conn,$_POST["takeoff"]),
		mysqli_real_escape_string($conn,$_POST["tlanding"]),
		mysqli_real_escape_string($conn,$_POST["id"]));
		mysqli_query($conn, $sql);
		
		//Update flightrole table (tow)
		$sql = sprintf("SELECT flight_id FROM flight WHERE svc_id='%s' AND flight_type='tow'",
		mysqli_real_escape_string($conn,$_POST["id"]));
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result, MYSQL_BOTH);
		$sql = sprintf("UPDATE flight_role SET role_id='%s' WHERE flight_id='".$row[0]."'",
		mysqli_real_escape_string($conn,$_POST["towpilot"]));
		mysqli_query($conn, $sql);
		
		$sql = sprintf("SELECT flight_id FROM flight_role WHERE flight_id='".$row[0]."' AND role_id='%s' AND role_type='tow'",
		mysqli_real_escape_string($conn,$_POST["towpilot"]));
		$result = mysqli_query($conn, $sql);
		$tpilot = mysqli_fetch_array($conn,MYSQL_BOTH);
		
		if(count($tpilot)==0){
			$sql = sprintf("INSERT INTO flight_role (flight_id,role_id,role_type) VALUES ('".$row[0]."','%s','tow')",
			mysqli_real_escape_string($conn,$_POST["towpilot"]));
			mysqli_query($conn, $sql);
		}
		
		//Update flightrole table (glider)
		$sql = sprintf("SELECT flight_id FROM flight WHERE svc_id='%s' AND flight_type='glider'",
		mysqli_real_escape_string($conn,$_POST["id"]));
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result, MYSQL_BOTH);
		$sql = sprintf("UPDATE flight_role SET role_id='%s' WHERE flight_id='".$row[0]."'",
		mysqli_real_escape_string($conn,$_POST["gliderpilot"]));
		mysqli_query($conn, $sql);
		
		$sql = sprintf("SELECT flight_id FROM flight_role WHERE flight_id='".$row[0]."' AND role_id='%s' AND role_type='glider'",
		mysqli_real_escape_string($conn,$_POST["gliderpilot"]));
		$result = mysqli_query($conn, $sql);
		$gpilot = mysqli_fetch_array($conn,MYSQL_BOTH);
		
		if(count($gpilot)==0){
			$sql = sprintf("INSERT INTO flight_role (flight_id,role_id,role_type) VALUES ('".$row[0]."','%s','glider')",
			mysqli_real_escape_string($conn,$_POST["gliderpilot"]));
			mysqli_query($conn, $sql);
		}
		
		echo "<p style='color:green'>Update Successful</p>";
	}
	//=========================================================================
	// This section creates new flightsheets
	//=========================================================================	
	if($firstvisit==0&&$fail==0&&
		!isset($_POST["update"])&&
		!isset($_POST["delete"])&&
		$_POST["id"]==""){
		
		/////////////////////////////////
		// Soar
		if($_POST["svctype"]=="soar"){
			//Get business rules
			$sql = "SELECT br_value FROM business_rule WHERE br_svctype='soar' AND br_rule='basetow_ft'";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result, MYSQL_BOTH);
			$basetow_ft = $row[0];
			$sql = "SELECT br_value FROM business_rule WHERE br_svctype='soar' AND br_rule='basetow_cost'";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result, MYSQL_BOTH);
			$basetow_cost = $row[0];
			$sql = "SELECT br_value FROM business_rule WHERE br_svctype='soar' AND br_rule='cost_100ft'";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result, MYSQL_BOTH);
			$cost_100ft = $row[0];
			
			//Calculate Cost
			if ($_POST["altitude"] > $basetow_ft){
				$_POST["cost"] = $basetow_cost + (($_POST["altitude"]-$basetow_ft)/100)*$cost_100ft;
			}else{
				$_POST["cost"] = $basetow_cost ;
			}
			
			//Insert Flightsheet
			$sql = sprintf("INSERT INTO service(svc_date,svc_cost,svc_comment,svc_type,svc_od) VALUES ('%s','%s','%s','%s','%s')",
			mysqli_real_escape_string($conn,$_POST["date"]),
			mysqli_real_escape_string($conn,$_POST["cost"]),
			mysqli_real_escape_string($conn,$_POST["comment"]),
			mysqli_real_escape_string($conn,$_POST["svctype"]),
			mysqli_real_escape_string($conn,$_POST["od"]));
			mysqli_query($conn, $sql);
			
			//Get service ID
			$sql = "SELECT LAST_INSERT_ID()";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result, MYSQL_BOTH);
			$svc_id = $row[0];
			
			//Use Service ID to insert new Glider flight
			$sql = sprintf("INSERT INTO flight(plane_id,svc_id,flight_takeoff,flight_landing,flight_type) VALUES ('%s','%s','%s','%s','%s')",
			mysqli_real_escape_string($conn,$_POST["gliderplane"]),
			mysqli_real_escape_string($conn,$svc_id),
			mysqli_real_escape_string($conn,$_POST["takeoff"]),
			mysqli_real_escape_string($conn,$_POST["glanding"]),
			mysqli_real_escape_string($conn,"glider"));
			mysqli_query($conn, $sql);
			
			//Get glider flight ID
			$sql = "SELECT LAST_INSERT_ID()";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result, MYSQL_BOTH);
			$glider_flight_id = $row[0];
			
			//Use glider flight ID to insert new flight role
			$sql = sprintf("INSERT INTO flight_role(flight_id,role_id,role_type) VALUES ('%s','%s','%s')",
			mysqli_real_escape_string($conn,$glider_flight_id),
			mysqli_real_escape_string($conn,$_POST["gliderpilot"]),
			mysqli_real_escape_string($conn,"glide"));
			mysqli_query($conn, $sql);
			
			//Calculate penalty
			if(isset($_POST["glanding"])&&$_POST["glanding"]!=""){
				list($hour, $min) = explode(':', $_POST["takeoff"]);
				$interval = new DateInterval("PT{$hour}H{$min}M");
				$x = new DateTime($_POST["glanding"]);
				$hours = $x->sub($interval);
				
				$h = $hours->format('H');
				$m = $hours->format('i');
				$time = ($h*60)+$m;
				
				$sql = sprintf("SELECT g.glider_seats FROM glider g,flight f
				WHERE f.svc_id='%s'
				AND g.plane_id=f.plane_id",
				mysqli_real_escape_string($conn,$svc_id));
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_array($result, MYSQL_BOTH);
				$seats = $row[0];
				
				if($seats==1){
					if(($time-120)>0){
						$_POST["penalty"]=($time-120);
					}
				}else if($seats==2){
					if(($time-60)>0){
						$_POST["penalty"]=($time-60);
					}
				}
			}
			
			//Use Flightsheet ID to insert new Soar Service
			$sql = sprintf("INSERT INTO soar(svc_id,soar_altitude,soar_penalty,soar_passenger) VALUES ('%s','%s','%s','%s')",
			mysqli_real_escape_string($conn,$svc_id),
			mysqli_real_escape_string($conn,$_POST["altitude"]),
			mysqli_real_escape_string($conn,$_POST["penalty"]),
			mysqli_real_escape_string($conn,$_POST["instructor"]));
			mysqli_query($conn, $sql);
			
			//Use Service ID to insert new Towplane flight
			$sql = sprintf("INSERT INTO flight(plane_id,svc_id,flight_takeoff,flight_landing,flight_type) VALUES ('%s','%s','%s','%s','%s')",
			mysqli_real_escape_string($conn,$_POST["towplane"]),
			mysqli_real_escape_string($conn,$svc_id),
			mysqli_real_escape_string($conn,$_POST["takeoff"]),
			mysqli_real_escape_string($conn,$_POST["tlanding"]),
			mysqli_real_escape_string($conn,"tow"));
			mysqli_query($conn, $sql);
			
			//Get towplane flight ID
			$sql = "SELECT LAST_INSERT_ID()";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result, MYSQL_BOTH);
			$tow_flight_id = $row[0];
			
			//Use towplane flight ID to insert new flight role
			$sql = sprintf("INSERT INTO flight_role(flight_id,role_id,role_type) VALUES ('%s','%s','%s')",
			mysqli_real_escape_string($conn,$tow_flight_id),
			mysqli_real_escape_string($conn,$_POST["towpilot"]),
			mysqli_real_escape_string($conn,"tow"));
			mysqli_query($conn, $sql);
		}
		/////////////////////////////////
		// Plane Rental
		if($_POST["svctype"]=="pr"){

			if(isset($_POST["member"])){
				$_POST["member"]=1;
			}else{
				$_POST["member"]=0;
			}
			
			//Insert Flightsheet
			$sql = sprintf("INSERT INTO service(svc_date,svc_cost,svc_comment,svc_type,svc_od) VALUES ('%s','%s','%s','%s','%s')",
			mysqli_real_escape_string($conn,$_POST["date"]),
			mysqli_real_escape_string($conn,$_POST["cost"]),
			mysqli_real_escape_string($conn,$_POST["comment"]),
			mysqli_real_escape_string($conn,$_POST["svctype"]),
			mysqli_real_escape_string($conn,$_POST["od"]));
			mysqli_query($conn, $sql);
			
			//Get service ID
			$sql = "SELECT LAST_INSERT_ID()";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result, MYSQL_BOTH);
			$svc_id = $row[0];
			
			//Use Flightsheet ID to insert new Plane Rental Service
			if(isset($_POST["tlanding"])){
				list($hour, $min) = explode(':', $_POST["takeoff"]);
				$interval = new DateInterval("PT{$hour}H{$min}M");
				$x = new DateTime($_POST["tlanding"]);
				$hours = $x->sub($interval);
				
				$h = $hours->format('H');
				$m = $hours->format('i');
				$tach = $h+($m/60);
				
				$sql = sprintf("INSERT INTO plane_rental(svc_id,pr_tach_hours,pr_member) VALUES ('%s','%s','%s')",
				mysqli_real_escape_string($conn,$svc_id),
				mysqli_real_escape_string($conn,$tach),
				mysqli_real_escape_string($conn,$_POST["member"]));
				mysqli_query($conn, $sql);
			}else{
				$sql = sprintf("INSERT INTO plane_rental(svc_id,pr_tach_hours,pr_member) VALUES ('%s','%s','%s')",
				mysqli_real_escape_string($conn,$svc_id),
				mysqli_real_escape_string($conn,"0"),
				mysqli_real_escape_string($conn,$_POST["member"]));
				mysqli_query($conn, $sql);
			}
			
			//Use Service ID to insert new Towplane flight
			$sql = sprintf("INSERT INTO flight(plane_id,svc_id,flight_takeoff,flight_landing,flight_type) VALUES ('%s','%s','%s','%s','%s')",
			mysqli_real_escape_string($conn,$_POST["towplane"]),
			mysqli_real_escape_string($conn,$svc_id),
			mysqli_real_escape_string($conn,$_POST["takeoff"]),
			mysqli_real_escape_string($conn,$_POST["tlanding"]),
			mysqli_real_escape_string($conn,"tow"));
			mysqli_query($conn, $sql);
			
			//Get towplane flight ID
			$sql = "SELECT LAST_INSERT_ID()";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result, MYSQL_BOTH);
			$tow_flight_id = $row[0];
			
			//Use towplane flight ID to insert new flight role
			$sql = sprintf("INSERT INTO flight_role(flight_id,role_id,role_type) VALUES ('%s','%s','%s')",
			mysqli_real_escape_string($conn,$tow_flight_id),
			mysqli_real_escape_string($conn,$_POST["towpilot"]),
			mysqli_real_escape_string($conn,"tow"));
			mysqli_query($conn, $sql);
			
			
			//Calculate Cost
			$sql = sprintf("SELECT pr.pr_tach_hours,er.er_employeecost,er.er_customercost FROM plane_rental pr,service s,flight f,engined_rental er 
				WHERE pr.svc_id='%s'
				AND pr.svc_id=s.svc_id
				AND f.svc_id=s.svc_id
				AND f.plane_id=er.plane_id",
			mysqli_real_escape_string($conn,$svc_id));
			$result = mysqli_query($conn, $sql);
			$cost = mysqli_fetch_array($result, MYSQL_BOTH);
			$member = (float)$cost[0] * (float)$cost[1];
			$nonmember = (float)$cost[0] * (float)$cost[2];
			if($_POST["member"]==1){
				$_POST["cost"] = $member;
			}else{
				$_POST["cost"] = $nonmember;
			}
			
			//Update cost
			$sql = sprintf("UPDATE service SET svc_cost='%s' WHERE svc_id='%s'",
			mysqli_real_escape_string($conn,$_POST["cost"]),
			mysqli_real_escape_string($conn,$svc_id));
			mysqli_query($conn, $sql);

			$_POST["id"] = $svc_id;
		}
		/////////////////////////////////
		// Towline Break
		if($_POST["svctype"]=="rb"){
			//Get business rules
			$sql = "SELECT br_value FROM business_rule WHERE br_svctype='ropebreak' AND br_rule='cost'";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result, MYSQL_BOTH);
			$rbcost = $row[0];
			
			//Calculate Cost
			if (isset($_POST["sim"])){
				$_POST["cost"] = $rbcost/100;
			}else{
				$_POST["cost"] = 0;
			}
			
			//Insert Flightsheet
			$sql = sprintf("INSERT INTO service(svc_date,svc_cost,svc_comment,svc_type,svc_od) VALUES ('%s','%s','%s','%s','%s')",
			mysqli_real_escape_string($conn,$_POST["date"]),
			mysqli_real_escape_string($conn,$_POST["cost"]),
			mysqli_real_escape_string($conn,$_POST["comment"]),
			mysqli_real_escape_string($conn,$_POST["svctype"]),
			mysqli_real_escape_string($conn,$_POST["od"]));
			mysqli_query($conn, $sql);
			
			//Get service ID
			$sql = "SELECT LAST_INSERT_ID()";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result, MYSQL_BOTH);
			$svc_id = $row[0];
			
			//Create new Ropebreak entry
			if (isset($_POST["sim"])){
				$sql = sprintf("INSERT INTO rope_break(svc_id,rb_sim) VALUES ('%s','1')",
				mysqli_real_escape_string($conn,$svc_id));
				mysqli_query($conn, $sql);
			}
			
			//Use Flightsheet ID to insert new Rope Break Service
			$sql = sprintf("INSERT INTO rope_break(svc_id,rb_sim) VALUES ('%s','%s')",
			mysqli_real_escape_string($conn,$svc_id),
			mysqli_real_escape_string($conn,$_POST["sim"]));
			mysqli_query($conn, $sql);

			//Use Service ID to insert new Towplane flight
			$sql = sprintf("INSERT INTO flight(plane_id,svc_id,flight_takeoff,flight_landing,flight_type) VALUES ('%s','%s','%s','%s','%s')",
			mysqli_real_escape_string($conn,$_POST["towplane"]),
			mysqli_real_escape_string($conn,$svc_id),
			mysqli_real_escape_string($conn,$_POST["takeoff"]),
			mysqli_real_escape_string($conn,$_POST["tlanding"]),
			mysqli_real_escape_string($conn,"tow"));
			mysqli_query($conn, $sql);
			
			//Get towplane flight ID
			$sql = "SELECT LAST_INSERT_ID()";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result, MYSQL_BOTH);
			$tow_flight_id = $row[0];
			
			//Use towplane flight ID to insert new flight role
			$sql = sprintf("INSERT INTO flight_role(flight_id,role_id,role_type) VALUES ('%s','%s','%s')",
			mysqli_real_escape_string($conn,$tow_flight_id),
			mysqli_real_escape_string($conn,$_POST["towpilot"]),
			mysqli_real_escape_string($conn,"tow"));
			mysqli_query($conn, $sql);
			
			//Use Service ID to insert new Glider flight
			$sql = sprintf("INSERT INTO flight(plane_id,svc_id,flight_takeoff,flight_landing,flight_type) VALUES ('%s','%s','%s','%s','%s')",
			mysqli_real_escape_string($conn,$_POST["gliderplane"]),
			mysqli_real_escape_string($conn,$svc_id),
			mysqli_real_escape_string($conn,$_POST["takeoff"]),
			mysqli_real_escape_string($conn,$_POST["glanding"]),
			mysqli_real_escape_string($conn,"glider"));
			mysqli_query($conn, $sql);
			
			//Get glider flight ID
			$sql = "SELECT LAST_INSERT_ID()";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result, MYSQL_BOTH);
			$glider_flight_id = $row[0];
			
			//Use glider flight ID to insert new flight role
			$sql = sprintf("INSERT INTO flight_role(flight_id,role_id,role_type) VALUES ('%s','%s','%s')",
			mysqli_real_escape_string($conn,$glider_flight_id),
			mysqli_real_escape_string($conn,$_POST["gliderpilot"]),
			mysqli_real_escape_string($conn,"glide"));
			mysqli_query($conn, $sql);
		}
		/////////////////////////////////
		// Aerotow
		if($_POST["svctype"]=="at"){
			//Get business rules
			$sql = "SELECT br_value FROM business_rule WHERE br_svctype='aerotow' AND br_rule='cost_mile'";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result, MYSQL_BOTH);
			$cost_mile = $row[0];
			$sql = "SELECT br_value FROM business_rule WHERE br_svctype='aerotow' AND br_rule='min_cost'";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result, MYSQL_BOTH);
			$min_cost = (float)$row[0];
			
			//Calculate Aerotow Cost
			if($_POST["cost"]==""){
				$_POST["cost"] = (float)$min_cost+((float)$cost_mile*$_POST["miles"]);
			}else{
				$_POST["cost"]=$_POST["cost"]*100;
			}
			
			//Insert Flightsheet
			$sql = sprintf("INSERT INTO service(svc_date,svc_cost,svc_comment,svc_type,svc_od) VALUES ('%s','%s','%s','%s','%s')",
			mysqli_real_escape_string($conn,$_POST["date"]),
			mysqli_real_escape_string($conn,$_POST["cost"]),
			mysqli_real_escape_string($conn,$_POST["comment"]),
			mysqli_real_escape_string($conn,$_POST["svctype"]),
			mysqli_real_escape_string($conn,$_POST["od"]));
			mysqli_query($conn, $sql);
			
			//Get service ID
			$sql = "SELECT LAST_INSERT_ID()";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result, MYSQL_BOTH);
			$svc_id = $row[0];
			
			//Use Flightsheet ID to insert new Aerotow Service
			$sql = sprintf("INSERT INTO aerotow(svc_id,aerotow_miles,aerotow_pickup) VALUES ('%s','%s','%s')",
			mysqli_real_escape_string($conn,$svc_id),
			mysqli_real_escape_string($conn,$_POST["miles"]),
			mysqli_real_escape_string($conn,$_POST["pickup"]));
			mysqli_query($conn, $sql);
			
			//Use Service ID to insert new Towplane flight
			$sql = sprintf("INSERT INTO flight(plane_id,svc_id,flight_takeoff,flight_landing,flight_type) VALUES ('%s','%s','%s','%s','%s')",
			mysqli_real_escape_string($conn,$_POST["towplane"]),
			mysqli_real_escape_string($conn,$svc_id),
			mysqli_real_escape_string($conn,$_POST["takeoff"]),
			mysqli_real_escape_string($conn,$_POST["tlanding"]),
			mysqli_real_escape_string($conn,"tow"));
			mysqli_query($conn, $sql);
			
			//Get towplane flight ID
			$sql = "SELECT LAST_INSERT_ID()";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result, MYSQL_BOTH);
			$tow_flight_id = $row[0];
			
			//Use towplane flight ID to insert new flight role
			$sql = sprintf("INSERT INTO flight_role(flight_id,role_id,role_type) VALUES ('%s','%s','%s')",
			mysqli_real_escape_string($conn,$tow_flight_id),
			mysqli_real_escape_string($conn,$_POST["towpilot"]),
			mysqli_real_escape_string($conn,"tow"));
			mysqli_query($conn, $sql);
			
			//Use Service ID to insert new Glider flight
			$sql = sprintf("INSERT INTO flight(plane_id,svc_id,flight_takeoff,flight_landing,flight_type) VALUES ('%s','%s','%s','%s','%s')",
			mysqli_real_escape_string($conn,$_POST["gliderplane"]),
			mysqli_real_escape_string($conn,$svc_id),
			mysqli_real_escape_string($conn,$_POST["takeoff"]),
			mysqli_real_escape_string($conn,$_POST["glanding"]),
			mysqli_real_escape_string($conn,"glider"));
			mysqli_query($conn, $sql);
			
			//Get glider flight ID
			$sql = "SELECT LAST_INSERT_ID()";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result, MYSQL_BOTH);
			$glider_flight_id = $row[0];
			
			//Use glider flight ID to insert new flight role
			$sql = sprintf("INSERT INTO flight_role(flight_id,role_id,role_type) VALUES ('%s','%s','%s')",
			mysqli_real_escape_string($conn,$glider_flight_id),
			mysqli_real_escape_string($conn,$_POST["gliderpilot"]),
			mysqli_real_escape_string($conn,"glide"));
			mysqli_query($conn, $sql);
		}
		
		//Set variables necessary for loading info on the next page
		$_POST["update"] = 1;
		$_POST["id"] = $svc_id;
		
		echo "<p style='color:green'>Record Created</p>";
	}	
	//Close database connection
	close($conn);
?>