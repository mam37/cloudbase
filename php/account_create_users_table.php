<?php
	if($_SESSION["admin"]==1){
		echo '<h2>Admin Control</h2>
			<table class="table table-hover table-condensed" >
				<tr>
					<th>First</th>
					<th>Last</th>
					<th>Password</th>
					<th>Admin?</th>
					<th>Action</th>
					<th>Action</th>
				</tr>';
		while($row = mysqli_fetch_array($result,MYSQLI_BOTH)){
			if($row[4]==1&&$row[5]!=$_SESSION["username"]){
				echo '<tr>
							<form action="account.php" method="post">
								<input type="hidden" name="id" value="'.htmlspecialchars($row[0]).'">
								<td>'.htmlspecialchars($row[1]).'</td>
								<td>'.htmlspecialchars($row[2]).'</td>
								<td><input class="form-control" type="text" name="update_pass"></td>'; 
								if($row[3]==1){
									echo'<td><input type="checkbox" name="update_admin" value="1" checked></td>';
								}else{
									echo'<td><input type="checkbox" name="update_admin" value="1"></td>';
								}
								echo'
								<td><input type="submit" value="update" class="btn btn-link"></td>
							</form>
							<form action="account.php" method="post">
								<input type="hidden" name="id" value="'.htmlspecialchars($row[0]).'">
								<input type="hidden" name="delete" value="1">
								<td><input type="submit" value="delete" class="btn btn-link"></td>
							</form>
					</tr>';
			}
		}
		echo'</table>';
	}
?>
