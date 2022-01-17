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

$query = mysqli_query($db,"SELECT *, CONCAT(S.firstname, ' ', S.middlename, ' ', S.lastname) AS fullname
FROM tbl_schoolyears SY
LEFT JOIN tbl_courses C USING(course_id)
LEFT JOIN tbl_students S USING(stud_id)
LEFT JOIN tbl_year_levels YL USING(year_id)
where stud_id = '".$_GET['stud']."'");
    $row = mysqli_fetch_array($query);


    

class PDF extends FPDF
{

// Page header

}

$pdf = new PDF('P','mm','Letter');
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
$pdf ->Cell(0,5,'Grade Sheet',0,1,'C');
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
$pdf ->Cell(74,5,$row['fullname'],'B',0);
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

$pdf->SetXY(10,103.5);
$l= mysqli_query($db, "SELECT * FROM tbl_students WHERE stud_id = '$_GET[stud]'");
while($rows = mysqli_fetch_array ($l)){
if($rows['curri'] == "Old Curri"){
	$sum = mysqli_query($db,"SELECT SUM(unit_total) as UN FROM tbl_enrolled_subjects LEFT JOIN tbl_subjects ON tbl_subjects.subj_id = tbl_enrolled_subjects.subj_id where tbl_enrolled_subjects.stud_id = '$_GET[stud]' AND tbl_enrolled_subjects.acad_year = '$_GET[sy]' AND tbl_enrolled_subjects.semester = '$_GET[sem]'");
                          $row = mysqli_fetch_array ($sum);
$credited = mysqli_query($db,"SELECT SUM(unit_total) as UN FROM tbl_enrolled_subjects LEFT JOIN tbl_subjects ON tbl_subjects.subj_id = tbl_enrolled_subjects.subj_id where remarks = 'Passed' and tbl_enrolled_subjects.stud_id = '$_GET[stud]' AND tbl_enrolled_subjects.acad_year = '$_GET[sy]' AND tbl_enrolled_subjects.semester = '$_GET[sem]'");
                          $rowew = mysqli_fetch_array ($credited);
$sqls = mysqli_query($db,"SELECT *,tbl_subjects.subj_code,tbl_subjects.subj_desc FROM tbl_enrolled_subjects LEFT JOIN tbl_subjects ON tbl_subjects.subj_id = tbl_enrolled_subjects.subj_id where tbl_enrolled_subjects.acad_year = '$_GET[sy]' AND tbl_enrolled_subjects.semester = '$_GET[sem]' AND stud_id = '$_GET[stud]'")or die($db);
$y = $pdf->Gety();
    $xy = 6.5;
    $i=1;
while($roe = mysqli_fetch_array($sqls)){
	$pdf ->SetXY(10,$y+$xy);
  $pdf ->Cell(3,5,'',0,1);
$pdf ->SetFont('Arial','',9);
$pdf ->Cell(31,6.5,$roe['subj_code'],'B',0);
$pdf ->Cell(2,6.5,'',0,0);
$fontsize = 10;
$tempFontSize = $fontsize;
$cellwidth = 94;
while ($pdf->GetStringWidth($roe['subj_desc']) > $cellwidth){
    $pdf->SetFontSize($tempFontSize -= 0.1);}
$pdf ->Cell(95,6.5,$roe['subj_desc'],'B',0,'C');
$pdf ->SetFont('Arial','',9);
$pdf ->Cell(2,6.5,'',0,0);
$pdf ->Cell(12,6.5,$roe['unit_total'],'B',0,'C');
$pdf ->Cell(2,6.5,'',0,0);
$pdf ->Cell(14,6.5,$roe['numgrade'],'B',0,'C');
$pdf ->Cell(2,6.5,'',0,0);
if ($roe['remarks'] == 'Passed') {
	$credits = $roe['unit_total'];
}else{
	$credits = 0;
}
$pdf ->Cell(16	,6.5,$credits,'B',0,'C');
$xy+=6.5;
    $i++;
 }}else{
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
}}
 
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


$pdf->SetXY(10,110);
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

$pdf->Cell(12,6.5,'Note:',0,0);
$pdf->Cell(12,6.5,'This is your TEMPORARY COPY ONLY!',0,1);
$pdf ->SetFont('Arial','I',9);
$pdf->Cell(12,6.5,'Not Valid without signature and School dry seal',0,0);





$pdf ->Output();
?>