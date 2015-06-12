<?php
if($_POST["payid"]==""){	
	echo'
		<table class="table table-hover table-condensed input_table">
			<tr>
				<th class="text-right col-md-3">Date:<i class="glyphicon glyphicon-asterisk" style="color:red"></i></th>
				<td><input class="form-control" type="text" id="date" name="date"></td>
			</tr>
			<tr>
				<th class="text-right col-md-3">Payment Type:<i class="glyphicon glyphicon-asterisk" style="color:red"></i></th>
				<td>
					<select  class="form-control" name="method">
						<option value="">--</option>
						<option value="cash">Cash</option>
						<option value="check">Check</option>
						<option value="card">Card</option>
					</select>
				</td>
			</tr>
			<tr>
				<th class="text-right col-md-3">Amount:<i class="glyphicon glyphicon-asterisk" style="color:red"></i></th>
				<td><input class="form-control" type="text" name="amount"></td>
			</tr>		
		</table>
		<input type="hidden" name="svcid" value="'.htmlspecialchars($_POST["svcid"]).'">';
}else{
	echo'
		<table class="table table-hover table-condensed">
			<tr>
				<th class="text-right col-md-3">Date:<i class="glyphicon glyphicon-asterisk" style="color:red"></i></th>
				<td><input class="form-control" type="date" name="date" id="date" value="'.htmlspecialchars($row[1]).'"></td>
			</tr>
			<tr>
				<th class="text-right col-md-3">Payment Type:<i class="glyphicon glyphicon-asterisk" style="color:red"></i></th>
				<td>';
				if($row[2]=="cash"){
					echo'
					<select class="form-control" name="method">
						<option value="cash" selected>Cash</option>
						<option value="check">Check</option>
						<option value="card">Card</option>
					</select>';
				}else if($row[2]=="check"){
					echo'
					<select class="form-control" name="method">
						<option value="cash">Cash</option>
						<option value="check" selected>Check</option>
						<option value="card">Card</option>
					</select>';
				}else if($row[2]=="card"){
					echo'
					<select class="form-control" name="method">
						<option value="cash">Cash</option>
						<option value="check">Check</option>
						<option value="card" selected>Card</option>
					</select>';
				}
				echo'
				</td>
			</tr>
			<tr>
				<th class="text-right col-md-3">Amount:<i class="glyphicon glyphicon-asterisk" style="color:red"></i></th>
				<td><input class="form-control" type="text" name="amount"  value="'.htmlspecialchars($row[3]).'"></td>
			</tr>		
		</table>
		<input type="hidden" name="payid" value="'.htmlspecialchars($_POST["payid"]).'">
		<input type="hidden" name="svcid" value="'.htmlspecialchars($_POST["svcid"]).'">';
	
}
?>
