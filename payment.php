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
			<h3>Payment</h3>	
				
					<form action="payment.php" method="post">
						<?php include 'php/payment_message.php';?>
						<?php include 'php/payment_update.php';?>
						<?php include 'php/payment_get_payment.php';?>
						<i class="glyphicon glyphicon-asterisk" style="color:red">required</i>
						<?php include 'php/payment_create_table.php';?>
						<input type="submit" class="btn btn-primary" value="Create Payment">
					</form>
				
				<script>
					$(document).ready(function(){
						$("#date").pickadate({
								dateFormat: 'yyyy-mm-dd',
								formatSubmit: 'yyyy-mm-dd'

						});	
					});
				</script>
			</div>
<?php include 'footer.html'; ?>		
</body>
</html>
