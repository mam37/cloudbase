<?php
	if($firstvisit==1&&!isset($_POST["update"])){
		echo '   <h3>Add New Pilot</h3>
			<i class="glyphicon glyphicon-asterisk" style="color:red">required</i>

			 <table class="table table-hover table-condensed">
				<tr>
					<th>Firstname<i class="glyphicon glyphicon-asterisk" style="color:red"></i></th>
					<th>Middlename</th>
					<th>Lastname<i class="glyphicon glyphicon-asterisk" style="color:red"></i></th>
					<th>Glider Pilot</th>
					<th>Instructor</th>
					<th>Tow Pilot</th>
					<th>Operations Director</th>
				</tr>
				<tr>
					<td><input type="text" name="fname"></td>
					<td><input type="text" name="mname"></td>
					<td><input type="text" name="lname"></td>
					<td><input type="checkbox" name="glide" value="1"></td>
					<td><input type="checkbox" name="instructor" value="1"></td>
					<td><input type="checkbox" name="tow" value="1"></td>
					<td><input type="checkbox" name="od" value="1"></td>
				</tr>
			</table>';
		echo '</tr></table>';
	}
	if(isset($_POST["update"])||$firstvisit==0&&$fail==0){
		echo '  <h3>Update Pilot Information</h3>
			<i class="glyphicon glyphicon-asterisk" style="color:red">required</i>
			<table class="table table-hover table-condensed">
				<tr>
					<th>Firstname<i class="glyphicon glyphicon-asterisk" style="color:red"></i></th>
					<th>Middlename</th>
					<th>Lastname<i class="glyphicon glyphicon-asterisk" style="color:red"></i></th>
					<th>Glider Pilot</th>
					<th>Instructor</th>
					<th>Tow Pilot</th>
					<th>Operations Director</th>
				</tr>
				<tr>
					<td><input type="text" name="fname" value="'.htmlspecialchars($row[1]).'"></td>
					<td><input type="text" name="mname" value="'.htmlspecialchars($row[2]).'"></td>
					<td><input type="text" name="lname" value="'.htmlspecialchars($row[3]).'"></td>';
					while($row2 = mysqli_fetch_array($result2, MYSQL_BOTH)){
						if($row2[1]==1){
							echo'<td><input type="checkbox" name="'.htmlspecialchars($row2[0]).'" value="1" checked></td>';
						}else{
							echo'<td><input type="checkbox" name="'.htmlspecialchars($row2[0]).'" value="1"></td>';
						}
					}
		echo '</tr></table><input type="hidden" name="id" value="'.htmlspecialchars($_POST["id"]).'">';
	}
?>
