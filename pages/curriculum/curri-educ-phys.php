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
    $pdf->Cell(90,4,'BACHELOR OF SECONDARY EDUCATION',0,1,'C');
    $pdf->Cell(50);
    $pdf->Cell(90,4,'Major in PHYSICAL SCIENCE',0,0,'C');
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
    $pdf->Cell(90,4,'as per CMO # 53 series of 2004',0,0,'C');
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
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Biological Science'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'NSCI',0,0);
$pdf ->Cell(15 ,4,'111',0,0);
$pdf ->Cell(90 ,4,'Biological Science',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'NSCI',0,0);
$pdf ->Cell(15 ,4,'111',0,0);
$pdf ->Cell(90 ,4,'Biological Science',0,0);
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
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Music, Art Education & Appreciation'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'HUMA',0,0);
$pdf ->Cell(15 ,4,'111',0,0);
$pdf ->Cell(90 ,4,'Music, Art Education & Appreciation',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'HUMA',0,0);
$pdf ->Cell(15 ,4,'111',0,0);
$pdf ->Cell(90 ,4,'Music, Art Education & Appreciation',0,0);
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
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'History & Philosophy Science'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'NSCI',0,0);
$pdf ->Cell(15 ,4,'112',0,0);
$pdf ->Cell(90 ,4,'History & Philosophy Science',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'NSCI',0,0);
$pdf ->Cell(15 ,4,'112',0,0);
$pdf ->Cell(90 ,4,'History & Philosophy Science',0,0);
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
$pdf ->Cell(11 ,6,'21',0,0);
$pdf ->Cell(9 ,6,'1',0,0);
$pdf ->Cell(10 ,6,'22',0,1);
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
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Basic Statistics'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'MATH',0,0);
$pdf ->Cell(15 ,4,'122',0,0);
$pdf ->Cell(90 ,4,'Basic Statistics',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'MATH 111',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'MATH',0,0);
$pdf ->Cell(15 ,4,'122',0,0);
$pdf ->Cell(90 ,4,'Basic Statistics',0,0);
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
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'General Chemistry'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'NSCI',0,0);
$pdf ->Cell(15 ,4,'121',0,0);
$pdf ->Cell(90 ,4,'General Chemistry',0,0);
$pdf ->Cell(10 ,4,'4',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'5',0,0);
$pdf ->Cell(20 ,4,'NSCI 111',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'NSCI',0,0);
$pdf ->Cell(15 ,4,'121',0,0);
$pdf ->Cell(90 ,4,'General Chemistry',0,0);
$pdf ->Cell(10 ,4,'4',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'5',0,0);
$pdf ->Cell(20 ,4,'NSCI 111',0,1);
}
}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Physical Science with Earth Science'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'NSCI',0,0);
$pdf ->Cell(15 ,4,'122',0,0);
$pdf ->Cell(90 ,4,'Physical Science with Earth Science',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'NSCI',0,0);
$pdf ->Cell(15 ,4,'122',0,0);
$pdf ->Cell(90 ,4,'Physical Science with Earth Science',0,0);
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
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Basic Electonics'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'NSCI',0,0);
$pdf ->Cell(15 ,4,'124',0,0);
$pdf ->Cell(90 ,4,'Basic Electonics',0,0);
$pdf ->Cell(10 ,4,'4',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'5',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'NSCI',0,0);
$pdf ->Cell(15 ,4,'124',0,0);
$pdf ->Cell(90 ,4,'Basic Electonics',0,0);
$pdf ->Cell(10 ,4,'4',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'5',0,1);
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
$pdf ->Cell(11 ,6,'23',0,0);
$pdf ->Cell(9 ,6,'3',0,0);
$pdf ->Cell(10 ,6,'26',0,1);
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
} else {
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
$pdf->SetFont('Arial','','10');
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
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Child & Adolescent Psychology'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'EDUC',0,0);
$pdf ->Cell(15 ,4,'211',0,0);
$pdf ->Cell(90 ,4,'Child & Adolescent Psychology',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'EDUC',0,0);
$pdf ->Cell(15 ,4,'211',0,0);
$pdf ->Cell(90 ,4,'Child & Adolescent Psychology',0,0);
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
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Educational Technology 1'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'EDUC',0,0);
$pdf ->Cell(15 ,4,'212',0,0);
$pdf ->Cell(90 ,4,'Educational Technology 1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'EDUC',0,0);
$pdf ->Cell(15 ,4,'212',0,0);
$pdf ->Cell(90 ,4,'Educational Technology 1',0,0);
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
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Field Study 1'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'EDUC',0,0);
$pdf ->Cell(15 ,4,'213',0,0);
$pdf ->Cell(90 ,4,'Field Study 1',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'1',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'EDUC',0,0);
$pdf ->Cell(15 ,4,'213',0,0);
$pdf ->Cell(90 ,4,'Field Study 1',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'1',0,1);
}}


$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Science, Technology & Society'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'NSCI',0,0);
$pdf ->Cell(15 ,4,'212',0,0);
$pdf ->Cell(90 ,4,'Science, Technology & Society',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'NSCI',0,0);
$pdf ->Cell(15 ,4,'212',0,0);
$pdf ->Cell(90 ,4,'Science, Technology & Society',0,0);
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
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Earth and Environmental Science 1'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'NSCI',0,0);
$pdf ->Cell(15 ,4,'214',0,0);
$pdf ->Cell(90 ,4,'Earth and Environmental Science 1',0,0);
$pdf ->Cell(10 ,4,'4',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'5',0,0);
$pdf ->Cell(20 ,4,'NSCI 122',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'NSCI',0,0);
$pdf ->Cell(15 ,4,'214',0,0);
$pdf ->Cell(90 ,4,'Earth and Environmental Science 1',0,0);
$pdf ->Cell(10 ,4,'4',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'5',0,0);
$pdf ->Cell(20 ,4,'NSCI 122',0,1);
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
$pdf ->Cell(11 ,6,'25',0,0);
$pdf ->Cell(9 ,6,'5',0,0);
$pdf ->Cell(10 ,6,'27',0,1);
$pdf ->Cell(180 ,6,'',0,1);









//YEAR , SEMESTER
$pdf ->Cell(10 ,5,'',0,0);
$pdf ->Cell(45 ,5,'Second Year, Second Semester',0,1);

$pdf->SetFont('Arial','','10');
// SUBJECTS
$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Philippine Government & Constitution'");
if(mysqli_num_rows($squery1)== 0){
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
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Theories of Learning'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'EDUC',0,0);
$pdf ->Cell(15 ,4,'221',0,0);
$pdf ->Cell(90 ,4,'Theories of Learning',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'EDUC',0,0);
$pdf ->Cell(15 ,4,'221',0,0);
$pdf ->Cell(90 ,4,'Theories of Learning',0,0);
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
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Educational Technology 2'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'EDUC',0,0);
$pdf ->Cell(15 ,4,'222',0,0);
$pdf ->Cell(90 ,4,'Educational Technology 2',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'EDUC 212',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'EDUC',0,0);
$pdf ->Cell(15 ,4,'222',0,0);
$pdf ->Cell(90 ,4,'Educational Technology 2',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'EDUC 212',0,1);
}}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Curriculum Development'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'EDUC',0,0);
$pdf ->Cell(15 ,4,'223',0,0);
$pdf ->Cell(90 ,4,'Curriculum Development',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'EDUC',0,0);
$pdf ->Cell(15 ,4,'223',0,0);
$pdf ->Cell(90 ,4,'Curriculum Development',0,0);
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
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Field Study 2'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'EDUC',0,0);
$pdf ->Cell(15 ,4,'224',0,0);
$pdf ->Cell(90 ,4,'Field Study 2',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(20 ,4,'EDUC 213',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'EDUC',0,0);
$pdf ->Cell(15 ,4,'224',0,0);
$pdf ->Cell(90 ,4,'Field Study 2',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(20 ,4,'EDUC 213',0,1);
}}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Organic Chemistry'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'NSCI',0,0);
$pdf ->Cell(15 ,4,'222',0,0);
$pdf ->Cell(90 ,4,'Organic Chemistry',0,0);
$pdf ->Cell(10 ,4,'4',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'5',0,0);
$pdf ->Cell(20 ,4,'NSCI 121',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'NSCI',0,0);
$pdf ->Cell(15 ,4,'222',0,0);
$pdf ->Cell(90 ,4,'Organic Chemistry',0,0);
$pdf ->Cell(10 ,4,'4',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'5',0,0);
$pdf ->Cell(20 ,4,'NSCI 121',0,1);
}}


$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Earth and Environmental Science 2'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'NSCI',0,0);
$pdf ->Cell(15 ,4,'223',0,0);
$pdf ->Cell(90 ,5,'Earth and Environmental Science 2',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'NSCI 214',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'NSCI',0,0);
$pdf ->Cell(15 ,4,'223',0,0);
$pdf ->Cell(90 ,5,'Earth and Environmental Science 2',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'NSCI 214',0,1);
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
$pdf ->Cell(11 ,6,'22',0,0);
$pdf ->Cell(9 ,6,'2',0,0);
$pdf ->Cell(10 ,6,'24',0,1);
$pdf ->Cell(180 ,6,'',0,1);
$pdf ->Cell(180 ,6,'',0,1);





$pdf->Cell(180,10,'',0,1);
$pdf->Cell(180,10,'',0,1);


$pdf ->Cell(10 ,5,'',0,0);
$pdf ->Cell(45 ,5,'Third Year, First Semester',0,1);

$pdf->SetFont('Arial','','10');
// SUBJECTS
$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Philippine Literature'");
if(mysqli_num_rows($squery1)== 0){
$pdf->SetFont('Arial','','10');
$pdf ->Cell(5 ,4,'',0,1);
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'PLIT',0,0);
$pdf ->Cell(15 ,4,'311',0,0);
$pdf ->Cell(90 ,4,'Philippine Literature',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,1);
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'PLIT',0,0);
$pdf ->Cell(15 ,4,'311',0,0);
$pdf ->Cell(90 ,4,'Philippine Literature',0,0);
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
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Economics with Agrarian Reform & Taxation'");
if(mysqli_num_rows($squery1)== 0){
$pdf->SetFont('Arial','','10');
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'ECON',0,0);
$pdf ->Cell(15 ,4,'311',0,0);
$pdf ->Cell(90 ,4,'Economics with Agrarian Reform & Taxation',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'ECON',0,0);
$pdf ->Cell(15 ,4,'311',0,0);
$pdf ->Cell(90 ,4,'Economics with Agrarian Reform & Taxation',0,0);
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
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Principles of Teaching 1'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'EDUC',0,0);
$pdf ->Cell(15 ,4,'311',0,0);
$pdf ->Cell(90 ,4,'Principles of Teaching 1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'EDUC',0,0);
$pdf ->Cell(15 ,4,'311',0,0);
$pdf ->Cell(90 ,4,'Principles of Teaching 1',0,0);
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
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Educational Assessment 1'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'EDUC',0,0);
$pdf ->Cell(15 ,4,'312',0,0);
$pdf ->Cell(90 ,4,'Educational Assessment 1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'EDUC',0,0);
$pdf ->Cell(15 ,4,'312',0,0);
$pdf ->Cell(90 ,4,'Educational Assessment 1',0,0);
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
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Field Study 3'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'EDUC',0,0);
$pdf ->Cell(15 ,4,'313',0,0);
$pdf ->Cell(90 ,4,'Field Study 3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(20 ,4,'EDUC 224',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'EDUC',0,0);
$pdf ->Cell(15 ,4,'313',0,0);
$pdf ->Cell(90 ,4,'Field Study 3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(20 ,4,'EDUC 224',0,1);
}}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Special Topics in Education 1'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'EDUC',0,0);
$pdf ->Cell(15 ,4,'314',0,0);
$pdf ->Cell(90 ,4,'Special Topics in Education 1',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'1',0,1);

} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'EDUC',0,0);
$pdf ->Cell(15 ,4,'314',0,0);
$pdf ->Cell(90 ,4,'Special Topics in Education 1',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'1',0,1);

}}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Analytic Chemistry'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'NSCI',0,0);
$pdf ->Cell(15 ,4,'312',0,0);
$pdf ->Cell(90 ,4,'Analytic Chemistry',0,0);
$pdf ->Cell(10 ,4,'4',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'5',0,0);
$pdf ->Cell(20 ,4,'NSCI 222',0,1);

} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'NSCI',0,0);
$pdf ->Cell(15 ,4,'312',0,0);
$pdf ->Cell(90 ,4,'Analytic Chemistry',0,0);
$pdf ->Cell(10 ,4,'4',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'5',0,0);
$pdf ->Cell(20 ,4,'NSCI 222',0,1);

}}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Biochemistry'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'NSCI',0,0);
$pdf ->Cell(15 ,4,'313',0,0);
$pdf ->Cell(90 ,4,'Biochemistry',0,0);
$pdf ->Cell(10 ,4,'4',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'5',0,1);

} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'NSCI',0,0);
$pdf ->Cell(15 ,4,'313',0,0);
$pdf ->Cell(90 ,4,'Biochemistry',0,0);
$pdf ->Cell(10 ,4,'4',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'5',0,1);

}}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Mechanics'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'NSCI',0,0);
$pdf ->Cell(15 ,4,'314',0,0);
$pdf ->Cell(90 ,4,'Mechanics',0,0);
$pdf ->Cell(10 ,4,'3','B',0);
$pdf ->Cell(10 ,4,'1','B',0);
$pdf ->Cell(10 ,4,'4','B',1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'NSCI',0,0);
$pdf ->Cell(15 ,4,'314',0,0);
$pdf ->Cell(90 ,4,'Mechanics',0,0);
$pdf ->Cell(10 ,4,'3','B',0);
$pdf ->Cell(10 ,4,'1','B',0);
$pdf ->Cell(10 ,4,'4','B',1);
}}


$pdf ->Cell(20 ,5,'',0,0);

$pdf->SetFont('Arial','B','10');
$pdf ->Cell(20 ,5,'',0,0);
$pdf ->Cell(94 ,6,'TOTAL',0,0,'C');
$pdf ->Cell(11 ,6,'24',0,0);
$pdf ->Cell(9 ,6,'5',0,0);
$pdf ->Cell(10 ,6,'29',0,1);
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
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'World Literature'");
if(mysqli_num_rows($squery1)== 0){
$pdf->SetFont('Arial','','10');
$pdf ->Cell(5 ,4,'',0,1);
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'WLIT',0,0);
$pdf ->Cell(15 ,4,'321',0,0);
$pdf ->Cell(90 ,4,'World Literature',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,1);
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'WLIT',0,0);
$pdf ->Cell(15 ,4,'321',0,0);
$pdf ->Cell(90 ,4,'World Literature',0,0);
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
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Principles of Teaching 2'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'EDUC',0,0);
$pdf ->Cell(15 ,4,'321',0,0);
$pdf ->Cell(90 ,4,'Principles of Teaching 2',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'EDUC 311',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'EDUC',0,0);
$pdf ->Cell(15 ,4,'321',0,0);
$pdf ->Cell(90 ,4,'Principles of Teaching 2',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'EDUC 311',0,1);
}}


$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Educational Assessment 2'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'EDUC',0,0);
$pdf ->Cell(15 ,4,'322',0,0);
$pdf ->Cell(90 ,4,'Educational Assessment 2',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'EDUC 312',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'EDUC',0,0);
$pdf ->Cell(15 ,4,'322',0,0);
$pdf ->Cell(90 ,4,'Educational Assessment 2',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'EDUC 312',0,1);
}}


$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Field Study 4'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'EDUC',0,0);
$pdf ->Cell(15 ,4,'323',0,0);
$pdf ->Cell(90 ,4,'Field Study 4',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(20 ,4,'EDUC 313',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'EDUC',0,0);
$pdf ->Cell(15 ,4,'323',0,0);
$pdf ->Cell(90 ,4,'Field Study 4',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(10 ,4,'2',0,0);
$pdf ->Cell(20 ,4,'EDUC 313',0,1);
}}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Special Topics in Education 2'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'EDUC',0,0);
$pdf ->Cell(15 ,4,'324',0,0);
$pdf ->Cell(90 ,4,'Special Topics in Education 2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(20 ,4,'EDUC 314',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'EDUC',0,0);
$pdf ->Cell(15 ,4,'324',0,0);
$pdf ->Cell(90 ,4,'Special Topics in Education 2',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(20 ,4,'EDUC 314',0,1);
}}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Developmental Reading 1'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'EDUC',0,0);
$pdf ->Cell(15 ,4,'325',0,0);
$pdf ->Cell(90 ,4,'Developmental Reading 1',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'EDUC',0,0);
$pdf ->Cell(15 ,4,'325',0,0);
$pdf ->Cell(90 ,4,'Developmental Reading 1',0,0);
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
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Optics'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'NSCI',0,0);
$pdf ->Cell(15 ,4,'324',0,0);
$pdf ->Cell(90 ,4,'Optics',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);

} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'NSCI',0,0);
$pdf ->Cell(15 ,4,'324',0,0);
$pdf ->Cell(90 ,4,'Optics',0,0);
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
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Thermodynamics'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'NSCI',0,0);
$pdf ->Cell(15 ,4,'325',0,0);
$pdf ->Cell(90 ,4,'Thermodynamics',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'NSCI 314',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'NSCI',0,0);
$pdf ->Cell(15 ,4,'325',0,0);
$pdf ->Cell(90 ,4,'Thermodynamics',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'NSCI 314',0,1);
}}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Research in Physical Science'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'NSCI',0,0);
$pdf ->Cell(15 ,4,'326',0,0);
$pdf ->Cell(90 ,4,'Research in Physical Science',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'NSCI',0,0);
$pdf ->Cell(15 ,4,'326',0,0);
$pdf ->Cell(90 ,4,'Research inPhysical Science',0,0);
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
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Electromagetics'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'NSCI',0,0);
$pdf ->Cell(15 ,4,'327',0,0);
$pdf ->Cell(90 ,4,'Electromagetics',0,0);
$pdf ->Cell(10 ,4,'4','B',0);
$pdf ->Cell(10 ,4,'1','B',0);
$pdf ->Cell(10 ,4,'5','B',1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'NSCI',0,0);
$pdf ->Cell(15 ,4,'327',0,0);
$pdf ->Cell(90 ,4,'Electromagetics',0,0);
$pdf ->Cell(10 ,4,'4','B',0);
$pdf ->Cell(10 ,4,'1','B',0);
$pdf ->Cell(10 ,4,'5','B',1);
}}

$pdf ->Cell(20 ,5,'',0,0);

$pdf->SetFont('Arial','B','10');
$pdf ->Cell(20 ,5,'',0,0);
$pdf ->Cell(94 ,6,'TOTAL',0,0,'C');
$pdf ->Cell(11 ,6,'26',0,0);
$pdf ->Cell(9 ,6,'3',0,0);
$pdf ->Cell(10 ,6,'29',0,1);
$pdf ->Cell(180 ,6,'',0,1);










$pdf ->Cell(10 ,5,'',0,0);
$pdf ->Cell(45 ,5,'Third Year, Summer',0,1);

// SUBJECTS
$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Scientific Report Writing'");
if(mysqli_num_rows($squery1)== 0){
$pdf->SetFont('Arial','','10');
$pdf ->Cell(5 ,4,'',0,1);
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'ENGL',0,0);
$pdf ->Cell(15 ,4,'311',0,0);
$pdf ->Cell(90 ,4,'Scientific Report Writing',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'ENGL 121',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,1);
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'ENGL',0,0);
$pdf ->Cell(15 ,4,'311',0,0);
$pdf ->Cell(90 ,4,'Scientific Report Writing',0,0);
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
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'The Teaching Profession'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'EDUC',0,0);
$pdf ->Cell(15 ,4,'331',0,0);
$pdf ->Cell(90 ,4,'The Teaching Profession',0,0);
$pdf ->Cell(10 ,4,'3','B',0);
$pdf ->Cell(10 ,4,'0','B',0);
$pdf ->Cell(10 ,4,'3','B',1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'EDUC',0,0);
$pdf ->Cell(15 ,4,'331',0,0);
$pdf ->Cell(90 ,4,'The Teaching Profession',0,0);
$pdf ->Cell(10 ,4,'3','B',0);
$pdf ->Cell(10 ,4,'0','B',0);
$pdf ->Cell(10 ,4,'3','B',1);
}}


$pdf ->Cell(20 ,5,'',0,0);

$pdf->SetFont('Arial','B','10');
$pdf ->Cell(20 ,5,'',0,0);
$pdf ->Cell(94 ,6,'TOTAL',0,0,'C');
$pdf ->Cell(11 ,6,'6',0,0);
$pdf ->Cell(9 ,6,'0',0,0);
$pdf ->Cell(10 ,6,'6',0,1);
$pdf ->Cell(180 ,6,'',0,1);









$pdf ->Cell(10 ,5,'',0,0);
$pdf ->Cell(45 ,5,'Fourt Year, First Semester',0,1);
$pdf->SetFont('Arial','','10');
// SUBJECTS
$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Society & Culture w/ Family Planning'");
if(mysqli_num_rows($squery1)== 0){
$pdf->SetFont('Arial','','10');
$pdf ->Cell(5 ,4,'',0,1);
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'SOCS',0,0);
$pdf ->Cell(15 ,4,'411',0,0);
$pdf ->Cell(90 ,4,'Society & Culture w/ Family Planning',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'ENGL 121',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,1);
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'SOCS',0,0);
$pdf ->Cell(15 ,4,'411',0,0);
$pdf ->Cell(90 ,4,'Society & Culture w/ Family Planning',0,0);
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
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Practice Teaching'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'EDUC',0,0);
$pdf ->Cell(15 ,4,'411',0,0);
$pdf ->Cell(90 ,4,'Practice Teaching',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'EDUC',0,0);
$pdf ->Cell(15 ,4,'411',0,0);
$pdf ->Cell(90 ,4,'Practice Teaching',0,0);
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
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Astronomy'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'NSCI',0,0);
$pdf ->Cell(15 ,4,'412',0,0);
$pdf ->Cell(90 ,4,'Astronomy',0,0);
$pdf ->Cell(10 ,4,'3','B',0);
$pdf ->Cell(10 ,4,'0','B',0);
$pdf ->Cell(10 ,4,'3','B',0);
$pdf ->Cell(20 ,4,'NSCI 223/324',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'NSCI',0,0);
$pdf ->Cell(15 ,4,'412',0,0);
$pdf ->Cell(90 ,4,'Astronomy',0,0);
$pdf ->Cell(10 ,4,'3','B',0);
$pdf ->Cell(10 ,4,'0','B',0);
$pdf ->Cell(10 ,4,'3','B',0);
$pdf ->Cell(20 ,4,'NSCI 223/324',0,1);
}}


$pdf ->Cell(20 ,5,'',0,0);

$pdf->SetFont('Arial','B','10');
$pdf ->Cell(20 ,5,'',0,0);
$pdf ->Cell(94 ,6,'TOTAL',0,0,'C');
$pdf ->Cell(11 ,6,'6',0,0);
$pdf ->Cell(9 ,6,'6',0,0);
$pdf ->Cell(10 ,6,'12',0,1);
$pdf ->Cell(180 ,6,'',0,1);



$pdf ->Cell(10 ,5,'',0,0);
$pdf ->Cell(45 ,5,'Fourth Year, Second Semester',0,1);

$pdf->SetFont('Arial','','10');
// SUBJECTS
$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Philosophy of Man with Logic'");
if(mysqli_num_rows($squery1)== 0){
$pdf->SetFont('Arial','','10');
$pdf ->Cell(5 ,4,'',0,1);
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'PHIL',0,0);
$pdf ->Cell(15 ,4,'421',0,0);
$pdf ->Cell(90 ,4,'Philosophy of Man with Logic',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,1);
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'PHIL',0,0);
$pdf ->Cell(15 ,4,'421',0,0);
$pdf ->Cell(90 ,4,'Philosophy of Man with Logic',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(20 ,4,'',0,1);
}}



$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Social Dimension of Education'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'EDUC',0,0);
$pdf ->Cell(15 ,4,'421',0,0);
$pdf ->Cell(90 ,4,'Social Dimension of Education',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);

} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'EDUC',0,0);
$pdf ->Cell(15 ,4,'421',0,0);
$pdf ->Cell(90 ,4,'Social Dimension of Education',0,0);
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
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Special Topics in Education 3'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'EDUC',0,0);
$pdf ->Cell(15 ,4,'422',0,0);
$pdf ->Cell(90 ,4,'Special Topics in Education 3',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(20 ,4,'EDUC 324',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'EDUC',0,0);
$pdf ->Cell(15 ,4,'422',0,0);
$pdf ->Cell(90 ,4,'Special Topics in Education 3',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'1',0,0);
$pdf ->Cell(20 ,4,'EDUC 324',0,1);
}}

$squery1 = mysqli_query($con, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, subjects_tbl.subj_code, subjects_tbl.subj_desc, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Math of Investment'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'MATH',0,0);
$pdf ->Cell(15 ,4,'421',0,0);
$pdf ->Cell(90 ,4,'Math of Investment',0,0);
$pdf ->Cell(10 ,4,'3',0,0);
$pdf ->Cell(10 ,4,'0',0,0);
$pdf ->Cell(10 ,4,'3',0,1);

} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'MATH',0,0);
$pdf ->Cell(15 ,4,'421',0,0);
$pdf ->Cell(90 ,4,'Math of Investment',0,0);
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
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_GET['stud_id']."' AND subj_desc = 'Modern Physics'");
if(mysqli_num_rows($squery1)== 0){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,'','B',0);
$pdf ->Cell(15 ,4,'NSCI',0,0);
$pdf ->Cell(15 ,4,'422',0,0);
$pdf ->Cell(90 ,4,'Modern Physics',0,0);
$pdf ->Cell(10 ,4,'4','B',0);
$pdf ->Cell(10 ,4,'1','B',0);
$pdf ->Cell(10 ,4,'5','B',0);
$pdf ->Cell(20 ,4,'NSCI 325',0,1);
} else {
   while ($row1= mysqli_fetch_array($squery1)){
$pdf ->Cell(5 ,4,'',0,0);
$pdf ->Cell(10 ,4,$row1['ofgrade'],'B',0);
$pdf ->Cell(15 ,4,'NSCI',0,0);
$pdf ->Cell(15 ,4,'422',0,0);
$pdf ->Cell(90 ,4,'Modern Physics',0,0);
$pdf ->Cell(10 ,4,'4','B',0);
$pdf ->Cell(10 ,4,'1','B',0);
$pdf ->Cell(10 ,4,'5','B',0);
$pdf ->Cell(20 ,4,'NSCI 325',0,1);
}}



$pdf ->Cell(20 ,5,'',0,0);

$pdf->SetFont('Arial','B','10');
$pdf ->Cell(20 ,5,'',0,0);
$pdf ->Cell(94 ,6,'TOTAL',0,0,'C');
$pdf ->Cell(11 ,6,'14',0,0);
$pdf ->Cell(9 ,6,'1',0,0);
$pdf ->Cell(10 ,6,'15',0,1);
$pdf ->Cell(180 ,6,'',0,1);







$pdf ->Cell(20 ,5,'',0,1);
$pdf ->Cell(20 ,5,'',0,1);

$pdf->SetFont('Arial','B','10');
$pdf ->Cell(20 ,4,'',0,0);
$pdf ->Cell(94 ,4,'TOTAL NUMBER OF UNITS',0,0,'C');
$pdf ->Cell(11 ,4,'',0,0);
$pdf ->Cell(9 ,4,'',0,0);
$pdf ->Cell(10 ,4,'190','B',1,1);
$pdf ->Cell(20 ,4,'',0,0);
$pdf ->Cell(94 ,4,'',0,0,'C');
$pdf ->Cell(11 ,4,'',0,0);
$pdf ->Cell(9 ,4,'',0,0);
$pdf ->Cell(10 ,1,'','B',1,1);


$pdf ->Cell(20 ,5,'',0,1);
$pdf ->Cell(20 ,5,'',0,1);




$pdf ->Output();
?>
