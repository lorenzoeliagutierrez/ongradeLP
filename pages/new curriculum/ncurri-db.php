<?php
require ('../fpdf/fpdf.php');

$con = mysqli_connect('clpc-32','root','');
mysqli_select_db($con,'srms');

//get invoices data
$query = mysqli_query($con,"SELECT * FROM students_tbl LEFT JOIN gender_tbl ON gender_tbl.gender_id = students_tbl.gender_id
    where stud_id = '".$_GET['stud_id']."'");
    $row = mysqli_fetch_array($query);



class PDF extends FPDF
{

// Page header

}

$pdf = new PDF('P','mm','Legal');
//left top right
$pdf->SetRightMargin(10);
$pdf->SetAutoPageBreak(true, 8);
$pdf ->AddPage();

    // Logo(x axis, y axis, height, width)
    $pdf->Image('../download.png',50,5,15,15);
    // text color
    $pdf->SetTextColor(255,0,0);
    // font(font type,style,font size)
    $pdf->SetFont('Arial','B',18);
    // Dummy cell
    $pdf->Cell(50);
    // //cell(width,height,text,border,end line,[align])
    $pdf->Cell(110,5,'Saint Francis of Assisi College',0,0,'C');
    // Line break
    $pdf->Ln(5);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','',10,'C');
    // dummy cell
    $pdf->Cell(50);
    // //cell(width,height,text,border,end line,[align])
    $pdf->Cell(90,3,'96 Bayanan, City of Bacoor, Cavite',0,0,'C');
    // Line break
    $pdf->Ln(5);
    $pdf->SetFont('Arial','B',10,'C');
    // dummy cell
    $pdf->Cell(50);
    // //cell(width,height,text,border,end line,[align])
    $pdf->Cell(90,4,'FOUR-YEAR CURRICULUM',0,0,'C');
    // Line break
    $pdf->Ln(4);
    $pdf->SetFont('Arial','B',10,'C');
    // dummy cell
    $pdf->Cell(50);
    // //cell(width,height,text,border,end line,[align])
    $pdf->Cell(90,4,'FOR',0,0,'C');
    // Line break
    $pdf->Ln(4);
    $pdf->SetFont('Arial','B',10,'C');
    // dummy cell
    $pdf->Cell(50);
    // //cell(width,height,text,border,end line,[align])
    $pdf->Cell(90,4,'BACHELOR OF SCIENCE IN COMPUTER SCIENCE',0,1,'C');

    // Line break

    $pdf->SetFont('Arial','',10,'C');
    // dummy cell
    $pdf->Cell(50);
    // //cell(width,height,text,border,end line,[align])
    $pdf->Cell(90,4,'(Effective Academic Year 2018-2019)',0,1,'C');
     // Line break
    $pdf->Ln(1);
   



//cell(width,height,text,border,end line,[align])
//student name
$pdf ->Cell(15 ,5,'Name:',0,0); 
$pdf->SetFont('Arial','B','10');
$pdf ->Cell(115 ,5,$row['firstname'],'B',0); //end of line


//student no
$pdf->SetFont('Arial','','10');
$pdf ->Cell(25 ,5,'Student No:',0,0);
$pdf->SetFont('Arial','B','10');
$pdf ->Cell(30 ,5,$row['stud_no'],'B',0); //end of line

//dummy cells
$pdf ->Cell(20 ,5,'',0,1);
$pdf ->Cell(20 ,5,'',0,0);

$pdf->SetFont('Arial','B','10');
$pdf ->Cell(20 ,7,'CODE',0,0);
$pdf ->Cell(90 ,7,'Description',0,0,'C');
$pdf ->Cell(34 ,7,'UNITS',0,0,'C');
$pdf ->Cell(60 ,7,'Pre-Requisites',0,0);

// UNITS
$pdf ->Cell(132 ,5,'',0,0);
$pdf ->Cell(10 ,5,'LEC',0,0);
$pdf ->Cell(10 ,5,'LAB',0,0);
$pdf ->Cell(10 ,5,'TOTAL',0,1);

//YEAR , SEMESTER
$pdf ->Cell(10 ,5,'',0,0);
$pdf ->Cell(45 ,5,'First Year, First Semester',0,1);
$pdf->SetFont('Arial','','9');
// SUBJECTS
$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Komunikasyon sa Akademikong Filipino'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'FILI',0,0);
$pdf ->Cell(15 ,4,'101',0,0);
$pdf ->Cell(90 ,4,'Komunikasyon sa Akademikong Filipino',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'FILI',0,0);
$pdf ->Cell(15 ,4,'101',0,0);
$pdf ->Cell(90 ,4,'Komunikasyon sa Akademikong Filipino',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} 
}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Science, Technology and Society'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'CCGE',0,0);
$pdf ->Cell(15 ,4,'101',0,0);
$pdf ->Cell(90 ,4,'Science, Technology and Society',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'CCGE',0,0);
$pdf ->Cell(15 ,4,'101',0,0);
$pdf ->Cell(90 ,4,'Science, Technology and Society',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
    } 
}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Readings in Philippine History'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'CCGE',0,0);
$pdf ->Cell(15 ,4,'102',0,0);
$pdf ->Cell(90 ,4,'Readings in Philippine History',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'CCGE',0,0);
$pdf ->Cell(15 ,4,'102',0,0);
$pdf ->Cell(90 ,4,'Readings in Philippine History',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
    } 
}


$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Understanding the Self'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'CCGE',0,0);
$pdf ->Cell(15 ,4,'103',0,0);
$pdf ->Cell(90 ,4,'Understanding the Self',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'CCGE',0,0);
$pdf ->Cell(15 ,4,'103',0,0);
$pdf ->Cell(90 ,4,'Understanding the Self',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
    } 
}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Franciscan Orientation'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'CHCL',0,0);
$pdf ->Cell(15 ,4,'101',0,0);
$pdf ->Cell(90 ,4,'Franciscan Orientation',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'1',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'CHCL',0,0);
$pdf ->Cell(15 ,4,'101',0,0);
$pdf ->Cell(90 ,4,'Franciscan Orientation',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'1',0,1);
    } 
}



$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Introduction to Computing'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'CCCS',0,0);
$pdf ->Cell(15 ,4,'101',0,0);
$pdf ->Cell(90 ,4,'Introduction to Computing',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'CCCS',0,0);
$pdf ->Cell(15 ,4,'101',0,0);
$pdf ->Cell(90 ,4,'Introduction to Computing',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
    } 
}


$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Gymnastics'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'PHED',0,0);
$pdf ->Cell(15 ,4,'101',0,0);
$pdf ->Cell(90 ,4,'Gymnastics',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'2',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'PHED',0,0);
$pdf ->Cell(15 ,4,'101',0,0);
$pdf ->Cell(90 ,4,'Gymnastics',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'2',0,1);
}
}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'National Service Training Program 1'");
if(mysqli_num_rows($squery1)== 0){
// LAST LINE PER SEM
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'NSTP',0,0);
$pdf ->Cell(15 ,4,'1',0,0);
$pdf ->Cell(90 ,4,'National Service Training Program 1',0,0);
$pdf ->Cell(10 ,4,'3','B',0);
$pdf ->Cell(9 ,4,'0','B',0);
$pdf ->Cell(7 ,4,'(3)','B',1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'NSTP',0,0);
$pdf ->Cell(15 ,4,'1',0,0);
$pdf ->Cell(90 ,4,'National Service Training Program 1',0,0);
$pdf ->Cell(10 ,4,'3','B',0);
$pdf ->Cell(9 ,4,'0','B',0);
$pdf ->Cell(7 ,4,'(3)','B',1);
}
}



$pdf ->Cell(20 ,5,'',0,0);

$pdf->SetFont('Arial','','10');
$pdf ->Cell(102 ,5,'',0,0);
$pdf ->Cell(32 ,6,'TOTAL',0,0);
$pdf->SetFont('Arial','B','10');
$pdf ->Cell(10 ,6,'18',0,0);
$pdf ->Cell(180 ,6,'',0,1);










//YEAR , SEMESTER
$pdf ->Cell(10 ,5,'',0,0);
$pdf ->Cell(45 ,5,'First Year, Second Semester',0,1);


// SUBJECTS
$pdf->SetFont('Arial','','9');
$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Pagbasa at Pagsulat Tungo sa Pananaliksik'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'FILI',0,0);
$pdf ->Cell(15 ,4,'102',0,0);
$pdf ->Cell(90 ,4,'Pagbasa at Pagsulat Tungo sa Pananaliksik',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'FILI101',0,1);
    } else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'FILI',0,0);
$pdf ->Cell(15 ,4,'102',0,0);
$pdf ->Cell(90 ,4,'Pagbasa at Pagsulat Tungo sa Pananaliksik',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'FILI101',0,1);
}
}


$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Mathematics in the Modern World'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'CCGE',0,0);
$pdf ->Cell(15 ,4,'104',0,0);
$pdf ->Cell(90 ,4,'Mathematics in the Modern World',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'CCGE',0,0);
$pdf ->Cell(15 ,4,'104',0,0);
$pdf ->Cell(90 ,4,'Mathematics in the Modern World',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
}
}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'The Contemporary World'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'CCGE',0,0);
$pdf ->Cell(15 ,4,'105',0,0);
$pdf ->Cell(90 ,4,'The Contemporary World',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'CCGE',0,0);
$pdf ->Cell(15 ,4,'105',0,0);
$pdf ->Cell(90 ,4,'The Contemporary World',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
}
}


$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Living in the I.T. Era'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'ECGE',0,0);
$pdf ->Cell(15 ,4,'101',0,0);
$pdf ->Cell(90 ,4,'Living in the I.T. Era',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'CCGE101',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'ECGE',0,0);
$pdf ->Cell(15 ,4,'101',0,0);
$pdf ->Cell(90 ,4,'Living in the I.T. Era',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'CCGE101',0,1);
}
}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Franciscan Core Values and Culture'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'CHCL',0,0);
$pdf ->Cell(15 ,4,'102',0,0);
$pdf ->Cell(90 ,4,'Franciscan Core Values and Culture',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(20 ,4,'CHCL101',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'CHCL',0,0);
$pdf ->Cell(15 ,4,'102',0,0);
$pdf ->Cell(90 ,4,'Franciscan Core Values and Culture',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(20 ,4,'CHCL101',0,1);
}}


$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Fundamentals of Programming 1'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'CCCS',0,0);
$pdf ->Cell(15 ,4,'102',0,0);
$pdf ->Cell(90 ,4,'Fundamentals of Programming 1',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'CCCS',0,0);
$pdf ->Cell(15 ,4,'102',0,0);
$pdf ->Cell(90 ,4,'Fundamentals of Programming 1',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
}}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Individual / Dual Sports'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'PHED',0,0);
$pdf ->Cell(15 ,4,'102',0,0);
$pdf ->Cell(90 ,4,'Individual / Dual Sports',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(20 ,4,'PHED101',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'PHED',0,0);
$pdf ->Cell(15 ,4,'102',0,0);
$pdf ->Cell(90 ,4,'Individual / Dual Sports',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(20 ,4,'PHED101',0,1);
}}



$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'National Service Training Program 2'");
if(mysqli_num_rows($squery1)== 0){
// LAST LINE PER SEM
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'NSTP',0,0);
$pdf ->Cell(15 ,4,'2',0,0);
$pdf ->Cell(90 ,5,'National Service Training Program 2',0,0);
$pdf ->Cell(10 ,4,'3','B',0);
$pdf ->Cell(9 ,4,'0','B',0);
$pdf ->Cell(11 ,4,'(3)','B',0);
$pdf ->Cell(20 ,4,'NSTP1',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'NSTP',0,0);
$pdf ->Cell(15 ,4,'2',0,0);
$pdf ->Cell(90 ,5,'National Service Training Program 2',0,0);
$pdf ->Cell(10 ,4,'3','B',0);
$pdf ->Cell(9 ,4,'0','B',0);
$pdf ->Cell(11 ,4,'(3)','B',0);
$pdf ->Cell(20 ,4,'NSTP1',0,1);
}}


$pdf ->Cell(20 ,5,'',0,0);

$pdf->SetFont('Arial','','10');
$pdf ->Cell(102 ,5,'',0,0);
$pdf ->Cell(32 ,6,'TOTAL',0,0);
$pdf->SetFont('Arial','B','10');
$pdf ->Cell(10 ,6,'18',0,0);
$pdf ->Cell(180 ,6,'',0,1);









//YEAR , SEMESTER
$pdf ->Cell(10 ,5,'',0,0);
$pdf ->Cell(45 ,5,'Second Year, First Semester',0,1);

// SUBJECTS
$pdf->SetFont('Arial','','9');
$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Masining na Pagpapahayag'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'FILI',0,0);
$pdf ->Cell(15 ,4,'103',0,0);
$pdf ->Cell(90 ,4,'Masining na Pagpapahayag',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20, 4,'FILI 102',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'FILI',0,0);
$pdf ->Cell(15 ,4,'103',0,0);
$pdf ->Cell(90 ,4,'Masining na Pagpapahayag',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20, 4,'FILI 102',0,1);
}}


$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Purposive Communication'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'CCGE',0,0);
$pdf ->Cell(15 ,4,'106',0,0);
$pdf ->Cell(90 ,4,'Purposive Communication',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'CCGE',0,0);
$pdf ->Cell(15 ,4,'106',0,0);
$pdf ->Cell(90 ,4,'Purposive Communication',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
}}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Art Appreciation'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'CCGE',0,0);
$pdf ->Cell(15 ,4,'107',0,0);
$pdf ->Cell(90 ,4,'Art Appreciation',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'CCGE',0,0);
$pdf ->Cell(15 ,4,'107',0,0);
$pdf ->Cell(90 ,4,'Art Appreciation',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
}}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'The Entrepreneurial Mind'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'ECGE',0,0);
$pdf ->Cell(15 ,4,'102',0,0);
$pdf ->Cell(90 ,4,'The Entrepreneurial Mind',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->SetFont('Arial','',8);
$pdf ->Cell(20 ,4,'CCGE104, CCGE105',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'ECGE',0,0);
$pdf ->Cell(15 ,4,'102',0,0);
$pdf ->Cell(90 ,4,'The Entrepreneurial Mind',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->SetFont('Arial','',8);
$pdf ->Cell(20 ,4,'CCGE104, CCGE105',0,1);
}}

$pdf ->SetFont('Arial','',9);
$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Discrete Structures 1'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'CSPC',0,0);
$pdf ->Cell(15 ,4,'101',0,0);
$pdf ->Cell(90 ,4,'Discrete Structures 1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'CSPC',0,0);
$pdf ->Cell(15 ,4,'101',0,0);
$pdf ->Cell(90 ,4,'Discrete Structures 1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
}}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Intermediate Programming'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'CCCS',0,0);
$pdf ->Cell(15 ,4,'103',0,0);
$pdf ->Cell(90 ,4,'Intermediate Programming',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'CCCS102',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'CCCS',0,0);
$pdf ->Cell(15 ,4,'103',0,0);
$pdf ->Cell(90 ,4,'Intermediate Programming',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'CCCS102',0,1);
}}



$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Team Sports'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'PHED',0,0);
$pdf ->Cell(15 ,4,'103',0,0);
$pdf ->Cell(90 ,5,'Team Sports',0,0);
$pdf ->Cell(10 ,4,'2','B',0);
$pdf ->Cell(10 ,4,'0','B',0);
$pdf ->Cell(10 ,4,'2','B',0);
$pdf ->Cell(20 ,4,'PHED101',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'PHED',0,0);
$pdf ->Cell(15 ,4,'103',0,0);
$pdf ->Cell(90 ,5,'Team Sports',0,0);
$pdf ->Cell(10 ,4,'2','B',0);
$pdf ->Cell(10 ,4,'0','B',0);
$pdf ->Cell(10 ,4,'2','B',0);
$pdf ->Cell(20 ,4,'PHED101',0,1);
}}

$pdf ->Cell(20 ,5,'',0,0);


$pdf->SetFont('Arial','','10');
$pdf ->Cell(102 ,5,'',0,0);
$pdf ->Cell(32 ,6,'TOTAL',0,0);
$pdf->SetFont('Arial','B','10');
$pdf ->Cell(10 ,6,'20',0,0);
$pdf ->Cell(180 ,6,'',0,1);









//YEAR , SEMESTER
$pdf ->Cell(10 ,5,'',0,0);
$pdf ->Cell(45 ,5,'Second Year, Second Semester',0,1);
$pdf->SetFont('Arial','','9');

// SUBJECTS
$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Ethics'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'CCGE',0,0);
$pdf ->Cell(15 ,4,'108',0,0);
$pdf ->Cell(90 ,4,'Ethics',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'CCGE103',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'CCGE',0,0);
$pdf ->Cell(15 ,4,'108',0,0);
$pdf ->Cell(90 ,4,'Ethics',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'CCGE103',0,1);
}}


$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Reading Visual Art'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'ECGE',0,0);
$pdf ->Cell(15 ,4,'103',0,0);
$pdf ->Cell(90 ,4,'Reading Visual Art',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf->SetFont('Arial','','8');
$pdf ->Cell(20 ,4,'CCGE106, CCGE107',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'ECGE',0,0);
$pdf ->Cell(15 ,4,'103',0,0);
$pdf ->Cell(90 ,4,'Reading Visual Art',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf->SetFont('Arial','','8');
$pdf ->Cell(20 ,4,'CCGE106, CCGE107',0,1);
}}
$pdf->SetFont('Arial','','9');
$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Rizal\'s Life, Works & Writings'");
if(mysqli_num_rows($squery1)== 0){

$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'RIZL',0,0);
$pdf ->Cell(15 ,4,'100',0,0);
$pdf ->Cell(90 ,4,'Rizal\'s Life, Works & Writings',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'CCGE102',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'RIZL',0,0);
$pdf ->Cell(15 ,4,'100',0,0);
$pdf ->Cell(90 ,4,'Rizal\'s Life, Works & Writings',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'CCGE102',0,1);
}}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Discrete Structures 2'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'CSPC',0,0);
$pdf ->Cell(15 ,4,'102',0,0);
$pdf ->Cell(90 ,4,'Discrete Structures 2',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'CSPC101',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'CSPC',0,0);
$pdf ->Cell(15 ,4,'102',0,0);
$pdf ->Cell(90 ,4,'Discrete Structures 2',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'CSPC101',0,1);
}}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Object Oriented Programming'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'CSPC',0,0);
$pdf ->Cell(15 ,4,'103',0,0);
$pdf ->Cell(90 ,4,'Object Oriented Programming',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'CCCS103',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'CSPC',0,0);
$pdf ->Cell(15 ,4,'103',0,0);
$pdf ->Cell(90 ,4,'Object Oriented Programming',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'CCCS103',0,1);
}}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Data Structures and Algorithms'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'CCCS',0,0);
$pdf ->Cell(15 ,4,'104',0,0);
$pdf ->Cell(90 ,4,'Data Structures and Algorithms',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20, 4,'CCCS103',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'CCCS',0,0);
$pdf ->Cell(15 ,4,'104',0,0);
$pdf ->Cell(90 ,4,'Data Structures and Algorithms',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20, 4,'CCCS103',0,1);
}}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Sports Management'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'PHED',0,0);
$pdf ->Cell(15 ,4,'104',0,0);
$pdf ->Cell(90 ,5,'Sports Management',0,0);
$pdf ->Cell(10 ,4,'2','B',0);
$pdf ->Cell(10 ,4,'0','B',0);
$pdf ->Cell(10 ,4,'2','B',0);
$pdf ->Cell(20 ,4,'PHED101',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'PHED',0,0);
$pdf ->Cell(15 ,4,'104',0,0);
$pdf ->Cell(90 ,5,'Sports Management',0,0);
$pdf ->Cell(10 ,4,'2','B',0);
$pdf ->Cell(10 ,4,'0','B',0);
$pdf ->Cell(10 ,4,'2','B',0);
$pdf ->Cell(20 ,4,'PHED101',0,1);
}}

$pdf ->Cell(20 ,5,'',0,0);


$pdf->SetFont('Arial','','10');
$pdf ->Cell(102 ,5,'',0,0);
$pdf ->Cell(32 ,6,'TOTAL',0,0);
$pdf->SetFont('Arial','B','10');
$pdf ->Cell(10 ,6,'20',0,0);
$pdf ->Cell(180 ,6,'',0,1);



//YEAR, SEMESTER
$pdf ->Cell(10 ,5,'',0,0);
$pdf ->Cell(45 ,5,'Third Year, First Semester',0,1);
$pdf->SetFont('Arial','B','10');

// SUBJECTS
$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Application Development and Emerging Technologies'");
if(mysqli_num_rows($squery1)== 0){
$pdf->SetFont('Arial','','9');
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'CCCS',0,0);
$pdf ->Cell(15 ,4,'105',0,0);
$pdf ->Cell(90 ,4,'Application Development and Emerging Technologies',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20,4,'CCCS103',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'CCCS',0,0);
$pdf ->Cell(15 ,4,'105',0,0);
$pdf ->Cell(90 ,4,'Application Development and Emerging Technologies',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20,4,'CCCS103',0,1);
}}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Information Management'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'CCCS',0,0);
$pdf ->Cell(15 ,4,'106',0,0);
$pdf ->Cell(90 ,4,'Information Management',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'CCCS104',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'CCCS',0,0);
$pdf ->Cell(15 ,4,'106',0,0);
$pdf ->Cell(90 ,4,'Information Management',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'CCCS104',0,1);
}}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Algorithms and Complexity'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'CSPC',0,0);
$pdf ->Cell(15 ,4,'104',0,0);
$pdf ->Cell(90 ,4,'Algorithms and Complexity',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'CCCS104',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'CSPC',0,0);
$pdf ->Cell(15 ,4,'104',0,0);
$pdf ->Cell(90 ,4,'Algorithms and Complexity',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'CCCS104',0,1);
}}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Automata and Formal Languages'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'CSPC',0,0);
$pdf ->Cell(15 ,4,'105',0,0);
$pdf ->Cell(90 ,4,'Automata and Formal Languages',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'CSPC102',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'CSPC',0,0);
$pdf ->Cell(15 ,4,'105',0,0);
$pdf ->Cell(90 ,4,'Automata and Formal Languages',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'CSPC102',0,1);
}}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Human Computer Interaction'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'CSPC',0,0);
$pdf ->Cell(15 ,4,'106',0,0);
$pdf ->Cell(90 ,4,'Human Computer Interaction',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'CSPC',0,0);
$pdf ->Cell(15 ,4,'106',0,0);
$pdf ->Cell(90 ,4,'Human Computer Interaction',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
}}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Operating Systems'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'CSPC',0,0);
$pdf ->Cell(15 ,4,'107',0,0);
$pdf ->Cell(90 ,4,'Operating Systems',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'CSPC',0,0);
$pdf ->Cell(15 ,4,'107',0,0);
$pdf ->Cell(90 ,4,'Operating Systems',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
}}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Software Engineering 1'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'CSPC',0,0);
$pdf ->Cell(15 ,4,'108',0,0);
$pdf ->Cell(90 ,4,'Software Engineering 1',0,0);
$pdf ->Cell(10 ,4,'2','B',0);
$pdf ->Cell(10 ,4,'1','B',0);
$pdf ->Cell(10 ,4,'3','B',0);
$pdf ->Cell(20 ,4,'3rd Yr. Standing',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'CSPC',0,0);
$pdf ->Cell(15 ,4,'108',0,0);
$pdf ->Cell(90 ,4,'Software Engineering 1',0,0);
$pdf ->Cell(10 ,4,'2','B',0);
$pdf ->Cell(10 ,4,'1','B',0);
$pdf ->Cell(10 ,4,'3','B',0);
$pdf ->Cell(20 ,4,'3rd Yr. Standing',0,1);
}}

$pdf ->Cell(20 ,5,'',0,0);


$pdf->SetFont('Arial','','10');
$pdf ->Cell(102 ,5,'',0,0);
$pdf ->Cell(32 ,6,'TOTAL',0,0);
$pdf->SetFont('Arial','B','10');
$pdf ->Cell(10 ,6,'21',0,0);
$pdf ->Cell(180 ,6,'',0,1);






$pdf ->Cell(10 ,5,'',0,0);
$pdf ->Cell(45 ,5,'Third Year, Second Semester',0,1);

// SUBJECTS
$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Fundamentals of Leadership and Management'");
if(mysqli_num_rows($squery1)== 0){
$pdf->SetFont('Arial','','9');
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'LEMA',0,0);
$pdf ->Cell(15 ,4,'100',0,0);
$pdf ->Cell(90 ,4,'Fundamentals of Leadership and Management',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'LEMA',0,0);
$pdf ->Cell(15 ,4,'100',0,0);
$pdf ->Cell(90 ,4,'Fundamentals of Leadership and Management',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
}}


$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Computer Architecture and Organization'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'CSPC',0,0);
$pdf ->Cell(15 ,4,'109',0,0);
$pdf ->Cell(90 ,4,'Computer Architecture and Organization',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'CSPC101',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'CSPC',0,0);
$pdf ->Cell(15 ,4,'109',0,0);
$pdf ->Cell(90 ,4,'Computer Architecture and Organization',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'CSPC101',0,1);
}}


$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Information Assurance and Security'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'CSPC',0,0);
$pdf ->Cell(15 ,4,'110',0,0);
$pdf ->Cell(90 ,4,'Information Assurance and Security',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'CSPC',0,0);
$pdf ->Cell(15 ,4,'110',0,0);
$pdf ->Cell(90 ,4,'Information Assurance and Security',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
}}


$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Software Engineering 2'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'CSPC',0,0);
$pdf ->Cell(15 ,4,'111',0,0);
$pdf ->Cell(90 ,4,'Software Engineering 2',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'CSPC112',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'CSPC',0,0);
$pdf ->Cell(15 ,4,'111',0,0);
$pdf ->Cell(90 ,4,'Software Engineering 2',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'CSPC112',0,1);
}}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Social Issues and Professional Practice'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'CSPC',0,0);
$pdf ->Cell(15 ,4,'112',0,0);
$pdf ->Cell(90 ,4,'Social Issues and Professional Practice',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'CSPC',0,0);
$pdf ->Cell(15 ,4,'112',0,0);
$pdf ->Cell(90 ,4,'Social Issues and Professional Practice',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
}}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Computer Science Research 1'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'CSPC',0,0);
$pdf ->Cell(15 ,4,'113',0,0);
$pdf ->Cell(90 ,4,'Computer Science Research 1',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'3rd Yr. Standing',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'CSPC',0,0);
$pdf ->Cell(15 ,4,'113',0,0);
$pdf ->Cell(90 ,4,'Computer Science Research 1',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'3rd Yr. Standing',0,1);
}}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'System Fundamentals'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'CSEL',0,0);
$pdf ->Cell(15 ,4,'101',0,0);
$pdf ->Cell(90 ,4,'System Fundamentals',0,0);
$pdf ->Cell(10 ,4,'3','B',0);
$pdf ->Cell(10 ,4,'0','B',0);
$pdf ->Cell(10 ,4,'3','B',0);
$pdf ->Cell(20 ,4,'3rd Yr. Standing',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'CSEL',0,0);
$pdf ->Cell(15 ,4,'101',0,0);
$pdf ->Cell(90 ,4,'System Fundamentals',0,0);
$pdf ->Cell(10 ,4,'3','B',0);
$pdf ->Cell(10 ,4,'0','B',0);
$pdf ->Cell(10 ,4,'3','B',0);
$pdf ->Cell(20 ,4,'3rd Yr. Standing',0,1);
}}

$pdf ->Cell(20 ,5,'',0,0);


$pdf->SetFont('Arial','','10');
$pdf ->Cell(102 ,5,'',0,0);
$pdf ->Cell(32 ,6,'TOTAL',0,0);
$pdf->SetFont('Arial','B','10');
$pdf ->Cell(10 ,6,'21',0,0);
$pdf ->Cell(180 ,6,'',0,1);










$pdf ->Cell(10 ,5,'',0,0);
$pdf ->Cell(45 ,5,'Fourth Year, First Semester',0,1);

// SUBJECTS
$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Pre-Internship'");
if(mysqli_num_rows($squery1)== 0){
$pdf->SetFont('Arial','','9');
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'NTRN',0,0);
$pdf ->Cell(15 ,4,'101',0,0);
$pdf ->Cell(90 ,4,'Pre-Internship',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'4th Yr. Standing',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'NTRN',0,0);
$pdf ->Cell(15 ,4,'101',0,0);
$pdf ->Cell(90 ,4,'Pre-Internship',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'4th Yr. Standing',0,1);
}}



$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Networks and Communications'");
if(mysqli_num_rows($squery1)== 0){
$pdf->SetFont('Arial','','9');
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'CSPC',0,0);
$pdf ->Cell(15 ,4,'114',0,0);
$pdf ->Cell(90 ,4,'Networks and Communications',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'CSPC106',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'CSPC',0,0);
$pdf ->Cell(15 ,4,'114',0,0);
$pdf ->Cell(90 ,4,'Networks and Communications',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'CSPC106',0,1);
}}


$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Design and Implementation of Programming Languages'");
if(mysqli_num_rows($squery1)== 0){
$pdf->SetFont('Arial','','9');
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'CSPC',0,0);
$pdf ->Cell(15 ,4,'115',0,0);
$pdf ->Cell(90 ,4,'Design and Implementation of Programming Languages',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'4th Yr. Standing',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'CSPC',0,0);
$pdf ->Cell(15 ,4,'115',0,0);
$pdf ->Cell(90 ,4,'Design and Implementation of Programming Languages',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'4th Yr. Standing',0,1);
}}


$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Computer Science Research 2'");
if(mysqli_num_rows($squery1)== 0){
$pdf->SetFont('Arial','','9');
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'CSPC',0,0);
$pdf ->Cell(15 ,4,'116',0,0);
$pdf ->Cell(90 ,4,'Computer Science Research 2',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'CSPC115',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'CSPC',0,0);
$pdf ->Cell(15 ,4,'116',0,0);
$pdf ->Cell(90 ,4,'Computer Science Research 2',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'CSPC115',0,1);
}}


$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Intelligent Systems'");
if(mysqli_num_rows($squery1)== 0){
$pdf->SetFont('Arial','','9');
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'CSEL',0,0);
$pdf ->Cell(15 ,4,'102',0,0);
$pdf ->Cell(90 ,4,'Intelligent Systems',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'CSEL',0,0);
$pdf ->Cell(15 ,4,'102',0,0);
$pdf ->Cell(90 ,4,'Intelligent Systems',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
}}
$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Parallel and Distributed Computing'");
if(mysqli_num_rows($squery1)== 0){
$pdf->SetFont('Arial','','9');
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'CSEL',0,0);
$pdf ->Cell(15 ,4,'103',0,0);
$pdf ->Cell(90 ,4,'Parallel and Distributed Computing',0,0);
$pdf ->Cell(10 ,4,'3','B',0);
$pdf ->Cell(10 ,4,'0','B',0);
$pdf ->Cell(10 ,4,'3','B',0);
$pdf ->Cell(20 ,4,'4th Yr. Standing',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'CSEL',0,0);
$pdf ->Cell(15 ,4,'103',0,0);
$pdf ->Cell(90 ,4,'Parallel and Distributed Computing',0,0);
$pdf ->Cell(10 ,4,'3','B',0);
$pdf ->Cell(10 ,4,'0','B',0);
$pdf ->Cell(10 ,4,'3','B',0);
$pdf ->Cell(20 ,4,'4th Yr. Standing',0,1);
}}


$pdf ->Cell(20 ,5,'',0,0);


$pdf->SetFont('Arial','','10');
$pdf ->Cell(102 ,5,'',0,0);
$pdf ->Cell(32 ,5,'TOTAL',0,0);
$pdf->SetFont('Arial','B','10');
$pdf ->Cell(10 ,5,'18',0,0);
$pdf ->Cell(180 ,5,'',0,1);







$pdf ->Cell(10 ,5,'',0,0);
$pdf ->Cell(45 ,5,'Fourth Year, Second Semester',0,1);

// SUBJECTS
$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Internship'");
if(mysqli_num_rows($squery1)== 0){
$pdf->SetFont('Arial','','9');
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'NTRN',0,0);
$pdf ->Cell(15 ,4,'102',0,0);
$pdf ->Cell(90 ,4,'Internship',0,0);
$pdf ->Cell(10 ,4,'0','B',0);
$pdf ->Cell(10 ,4,'12','B',0);
$pdf ->Cell(10 ,4,'12','B',0);
$pdf ->Cell(20 ,4,'NTRN101',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'NTRN',0,0);
$pdf ->Cell(15 ,4,'102',0,0);
$pdf ->Cell(90 ,4,'Internship',0,0);
$pdf ->Cell(10 ,4,'0','B',0);
$pdf ->Cell(10 ,4,'12','B',0);
$pdf ->Cell(10 ,4,'12','B',0);
$pdf ->Cell(20 ,4,'NTRN101',0,1);
}}

$pdf ->Cell(20 ,5,'',0,0);


$pdf->SetFont('Arial','','10');
$pdf ->Cell(102 ,5,'',0,0);
$pdf ->Cell(33 ,6,'TOTAL',0,0);
$pdf->SetFont('Arial','B','10');
$pdf ->Cell(10 ,6,'12',0,0);
$pdf ->Cell(180 ,6,'',0,1);









$pdf ->Cell(20 ,5,'',0,1);

$pdf->SetFont('Arial','B','10');
$pdf ->Cell(95 ,4,'',0,0);
$pdf ->Cell(34 ,4,'TOTAL NUMBER OF UNITS',0,0,'C');
$pdf ->Cell(16 ,4,'',0,0);
$pdf ->Cell(9 ,4,'',0,0);
$pdf ->Cell(10 ,4,'148','',1,0);




$pdf ->Output();
?>