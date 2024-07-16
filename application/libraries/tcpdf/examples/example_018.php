<?php
//============================================================+
// File name   : example_018.php
// Begin       : 2008-03-06
// Last Update : 2013-05-14
//
// Description : Example 018 for TCPDF class
//               RTL document with Persian language
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
 * @abstract TCPDF - Example: RTL document with Persian language
 * @author Nicola Asuni
 * @since 2008-03-06
 * @group rtl
 * @group pdf
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Nicola Asuni');
$pdf->setTitle('TCPDF Example 018');
$pdf->setSubject('TCPDF Tutorial');
$pdf->setKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 018', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language dependent data:
$lg = Array();
$lg['a_meta_charset'] = 'UTF-8';
$lg['a_meta_dir'] = 'rtl';
$lg['a_meta_language'] = 'fa';
$lg['w_page'] = 'page';

// set some language-dependent strings (optional)
$pdf->setLanguageArray($lg);

// ---------------------------------------------------------

// set font
$pdf->setFont('dejavusans', '', 12);

// add a page
$pdf->AddPage();

// Persian and English content
//$htmlpersian = '<span color="#660000">Persian example:</span><br />سلام بالاخره مشکل PDF فارسی به طور کامل حل شد. اینم یک نمونش.<br />مشکل حرف \"ژ\" در بعضی کلمات مانند کلمه ویژه نیز بر طرف شد.<br />نگارش حروف لام و الف پشت سر هم نیز تصحیح شد.<br />با تشکر از  "Asuni Nicola" و محمد علی گل کار برای پشتیبانی زبان فارسی.';
//$pdf->WriteHTML($htmlpersian, true, 0, true, 0);

// set LTR direction for english translation
$pdf->setRTL(false);

$pdf->setFontSize(10);

// print newline
$pdf->Ln();


//add content (student list)
//title
 
$pdf->setFont('aefurat', '', 26);
$pdf->Cell(190,5,"لائحة التلاميذ",0,1,'C');
$pdf->setRTL(true);
$pdf->Ln();
// set font
$pdf->setFont('aefurat', '', 18);
//$pdf->SetFont('Helvetica','',10);
$pdf->Cell(30,5,"الأكاديمية                            الجماعة ",0);
$pdf->setFont('aefurat', '', 16);
$pdf->Cell(160,5,"acadymic",0);
 $pdf->Ln();
$pdf->Cell(30,5,"المديرية                                    المؤسسة ",0);
$pdf->setFont('aefurat', '', 16);
$pdf->Cell(160,5,"delegation",0);
$pdf->Ln();
$pdf->Cell(30,5,"القسم                                      المستوى ",0);
$pdf->Cell(160,5,"class",0);
$pdf->Ln();
$pdf->Ln(2);
 
// Persian and English content
//$htmlpersiantranslation = '<span color="#0000ff">Hi, At last Problem of Persian PDF Solved completely. This is a example for it.<br />Problem of "jeh" letter in some word like "ویژه" (=special) fix too.<br />The joining of laa and alf letter fix now.<br />Special thanks to "Nicola Asuni" and "Mohamad Ali Golkar" for Persian support.</span>';
//$pdf->WriteHTML($htmlpersiantranslation, true, 0, true, 0);





// Restore RTL direction
$pdf->setRTL(true);

// set font


// print newline
$pdf->Ln();
 
$pdf->setFont('aefurat', '', 13);
//make the table
$html = "
	<table>
		<tr>
			<th>رت</th>
			<th>الرمز</th>
			<th>الاسم الكامل</th>
			<th>النوع</th>
			<th>تاريخ الازدياد</th>
			<th>مكان الازدياد</th>
		</tr>
		";
//load the json data
$file = file_get_contents('MOCK_DATA-100.json');
$data = json_decode($file);

//loop the data
foreach($data as $student){	
	$html .= "
			<tr>
				<td>". $student->id ."</td>
				<td>". $student->first_name ."</td>
				<td>". $student->last_name ."</td>
				<td>". $student->email ."</td>
				<td>". $student->gender ."</td>
				<td>". $student->address ."</td>
			</tr>
			";
}		

$html .= "
	</table>
	<style>
	table {
		border-collapse:collapse;
	}
	th,td {
		border:1px solid #888;
	}
	table tr th {
		background-color:#888;
		color:#fff;
		font-weight:bold;
	}
	</style>
";
//WriteHTMLCell
$pdf->WriteHTMLCell(192,0,9,'',$html,0);
// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_018.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
