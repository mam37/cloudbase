<?php
	if($firstvisit==1&&!isset($_POST["update"])){
		echo '   
			<h3>New Aircraft</h3>
			<i class="glyphicon glyphicon-asterisk" style="color:red">required</i>

			 <table class="table table-hover table-condensed">
				<tr>
					<th>Make / Model<i class="glyphicon glyphicon-asterisk" style="color:red"></i></th>
					<th>Serial #<i class="glyphicon glyphicon-asterisk" style="color:red"></i></th>
					<th>Name<i class="glyphicon glyphicon-asterisk" style="color:red"></i></th>
					<th>Owner</th>
					<th>Active</th>
					<th>Type<i class="glyphicon glyphicon-asterisk" style="color:red"></i></th>
				</tr>
				<tr>
					<td><input type="text" name="model"></td>
					<td><input type="text" name="serial"></td>
					<td><input type="text" name="name"></td>
					<td><input type="text" name="owner"></td>
					<td><input type="checkbox" name="active" value="1"></td>
					<td>
						<select name="type" id="type">
							<option value="select">--</option>
							<option value="glider">Glider</option>
							<option value="tow">Towplane</option>
						</select>
					</td>
				</tr>
			</table>
			<table class="table table-hover table-condensed type" id="glider">
				<tr>
					<th>Hour Cost<i class="glyphicon glyphicon-asterisk" style="color:red"></i></th>
					<th>Minute Cost<i class="glyphicon glyphicon-asterisk" style="color:red"></i></th>
					<th>Seats<i class="glyphicon glyphicon-asterisk" style="color:red"></i></th>
				</tr>
				<tr>
					<td><input type="text" name="hour"></td>
					<td><input type="text" name="minute"></td>
					<td><input type="text" name="seats"></td>
				</tr>
			</table>
			<table class="table table-hover table-condensed type" id="tow">
				<tr>
					<th>Employee Cost<i class="glyphicon glyphicon-asterisk" style="color:red"></i></th>
					<th>Customer Cost<i class="glyphicon glyphicon-asterisk" style="color:red"></i></th>
				</tr>
				<tr>
					<td><input type="text" name="emp"></td>
					<td><input type="text" name="cust"></td>
				</tr>
			</table>
			<script>
				$(function() {
					$(".type").hide();
					$("#type").change(function(){
						$(".type").hide();
						$("#" + $(this).val()).show();
					});
				});
			</script>
			';		
	}
	if(isset($_POST["update"])||$firstvisit==0){
		echo '
			<h3>Update Aircraft</h3>
			<i class="glyphicon glyphicon-asterisk" style="color:red">required</i>
			<input type="hidden" name="id" value="'.$_POST["id"].'">
			 <table class="table table-hover table-condensed">
				<tr>
					<th>Make / Model<i class="glyphicon glyphicon-asterisk" style="color:red"></i></th>
					<th>Serial #<i class="glyphicon glyphicon-asterisk" style="color:red"></i></th>
					<th>Name<i class="glyphicon glyphicon-asterisk" style="color:red"></i></th>
					<th>Owner</th>
					<th>Active</th>
					<th>Type<i class="glyphicon glyphicon-asterisk" style="color:red"></i></th>
				</tr>
				<tr>
					<td><input type="text" name="model" value="'.htmlspecialchars($row[1]).'"></td>
					<td><input type="text" name="serial" value="'.htmlspecialchars($row[6]).'"></td>
					<td><input type="text" name="name" value="'.htmlspecialchars($row[2]).'"></td>
					<td><input type="text" name="owner" value="'.htmlspecialchars($row[3]).'"></td>
					<td>';
						if($row[4]==1){
							echo'<input type="checkbox" name="active" value="1" checked>';
						}else{
							echo'<input type="checkbox" name="active" value="1">';
						}echo '
					</td>
					<td>
						<select name="type">';
							if($row[5]=="glider"){
								echo '	<option value="glider" selected="selected">Glider</option>';
							}else{
								echo '<option value="tow" selected="selected">Towplane</option>';
							}echo '						
						</select>
					</td>
				</tr>
			</table>';
			if($row2[0]!=""){
				echo'
				<table class="table table-hover table-condensed type" id="glider">
					<tr>
						<th>Hour Cost<i class="glyphicon glyphicon-asterisk" style="color:red"></i></th>
						<th>Minute Cost<i class="glyphicon glyphicon-asterisk" style="color:red"></i></th>
						<th>Seats<i class="glyphicon glyphicon-asterisk" style="color:red"></i></th>
					</tr>
					<tr>
						<td><input type="text" name="hour" value="'.htmlspecialchars($row2[1]).'"></td>
						<td><input type="text" name="minute" value="'.htmlspecialchars($row2[2]).'"></td>
						<td><input type="text" name="seats" value="'.htmlspecialchars($row2[3]).'"></td>
					</tr>
				</table>';
			}
			if($row3[0]!=""){
				echo'
				<table class="table table-hover table-condensed type" id="tow">
					<tr>
						<th>Employee Cost<i class="glyphicon glyphicon-asterisk" style="color:red"></i></th>
						<th>Customer Cost<i class="glyphicon glyphicon-asterisk" style="color:red"></i></th>
					</tr>
					<tr>
						<td><input type="text" name="emp" value="'.htmlspecialchars($row3[1]).'"></td>
						<td><input type="text" name="cust" value="'.htmlspecialchars($row3[2]).'"></td>
						</tr>
				</table>';
			
			}
	}
?>
