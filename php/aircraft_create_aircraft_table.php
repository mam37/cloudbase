<?php
	echo ' <table class="table table-hover table-condensed">
			<tr>
				<th>Model</th>
				<th>Serial #</th>
				<th>Name</th>
				<th>Type</th>
				<th>Action</th>
				<th>Action</th>
			</tr>';
	while($row = mysqli_fetch_array($result,MYSQLI_BOTH)){
		echo '<tr>
					<form action="newaircraft.php" method="post">
						<input type="hidden" name="id" value="'.htmlspecialchars($row[0]).'">
						<td>'.htmlspecialchars($row[1]).'</td>
						<td>'.htmlspecialchars($row[4]).'</td>
						<td>'.htmlspecialchars($row[2]).'</td>
						<td>'.htmlspecialchars($row[3]).'</td>'; 
						echo'
						<input type="hidden" name="update" value="1">
						<td><input type="submit" value="update" class="btn btn-link"></td>
					</form>
					<form action="aircraft.php" method="post">
						<input type="hidden" name="id" value="'.htmlspecialchars($row[0]).'">
						<input type="hidden" name="delete" value="1">
						<td><input type="submit" value="delete" class="btn btn-link"></td>
					</form>
			</tr>';
	}
	echo '</table>';
?>
