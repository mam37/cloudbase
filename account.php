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
				
				
					<h2>Account Information</h2>
					<form action="account.php" method="post">
						<?php include 'php/account_update_message.php'; ?>
						<?php include 'php/account_update.php'; ?>
						<?php include 'php/account_get_user_info.php'; ?>
						
						<i class="glyphicon glyphicon-asterisk" style="color:red">required</i>
						 <table class="table table-condensed input_table" >
							<tr >
								<th class="text-right col-md-3">Firstname:<i class="glyphicon glyphicon-asterisk" style="color:red"></i></th>
								<td ><input class="form-control" type="text" name="fname" value="<?php echo $row[0];?>"></td>
							</tr>
							<tr>
								<th class="text-right col-md-3">Middlename:</th>
								<td><input  class="form-control" type="text" name="mname" value="<?php echo $row[1];?>"></td>
							</tr>
							<tr>
								<th class="text-right col-md-3">Lastname:<i class="glyphicon glyphicon-asterisk" style="color:red"></i></th>
								<td><input class="form-control" type="text" name="lname" value="<?php echo $row[2];?>"></td>
							</tr>
							<tr>
								<th class="text-right col-md-3">Email:<i class="glyphicon glyphicon-asterisk" style="color:red"></i></th>
								<td><input  class="form-control"type="text" name="email" value="<?php echo $row[3];?>"></td>
							</tr>
							<tr>
								<th class="text-right col-md-3">Username:<i class="glyphicon glyphicon-asterisk" style="color:red"></i></th>
							<td><input  class="form-control" type="text" name="uname" value="<?php echo $_SESSION["username"];?>"></td>
							</tr>
							<tr>
								<th class="text-right col-md-3">Password:</th>
								<td><input class="form-control" type="password" name="pass1" autocomplete="off"></td>
							</tr>
							<tr>
								<th class="text-right col-md-3">Confirm Password:</th>
								<td><input class="form-control" type="password" name="pass2"></td>
							</tr>
							<tr>	<td><input class="btn btn-primary" type="submit" value="Update"></td>
								<td></td>
						
							</tr>
						</table>
						
					</form>
						
			<?php if($_SESSION["admin"]==1){echo "<a id=\"clickme\">Create New User Account</a>";}?>
					<form action="account.php" method="post">
						
						 <table class="table table-hover table-condensed input_table" id="new_user" >
							<tr>
								<th class="text-right col-md-3">Firstname:<i class="glyphicon glyphicon-asterisk" style="color:red"></i></th>
								<td><input class="form-control" type="text" name="new_fname"></td>
							</tr>
							<tr>
								<th class="text-right col-md-3">Middlename:</th>
								<td><input class ="form-control" type="text" name="new_mname"></td>
							</tr>
							<tr>
								<th class="text-right col-md-3">Lastname:<i class="glyphicon glyphicon-asterisk" style="color:red"></i></th>
								<td><input class= "form-control" type="text" name="new_lname"></td>
							</tr>
							<tr>
								<th class="text-right col-md-3">Email:<i class="glyphicon glyphicon-asterisk" style="color:red"></i></th>
								<td><input class="form-control" type="text" name="new_email"></td>
							</tr>
							<tr>
								<th class="text-right col-md-3">Username:<i class="glyphicon glyphicon-asterisk" style="color:red"></i></th>
								<td><input class="form-control" type="text" name="new_uname"></td>
							</tr>
							<tr>
								<th class="text-right col-md-3">Password:<i class="glyphicon glyphicon-asterisk" style="color:red"></i></th>
								<td><input class="form-control" type="password" name="new_pass1" autocomplete="off"></td>
							</tr>
							<tr>
								<th class="text-right col-md-3">Confirm Password:<i class="glyphicon glyphicon-asterisk 								"style="color:red"></i></th>
								<td><input class="form-control" type="password" name="new_pass2"></td>
							</tr>
							<tr>
								<th class="text-right col-md-3">Admin?:</th>
								<td><input type="checkbox" name="new_admin" value="1"></td>
							</tr>
							<tr>		
								<td><input class="btn btn-primary" type="submit" value="Submit"></td>
								<td></td>	
							</tr>
						</table>
						<script type="text/javascript">
							$(document).ready( function() {
								//$("input").addClass("form-control");
								//$("th").addClass("col-md-2");
								$("#clickme").click( function() {
									$("#new_user").toggle();
								});
								$("#new_user").hide();
								
							});
						</script>
					</form>
					<?php include 'php/account_get_user_list.php'; ?>
					<?php include 'php/account_create_users_table.php'; ?>
			
			</div>

<div>

 <?php include 'footer.html'; ?>
</div>	
</body>
</html>
