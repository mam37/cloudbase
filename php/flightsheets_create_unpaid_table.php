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
	for($i=0;$i<count($records5);$i++){
		if($records6[$i][10]==""||$records6[$i][9]>($records6[$i][10]*100)){
			echo'
				<tr>
					<td>'.htmlspecialchars($records5[$i][0]).'</td>
					<td>'.htmlspecialchars($records5[$i][1]).'</td>
					<td>'.htmlspecialchars($records5[$i][4]).'</td>
					<td>'.htmlspecialchars($records5[$i][2]).' '.htmlspecialchars($records5[$i][3]).'</td>
					<td>Soar</td>
					<td>
						<form action="newsheet.php" method="post">
							<input type="hidden" name="od" value="'.htmlspecialchars($records5[$i][11]).'">
							<input type="hidden" name="id" value="'.htmlspecialchars($records5[$i][0]).'">
							<input type="hidden" name="date" value="'.htmlspecialchars($records5[$i][1]).'">
							<input type="hidden" name="svctype" value="'.htmlspecialchars($records5[$i][5]).'">
							<input type="hidden" name="altitude" value="'.htmlspecialchars($records5[$i][6]).'">
							<input type="hidden" name="takeoff" value="'.htmlspecialchars($records5[$i][4]).'">
							<input type="hidden" name="penalty" value="'.htmlspecialchars($records5[$i][7]).'">
							<input type="hidden" name="instructor" value="'.htmlspecialchars($records5[$i][8]).'">
							<input type="hidden" name="cost" value="'.htmlspecialchars($records5[$i][9]).'">
							<input type="hidden" name="towpilot" value="'.htmlspecialchars($records5[$i][12]).'">
							<input type="hidden" name="gliderpilot" value="'.htmlspecialchars($records5[$i][13]).'">
							<input type="hidden" name="update" value="1">
							<input type="submit" value="update" class="btn btn-link">
						</form>
					</td>
					<td>
						<form action="flightsheets.php" method="post">
							<input type="hidden" name="id" value="'.htmlspecialchars($records5[$i][0]).'">
							<input type="hidden" name="delete" value="1">
							<input type="submit" value="delete" class="btn btn-link">
						</form>
					</td>
				</tr>';	
		}
	}
	//Plane rental flights
	for($i=0;$i<count($records6);$i++){
		if($records6[$i][7]==""||$records6[$i][6]>($records6[$i][7]*100)){
			echo'
				<tr>
					<td>'.htmlspecialchars($records6[$i][0]).'</td>
					<td>'.htmlspecialchars($records6[$i][1]).'</td>
					<td>'.htmlspecialchars($records6[$i][4]).'</td>
					<td>'.htmlspecialchars($records6[$i][2]).' '.htmlspecialchars($records6[$i][3]).'</td>
					<td>Rental</td>
					<td>
						<form action="newsheet.php" method="post">
							<input type="hidden" name="od" value="'.htmlspecialchars($records6[$i][9]).'">
							<input type="hidden" name="id" value="'.htmlspecialchars($records6[$i][0]).'">
							<input type="hidden" name="date" value="'.htmlspecialchars($records6[$i][1]).'">
							<input type="hidden" name="svctype" value="'.htmlspecialchars($records6[$i][5]).'">
							<input type="hidden" name="takeoff" value="'.htmlspecialchars($records6[$i][4]).'">
							<input type="hidden" name="cost" value="'.htmlspecialchars($records6[$i][6]).'">';
							if($records6[$i][8]==1){
								echo'<input type="hidden" name="member" value="1">';
							}
							echo'<input type="hidden" name="towpilot" value="'.htmlspecialchars($records6[$i][10]).'">
							<input type="hidden" name="update" value="1">
							<input type="submit" value="update" class="btn btn-link">
						</form>
					</td>
					<td>
						<form action="flightsheets.php" method="post">
							<input type="hidden" name="id" value="'.htmlspecialchars($records6[$i][0]).'">
							<input type="hidden" name="delete" value="1">
							<input type="submit" value="delete" class="btn btn-link">
						</form>
					</td>
				</tr>';
		}
	}
	//Ropebreak flights
	for($i=0;$i<count($records7);$i++){
		if(($records7[$i][8]==""||$records7[$i][7]>($records7[$i][8]*100))&&$records7[$i][7]!=0){
			echo'
			<tr>
					<td>'.htmlspecialchars($records7[$i][0]).'</td>
					<td>'.htmlspecialchars($records7[$i][1]).'</td>
					<td>'.htmlspecialchars($records7[$i][4]).'</td>
					<td>'.htmlspecialchars($records7[$i][2]).' '.htmlspecialchars($records7[$i][3]).'</td>
					<td>Ropebreak</td>
					<td>
						<form action="newsheet.php" method="post">
							<input type="hidden" name="od" value="'.htmlspecialchars($records7[$i][9]).'">
							<input type="hidden" name="id" value="'.htmlspecialchars($records7[$i][0]).'">
							<input type="hidden" name="date" value="'.htmlspecialchars($records7[$i][1]).'">
							<input type="hidden" name="svctype" value="'.htmlspecialchars($records7[$i][5]).'">
							<input type="hidden" name="takeoff" value="'.htmlspecialchars($records7[$i][4]).'">';
							if($records7[$i][6]==1){
								echo'<input type="hidden" name="sim" value="'.htmlspecialchars($records7[$i][6]).'">';
							}echo'
							<input type="hidden" name="cost" value="'.htmlspecialchars($records7[$i][7]).'">
							<input type="hidden" name="towpilot" value="'.htmlspecialchars($records7[$i][10]).'">
							<input type="hidden" name="gliderpilot" value="'.htmlspecialchars($records7[$i][11]).'">
							<input type="hidden" name="update" value="1">
							<input type="submit" value="update" class="btn btn-link">
						</form>
					</td>
					<td>
						<form action="flightsheets.php" method="post">
							<input type="hidden" name="id" value="'.htmlspecialchars($records7[$i][0]).'">
							<input type="hidden" name="delete" value="1">
							<input type="submit" value="delete" class="btn btn-link">
						</form>
					</td>
				</tr>';
		}
	}
	//Aerotow flights
	for($i=0;$i<count($records8);$i++){
		if($records8[$i][9]==""||$records8[$i][8]>($records8[$i][9]*100)){
			echo'
			<tr>
					<td>'.htmlspecialchars($records8[$i][0]).'</td>
					<td>'.htmlspecialchars($records8[$i][1]).'</td>
					<td>'.htmlspecialchars($records8[$i][4]).'</td>
					<td>'.htmlspecialchars($records8[$i][2]).' '.htmlspecialchars($records8[$i][3]).'</td>
					<td>Aerotow</td>
					<td>
						<form action="newsheet.php" method="post">
							<input type="hidden" name="od" value="'.htmlspecialchars($records8[$i][10]).'">
							<input type="hidden" name="id" value="'.htmlspecialchars($records8[$i][0]).'">
							<input type="hidden" name="date" value="'.htmlspecialchars($records8[$i][1]).'">
							<input type="hidden" name="svctype" value="'.htmlspecialchars($records8[$i][5]).'">
							<input type="hidden" name="takeoff" value="'.htmlspecialchars($records8[$i][4]).'">
							<input type="hidden" name="miles" value="'.htmlspecialchars($records8[$i][6]).'">
							<input type="hidden" name="pickup" value="'.htmlspecialchars($records8[$i][7]).'">
							<input type="hidden" name="cost" value="'.htmlspecialchars($records8[$i][8]).'">
							<input type="hidden" name="towpilot" value="'.htmlspecialchars($records8[$i][11]).'">
							<input type="hidden" name="gliderpilot" value="'.htmlspecialchars($records8[$i][12]).'">
							<input type="hidden" name="update" value="1">
							<input type="submit" value="update" class="btn btn-link">
						</form>
					</td>
					<td>
						<form action="flightsheets.php" method="post">
							<input type="hidden" name="id" value="'.htmlspecialchars($records8[$i][0]).'">
							<input type="hidden" name="delete" value="1">
							<input type="submit" value="delete" class="btn btn-link">
						</form>
					</td>
				</tr>';
			}
	}
	echo'</table>';
					
?>