<?php
ob_clean();
//============================================================+
// File name   : example_006.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 006 for TCPDF class
//               WriteHTML and RTL support
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML and RTL support
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
$this->load->library('Pdf');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Print PDF');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE. '', PDF_HEADER_STRING, '', '');
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'1.png';
        $this->Image($image_file, 10, 10, 15, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
        $this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }
}
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
$pdf->SetFont('times', '', 11);

// add a page
$pdf->AddPage('P', 'A4');

$pdf->writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='');
$pdf->writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);

// create some HTML content
$title = <<<EOD
EOD;
$pdf->WriteHTMLCell(0, 0, '', '', $title, 0, 1, 0, true, 'C', true); 
	 
		$table = '<table style="1px solid black; padding: 10px;">';
		$table .= '
		<h1>Activity Log Report</h1>
		<br>
		<br>';
		if(isset($from_date, $to_date))
		{
			echo 
			'
				<p>Sorted from '.$from_date.' to '.$to_date.'</p>
			';
		}
		else
		{
			// nothing.
		}
		$table .='
		<table style="border: 1px solid black; padding: 10px">
			<thead>
				<tr>
					<td>Log ID</td>
					<td>Employee ID</td>
					<td>Employee Name</td>			
					<td>Account Type</td>
					<td>Activity</td>
					<td>Activity ID</td>
					<td>Date</td>
					<td>Time</td>
				</tr>
			</thead>
			<tbody>';
		foreach ($ac_records as $acr) 
		{
			$table .= 
			'
				<tr>
					<td>'.$acr->log_id.'</td>
					<td>'.$acr->employee_id.'</td>
					<td>'.$acr->employee_name.'</td>
					<td>'.$acr->account_type.'</td>
					<td>'.$acr->activity.'</td>
					<td>'.$acr->activity_id.'</td>
					<td>'.$acr->date.'</td>
					<td>'.$acr->time.'</td>
				</tr>
			';
		}
		$table .= '
			</tbody>
		';
		$table .= '</table>';
// output the HTML content
$pdf->WriteHTMLCell(0, 0, '', '', $table, 0, 1, 0, true, 'C', true);
// $pdf->writeHTML($html, true, false, true, false, '');
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
ob_end_clean();
$pdf->Output('example_006.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
