<?php
 
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
 
// DB table to use
$table = 'view_flightsheets';
 
// Table's primary key
$primaryKey = 'svc_date';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'svc_date', 'dt' => 0 ),
    array( 'db' => 'flight_takeoff',  'dt' => 1 ),
    array( 'db' => 'flight_landing',  'dt' => 2 ),
    array( 'db' => 'duration',  'dt' => 3 ),
    array( 'db' => 'plane_serial',  'dt' => 4 ),
    array( 'db' => 'pilot',  'dt' => 5 ),
    array( 'db' => 'svc_cost',  'dt' => 6 )
);
 
// SQL server connection information
require('sql_details.php');
require('database_access.php');

// get and filter dates
$link = open();
$date_start = mysqli_real_escape_string($link, $_POST["date_start"]);
$date_end = mysqli_real_escape_string($link, $_POST["date_end"]);
close($link);

// set where parmeter in mysql search for date filtering
if($date_start && $date_end) {
    $where = "svc_date between \"$date_start\" and \"$date_end\"";
    $isFilter = true;
} else {
    $isFilter = false;
}
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( 'ssp.class.php' );

if($isFilter) {
    echo json_encode(
    //SSP::simple( $_POST, $sql_details, $table, $primaryKey, $columns )
        SSP::complex( $_POST, $sql_details, $table, $primaryKey, $columns, null, $where)
    );
} else {
    echo json_encode(
        SSP::simple( $_POST, $sql_details, $table, $primaryKey, $columns )
    );
}    
