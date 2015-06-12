<?php include 'php/database_access.php'; ?>
<?php include 'php/authenticate.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
<?php include 'meta_include.html'; ?>

</head>
<body>
<?php include 'menu.php'; ?>	
				
			<div class="container">
			
					<form action="newsheet.php" method="post">
						<?php include 'php/newsheet_message.php'; ?>
						<?php include 'php/newsheet_update.php'; ?>
						<?php include 'php/newsheet_get_pilots.php'; ?>
						<?php include 'php/newsheet_get_planes.php'; ?>
						<?php include 'php/newsheet_get_payments.php';?>
						<?php include 'php/newsheet_create_table.php'; ?>
						<input class="hideme soar pr rb at btn btn-primary" type="submit" value="Submit">
					</form>
					<h3>Payments</h3>
					<?php include 'php/newsheet_create_payment_table.php'; ?>
					<form action="payment.php" method="post">
						<input type="hidden" name="new" value="1">
						<input type="hidden" name="svcid" value="<?php echo $_POST["id"];?>">
						<input class="btn btn-primary" type="submit" value="New Payment">
					</form><br>
				
			</div>
		

		<script>
			$(document).ready(function(){
				/*
				$("#takeoff").timepicki({
					show_meridian: false,
					min_hour_value:0,
					max_hour_value:23,
					overflow_minutes:true,
					increase_direction:"up",
					reset: true
				});
				$("#towlanding").timepicki({
					show_meridian: false,
					min_hour_value:0,
					max_hour_value:23,
					overflow_minutes:true,
					increase_direction:"up",
					disable_keyboard_mobile: true
				});
				$("#gliderlanding").timepicki({
					show_meridian: false,
					min_hour_value:0,
					max_hour_value:23,
					overflow_minutes:true,
					increase_direction:"up",
					disable_keyboard_mobile: true
				});
				*/
				$("#date").pickadate({
					format: "yyyy-mm-dd",
					formatSubmit: "yyyy-mm-dd"
				});	
			});
		</script>
<?php include 'footer.html'; ?>
</body>
</html>
