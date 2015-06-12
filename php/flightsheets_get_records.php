<?php
	//Connect to database
	$conn = open();
	
	////////////////////////////////////////////
	//Get incomplete Soar flights
	$sql = "SELECT DISTINCT f.svc_id,s.svc_date,p.person_fname,p.person_lname,f.flight_takeoff,s.svc_type,so.soar_altitude,so.soar_penalty,so.soar_passenger,s.svc_cost,s.svc_od FROM flight f,person p,service s,soar so
		WHERE s.svc_od=p.person_id 
		AND f.svc_id=s.svc_id
		AND f.flight_landing='00:00:00'
		AND so.svc_id=s.svc_id";
	$result = mysqli_query($conn, $sql);
	$records = Array();
	while($row = mysqli_fetch_array($result, MYSQL_BOTH)){
		array_push($records,$row);
	}
	//Get pilot roles
	for($i=0;$i<count($records);$i++){
		//Towpilot
		$sql = sprintf("SELECT fr.role_id FROM flight_role fr, flight f WHERE f.svc_id='%s' AND f.flight_type='tow' AND f.flight_id=fr.flight_id",
		mysqli_real_escape_string($conn,$records[$i][0]));
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result,MYSQLI_BOTH);
		$records[$i][] = $row[0];
		
		//Gliderpilot
		$sql = sprintf("SELECT fr.role_id FROM flight_role fr, flight f WHERE f.svc_id='%s' AND f.flight_type='glider' AND f.flight_id=fr.flight_id",
		mysqli_real_escape_string($conn,$records[$i][0]));
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result,MYSQLI_BOTH);
		$records[$i][] = $row[0];
	}
	
	
	////////////////////////////////////////////
	//Get incomplete Plane Rental flights
	$sql = "SELECT DISTINCT f.svc_id,s.svc_date,p.person_fname,p.person_lname,f.flight_takeoff,s.svc_type,s.svc_cost,pr.pr_member,s.svc_od
		FROM flight f,person p,service s
		LEFT JOIN plane_rental pr ON pr.svc_id=s.svc_id
		WHERE s.svc_od=p.person_id 
		AND f.svc_id=s.svc_id
		AND f.flight_landing='00:00:00'
        AND s.svc_type='pr'";
	$result = mysqli_query($conn, $sql);
	$records2 = Array();
	while($row = mysqli_fetch_array($result, MYSQL_BOTH)){
		array_push($records2,$row);
	}
	//Get pilot roles
	for($i=0;$i<count($records2);$i++){
		//Towpilot
		$sql = sprintf("SELECT fr.role_id FROM flight_role fr, flight f WHERE f.svc_id='%s' AND f.flight_type='tow' AND f.flight_id=fr.flight_id",
		mysqli_real_escape_string($conn,$records2[$i][0]));
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result,MYSQLI_BOTH);
		$records2[$i][] = $row[0];
	}
	
	
	////////////////////////////////////////////
	//Get incomplete towline break flights
	$sql = "SELECT DISTINCT f.svc_id,s.svc_date,p.person_fname,p.person_lname,f.flight_takeoff,s.svc_type,rb.rb_sim,s.svc_cost,s.svc_od 
		FROM flight f,person p,service s,rope_break rb
		WHERE s.svc_od=p.person_id 
		AND f.svc_id=s.svc_id
		AND f.flight_landing='00:00:00'
		AND rb.svc_id=s.svc_id";
	$result = mysqli_query($conn, $sql);
	$records3 = Array();
	while($row = mysqli_fetch_array($result, MYSQL_BOTH)){
		array_push($records3,$row);
	}
	//Get pilot roles
	for($i=0;$i<count($records3);$i++){
		//Towpilot
		$sql = sprintf("SELECT fr.role_id FROM flight_role fr, flight f WHERE f.svc_id='%s' AND f.flight_type='tow' AND f.flight_id=fr.flight_id",
		mysqli_real_escape_string($conn,$records[$i][0]));
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result,MYSQLI_BOTH);
		$records3[$i][] = $row[0];
		
		//Gliderpilot
		$sql = sprintf("SELECT fr.role_id FROM flight_role fr, flight f WHERE f.svc_id='%s' AND f.flight_type='glider' AND f.flight_id=fr.flight_id",
		mysqli_real_escape_string($conn,$records[$i][0]));
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result,MYSQLI_BOTH);
		$records3[$i][] = $row[0];
	}
	
	////////////////////////////////////////////
	//Get incomplete Aerotow flights
	$sql = "SELECT DISTINCT f.svc_id,s.svc_date,p.person_fname,p.person_lname,f.flight_takeoff,s.svc_type,a.aerotow_miles,a.aerotow_pickup,s.svc_cost,s.svc_od
		FROM flight f,person p,service s,aerotow a
		WHERE s.svc_od=p.person_id 
		AND f.svc_id=s.svc_id
		AND f.flight_landing='00:00:00'
		AND a.svc_id=s.svc_id";
	$result = mysqli_query($conn, $sql);
	$records4 = Array();
	while($row = mysqli_fetch_array($result, MYSQL_BOTH)){
		array_push($records4,$row);
	}
	//Get pilot roles
	for($i=0;$i<count($records4);$i++){
		//Towpilot
		$sql = sprintf("SELECT fr.role_id FROM flight_role fr, flight f WHERE f.svc_id='%s' AND f.flight_type='tow' AND f.flight_id=fr.flight_id",
		mysqli_real_escape_string($conn,$records4[$i][0]));
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result,MYSQLI_BOTH);
		$records4[$i][] = $row[0];
		
		//Gliderpilot
		$sql = sprintf("SELECT fr.role_id FROM flight_role fr, flight f WHERE f.svc_id='%s' AND f.flight_type='glider' AND f.flight_id=fr.flight_id",
		mysqli_real_escape_string($conn,$records[$i][0]));
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result,MYSQLI_BOTH);
		$records4[$i][] = $row[0];
	}
	
	////////////////////////////////////////////
	//Get unpaid Soar flights
	$sql = "SELECT DISTINCT f.svc_id,s.svc_date,p.person_fname,p.person_lname,f.flight_takeoff,s.svc_type,so.soar_altitude,so.soar_penalty,so.soar_passenger,s.svc_cost,SUM(pay.pay_amount) AS payments,s.svc_od
		FROM flight f,person p,soar so,service s
		LEFT JOIN payment pay ON pay.svc_id=s.svc_id
		WHERE s.svc_od=p.person_id 
		AND f.svc_id=s.svc_id
		AND so.svc_id=s.svc_id
		AND NOT f.flight_landing='00:00:00'
		GROUP BY s.svc_id";
	$result = mysqli_query($conn, $sql);
	$records5 = Array();
	while($row = mysqli_fetch_array($result, MYSQL_BOTH)){
		array_push($records5,$row);
	}
	//Get pilot roles
	for($i=0;$i<count($records5);$i++){
		//Towpilot
		$sql = sprintf("SELECT fr.role_id FROM flight_role fr, flight f WHERE f.svc_id='%s' AND f.flight_type='tow' AND f.flight_id=fr.flight_id",
		mysqli_real_escape_string($conn,$records[$i][0]));
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result,MYSQLI_BOTH);
		$records5[$i][] = $row[0];
		
		//Gliderpilot
		$sql = sprintf("SELECT fr.role_id FROM flight_role fr, flight f WHERE f.svc_id='%s' AND f.flight_type='glider' AND f.flight_id=fr.flight_id",
		mysqli_real_escape_string($conn,$records[$i][0]));
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result,MYSQLI_BOTH);
		$records5[$i][] = $row[0];
	}
	
	
	////////////////////////////////////////////
	//Get unpaid Plane Rental flights
	$sql = "SELECT f.svc_id,s.svc_date,p.person_fname,p.person_lname,f.flight_takeoff,s.svc_type,s.svc_cost,SUM(pay.pay_amount) AS payments,pr.pr_member,s.svc_od
		FROM flight f,person p,service s
		LEFT JOIN payment pay ON pay.svc_id=s.svc_id
		LEFT JOIN plane_rental pr ON pr.svc_id=s.svc_id
		WHERE s.svc_od=p.person_id 
		AND f.svc_id=s.svc_id
		AND s.svc_type='pr'
		AND NOT f.flight_landing='00:00:00'
		GROUP BY s.svc_id";
	$result = mysqli_query($conn, $sql);
	$records6 = Array();
	while($row = mysqli_fetch_array($result, MYSQL_BOTH)){
		array_push($records6,$row);
	}
	//Get pilot roles
	for($i=0;$i<count($records6);$i++){
		//Towpilot
		$sql = sprintf("SELECT fr.role_id FROM flight_role fr, flight f WHERE f.svc_id='%s' AND f.flight_type='tow' AND f.flight_id=fr.flight_id",
		mysqli_real_escape_string($conn,$records6[$i][0]));
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result,MYSQLI_BOTH);
		$records6[$i][] = $row[0];
	}
	
	
	////////////////////////////////////////////
	//Get unpaid towline break flights
	$sql = "SELECT DISTINCT f.svc_id,s.svc_date,p.person_fname,p.person_lname,f.flight_takeoff,s.svc_type,rb.rb_sim,s.svc_cost,SUM(pay.pay_amount) AS payments,s.svc_od
		FROM flight f,person p,rope_break rb,service s
		LEFT JOIN payment pay ON pay.svc_id=s.svc_id 
		WHERE s.svc_od=p.person_id 
		AND f.svc_id=s.svc_id
		AND rb.svc_id=s.svc_id
		GROUP BY s.svc_id";
	$result = mysqli_query($conn, $sql);
	$records7 = Array();
	while($row = mysqli_fetch_array($result, MYSQL_BOTH)){
		array_push($records7,$row);
	}
	//Get pilot roles
	for($i=0;$i<count($records7);$i++){
		//Towpilot
		$sql = sprintf("SELECT fr.role_id FROM flight_role fr, flight f WHERE f.svc_id='%s' AND f.flight_type='tow' AND f.flight_id=fr.flight_id",
		mysqli_real_escape_string($conn,$records[$i][0]));
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result,MYSQLI_BOTH);
		$records7[$i][] = $row[0];
		
		//Gliderpilot
		$sql = sprintf("SELECT fr.role_id FROM flight_role fr, flight f WHERE f.svc_id='%s' AND f.flight_type='glider' AND f.flight_id=fr.flight_id",
		mysqli_real_escape_string($conn,$records[$i][0]));
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result,MYSQLI_BOTH);
		$records7[$i][] = $row[0];
	}
	
	////////////////////////////////////////////
	//Get unpaid Aerotow flights
	$sql = "SELECT DISTINCT f.svc_id,s.svc_date,p.person_fname,p.person_lname,f.flight_takeoff,s.svc_type,a.aerotow_miles,a.aerotow_pickup,s.svc_cost,SUM(pay.pay_amount) AS payments,s.svc_od
			FROM flight f,person p,aerotow a,service s
			LEFT JOIN payment pay ON  pay.svc_id=s.svc_id
			WHERE s.svc_od=p.person_id 
			AND f.svc_id=s.svc_id
			AND a.svc_id=s.svc_id
			GROUP BY s.svc_id";
	$result = mysqli_query($conn, $sql);
	$records8 = Array();
	while($row = mysqli_fetch_array($result, MYSQL_BOTH)){
		array_push($records8,$row);
	}
	//Get pilot roles
	for($i=0;$i<count($records8);$i++){
		//Towpilot
		$sql = sprintf("SELECT fr.role_id FROM flight_role fr, flight f WHERE f.svc_id='%s' AND f.flight_type='tow' AND f.flight_id=fr.flight_id",
		mysqli_real_escape_string($conn,$records4[$i][0]));
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result,MYSQLI_BOTH);
		$records8[$i][] = $row[0];
		
		//Gliderpilot
		$sql = sprintf("SELECT fr.role_id FROM flight_role fr, flight f WHERE f.svc_id='%s' AND f.flight_type='glider' AND f.flight_id=fr.flight_id",
		mysqli_real_escape_string($conn,$records[$i][0]));
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result,MYSQLI_BOTH);
		$records8[$i][] = $row[0];
	}
	///////////////////////////////////////////////////////////////////////////
	//Search Table
	if(isset($_POST["from_date"])&&isset($_POST["to_date"])){
		////////////////////////////////////////////
		//Get Soar flights
		$sql = sprintf("SELECT DISTINCT f.svc_id,s.svc_date,p.person_fname,p.person_lname,f.flight_takeoff,s.svc_type,so.soar_altitude,so.soar_penalty,so.soar_passenger,s.svc_cost,s.svc_od
			FROM flight f,person p,service s,soar so
			WHERE s.svc_od=p.person_id 
			AND f.svc_id=s.svc_id
			AND so.svc_id=s.svc_id
			AND s.svc_date >= '%s'
			AND s.svc_date <= '%s'",
			mysqli_real_escape_string($conn,$_POST["from_date"]),
			mysqli_real_escape_string($conn,$_POST["to_date"]));
		$result = mysqli_query($conn, $sql);
		$records9 = Array();
		while($row = mysqli_fetch_array($result, MYSQL_BOTH)){
			array_push($records9,$row);
		}
		//Get pilot roles
		for($i=0;$i<count($records9);$i++){
			//Towpilot
			$sql = sprintf("SELECT fr.role_id FROM flight_role fr, flight f WHERE f.svc_id='%s' AND f.flight_type='tow' AND f.flight_id=fr.flight_id",
			mysqli_real_escape_string($conn,$records[$i][0]));
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result,MYSQLI_BOTH);
			$records9[$i][] = $row[0];
			
			//Gliderpilot
			$sql = sprintf("SELECT fr.role_id FROM flight_role fr, flight f WHERE f.svc_id='%s' AND f.flight_type='glider' AND f.flight_id=fr.flight_id",
			mysqli_real_escape_string($conn,$records9[$i][0]));
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result,MYSQLI_BOTH);
			$records9[$i][] = $row[0];
		}
		
		
		////////////////////////////////////////////
		//Get Plane Rental flights
		$sql = sprintf("SELECT DISTINCT f.svc_id,s.svc_date,p.person_fname,p.person_lname,f.flight_takeoff,s.svc_type,s.svc_cost,pr.pr_member,s.svc_od
			FROM flight f,person p,service s
			LEFT JOIN plane_rental pr ON pr.svc_id=s.svc_id
			WHERE s.svc_od=p.person_id 
			AND f.svc_id=s.svc_id
			AND s.svc_type='pr'
			AND s.svc_date >= '%s'
			AND s.svc_date <= '%s'",
			mysqli_real_escape_string($conn,$_POST["from_date"]),
			mysqli_real_escape_string($conn,$_POST["to_date"]));
			
		$result = mysqli_query($conn, $sql);
		$records10 = Array();
		while($row = mysqli_fetch_array($result, MYSQL_BOTH)){
			array_push($records10,$row);
		}
		//Get pilot roles
		for($i=0;$i<count($records10);$i++){
			//Towpilot
			$sql = sprintf("SELECT fr.role_id FROM flight_role fr, flight f WHERE f.svc_id='%s' AND f.flight_type='tow' AND f.flight_id=fr.flight_id",
			mysqli_real_escape_string($conn,$records10[$i][0]));
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result,MYSQLI_BOTH);
			$records10[$i][] = $row[0];
		}
		
		
		////////////////////////////////////////////
		//Get towline break flights
		$sql = sprintf("SELECT DISTINCT f.svc_id,s.svc_date,p.person_fname,p.person_lname,f.flight_takeoff,s.svc_type,rb.rb_sim,s.svc_cost,s.svc_od 
			FROM flight f,person p,service s,rope_break rb
			WHERE s.svc_od=p.person_id 
			AND f.svc_id=s.svc_id
			AND rb.svc_id=s.svc_id
			AND s.svc_date >= '%s'
			AND s.svc_date <= '%s'",
			mysqli_real_escape_string($conn,$_POST["from_date"]),
			mysqli_real_escape_string($conn,$_POST["to_date"]));
		$result = mysqli_query($conn, $sql);
		$records11 = Array();
		while($row = mysqli_fetch_array($result, MYSQL_BOTH)){
			array_push($records11,$row);
		}
		//Get pilot roles
		for($i=0;$i<count($records11);$i++){
			//Towpilot
			$sql = sprintf("SELECT fr.role_id FROM flight_role fr, flight f WHERE f.svc_id='%s' AND f.flight_type='tow' AND f.flight_id=fr.flight_id",
			mysqli_real_escape_string($conn,$records[$i][0]));
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result,MYSQLI_BOTH);
			$records11[$i][] = $row[0];
			
			//Gliderpilot
			$sql = sprintf("SELECT fr.role_id FROM flight_role fr, flight f WHERE f.svc_id='%s' AND f.flight_type='glider' AND f.flight_id=fr.flight_id",
			mysqli_real_escape_string($conn,$records[$i][0]));
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result,MYSQLI_BOTH);
			$records11[$i][] = $row[0];
		}
		
		////////////////////////////////////////////
		//Get Aerotow flights
		$sql = sprintf("SELECT DISTINCT f.svc_id,s.svc_date,p.person_fname,p.person_lname,f.flight_takeoff,s.svc_type,a.aerotow_miles,a.aerotow_pickup,s.svc_cost,s.svc_od 
			FROM flight f,person p,service s,aerotow a
			WHERE s.svc_od=p.person_id 
			AND f.svc_id=s.svc_id
			AND a.svc_id=s.svc_id
			AND s.svc_date >= '%s'
			AND s.svc_date <= '%s'",
			mysqli_real_escape_string($conn,$_POST["from_date"]),
			mysqli_real_escape_string($conn,$_POST["to_date"]));
		$result = mysqli_query($conn, $sql);
		$records12 = Array();
		while($row = mysqli_fetch_array($result, MYSQL_BOTH)){
			array_push($records12,$row);
		}
		//Get pilot roles
		for($i=0;$i<count($records12);$i++){
			//Towpilot
			$sql = sprintf("SELECT fr.role_id FROM flight_role fr, flight f WHERE f.svc_id='%s' AND f.flight_type='tow' AND f.flight_id=fr.flight_id",
			mysqli_real_escape_string($conn,$records12[$i][0]));
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result,MYSQLI_BOTH);
			$records12[$i][] = $row[0];
			
			//Gliderpilot
			$sql = sprintf("SELECT fr.role_id FROM flight_role fr, flight f WHERE f.svc_id='%s' AND f.flight_type='glider' AND f.flight_id=fr.flight_id",
			mysqli_real_escape_string($conn,$records[$i][0]));
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result,MYSQLI_BOTH);
			$records12[$i][] = $row[0];
		}
	}
	
	//Close database connection
	close($conn);
?>