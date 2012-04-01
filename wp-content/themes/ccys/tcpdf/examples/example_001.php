<?php
//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2010-08-14
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               Manor Coach House, Church Hill
//               Aldershot, Hants, GU12 4RQ
//               UK
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

require_once('../config/lang/eng.php');
require_once('../tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 001');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Disable header and footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('times', '', 9.8, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

$ch_last_name = "Craciunoiu";
$ch_first_name = "Marius";
$ch_middle_name = "Mike";

$con_street = "12321 Balonga";
$con_city = "San Jo";
$con_state = "CA";
$con_zip = "94123";
$con_phone = "213-4123-213";

$ch_birthday = "Craciunoiu";
$ch_birthmonth = "Marius";
$ch_birthyear = "Mike";

// Gender
$ch_gender = 'male';
$gender_male = '';
$gender_female = '';

if ($ch_gender == 'male') {
	$gender_male = "X";
} elseif ($ch_gender == 'female') {
	$gender_female = "X";
};

// Sport
$ch_sport = "football";
$sport_football = "";
$sport_cheer = "";
$sport_dance = "";

if ($ch_sport == "football") {
	$sport_football = "X";
} elseif ($ch_sport == "cheer") {
	$sport_cheer = "X";
} else {
	$sport_dance = "X";
}

// School
$s_school = "Homestead";
$s_grade = "5th grade";
$s_gpa = "4.0";

// Parent Info
$con_guardian = "Desi Romero";
$con_relationship = "Father";
$email = "marius@usa.com";

// Emergency Info
$er_name = "Karnisha Garner";
$er_relationship = "Sistah";
$er_phone = "123-123-2131";
$er_cellphone = "497-123-7651";



// Set some content to print
$html = '
	<style>
		.red {
			color: #ff0000;
		}
		.underline {
			text-decoration: underline;
		}
	</style>
	<h1>Pop Warner Little Scholars, Inc.</h1>
	<p style="font-weight: bold;">2012 PARTICIPANT CONTRACT AND PARENTAL CONSENT FORM</p>
	<u>Special Note</u>: <span class="red">This form must be dated after January 1, 2012 and is <u>APPLICABLE ONLY FOR THE 2012 SEASON.</u></span>
	<p>This form must be submitted to your LOCAL organization prior to the athlete participating in Pop Warner.  No other forms are acceptable.<br />  
	Every Pop Warner Association must have a fully completed and signed original of this form prior to allowing the athlete to participate.</p>

	<!-- Begin Form -->

	<p>Legal Name of Participant (must match birth certificate</p>
	<p>Last <span class="underline"> &nbsp;&nbsp;&nbsp; ' . $ch_last_name . ' &nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp; First <span class="underline"> &nbsp;&nbsp;&nbsp; ' . $ch_first_name . ' &nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp; Middle <span class="underline"> &nbsp;&nbsp;&nbsp; ' . $ch_middle_name . ' &nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp; Also known as____________________</p>

	<!-- Address -->

	<p>Address <span class="underline"> &nbsp;&nbsp;&nbsp; ' . $con_street . ' &nbsp;&nbsp;&nbsp; </span></p>
	<p>City <span class="underline">  &nbsp;&nbsp;&nbsp; ' . $con_city . ' &nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp; 
	State <span class="underline">  &nbsp;&nbsp;&nbsp; ' . $con_state . ' &nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp; 
	Zip <span class="underline">  &nbsp;&nbsp;&nbsp; ' . $con_city . ' &nbsp;&nbsp;&nbsp; </span></p>
	
	<!-- Phone, Birthday, Gender -->
	
	<p>Phone No <span class="underline">  &nbsp;&nbsp;&nbsp; ' . $con_phone . ' &nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp; 
	Birthdate <span class="underline">  &nbsp;&nbsp;&nbsp; ' . $ch_birthday . ' ' . $ch_birthmonth . ' ' . $ch_birthyear . ' &nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp; 
	Gender <span class="underline">  &nbsp;&nbsp;&nbsp; ' . $gender_male . ' &nbsp;&nbsp;&nbsp; </span> Male &nbsp;&nbsp;&nbsp; <span class="underline">  &nbsp;&nbsp;&nbsp; ' . $gender_female . ' &nbsp;&nbsp;&nbsp; </span>Female</p>
	
	<!-- Sport -->
	
	<p>Gender  &nbsp;&nbsp;&nbsp; <span class="underline">  &nbsp;&nbsp;&nbsp; ' . $sport_football . ' &nbsp;&nbsp;&nbsp; </span> Football &nbsp;&nbsp;&nbsp; <span class="underline">  &nbsp;&nbsp;&nbsp; ' . $sport_cheer . ' &nbsp;&nbsp;&nbsp; </span>Cheer &nbsp;&nbsp;&nbsp; <span class="underline">  &nbsp;&nbsp;&nbsp; ' . $sport_dance . ' &nbsp;&nbsp;&nbsp; </span>Dance</p>
	
	<!-- School -->
	
	<p>School <span class="underline"> &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp; ' . $s_school . ' &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp; </span>
	  Grade Level <span class="underline">  &nbsp;&nbsp;&nbsp; ' . $s_grade . ' &nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp;</p>
	<span>Grade Point Average <span class="underline">  &nbsp;&nbsp;&nbsp; ' . $s_gpa . ' &nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp; 
	Alternative Form Participant <span class="underline">  &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; </span></span><br/>
	<span>(must meet Scholastic Fitness Requirement of 2.0/70% or else fill out the Scholastic Eligibility Form or Home School Eligibility Form).</span>
	
	<!-- Parent Info -->
	
	<p>Mailing Address if different from above: _____________________________________________________________________________</p>
	<p>Name of Parent/Guardian <span class="underline"> &nbsp;&nbsp;&nbsp;' . $con_guardian . ' &nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp; 
	  Relationship to Athlete <span class="underline">  &nbsp;&nbsp;&nbsp; ' . $con_relationship . ' &nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp;</p>
	<p>Address (if different from above): __________________________________________________________________________________</p>
	<p>
	City_____________________________________________ State _________________ Zip ____________________________________</p>
	<p>Telephone No <span class="underline"> &nbsp;&nbsp;&nbsp;' . $con_phone . '&nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;  
	  Email Address <span class="underline">  &nbsp;&nbsp;&nbsp; ' . $email . ' &nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp;</p>

	<!-- Emergency Contact -->
	
	<span>Emergency Contact Information (if the parent/guardian can not be reached):</span><br />
	<span>Name<span class="underline"> &nbsp;&nbsp;&nbsp;' . $er_name . ' &nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp; 
	  Relationship to Athlete <span class="underline">  &nbsp;&nbsp;&nbsp; ' . $er_relationship . ' &nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp;</span><br />
    <span>Home Telephone No <span class="underline"> &nbsp;&nbsp;&nbsp;' . $er_phone . ' &nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp; 
      Cell or Work No <span class="underline">  &nbsp;&nbsp;&nbsp; ' . $er_cellphone . ' &nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp;</span><br /><br />
      
    <!-- PPWLS Office Use -->
    <table style="border: 1px solid #000;" width="2050" cellspacing="0" cellpadding="0">
    <tr>
        <td width="6">&nbsp;</td>
        <td>&nbsp;</td>
        <td width="6">&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><span class="underline"><strong>Pop Warner Official Use Only</strong></span><br />
            <span>Registration Number: _______________________ &nbsp;&nbsp;&nbsp; 
              Witnessed By: <span class="underline">  &nbsp;&nbsp;&nbsp; ' . $er_relationship . ' &nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp;</span><br /><br />
            <span class="underline">Participant Fees</span><br />
            <span>Amount Paid $______________</span>
            <p>Type of Transaction: ______ Cash &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;
            	______ Check &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp; ______ Credit Card &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp; ______ Other (please explain)</p>
            <p>Proof of age verified?  &nbsp;&nbsp;&nbsp; Yes  &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;  No</p>
            <p>Birth Certificate &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp; Other (please explain)</p>
            <p>Division of Play (circle one): &nbsp; Flag &nbsp; / &nbsp; Tiny Mite &nbsp; / &nbsp; Mitey Mite &nbsp; / &nbsp; Jr. Pee Wee &nbsp; / &nbsp; Pee Wee &nbsp; / &nbsp; Jr .Midget &nbsp; / &nbsp; Midget &nbsp; / &nbsp; U/L</p>
            <p>Weight at Time of Registration  (Football Only): ___________</p>
            <p>Proof of Scholastic Fitness verified? &nbsp;&nbsp;&nbsp; Yes &nbsp;&nbsp;&nbsp; No</p>
        </td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td width="6">&nbsp;</td>
        <td>&nbsp;</td>
        <td width="6">&nbsp;</td>
    </tr>
    </table>
  ';

// &nbsp;&nbsp;&nbsp; 

// Print text using writeHTMLCell()
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
