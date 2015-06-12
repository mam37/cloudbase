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
			
					<?php include 'php/newpilot_message.php';?>
					<?php include 'php/newpilot_update.php';?>
					<?php include 'php/newpilot_get_pilot.php';?>
				
					<form action="newpilot.php" method="post">
						<?php include 'php/newpilot_create_table.php';?>
						<input class="btn btn-primary" type="submit" value="Submit">
					</form>
				
			</div>
<?php include 'footer.html'; ?>	
</body>
</html>
