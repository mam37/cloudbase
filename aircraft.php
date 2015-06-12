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
		<h2>Aircraft Information</h2>
			<form action="newaircraft.php" method="post">
				<input type="hidden" name="new" value="1">
				<input class="btn btn-primary" type="submit" value="Add New Aircraft">
			</form><br>
			<?php include 'php/aircraft_update.php'; ?>
			<?php include 'php/aircraft_get_aircraft.php'; ?>
			<?php include 'php/aircraft_create_aircraft_table.php'; ?>	
	</div>
	<?php include 'footer.html'; ?>
</body>
</html>
