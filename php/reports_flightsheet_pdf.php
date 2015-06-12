<?php
/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML and RTL support
 */

// Include the main TCPDF library 
require_once('tcpdf.php');

// get sql data
/*
require_once('database_access.php');
$link = open();
$pdf_start = mysqli_real_escape_string($link, $_POST["pdf_start"]);
$pdf_end = mysqli_real_escape_string($link, $_POST["pdf_end"]);

if ($pdf_start && $pdf_end) {
    $query = "select * from view_flightsheets where svc_date between \"$pdf_start\" and \"$pdf_end\" ";
    $query .= "order by svc_date desc;";
} else {
    $query = "select * from view_flightsheets order by svc_date desc;";
}
$result = mysqli_query($link, $query);

$flights = "";
while ($row = $result->fetch_assoc()) {
    $flights .= "<tr>";
    $flights .= "<td>" . $row["svc_date"] . "</td>";
    $flights .= "<td>" . $row["flight_takeoff"] . "</td>";
    $flights .= "<td>" . $row["flight_landing"] . "</td>";
    $flights .= "<td>" . $row["duration"] . "</td>";
    $flights .= "<td>" . $row["plane_serial"] . "</td>";
    $flights .= "<td>" . $row["pilot"] . "</td>";
    $flights .= "<td>" . $row["instructor"] . "</td>";
    $flights .= "<td>" . $row["svc_cost"] . "</td>";
    $flights .= "</tr>";
}
close($link);
*/
// end get sql data

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Cloudbase');
$pdf->SetTitle('M-ASA Flight Sheet');
$pdf->SetSubject('M-ASA Flight Sheet');
$pdf->SetKeywords('');

// set default header data
// the program by default searches for a path relative to the installation
// directory, hence the inefficient file path
$logo = "../images/MASA-logo.svg";
$logo_width = 20; // mm

$heading_title = "Flight Sheet";
$pdf->SetHeaderData($logo, $logo_width, $heading_title, 
  "\tMid-Atlantic Soaring Association\nFrederick, Maryland");

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 8);

// add a page
$pdf->AddPage();

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// create some HTML content
$html = "<table style=\"font-weight: bold\">";
$hmtl .= "<tr>";
$html .= "<th>Date</th>";
$html .= "<th>T/O</th>";
$html .= "<th>Land</th>";
$html .= "<th>Duration</th>";
$html .= "<th>Aircraft</th>";
$html .= "<th>Pilot</th>";
$html .= "<th>Cost</th>";
$hmtl .= "</tr>";
$html .= "</table>";
$pdf->writeHTML($html, true, false, false, false, '');

$html = "<table>" . $_POST["report"] . "</table>";
$pdf->writeHTML($html, true, false, false, false, '');


//$pdf->writeHTML("</table>", true, false, false, false, '');

$html =" <hr />";
$html .="<p>End of Flight Sheet Report</p>";
// output the HTML content
$pdf->writeHTML($html, true, false, false, false, '');

// reset pointer to the last page
//$pdf->lastPage();

//Close and output PDF document
$pdf->Output('flightsheet.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
