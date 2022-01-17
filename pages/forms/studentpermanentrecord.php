<?php

require ('../fpdf/fpdf.php');
include '../../includes/db.php';
// $server = 'localhost';
//     $username = 'root';
//     $password = '';
//     $dbase = 'enrollment';

//     $db = new mysqli($server, $username, $password, $dbase);

    date_default_timezone_set('Asia/Manila');

//   include '../../includes/session.php';  
// if ($_SESSION['userid'] != $_GET['stud_id']) {
//   header("location: ../404/404.php");
// }

$query = mysqli_query($db,"SELECT *,CONCAT(tbl_students.lastname, ' ', tbl_students.firstname, ' ', tbl_students.middlename)  as fullname FROM tbl_schoolyears
    LEFT JOIN tbl_students ON tbl_students.stud_id = tbl_schoolyears.stud_id
    LEFT JOIN tbl_courses ON tbl_courses.course_id = tbl_schoolyears.course_id
    where tbl_schoolyears.stud_id = '".$_GET['stud']."'");
    $row = mysqli_fetch_array($query);


class PDF extends FPDF
{

// Page header

}

$pdf = new PDF('P','mm','Legal');
//left right top
$pdf->SetLeftMargin(15);
$pdf->SetRightMargin(24);
$pdf->SetTopMargin(28);
$pdf->SetAutoPageBreak(true, 8);
$pdf ->AddPage();

$pdf ->SetFont('Arial','B',15);
$pdf ->Cell(0,5,'SAINT FRANCIS OF ASSISI COLLEGE',0,1,'C');
$pdf ->SetFont('Arial','',10);
$test = utf8_decode("Piñas");
$pdf ->Cell(0,5,'045 Admiral Village, Talon 3, Las '.$test.' City',0,1,'C');
$pdf ->Cell(0,5,'',0,1);
$pdf ->SetFont('Arial','B',11);
$pdf ->Cell(0,5,'STUDENT\'S PERMANENT RECORD',0,1,'C');
$pdf ->SetFont('Arial','',10);
$pdf ->Cell(0,5,'Collegiate Department',0,1,'C');
$pdf ->Cell(0,10,'',0,1);
$pdf ->Cell(25,5,'Name',0,0,'L');
$pdf ->Cell(3,5,':',0,0);
$fontsize = 10;
$tempFontSize = $fontsize;
$cellwidth = 73;
while ($pdf->GetStringWidth($row['fullname']) > $cellwidth){
    $pdf->SetFontSize($tempFontSize -= 0.1);}
$pdf ->Cell(74,5,utf8_decode(strtoupper($row['fullname'])) ,'B',0);
$pdf ->SetFont('Arial','',10);
$pdf ->Cell(34,5,'  Date of Application',0,0,'L');
$pdf ->Cell(3,5,':',0,0);
$pdf ->Cell(36,5,'','B',1);
$pdf ->Cell(25,5,'Date of Birth',0,0,'L');
$pdf ->Cell(3,5,':',0,0);
$pdf ->Cell(74,5,$row['birthdate'],'B',0);

$pdf ->Cell(34,5,'  Place of Birth',0,0,'L');
$pdf ->Cell(3,5,':',0,0);
$fontsize = 10;
$tempFontSize = $fontsize;
$cellwidth = 35;
while ($pdf->GetStringWidth($row['birthplace']) > $cellwidth){
    $pdf->SetFontSize($tempFontSize -= 0.1);}
$pdf ->Cell(36,5,$row['birthplace'],'B',1);
$pdf ->SetFont('Arial','',10);
$pdf ->Cell(25,5,'Home Address',0,0,'L');
$pdf ->Cell(3,5,':',0,0);
$fontsize = 10;
$tempFontSize = $fontsize;
$cellwidth = 73;
while ($pdf->GetStringWidth($row['address']) > $cellwidth){
    $pdf->SetFontSize($tempFontSize -= 0.1);}
$pdf ->Cell(74,5,$row['address'],'B',0);
$pdf ->SetFont('Arial','',10);
$pdf ->Cell(34,5,'  Telephone No.',0,0,'L');
$pdf ->Cell(3,5,':',0,0);
$pdf ->Cell(36,5,'','B',1);
$pdf ->Cell(25,5,'',0,0,'L');
$pdf ->Cell(3,5,'',0,0);
$pdf ->Cell(74,5,'','B',1);
$pdf ->Cell(3,4.5,'',0,1);

$pdf ->SetFont('Arial','B',10);
$pdf ->Cell(25,5,'RECORD OF PRELIMINARY EDUCATION:',0,1,'L');
$pdf ->SetFont('Arial','',10);
$pdf ->Cell(70,5,'Elementary Grade Completed (School)',0,0,'L');
$fontsize = 10;
$tempFontSize = $fontsize;
$cellwidth = 69;
while ($pdf->GetStringWidth($row['elem']) > $cellwidth){
    $pdf->SetFontSize($tempFontSize -= 0.1);}
$pdf ->Cell(70,5,$row['elem'],'B',0);
$pdf ->SetFont('Arial','',10);
$pdf ->Cell(3,5,'',0,0);
$pdf ->Cell(14,5,'Year   :',0,0);
$pdf ->Cell(18,5,$row['elemSY'],'B',1);
$pdf ->Cell(70,5,'High School Course Completed (School)',0,0,'L');
$fontsize = 10;
$tempFontSize = $fontsize;
$cellwidth = 69;
while ($pdf->GetStringWidth($row['hs']) > $cellwidth){
    $pdf->SetFontSize($tempFontSize -= 0.1);}
$pdf ->Cell(70,5,$row['hs'],'B',0);
$pdf ->SetFont('Arial','',10);
$pdf ->Cell(3,5,'',0,0);
$pdf ->Cell(14,5,'Year   :',0,0);
$pdf ->Cell(18,5,$row['hsSY'],'B',1);

$pdf ->Cell(3,4.5,'',0,1);
$pdf ->SetFont('Arial','B',10);
$pdf ->Cell(25,5,'ADMISSION CREDENTIALS:',0,1,'L');
$pdf ->Cell(14,5,'',0,0);
$pdf ->Cell(18,5,'',0,0);
$pdf ->Cell(23,5,'','B',0);
$pdf ->SetFont('Arial','',8);
$pdf ->Cell(1,5,'Form 138',0,0);
$pdf ->Cell(14,5,'',0,0);
$pdf ->Cell(18,5,'',0,0);
$pdf ->Cell(21,5,'','B',0);
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(18,5,'Official Transcript of Records',0,1);
$pdf ->Cell(14,5,'',0,0);
$pdf ->Cell(18,5,'',0,0);
$pdf ->Cell(23,5,'','B',0);	
$pdf ->SetFont('Arial','',8);
$pdf ->Cell(1,5,'Form 137',0,0);
$pdf ->Cell(14,5,'',0,0);
$pdf ->Cell(18,5,'',0,0);
$pdf ->Cell(21,5,'','B',0);
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(18,5,'Certificate of Good Moral Character',0,1);
$pdf ->Cell(14,5,'',0,0);
$pdf ->Cell(18,5,'',0,0);
$pdf ->Cell(23,5,'',0,0);
$pdf ->SetFont('Arial','',8);
$pdf ->Cell(1,5,'',0,0);
$pdf ->Cell(14,5,'',0,0);
$pdf ->Cell(18,5,'',0,0);
$pdf ->Cell(21,5,'','B',0);
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(18,5,'NSO / Information Sheet / 2x2, 1x1 pictures',0,1);

$pdf ->Cell(3,4.5,'',0,1);
$pdf ->SetFont('Arial','B',10);
$pdf ->Cell(32,5,'COURSE  :',0,0,'L');
$pdf ->SetFont('Arial','',10);
$fontsize = 10;
$tempFontSize = $fontsize;
$cellwidth = 76;
while ($pdf->GetStringWidth($row['course']) > $cellwidth){
    $pdf->SetFontSize($tempFontSize -= 0.1);}
$pdf ->Cell(77,5,$row['course'],'B',0);
$pdf ->SetFont('Arial','',10);
$pdf ->Cell(2,5,'',0,0);
if ($_GET['sem'] == 'First Semester') {
	$sem = '1st';
}elseif($_GET['sem'] == 'Second Semester'){
	$sem = '2nd';
}else{
	$sem = 'Summer';
}
$pdf ->Cell(13,5,$sem,'B',0);
$pdf ->Cell(2,5,'',0,0);
$pdf ->SetFont('Arial','',9);
$pdf ->Cell(32,5,'Semester   /   A.Y.',0,0,'C');
$pdf ->Cell(0,5,$_GET['sy'],'B',1);
$pdf ->Cell(3,5,'',0,1);
$pdf ->Cell(3,5,'',0,1);

$pdf ->SetFont('Arial','B',10);
$pdf ->Cell(31,5,'COURSE CODE',0,0,'L');
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(95,5,'DESCRIPTION',0,0,'C');
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(12,5,'UNIT',0,0,'C');
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(14,5,'GRADE',0,0,'C');
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(16,5,'CREDIT',0,1,'C');

$pdf->SetXY(10,143.5);
$l= mysqli_query($db, "SELECT * FROM tbl_students WHERE stud_id = '$_GET[stud]'");
while($rows = mysqli_fetch_array ($l)){

 $sum = mysqli_query($db,"SELECT SUM(unit_total) as UN FROM tbl_enrolled_subjects LEFT JOIN tbl_subjects_new ON tbl_subjects_new.subj_id = tbl_enrolled_subjects.subj_id where tbl_enrolled_subjects.stud_id = '$_GET[stud]' AND tbl_enrolled_subjects.acad_year = '$_GET[sy]' AND tbl_enrolled_subjects.semester = '$_GET[sem]'");
                          $row = mysqli_fetch_array ($sum);
$credited = mysqli_query($db,"SELECT SUM(unit_total) as UN FROM tbl_enrolled_subjects LEFT JOIN tbl_subjects_new ON tbl_subjects_new.subj_id = tbl_enrolled_subjects.subj_id where remarks = 'Passed' and tbl_enrolled_subjects.stud_id = '$_GET[stud]' AND tbl_enrolled_subjects.acad_year = '$_GET[sy]' AND tbl_enrolled_subjects.semester = '$_GET[sem]'");
                          $rowew = mysqli_fetch_array ($credited);
  $sqls = mysqli_query($db,"SELECT *,tbl_subjects_new.subj_code,tbl_subjects_new.subj_desc FROM tbl_enrolled_subjects LEFT JOIN tbl_subjects_new ON tbl_subjects_new.subj_id = tbl_enrolled_subjects.subj_id where tbl_enrolled_subjects.acad_year = '$_GET[sy]' AND tbl_enrolled_subjects.semester = '$_GET[sem]' AND stud_id = '$_GET[stud]'")or die($db);
  $y = $pdf->Gety();
    $xy = 6.5;
    $i=1;
while($roe = mysqli_fetch_array($sqls)){
	$pdf ->SetXY(10,$y+$xy);
    $pdf ->Cell(3,5,'',0,1);
$pdf ->SetFont('Arial','',9);
$pdf ->Cell(31,6.5,$roe['subj_code'],'',0);
$pdf ->Cell(2,6.5,'',0,0);
$fontsize = 10;
$tempFontSize = $fontsize;
$cellwidth = 94;
while ($pdf->GetStringWidth($roe['subj_desc']) > $cellwidth){
    $pdf->SetFontSize($tempFontSize -= 0.1);}
$pdf ->Cell(95,6.5,$roe['subj_desc'],'B',0,'C');
$pdf ->SetFont('Arial','',9);
$pdf ->Cell(12,6.5,$roe['unit_total'],'',0,'C');
$pdf ->Cell(2,6.5,'',0,0);
$pdf ->Cell(14,6.5,$roe['numgrade'],'',0,'C');
$pdf ->Cell(2,6.5,'',0,0);
if ($roe['remarks'] == 'Passed') {
	$credits = $roe['unit_total'];
}else{
	$credits = 0;
}
$pdf ->Cell(16	,6.5,$credits,'',0,'C');
                        
	$xy+=6.5;
    $i++;
}
}
 
$pdf->GetY();
$pdf ->Cell(3,6.5,'',0,1);
$pdf ->SetFont('Arial','B',9);
$pdf ->Cell(31,6.5,'','',0,'L');
$pdf ->Cell(2,6.5,'',0,0);
$pdf ->Cell(95,6.5,'***nothing follows***','',0,'C');
$pdf ->Cell(2,6.5,'',0,0);
$pdf ->Cell(12,6.5,$row['UN'],'',0,'C');
$pdf ->Cell(2,6.5,'',0,0);
$pdf ->Cell(14,6.5,'','',0);
$pdf ->Cell(2,6.5,'',0,0);
$pdf ->Cell(16	,6.5,$rowew['UN'],'',0,'C');


$pdf->SetXY(10,150);
$pdf ->Cell(3,5,'',0,1);
$pdf ->SetFont('Arial','',9);
$pdf ->Cell(31,6.5,'','B',0,'L');
$pdf ->Cell(2,6.5,'',0,0);
$pdf ->Cell(95,6.5,'','B',0,'C');
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(12,6.5,'','B',0);
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(14,6.5,'','B',0);
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(16	,6.5,'','B',1);

$pdf ->SetFont('Arial','',9);
$pdf ->Cell(31,6.5,'','B',0,'L');
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(95,6.5,'','B',0,'C');
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(12,6.5,'','B',0);
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(14,6.5,'','B',0);
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(16	,6.5,'','B',1);

$pdf ->SetFont('Arial','',9);
$pdf ->Cell(31,6.5,'','B',0,'L');
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(95,6.5,'','B',0,'C');
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(12,6.5,'','B',0);
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(14,6.5,'','B',0);
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(16	,6.5,'','B',1);

$pdf ->SetFont('Arial','',9);
$pdf ->Cell(31,6.5,'','B',0,'L');
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(95,6.5,'','B',0,'C');
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(12,6.5,'','B',0);
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(14,6.5,'','B',0);
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(16	,6.5,'','B',1);

$pdf ->SetFont('Arial','',9);
$pdf ->Cell(31,6.5,'','B',0,'L');
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(95,6.5,'','B',0,'C');
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(12,6.5,'','B',0);
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(14,6.5,'','B',0);
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(16	,6.5,'','B',1);

$pdf ->SetFont('Arial','',9);
$pdf ->Cell(31,6.5,'','B',0,'L');
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(95,6.5,'','B',0,'C');
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(12,6.5,'','B',0);
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(14,6.5,'','B',0);
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(16	,6.5,'','B',1);

$pdf ->SetFont('Arial','',9);
$pdf ->Cell(31,6.5,'','B',0,'L');
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(95,6.5,'','B',0,'C');
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(12,6.5,'','B',0);
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(14,6.5,'','B',0);
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(16	,6.5,'','B',1);

$pdf ->SetFont('Arial','',9);
$pdf ->Cell(31,6.5,'','B',0,'L');
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(95,6.5,'','B',0,'C');
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(12,6.5,'','B',0);
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(14,6.5,'','B',0);
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(16	,6.5,'','B',1);

$pdf ->SetFont('Arial','',9);
$pdf ->Cell(31,6.5,'','B',0,'L');
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(95,6.5,'','B',0,'C');
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(12,6.5,'','B',0);
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(14,6.5,'','B',0);
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(16	,6.5,'','B',1);

$pdf ->SetFont('Arial','',9);
$pdf ->Cell(31,6.5,'','B',0,'L');
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(95,6.5,'','B',0,'C');
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(12,6.5,'','B',0);
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(14,6.5,'','B',0);
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(16	,6.5,'','B',1);

$pdf ->SetFont('Arial','',9);
$pdf ->Cell(31,6.5,'','B',0,'L');
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(95,6.5,'','B',0,'C');
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(12,6.5,'','B',0);
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(14,6.5,'','B',0);
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(16	,6.5,'','B',1);

$pdf ->SetFont('Arial','',9);
$pdf ->Cell(31,6.5,'','B',0,'L');
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(95,6.5,'','B',0,'C');
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(12,6.5,'','B',0);
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(14,6.5,'','B',0);
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(16	,6.5,'','B',1);

$pdf ->Cell(2,5,'',0,1);
$pdf ->Cell(2,5,'',0,1);
$pdf ->Cell(2,5,'',0,1);

$pdf ->SetFont('Arial','',9);
$pdf ->Cell(20,5,'Prepared by:',0,0);

$pdf ->SetFont('Arial','B',9);
$pdf ->Cell(79,5,'Marilyn B. Montifalcon',0,0,'C');
$pdf ->SetFont('Arial','',9);
$pdf ->Cell(16,5,'Noted by:',0,0);
$pdf ->Cell(2,5,'',0,0);
$pdf ->SetFont('Arial','B',9);
$pdf ->Cell(0,5,'Aries C. Roldan, LPT, MAEd',0,1,'C');

$pdf ->SetFont('Arial','',9);
$pdf ->Cell(20,5,'',0,0);
$pdf ->Cell(79,5,'College Evaluator',0,0,'C');
$pdf ->Cell(18,5,'',0,0);
$pdf ->Cell(0,5,'Chief Registrar',0,1,'C');
$pdf ->Cell(0,5,'',0,1);

$pdf ->Cell(20,5,'Date:',0,0);
$pdf ->Cell(15,5,'',0,0);
$pdf ->Cell(49,5,'','B',0,'C');
$pdf ->Cell(15,5,'',0,0);
$pdf ->Cell(16,5,'Date:',0,0);
$pdf ->Cell(2,5,'',0,0);
$pdf ->Cell(0,5,'','B',0,'C');





$pdf ->Output();
?>