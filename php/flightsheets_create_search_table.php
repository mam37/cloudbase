<?php
	echo'
	<form action="flightsheets.php" method="post" class="form-inline">
		<label>From: </label><input type="text" name="from_date" id="from_date" class="form-control">
		<label>To: </label><input type="text" name="to_date" id="to_date" class="form-control">
		<input class="btn btn-primary" type="submit" value="Search">
	</form><br>
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
	for($i=0;$i<count($records9);$i++){
		echo'
			<tr>
				<td>'.htmlspecialchars($records9[$i][0]).'</td>
				<td>'.htmlspecialchars($records9[$i][1]).'</td>
				<td>'.htmlspecialchars($records9[$i][4]).'</td>
				<td>'.htmlspecialchars($records9[$i][2]).' '.htmlspecialchars($records9[$i][3]).'</td>
				<td>Soar</td>
				<td>
					<form action="newsheet.php" method="post">
						<input type="hidden" name="od" value="'.htmlspecialchars($records9[$i][10]).'">
						<input type="hidden" name="id" value="'.htmlspecialchars($records9[$i][0]).'">
						<input type="hidden" name="date" value="'.htmlspecialchars($records9[$i][1]).'">
						<input type="hidden" name="svctype" value="'.htmlspecialchars($records9[$i][5]).'">
						<input type="hidden" name="altitude" value="'.htmlspecialchars($records9[$i][6]).'">
						<input type="hidden" name="takeoff" value="'.htmlspecialchars($records9[$i][4]).'">
						<input type="hidden" name="penalty" value="'.htmlspecialchars($records9[$i][7]).'">
						<input type="hidden" name="instructor" value="'.htmlspecialchars($records9[$i][8]).'">
						<input type="hidden" name="cost" value="'.htmlspecialchars($records9[$i][9]).'">
						<input type="hidden" name="towpilot" value="'.htmlspecialchars($records9[$i][11]).'">
						<input type="hidden" name="gliderpilot" value="'.htmlspecialchars($records9[$i][12]).'">
						<input type="hidden" name="update" value="1">
						<input type="submit" value="update" class="btn btn-link">
					</form>
				</td>
				<td>
					<form action="flightsheets.php" method="post">
						<input type="hidden" name="id" value="'.htmlspecialchars($records9[$i][0]).'">
						<input type="hidden" name="delete" value="1">
						<input type="submit" value="delete" class="btn btn-link">
					</form>
				</td>
			</tr>';	
	}
	//Plane rental flights
	for($i=0;$i<count($records10);$i++){
		echo'
			<tr>
				<td>'.htmlspecialchars($records10[$i][0]).'</td>
				<td>'.htmlspecialchars($records10[$i][1]).'</td>
				<td>'.htmlspecialchars($records10[$i][4]).'</td>
				<td>'.htmlspecialchars($records10[$i][2]).' '.htmlspecialchars($records10[$i][3]).'</td>
				<td>Rental</td>
				<td>
					<form action="newsheet.php" method="post">
						<input type="hidden" name="od" value="'.htmlspecialchars($records10[$i][8]).'">
						<input type="hidden" name="id" value="'.htmlspecialchars($records10[$i][0]).'">
						<input type="hidden" name="date" value="'.htmlspecialchars($records10[$i][1]).'">
						<input type="hidden" name="svctype" value="'.htmlspecialchars($records10[$i][5]).'">
						<input type="hidden" name="takeoff" value="'.htmlspecialchars($records10[$i][4]).'">
						<input type="hidden" name="cost" value="'.htmlspecialchars($records10[$i][6]).'">';
						if($records10[$i][7]==1){
								echo'<input type="hidden" name="member" value="1">';
						}
						echo'
						<input type="hidden" name="towpilot" value="'.htmlspecialchars($records10[$i][9]).'">
						<input type="hidden" name="update" value="1">
						<input type="submit" value="update" class="btn btn-link">
					</form>
				</td>
				<td>
					<form action="flightsheets.php" method="post">
						<input type="hidden" name="id" value="'.htmlspecialchars($records10[$i][0]).'">
						<input type="hidden" name="delete" value="1">
						<input type="submit" value="delete" class="btn btn-link">
					</form>
				</td>
			</tr>';	
	}
	//Ropebreak flights
	for($i=0;$i<count($records11);$i++){
		echo'
		<tr>
				<td>'.htmlspecialchars($records11[$i][0]).'</td>
				<td>'.htmlspecialchars($records11[$i][1]).'</td>
				<td>'.htmlspecialchars($records11[$i][4]).'</td>
				<td>'.htmlspecialchars($records11[$i][2]).' '.htmlspecialchars($records11[$i][3]).'</td>
				<td>Ropebreak</td>
				<td>
					<form action="newsheet.php" method="post">
						<input type="hidden" name="od" value="'.htmlspecialchars($records11[$i][8]).'">
						<input type="hidden" name="id" value="'.htmlspecialchars($records11[$i][0]).'">
						<input type="hidden" name="date" value="'.htmlspecialchars($records11[$i][1]).'">
						<input type="hidden" name="svctype" value="'.htmlspecialchars($records11[$i][5]).'">
						<input type="hidden" name="takeoff" value="'.htmlspecialchars($records11[$i][4]).'">';
						if($records11[$i][6]==1){
							echo'<input type="hidden" name="sim" value="'.htmlspecialchars($records11[$i][6]).'">';
						}echo'
						<input type="hidden" name="cost" value="'.htmlspecialchars($records11[$i][7]).'">
						<input type="hidden" name="towpilot" value="'.htmlspecialchars($records11[$i][9]).'">
						<input type="hidden" name="gliderpilot" value="'.htmlspecialchars($records11[$i][10]).'">
						<input type="hidden" name="update" value="1">
						<input type="submit" value="update" class="btn btn-link">
					</form>
				</td>
				<td>
					<form action="flightsheets.php" method="post">
						<input type="hidden" name="id" value="'.htmlspecialchars($records11[$i][0]).'">
						<input type="hidden" name="delete" value="1">
						<input type="submit" value="delete" class="btn btn-link">
					</form>
				</td>
			</tr>';
	}
	//Aerotow flights
	for($i=0;$i<count($records12);$i++){
		echo'
		<tr>
				<td>'.htmlspecialchars($records12[$i][0]).'</td>
				<td>'.htmlspecialchars($records12[$i][1]).'</td>
				<td>'.htmlspecialchars($records12[$i][4]).'</td>
				<td>'.htmlspecialchars($records12[$i][2]).' '.htmlspecialchars($records12[$i][3]).'</td>
				<td>Aerotow</td>
				<td>
					<form action="newsheet.php" method="post">
						<input type="hidden" name="od" value="'.htmlspecialchars($records12[$i][9]).'">
						<input type="hidden" name="id" value="'.htmlspecialchars($records12[$i][0]).'">
						<input type="hidden" name="date" value="'.htmlspecialchars($records12[$i][1]).'">
						<input type="hidden" name="svctype" value="'.htmlspecialchars($records12[$i][5]).'">
						<input type="hidden" name="takeoff" value="'.htmlspecialchars($records12[$i][4]).'">
						<input type="hidden" name="miles" value="'.htmlspecialchars($records12[$i][6]).'">
						<input type="hidden" name="pickup" value="'.htmlspecialchars($records12[$i][7]).'">
						<input type="hidden" name="cost" value="'.htmlspecialchars($records12[$i][8]).'">
						<input type="hidden" name="towpilot" value="'.htmlspecialchars($records12[$i][10]).'">
						<input type="hidden" name="gliderpilot" value="'.htmlspecialchars($records12[$i][11]).'">
						<input type="hidden" name="update" value="1">
						<input type="submit" value="update" class="btn btn-link">
					</form>
				</td>
				<td>
					<form action="flightsheets.php" method="post">
						<input type="hidden" name="id" value="'.htmlspecialchars($records12[$i][0]).'">
						<input type="hidden" name="delete" value="1">
						<input type="submit" value="delete" class="btn btn-link">
					</form>
				</td>
			</tr>';
	}
	echo'</table>';
					
?>