<?php
require ('fpdf17/curri.php');

$pdf = new FPDF('P','mm','A4');

$pdf ->AddPage();
$pdf->SetFont('Arial','B','14');

//cell(width,height,text,border,end line,[align])
$pdf ->Cell(130 ,5,'Name',0,0);
$pdf ->Cell(59 ,5,'Student No.',0,1); //end of line

//set font to arial, regular, 12pt
$pdf ->SetFont('Arial','','12');

$pdf ->Cell(130 ,5,'[Street Address]',0,0);
$pdf ->Cell(59 ,5,'',0,1); //end of line


$pdf ->Output();
?>