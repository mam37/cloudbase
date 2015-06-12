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
		
				<h2>Flightsheets</h2>
					
					<form action="newsheet.php" method="post">
						<input type="hidden" name="new" value="1">
						<input class="btn btn-primary" type="submit" value="Create New Flightsheet">
					</form>
					<?php include 'php/flightsheets_update.php';?>
					<?php include 'php/flightsheets_get_records.php';?>
					<h2>Incomplete Flights</h2>
					<?php include 'php/flightsheets_create_table.php';?>
					<br>
					<h2>Flights with outstanding balance</h2>
					<?php include 'php/flightsheets_create_unpaid_table.php';?>
					<h2>Search Flights</h2>
					<?php include 'php/flightsheets_create_search_table.php';?>
			
			</div>
			<script>
				$(document).ready(function(){
					$("#from_date").pickadate({
						format: "yyyy-mm-dd",
						formatSubmit: "yyyy-mm-dd"
					});	
					$("#to_date").pickadate({
						format: "yyyy-mm-dd",
						formatSubmit: "yyyy-mm-dd"
					});
				});
			</script>

 <?php include 'footer.html'; ?>
</body>
</html>
