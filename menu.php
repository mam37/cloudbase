<!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" 
     aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <img src="images/logo.png" class="img-responsive" alt="Responsive image">
        </div>

        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="flightsheets.php">Flightsheets</a></li>
            <li><a href="reports.php">Reports</a></li>
            <li><a href="pilots.php">Pilots</a></li>
            <li><a href="aircraft.php">Aircraft</a></li>
            <li><a href="account.php">My Account</a></li>
          </ul>
 
          <ul class="nav navbar-nav navbar-right">
        <li><a href="account.php" class="hidden-sm hidden-xs" style="color: black; background: #FBFBFF">Welcome, 
	<?php echo $_SESSION["fname"] . " " . $_SESSION["lname"]; ?></a></li> 
	<li><a href="logout.php">Log out</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

<script type="text/javascript">
$(document).ready(function() {
    $('a[href="' + this.location.pathname.substring(location.pathname.lastIndexOf('/')+1) + '"]').parent().prop('id', 'active');
});

</script>
<!-- End of navbar -->
        
