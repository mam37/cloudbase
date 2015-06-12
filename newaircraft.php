<?php include 'php/database_access.php'; ?>
<?php include 'php/authenticate.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
<?php include 'meta_include.html' ?>

  </head>

 <body>

   <?php include 'menu.php'; ?>
			 <div class="container">
				
					<?php include 'php/newaircraft_message.php';?>
					<?php include 'php/newaircraft_update.php';?>
					<?php include 'php/newaircraft_get_aircraft.php';?>
					<form action="newaircraft.php" method="post">
						<?php include 'php/newaircraft_create_table.php';?>
						<input class="btn btn-primary" type="submit" value="Submit">
					</form><br>
				
			</div>
<?php include 'footer.html'; ?>	
</body>
</html>
