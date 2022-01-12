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
    $pdf->Ln(8);
    $pdf->SetFont('Arial','B',10,'C');
    // dummy cell
    $pdf->Cell(50);
    // //cell(width,height,text,border,end line,[align])
    $pdf->Cell(90,4,'TWO-YEAR CURRICULUM',0,0,'C');
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
    $pdf->Cell(90,4,'ASSOCIATE IN COMPUTER TECHNOLOGY',0,0,'C');
    // Line break
    $pdf->Ln(10);
    $pdf->SetFont('Arial','',10,'C');
    // dummy cell
    $pdf->Cell(50);
    // //cell(width,height,text,border,end line,[align])
    $pdf->Cell(90,4,'Effective Aacademic Year 2008-2009',0,0,'C');
     // Line break
    $pdf->Ln(4);
    $pdf->SetFont('Arial','',10,'C');
    // dummy cell
    $pdf->Cell(50);
    // cell(width,height,text,border,end line,[align])
    $pdf->Cell(90,4,'as per CMO # 53 series of 2006',0,0,'C');
    $pdf->Ln(10);



//cell(width,height,text,border,end line,[align])
//student name
$pdf ->Cell(15 ,5,'Name:',0,0); 
$pdf->SetFont('Arial','B','10');
$pdf ->Cell(115 ,5,$row['firstname'],'B',0); //end of line


//student no
$pdf->SetFont('Arial','','10');
$pdf ->Cell(25 ,5,'Student No:',0,0);
$pdf->SetFont('Arial','B','10');
$pdf ->Cell(30 ,5,$row['stud_no'],'B',1); //end of line

//dummy cells
$pdf ->Cell(20 ,5,'',0,1);
$pdf ->Cell(20 ,5,'',0,0);

$pdf->SetFont('Arial','B','10');
$pdf ->Cell(20 ,5,'CODE',0,0);
$pdf ->Cell(90 ,5,'Description',0,0,'C');
$pdf ->Cell(34 ,5,'UNITS',0,0,'C');
$pdf ->Cell(60 ,5,'Pre-Requisites',0,1);

// UNITS
$pdf ->Cell(132 ,5,'',0,0);
$pdf ->Cell(10 ,5,'LEC',0,0);
$pdf ->Cell(10 ,5,'LAB',0,0);
$pdf ->Cell(10 ,5,'TOTAL',0,1);

//YEAR , SEMESTER
$pdf ->Cell(10 ,5,'',0,0);
$pdf ->Cell(45 ,5,'First Year, First Semester',0,1);
$pdf->SetFont('Arial','','10');
// SUBJECTS
$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Communication Skills 1'");
if(mysqli_num_rows($squery1)== 0){
    $pdf ->Cell(5 ,4,'',0,1);
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'ENGL',0,0);
$pdf ->Cell(15 ,4,'111',0,0);
$pdf ->Cell(90 ,4,'Communication Skills 1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,1);
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'ENGL',0,0);
$pdf ->Cell(15 ,4,'111',0,0);
$pdf ->Cell(90 ,4,'Communication Skills 1',0,0);
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
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Komunikasyon Sa Akademikong Filipino'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'FILI',0,0);
$pdf ->Cell(15 ,4,'111',0,0);
$pdf ->Cell(90 ,4,'Komunikasyon Sa Akademikong Filipino',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'FILI',0,0);
$pdf ->Cell(15 ,4,'111',0,0);
$pdf ->Cell(90 ,4,'Komunikasyon Sa Akademikong Filipino',0,0);
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
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'College Algebra'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'MATH',0,0);
$pdf ->Cell(15 ,4,'111',0,0);
$pdf ->Cell(90 ,4,'College Algebra',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'MATH',0,0);
$pdf ->Cell(15 ,4,'111',0,0);
$pdf ->Cell(90 ,4,'College Algebra',0,0);
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
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'General Chemistry'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'CHEM',0,0);
$pdf ->Cell(15 ,4,'111',0,0);
$pdf ->Cell(90 ,4,'General Chemistry',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'4',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'CHEM',0,0);
$pdf ->Cell(15 ,4,'111',0,0);
$pdf ->Cell(90 ,4,'General Chemistry',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'4',0,1);
    } 
}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'I.T. Concepts & Fundamentals'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'COMP',0,0);
$pdf ->Cell(15 ,4,'111',0,0);
$pdf ->Cell(90 ,4,'I.T. Concepts & Fundamentals',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'COMP',0,0);
$pdf ->Cell(15 ,4,'111',0,0);
$pdf ->Cell(90 ,4,'I.T. Concepts & Fundamentals',0,0);
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
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Fundamentals of Problem Solving & Programming 1'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'COMP',0,0);
$pdf ->Cell(15 ,4,'112',0,0);
$pdf ->Cell(90 ,4,'Fundamentals of Problem Solving & Programming 1',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'COMP',0,0);
$pdf ->Cell(15 ,4,'112',0,0);
$pdf ->Cell(90 ,4,'Fundamentals of Problem Solving & Programming 1',0,0);
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
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Christian Community Living 1'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'CHCL',0,0);
$pdf ->Cell(15 ,4,'111',0,0);
$pdf ->Cell(90 ,4,'Christian Community Living 1',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'1',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'CHCL',0,0);
$pdf ->Cell(15 ,4,'111',0,0);
$pdf ->Cell(90 ,4,'Christian Community Living 1',0,0);
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
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Physical Education 1'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'PHED',0,0);
$pdf ->Cell(15 ,4,'111',0,0);
$pdf ->Cell(89 ,4,'Physical Education 1',0,0);
$pdf ->Cell(11 ,4,'(2)',0,0);
$pdf ->Cell(9 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'(2)',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'PHED',0,0);
$pdf ->Cell(15 ,4,'111',0,0);
$pdf ->Cell(89 ,4,'Physical Education 1',0,0);
$pdf ->Cell(11 ,4,'(2)',0,0);
$pdf ->Cell(9 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'(2)',0,1);
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
$pdf ->Cell(15 ,4,'11',0,0);
$pdf ->Cell(89 ,4,'National Service Training Program 1',0,0);
$pdf ->Cell(11 ,4,'(3)','B',0);
$pdf ->Cell(9 ,4,'0','B',0);
$pdf ->Cell(7 ,4,'(3)','B',1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'NSTP',0,0);
$pdf ->Cell(15 ,4,'11',0,0);
$pdf ->Cell(89 ,4,'National Service Training Program 1',0,0);
$pdf ->Cell(11 ,4,'(3)','B',0);
$pdf ->Cell(9 ,4,'0','B',0);
$pdf ->Cell(7 ,4,'(3)','B',1);
}
}



$pdf ->Cell(20 ,5,'',0,0);

$pdf->SetFont('Arial','B','10');
$pdf ->Cell(20 ,5,'',0,0);
$pdf ->Cell(94 ,6,'TOTAL',0,0,'C');
$pdf ->Cell(11 ,6,'17',0,0);
$pdf ->Cell(9 ,6,'3',0,0);
$pdf ->Cell(10 ,6,'20',0,0);
$pdf ->Cell(180 ,6,'',0,1);
$pdf ->Cell(180 ,6,'',0,1);









//YEAR , SEMESTER
$pdf ->Cell(10 ,5,'',0,0);
$pdf ->Cell(45 ,5,'First Year, Second Semester',0,1);


// SUBJECTS
$pdf->SetFont('Arial','','10');
$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Communication Skills 2'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,1);
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'ENGL',0,0);
$pdf ->Cell(15 ,4,'121',0,0);
$pdf ->Cell(90 ,4,'Communication Skills 2',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'ENGL 111',0,1);
    } else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,1);
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'ENGL',0,0);
$pdf ->Cell(15 ,4,'121',0,0);
$pdf ->Cell(90 ,4,'Communication Skills 2',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'ENGL 111',0,1);
}
}


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
$pdf ->Cell(15 ,4,'121',0,0);
$pdf ->Cell(90 ,4,'Pagbasa at Pagsulat Tungo sa Pananaliksik',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'FILI 111',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'FILI',0,0);
$pdf ->Cell(15 ,4,'121',0,0);
$pdf ->Cell(90 ,4,'Pagbasa at Pagsulat Tungo sa Pananaliksik',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'FILI 111',0,1);
}
}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Advanced Algebra and Trigonometry'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'MATH',0,0);
$pdf ->Cell(15 ,4,'123',0,0);
$pdf ->Cell(90 ,4,'Advanced Algebra and Trigonometry',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'MATH 111',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'MATH',0,0);
$pdf ->Cell(15 ,4,'123',0,0);
$pdf ->Cell(90 ,4,'Advanced Algebra and Trigonometry',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'MATH 111',0,1);
}
}


$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Discrete Mathematics'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'MATH',0,0);
$pdf ->Cell(15 ,4,'124',0,0);
$pdf ->Cell(90 ,4,'Discrete Mathematics',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'MATH 111',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'MATH',0,0);
$pdf ->Cell(15 ,4,'124',0,0);
$pdf ->Cell(90 ,4,'Discrete Mathematics',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'MATH 111',0,1);
}
}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Integrated Software & Productivity Tools'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'COMP',0,0);
$pdf ->Cell(15 ,4,'121',0,0);
$pdf ->Cell(90 ,4,'Integrated Software & Productivity Tools',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'COMP 111',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'COMP',0,0);
$pdf ->Cell(15 ,4,'121',0,0);
$pdf ->Cell(90 ,4,'Integrated Software & Productivity Tools',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'COMP 111',0,1);
}}


$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Fundamentals of Problem Solving & Programming 2'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'COMP',0,0);
$pdf ->Cell(15 ,4,'122',0,0);
$pdf ->Cell(90 ,4,'Fundamentals of Problem Solving & Programming 2',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'COMP 112',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'COMP',0,0);
$pdf ->Cell(15 ,4,'122',0,0);
$pdf ->Cell(90 ,4,'Fundamentals of Problem Solving & Programming 2',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'COMP 112',0,1);
}}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Data Structures'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'COMP',0,0);
$pdf ->Cell(15 ,4,'123',0,0);
$pdf ->Cell(90 ,4,'Data Structures',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'COMP 112',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'COMP',0,0);
$pdf ->Cell(15 ,4,'123',0,0);
$pdf ->Cell(90 ,4,'Data Structures',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'COMP 112',0,1);
}}


$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Christian Community Living 2'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'CHCL',0,0);
$pdf ->Cell(15 ,4,'121',0,0);
$pdf ->Cell(90 ,4,'Christian Community Living 2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(20 ,4,'CHCL 111',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
    $pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'CHCL',0,0);
$pdf ->Cell(15 ,4,'121',0,0);
$pdf ->Cell(90 ,4,'Christian Community Living 2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(20 ,4,'CHCL 111',0,1);
}}


$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Physical Education 2'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'PHED',0,0);
$pdf ->Cell(15 ,4,'121',0,0);
$pdf ->Cell(89 ,4,'Physical Education 2',0,0);
$pdf ->Cell(11 ,4,'(2)',0,0);
$pdf ->Cell(9 ,4,'0',0,0);
$pdf ->Cell(11 ,4,'(2)',0,0);
$pdf ->Cell(20 ,4,'PHED 111',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'PHED',0,0);
$pdf ->Cell(15 ,4,'121',0,0);
$pdf ->Cell(89 ,4,'Physical Education 2',0,0);
$pdf ->Cell(11 ,4,'(2)',0,0);
$pdf ->Cell(9 ,4,'0',0,0);
$pdf ->Cell(11 ,4,'(2)',0,0);
$pdf ->Cell(20 ,4,'PHED 111',0,1);
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
$pdf ->Cell(15 ,4,'12',0,0);
$pdf ->Cell(89 ,5,'National Service Training Program 2',0,0);
$pdf ->Cell(11 ,4,'(3)','B',0);
$pdf ->Cell(9 ,4,'0','B',0);
$pdf ->Cell(11 ,4,'(3)','B',0);
$pdf ->Cell(20 ,4,'NSTP 11',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'NSTP',0,0);
$pdf ->Cell(15 ,4,'12',0,0);
$pdf ->Cell(89 ,5,'National Service Training Program 2',0,0);
$pdf ->Cell(11 ,4,'(3)','B',0);
$pdf ->Cell(9 ,4,'0','B',0);
$pdf ->Cell(11 ,4,'(3)','B',0);
$pdf ->Cell(20 ,4,'NSTP 11',0,1);
}}


$pdf ->Cell(20 ,5,'',0,0);

$pdf->SetFont('Arial','B','10');
$pdf ->Cell(20 ,5,'',0,0);
$pdf ->Cell(94 ,6,'TOTAL',0,0,'C');
$pdf ->Cell(11 ,6,'20',0,0);
$pdf ->Cell(9 ,6,'2',0,0);
$pdf ->Cell(10 ,6,'22',0,1);
$pdf ->Cell(180 ,6,'',0,1);









//YEAR , SEMESTER
$pdf ->Cell(10 ,5,'',0,0);
$pdf ->Cell(45 ,5,'Second Year, First Semester',0,1);

// SUBJECTS
$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Oral Communication & Public Speaking'");
if(mysqli_num_rows($squery1)== 0){
$pdf->SetFont('Arial','','10');
$pdf ->Cell(5 ,4,'',0,1);
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'ENGL',0,0);
$pdf ->Cell(15 ,4,'211',0,0);
$pdf ->Cell(90 ,4,'Oral Communication & Public Speaking',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'ENGL 121',0,1);
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,1);
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'ENGL',0,0);
$pdf ->Cell(15 ,4,'211',0,0);
$pdf ->Cell(90 ,4,'Oral Communication & Public Speaking',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'ENGL 121',0,1);
}}

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
$pdf ->Cell(15 ,4,'211',0,0);
$pdf ->Cell(90 ,4,'Masining na Pagpapahayag',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'FILI 121',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'FILI',0,0);
$pdf ->Cell(15 ,4,'211',0,0);
$pdf ->Cell(90 ,4,'Masining na Pagpapahayag',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'FILI 121',0,1);
}}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Philippine History'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'HIST',0,0);
$pdf ->Cell(15 ,4,'211',0,0);
$pdf ->Cell(90 ,4,'Philippine History',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'HIST',0,0);
$pdf ->Cell(15 ,4,'211',0,0);
$pdf ->Cell(90 ,4,'Philippine History',0,0);
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
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'General Psychology'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'GPSY',0,0);
$pdf ->Cell(15 ,4,'211',0,0);
$pdf ->Cell(90 ,4,'General Psychology',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'GPSY',0,0);
$pdf ->Cell(15 ,4,'211',0,0);
$pdf ->Cell(90 ,4,'General Psychology',0,0);
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
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Introduction to Accounting'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'ACTG',0,0);
$pdf ->Cell(15 ,4,'212',0,0);
$pdf ->Cell(90 ,4,'Introduction to Accounting',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'ACTG',0,0);
$pdf ->Cell(15 ,4,'212',0,0);
$pdf ->Cell(90 ,4,'Introduction to Accounting',0,0);
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
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Object-Oriented Programming'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'COMP',0,0);
$pdf ->Cell(15 ,4,'211',0,0);
$pdf ->Cell(90 ,4,'Object-Oriented Programming',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'COMP 122/123',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'COMP',0,0);
$pdf ->Cell(15 ,4,'211',0,0);
$pdf ->Cell(90 ,4,'Object-Oriented Programming',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'COMP 122/123',0,1);
}}


$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Database Management Systems'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'COMP',0,0);
$pdf ->Cell(15 ,4,'212',0,0);
$pdf ->Cell(90 ,4,'Database Management Systems',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'COMP 122/123',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'COMP',0,0);
$pdf ->Cell(15 ,4,'212',0,0);
$pdf ->Cell(90 ,4,'Database Management Systems',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'COMP 122/123',0,1);
}}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Intro to Comp. Org. Architecture and Machine Level Programming'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'COMP',0,0);
$pdf ->Cell(15 ,4,'213',0,0);
$pdf ->Cell(90 ,4,'Intro to Comp. Org. Architecture and Machine',0,1);
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','',0);
$pdf ->Cell(15 ,4,'',0,0);
$pdf ->Cell(15 ,4,'',0,0);
$pdf ->Cell(90 ,4,'Level Programming',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'COMP 111/122',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'COMP',0,0);
$pdf ->Cell(15 ,4,'213',0,0);
$pdf ->Cell(90 ,4,'Intro to Comp. Org. Architecture and Machine',0,1);
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','',0);
$pdf ->Cell(15 ,4,'',0,0);
$pdf ->Cell(15 ,4,'',0,0);
$pdf ->Cell(90 ,4,'Level Programming',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'COMP 111/122',0,1);
}}


// LAST LINE PER SEM
$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Presentation Skills in I.T.'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'COMP',0,0);
$pdf ->Cell(15 ,4,'214',0,0);
$pdf ->Cell(90 ,5,'Presentation Skills in I.T.',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'COMP 121',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'COMP',0,0);
$pdf ->Cell(15 ,4,'214',0,0);
$pdf ->Cell(90 ,5,'Presentation Skills in I.T.',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'COMP 121',0,1);
}}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Physical Education 3'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'PHED',0,0);
$pdf ->Cell(15 ,4,'211',0,0);
$pdf ->Cell(89 ,5,'Physical Education 3',0,0);
$pdf ->Cell(11 ,4,'(2)','B',0);
$pdf ->Cell(9 ,4,'0','B',0);
$pdf ->Cell(11 ,4,'(2)','B',0);
$pdf ->Cell(20 ,4,'PHED 121',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'PHED',0,0);
$pdf ->Cell(15 ,4,'211',0,0);
$pdf ->Cell(89 ,5,'Physical Education 3',0,0);
$pdf ->Cell(11 ,4,'(2)','B',0);
$pdf ->Cell(9 ,4,'0','B',0);
$pdf ->Cell(11 ,4,'(2)','B',0);
$pdf ->Cell(20 ,4,'PHED 121',0,1);
}}

$pdf ->Cell(20 ,5,'',0,0);

$pdf->SetFont('Arial','B','10');
$pdf ->Cell(20 ,5,'',0,0);
$pdf ->Cell(94 ,6,'TOTAL',0,0,'C');
$pdf ->Cell(11 ,6,'23',0,0);
$pdf ->Cell(9 ,6,'4',0,0);
$pdf ->Cell(10 ,6,'27',0,1);
$pdf ->Cell(180 ,6,'',0,1);









//YEAR , SEMESTER
$pdf ->Cell(10 ,5,'',0,0);
$pdf ->Cell(45 ,5,'Second Year, Second Semester',0,1);

// SUBJECTS
$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Philippine Government & Constitution'");
if(mysqli_num_rows($squery1)== 0){
$pdf->SetFont('Arial','','10');
$pdf ->Cell(5 ,4,'',0,1);
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'CONS',0,0);
$pdf ->Cell(15 ,4,'221',0,0);
$pdf ->Cell(90 ,4,'Philippine Government & Constitution',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,1);
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'CONS',0,0);
$pdf ->Cell(15 ,4,'221',0,0);
$pdf ->Cell(90 ,4,'Philippine Government & Constitution',0,0);
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
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Rizal\'s Life, Works & Writings'");
if(mysqli_num_rows($squery1)== 0){

$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'RZAL',0,0);
$pdf ->Cell(15 ,4,'221',0,0);
$pdf ->Cell(90 ,4,'Rizal\'s Life, Works & Writings',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'RZAL',0,0);
$pdf ->Cell(15 ,4,'221',0,0);
$pdf ->Cell(90 ,4,'Rizal\'s Life, Works & Writings',0,0);
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
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Business and Technical Writing'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'ENGL',0,0);
$pdf ->Cell(15 ,4,'221',0,0);
$pdf ->Cell(90 ,4,'Business and Technical Writing',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'ENGL 121',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'ENGL',0,0);
$pdf ->Cell(15 ,4,'221',0,0);
$pdf ->Cell(90 ,4,'Business and Technical Writing',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'ENGL 121',0,1);
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
$pdf ->Cell(15 ,4,'COMP',0,0);
$pdf ->Cell(15 ,4,'221',0,0);
$pdf ->Cell(90 ,4,'Operating Systems',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'COMP 213',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'COMP',0,0);
$pdf ->Cell(15 ,4,'221',0,0);
$pdf ->Cell(90 ,4,'Operating Systems',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'COMP 213',0,1);
}}


$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Network Principles, Management & Programming'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'COMP',0,0);
$pdf ->Cell(15 ,4,'222',0,0);
$pdf ->Cell(90 ,4,'Network Principles, Management & Programming',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'COMP 213',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'COMP',0,0);
$pdf ->Cell(15 ,4,'222',0,0);
$pdf ->Cell(90 ,4,'Network Principles, Management & Programming',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'COMP 213',0,1);
}}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Web Development & Programming'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'COMP',0,0);
$pdf ->Cell(15 ,4,'223',0,0);
$pdf ->Cell(90 ,4,'Web Development & Programming',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'COMP 212',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'COMP',0,0);
$pdf ->Cell(15 ,4,'223',0,0);
$pdf ->Cell(90 ,4,'Web Development & Programming',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'COMP 212',0,1);
}}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Ethics for I.T. Professionals'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'COMP',0,0);
$pdf ->Cell(15 ,4,'224',0,0);
$pdf ->Cell(90 ,4,'Ethics for I.T. Professionals',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'COMP 111',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'COMP',0,0);
$pdf ->Cell(15 ,4,'224',0,0);
$pdf ->Cell(90 ,4,'Ethics for I.T. Professionals',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'COMP 111',0,1);
}}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'System Analysis & Design'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'COMP',0,0);
$pdf ->Cell(15 ,4,'225',0,0);
$pdf ->Cell(90 ,4,'System Analysis & Design',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'COMP 212',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'COMP',0,0);
$pdf ->Cell(15 ,4,'225',0,0);
$pdf ->Cell(90 ,4,'System Analysis & Design',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'COMP 212',0,1);
}}


$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Foreign Language 1 (Niponggo)'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'FRLG',0,0);
$pdf ->Cell(15 ,4,'221',0,0);
$pdf ->Cell(90 ,5,'Foreign Language 1 (Niponggo)',0,0);
$pdf ->Cell(10 ,4,'3','0',0);
$pdf ->Cell(10 ,4,'0','0',0);
$pdf ->Cell(7 ,4,'3','0',1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'FRLG',0,0);
$pdf ->Cell(15 ,4,'221',0,0);
$pdf ->Cell(90 ,5,'Foreign Language 1 (Niponggo)',0,0);
$pdf ->Cell(10 ,4,'3','0',0);
$pdf ->Cell(10 ,4,'0','0',0);
$pdf ->Cell(7 ,4,'3','0',1);
}}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Internship'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'PRAC',0,0);
$pdf ->Cell(15 ,4,'221',0,0);
$pdf ->Cell(90 ,5,'Internship',0,0);
$pdf ->Cell(10 ,4,'0','0',0);
$pdf ->Cell(10 ,4,'3','0',0);
$pdf ->Cell(7 ,4,'3','0',1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'PRAC',0,0);
$pdf ->Cell(15 ,4,'221',0,0);
$pdf ->Cell(90 ,5,'Internship',0,0);
$pdf ->Cell(10 ,4,'0','0',0);
$pdf ->Cell(10 ,4,'3','0',0);
$pdf ->Cell(7 ,4,'3','0',1);
}}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Physical Education 4'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'PHED',0,0);
$pdf ->Cell(15 ,4,'221',0,0);
$pdf ->Cell(89 ,5,'Physical Education 4',0,0);
$pdf ->Cell(11 ,4,'(2)','B',0);
$pdf ->Cell(9 ,4,'0','B',0);
$pdf ->Cell(11 ,4,'(2)','B',0);
$pdf ->Cell(20 ,4,'PHED 211',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'PHED',0,0);
$pdf ->Cell(15 ,4,'221',0,0);
$pdf ->Cell(89 ,5,'Physical Education 4',0,0);
$pdf ->Cell(11 ,4,'(2)','B',0);
$pdf ->Cell(9 ,4,'0','B',0);
$pdf ->Cell(11 ,4,'(2)','B',0);
$pdf ->Cell(20 ,4,'PHED 211',0,1);
}}

$pdf ->Cell(20 ,5,'',0,0);

$pdf->SetFont('Arial','B','10');
$pdf ->Cell(20 ,5,'',0,0);
$pdf ->Cell(94 ,6,'TOTAL',0,0,'C');
$pdf ->Cell(11 ,6,'23',0,0);
$pdf ->Cell(9 ,6,'7',0,0);
$pdf ->Cell(10 ,6,'30',0,1);
$pdf ->Cell(180 ,6,'',0,0);
$pdf ->Cell(180 ,6,'',0,0);



$pdf ->Cell(20 ,5,'',0,0);
$pdf ->Cell(20 ,5,'',0,1);

$pdf->SetFont('Arial','B','10');
$pdf ->Cell(20 ,4,'',0,0);
$pdf ->Cell(94 ,4,'TOTAL NUMBER OF UNITS',0,0,'C');
$pdf ->Cell(11 ,4,'',0,0);
$pdf ->Cell(9 ,4,'',0,0);
$pdf ->Cell(10 ,4,'99','B',1,1);
$pdf ->Cell(20 ,4,'',0,0);
$pdf ->Cell(94 ,4,'',0,0,'C');
$pdf ->Cell(11 ,4,'',0,0);
$pdf ->Cell(9 ,4,'',0,0);
$pdf ->Cell(10 ,1,'','B',1,1);



$pdf ->Output();
?>