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
			<h2>Pilot Information</h2>
				
					<form action="newpilot.php" method="post">
						<input type="hidden" name="new" value="1">
						<input class="btn btn-primary" type="submit" value="Add New Pilot">
					</form><br>
					<?php include 'php/pilot_delete.php'; ?>
					<?php include 'php/pilot_get_pilots.php'; ?>
					<?php include 'php/pilot_create_pilots_table.php'; ?>
				
		
			</div>
<?php include 'footer.html'; ?>

</body>
</html>
