<?php include 'php/database_access.php'; ?>
<?php include 'php/authenticate.php'; ?>
<?php  //include 'php/reports_dyn.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<?php include 'meta_include.html'; ?>  
</head>

<body>

<?php include 'menu.php'; ?>		
<div class="container">
<h2>Flight Reports</h2>
<!--
<form id="date_filter" method="POST">
  <input type="text" id="date_start" name="date_start" />
  <input type="text" id="date_end" name="date_end" />
  <input class="btn btn-primary" type="submit">
</form>
<form id="date_filter" method="POST">
  <input type="text" id="date_start" name="date_start" />
  <input type="text" id="date_end" name="date_end" />
  <input class="btn btn-primary" type="submit">
</form>
-->

<form class="form-inline" id="date_filter">
  <div class="form-group">
    <label for="date_start">Start </label>
    <input type="text" class="form-control" id="date_start" name="date_start">
  </div>
  <div class="form-group">
    <label for="date_end">End </label>
    <input type="text" class="form-control" id="date_end" name="date_end">
  </div>
  <button type="submit" class="btn btn-primary">Filter Dates</button>
</form><br>

<table id="flightsheet" class="table table-hover table-condensed">
  <thead>
    <tr>
      <th>Date</th>
      <th>T/O</th>
      <th>Land</th>
      <th>Duration</th>
      <th>Aircraft</th>
      <th>Pilot</th>
      <th>Cost</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th>Date</th>
      <th>T/O</th>
      <th>Land</th>
      <th>Duration</th>
      <th>Aircraft</th>
      <th>Pilot</th>
      <th>Cost</th>
    </tr>
    </tfoot>

	

  
</table>

<form id="pdf" method="POST" action="php/reports_flightsheet_pdf.php" >
  <input class="btn btn-primary" type="submit" value="Generate PDF"
	 data-toggle="tooltip" data-placement="right" data-html="true" title="create pdf of records shown"
 />
  <input id="report" type="hidden" name="report" />
</form><br>


<script type="text/javascript">
  
  // initialize data table 
  $(document).ready(function() {
    var table = $('#flightsheet').DataTable( {
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
      "order": [[0, "desc"]], 
      "processing": true,
      "serverSide": true,
      "ajax": {
        "url": "php/reports_flightsheet.php",
        "type": "POST",
	"data":  function(req) {
	  req.date_start=$("#date_start").val(); 
	  req.date_end=$("#date_end").val(); 
        }
      }
    });
    // initialize calendar widget
    /*
    $( "#date_start" ).datepicker({
      dateFormat: "yy-mm-dd"
    });
    $( "#date_end" ).datepicker({
      dateFormat: "yy-mm-dd"
    });
*/
    $("#date_start").pickadate({
      format: "yyyy-mm-dd",
      formatSubmit: "yyyy-mm-dd"
    });
    $("#date_end").pickadate({
      format: "yyyy-mm-dd",
      formatSubmit: "yyyy-mm-dd"
    });

    // Event listener to the two range filtering inputs to redraw on input
    $("#date_filter").submit( function(event) {
      event.preventDefault();
      table.draw();
    });
    $("#pdf").submit( function() {
	    var htmlstring = ($("#flightsheet").find("tbody")).html();
	    $("#report").val(htmlstring);
            //console.log($("#report").val());
    });
  });
  
</script>
	

</div> <!-- end cotainer -->

 <?php include 'footer.html'; ?>
		
</body>
</html>
