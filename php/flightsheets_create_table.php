<?php
	echo'
	 <table class="table table-hover table-condensed">
		<tr>
			<th>Flight No</th>
			<th>Date</th>
			<th>Takeoff Time</th>
			<th>Operations Director</th>
			<th>Type</th>
			<th>Action</th>
			<th>Action</th>
		</tr>';
	//Soar Flights
	for($i=0;$i<count($records);$i++){
		echo'
			<tr>
				<td>'.htmlspecialchars($records[$i][0]).'</td>
				<td>'.htmlspecialchars($records[$i][1]).'</td>
				<td>'.htmlspecialchars($records[$i][4]).'</td>
				<td>'.htmlspecialchars($records[$i][2]).' '.htmlspecialchars($records[$i][3]).'</td>
				<td>Soar</td>
				<td>
					<form action="newsheet.php" method="post">
						<input type="hidden" name="od" value="'.htmlspecialchars($records[$i][10]).'">
						<input type="hidden" name="id" value="'.htmlspecialchars($records[$i][0]).'">
						<input type="hidden" name="date" value="'.htmlspecialchars($records[$i][1]).'">
						<input type="hidden" name="svctype" value="'.htmlspecialchars($records[$i][5]).'">
						<input type="hidden" name="altitude" value="'.htmlspecialchars($records[$i][6]).'">
						<input type="hidden" name="takeoff" value="'.htmlspecialchars($records[$i][4]).'">
						<input type="hidden" name="penalty" value="'.htmlspecialchars($records[$i][7]).'">
						<input type="hidden" name="instructor" value="'.htmlspecialchars($records[$i][8]).'">
						<input type="hidden" name="cost" value="'.htmlspecialchars($records[$i][9]).'">
						<input type="hidden" name="towpilot" value="'.htmlspecialchars($records[$i][11]).'">
						<input type="hidden" name="gliderpilot" value="'.htmlspecialchars($records[$i][12]).'">
						<input type="hidden" name="update" value="1">
						<input type="submit" value="update" class="btn btn-link">
					</form>
				</td>
				<td>
					<form action="flightsheets.php" method="post">
						<input type="hidden" name="id" value="'.htmlspecialchars($records[$i][0]).'">
						<input type="hidden" name="delete" value="1">
						<input type="submit" value="delete" class="btn btn-link">
					</form>
				</td>
			</tr>';	
	}
	//Plane rental flights
	for($i=0;$i<count($records2);$i++){
		echo'
			<tr>
				<td>'.htmlspecialchars($records2[$i][0]).'</td>
				<td>'.htmlspecialchars($records2[$i][1]).'</td>
				<td>'.htmlspecialchars($records2[$i][4]).'</td>
				<td>'.htmlspecialchars($records2[$i][2]).' '.htmlspecialchars($records2[$i][3]).'</td>
				<td>Rental</td>
				<td>
					<form action="newsheet.php" method="post">
						<input type="hidden" name="od" value="'.htmlspecialchars($records2[$i][8]).'">
						<input type="hidden" name="id" value="'.htmlspecialchars($records2[$i][0]).'">
						<input type="hidden" name="date" value="'.htmlspecialchars($records2[$i][1]).'">
						<input type="hidden" name="svctype" value="'.htmlspecialchars($records2[$i][5]).'">
						<input type="hidden" name="takeoff" value="'.htmlspecialchars($records2[$i][4]).'">
						<input type="hidden" name="cost" value="'.htmlspecialchars($records2[$i][6]).'">';
						if($records2[$i][7]==1){
								echo'<input type="hidden" name="member" value="1">';
						}
						echo'
						<input type="hidden" name="towpilot" value="'.htmlspecialchars($records2[$i][9]).'">
						<input type="hidden" name="update" value="1">
						<input type="submit" value="update" class="btn btn-link">
					</form>
				</td>
				<td>
					<form action="flightsheets.php" method="post">
						<input type="hidden" name="id" value="'.htmlspecialchars($records2[$i][0]).'">
						<input type="hidden" name="delete" value="1">
						<input type="submit" value="delete" class="btn btn-link">
					</form>
				</td>
			</tr>';	
	}
	//Ropebreak flights
	for($i=0;$i<count($records3);$i++){
		echo'
		<tr>
				<td>'.htmlspecialchars($records3[$i][0]).'</td>
				<td>'.htmlspecialchars($records3[$i][1]).'</td>
				<td>'.htmlspecialchars($records3[$i][4]).'</td>
				<td>'.htmlspecialchars($records3[$i][2]).' '.htmlspecialchars($records3[$i][3]).'</td>
				<td>Ropebreak</td>
				<td>
					<form action="newsheet.php" method="post">
						<input type="hidden" name="od" value="'.htmlspecialchars($records3[$i][8]).'">
						<input type="hidden" name="id" value="'.htmlspecialchars($records3[$i][0]).'">
						<input type="hidden" name="date" value="'.htmlspecialchars($records3[$i][1]).'">
						<input type="hidden" name="svctype" value="'.htmlspecialchars($records3[$i][5]).'">
						<input type="hidden" name="takeoff" value="'.htmlspecialchars($records3[$i][4]).'">';
						if($records3[$i][6]==1){
							echo'<input type="hidden" name="sim" value="'.htmlspecialchars($records3[$i][6]).'">';
						}echo'
						<input type="hidden" name="cost" value="'.htmlspecialchars($records3[$i][7]).'">
						<input type="hidden" name="towpilot" value="'.htmlspecialchars($records3[$i][9]).'">
						<input type="hidden" name="gliderpilot" value="'.htmlspecialchars($records3[$i][10]).'">
						<input type="hidden" name="update" value="1">
						<input type="submit" value="update" class="btn btn-link">
					</form>
				</td>
				<td>
					<form action="flightsheets.php" method="post">
						<input type="hidden" name="id" value="'.htmlspecialchars($records3[$i][0]).'">
						<input type="hidden" name="delete" value="1">
						<input type="submit" value="delete" class="btn btn-link">
					</form>
				</td>
			</tr>';
	}
	//Aerotow flights
	for($i=0;$i<count($records4);$i++){
		echo'
		<tr>
				<td>'.htmlspecialchars($records4[$i][0]).'</td>
				<td>'.htmlspecialchars($records4[$i][1]).'</td>
				<td>'.htmlspecialchars($records4[$i][4]).'</td>
				<td>'.htmlspecialchars($records4[$i][2]).' '.htmlspecialchars($records4[$i][3]).'</td>
				<td>Aerotow</td>
				<td>
					<form action="newsheet.php" method="post">
						<input type="hidden" name="od" value="'.htmlspecialchars($records4[$i][9]).'">
						<input type="hidden" name="id" value="'.htmlspecialchars($records4[$i][0]).'">
						<input type="hidden" name="date" value="'.htmlspecialchars($records4[$i][1]).'">
						<input type="hidden" name="svctype" value="'.htmlspecialchars($records4[$i][5]).'">
						<input type="hidden" name="takeoff" value="'.htmlspecialchars($records4[$i][4]).'">
						<input type="hidden" name="miles" value="'.htmlspecialchars($records4[$i][6]).'">
						<input type="hidden" name="pickup" value="'.htmlspecialchars($records4[$i][7]).'">
						<input type="hidden" name="cost" value="'.htmlspecialchars($records4[$i][8]).'">
						<input type="hidden" name="towpilot" value="'.htmlspecialchars($records4[$i][10]).'">
						<input type="hidden" name="gliderpilot" value="'.htmlspecialchars($records4[$i][11]).'">
						<input type="hidden" name="update" value="1">
						<input type="submit" value="update" class="btn btn-link">
					</form>
				</td>
				<td>
					<form action="flightsheets.php" method="post">
						<input type="hidden" name="id" value="'.htmlspecialchars($records4[$i][0]).'">
						<input type="hidden" name="delete" value="1">
						<input type="submit" value="delete" class="btn btn-link">
					</form>
				</td>
			</tr>';
	}
	echo'</table>';
					
?>