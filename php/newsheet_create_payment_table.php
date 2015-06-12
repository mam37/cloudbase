<?php
	if(count($payments)>0){
		echo'	
		 <table class="table table-hover table-condensed">
			<tr>
				<th>Pmnt ID</th>
				<th>Date</th>
				<th>Type</th>
				<th>Amount</th>
				<th>Action</th>
				<th>Action</th>
			</tr>';
	}
	for($i=0;$i<count($payments);$i++){	
		echo'
		<tr>
			<td>'.htmlspecialchars($payments[$i][0]).'</td>
			<td>'.htmlspecialchars($payments[$i][1]).'</td>
			<td>'.htmlspecialchars($payments[$i][2]).'</td>
			<td>$'.htmlspecialchars($payments[$i][3]).'</td>
			<td>
				<form action="payment.php" method="post">
					<input type="hidden" name="svcid" value="'.htmlspecialchars($_POST["id"]).'">
					<input type="hidden" name="update" value="1">
					<input type="hidden" name="payid" value="'.htmlspecialchars($payments[$i][0]).'">
					<input type="submit" class="btn btn-link" value="update">
					<input type="hidden" name="id" value="'.htmlspecialchars($_POST["id"]).'">
				</form>
			</td>
			<td>
				<form action="payment.php" method="post">
					<input type="hidden" name="payid" value="'.htmlspecialchars($payments[$i][0]).'">
					<input type="hidden" name="delete" value="1">
					<input type="hidden" name="id" value="'.htmlspecialchars($_POST["id"]).'">
					<input type="submit" class="btn btn-link" value="delete">
				</form>
			</td>
		</tr>';
	}
	echo'
	</table>
	<input type="hidden" name="svcid" value="'.htmlspecialchars($_POST["id"]).'">';	
?>
