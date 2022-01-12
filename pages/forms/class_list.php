<?php
require ('../fpdf/fpdf.php');
include '../../includes/session.php';





class PDF extends FPDF
{

// Page header

function Header()
{   
    include '../../includes/db.php';
    // Logo(x axis, y axis, height, width)
    $this->Image('../../img/logo.png',27,3,19,19);
    // font(font type,style,font size)
    $this->SetFont('Times','B',28);
    $this->SetTextColor(255,0,0);
    // Dummy cell
    $this->Cell(50);
    // //cell(width,height,text,border,end line,[align])
    $this->Cell(110,5,'Saint Francis of Assisi College',0,0,'C');
    // Line break
    $this->Ln(9);
    $this->SetTextColor(0,0,0);
    $this->SetFont('Arial','',10);
    // dummy cell
    
    // //cell(width,height,text,border,end line,[align])
    $this->Cell(0,3,'#96 Bayanan, City of Bacoor, Cavite',0,0,'C');
    // Line break
    $this->Ln(4);
    $this->SetFont('Arial','B',12);
    // //cell(width,height,text,border,end line,[align])
    $this->Cell(0,4,'COLLEGE DEPARTMENT',0,0,'C');
    // Line break
    $this->Ln(8);
    $this->SetFont('Arial','B',14);
    // //cell(width,height,text,border,end line,[align])
    $this->Cell(0,6,'CLASS LIST',0,1,'C');
    $this->SetFont('Arial','B',10);
    $this->Cell(0,4,$_SESSION['active_sem'].' '.$_SESSION['active_acad'],0,1,'C');

    $this->Ln(3);
$que3 =mysqli_num_rows(mysqli_query($db,
    "SELECT *,tbl_students.img,CONCAT(tbl_students.lastname, ', ', tbl_students.firstname, ' ', tbl_students.middlename)  AS fullname 
    FROM tbl_enrolled_subjects 
    LEFT JOIN tbl_subjects ON tbl_subjects.subj_id = tbl_enrolled_subjects.subj_id
    LEFT JOIN tbl_students ON tbl_students.stud_id = tbl_enrolled_subjects.stud_id
    LEFT JOIN tbl_courses ON tbl_courses.course_id = tbl_students.course_id
    LEFT JOIN tbl_schedules_old ON tbl_schedules_old.class_id = tbl_enrolled_subjects.class_id
    LEFT JOIN tbl_faculties_staff ON tbl_faculties_staff.faculty_id = tbl_schedules_old.faculty_id
    WHERE tbl_enrolled_subjects.acad_year = '$_SESSION[active_acad]' 
    AND tbl_enrolled_subjects.semester='$_SESSION[active_sem]' 
    AND tbl_subjects.subj_code = '$_GET[code]' 
    AND tbl_schedules_old.section = '$_GET[section]'
    And tbl_enrolled_subjects.enroll_status = 'Approved'
    
    UNION 
    SELECT *,tbl_students.img,CONCAT(tbl_students.lastname, ', ', tbl_students.firstname, ' ', tbl_students.middlename)  as fullname 
    FROM tbl_enrolled_subjects 
    LEFT JOIN tbl_subjects_new ON tbl_subjects_new.subj_id = tbl_enrolled_subjects.subj_id
    LEFT JOIN tbl_students ON tbl_students.stud_id = tbl_enrolled_subjects.stud_id
    LEFT JOIN tbl_courses ON tbl_courses.course_id = tbl_students.course_id
    LEFT JOIN tbl_schedules ON tbl_schedules.class_id = tbl_enrolled_subjects.class_id
    LEFT JOIN tbl_faculties_staff ON tbl_faculties_staff.faculty_id = tbl_schedules.faculty_id 
    WHERE tbl_enrolled_subjects.acad_year = '$_SESSION[active_acad]' 
    AND tbl_enrolled_subjects.semester='$_SESSION[active_sem]' 
    AND tbl_subjects_new.subj_code = '$_GET[code]' 
    AND tbl_schedules.section = '$_GET[section]'
    And tbl_enrolled_subjects.enroll_status = 'Approved' 
    "));

$qwer = mysqli_fetch_array(mysqli_query($db,
    "SELECT * 
    FROM tbl_schedules 
    LEFT JOIN tbl_subjects_new ON tbl_subjects_new.subj_id = tbl_schedules.subj_id 
    WHERE class_code = '$_GET[code]' and section = '$_GET[section]' and tbl_schedules.acad_year = '$_SESSION[active_acad]' and tbl_schedules.semester = '$_SESSION[active_sem]'
    UNION 
    SELECT * 
    FROM tbl_schedules_old 
    LEFT JOIN tbl_subjects ON tbl_subjects.subj_id = tbl_schedules_old.subj_id 
    WHERE class_code = '$_GET[code]' and section = '$_GET[section]' and tbl_schedules_old.acad_year = '$_SESSION[active_acad]' and tbl_schedules_old.semester = '$_SESSION[active_sem]'"));

$this->SetFont('Arial','','11');
$this->Cell(25,5,'Course Code:',0,0);
$this->Cell(23,5,$_GET['code'],'B',0,'C');
$this->Cell(23,5,'Course Title:',0,0);
$fontsize = 11;
            $tempFontSize = $fontsize;
            $cellwidth = 77;
            while ($this->GetStringWidth($qwer['subj_desc']) > $cellwidth){
                $this->SetFontSize($tempFontSize -= 0.1);}
$this->Cell(77,5,$qwer['subj_desc'],'B',0,'C');
$this->SetFont('Arial','','11');
$this->Cell(25,5,'No. of Units:',0,0);
$this->Cell(22,5,$qwer['unit_total'],'B',1,'C');

$this->Cell(51,5,'Schedule (Time/Day/Room):',0,0);
$this->Cell(102,5,$qwer['time'].' / '.$qwer['day'].' / '.$qwer['room'],'B',0,'C');
$this->Cell(20,5,'Class Size:',0,0);
$this->Cell(22,5,$que3,'B',1,'C');


$this->SetXY(10,81.7);
$this->SetFont('Arial','B','14');
$this->Cell(9,10,'',1,0,'C');
$this->Cell(100,10,'Name',1,0,'C');
$this->Cell(60,10,'Program',1,0,'C');
$this->Cell(0,10,'Year Level',1,1,'C');

$this->Rect(10,96.7,8.87,5);
$this->Rect(18.87,96.7,100,5);
$this->Rect(118.87,96.7,60,5);
$this->Rect(178.87,96.7,27,5);



$this->Rect(10,101.7,8.87,5);
$this->Rect(18.87,101.7,100,5);
$this->Rect(118.87,101.7,60,5);
$this->Rect(178.87,101.7,27,5);




$this->Rect(10,106.7,8.87,5);
$this->Rect(18.87,106.7,100,5);
$this->Rect(118.87,106.7,60,5);
$this->Rect(178.87,106.7,27,5);




$this->Rect(10,111.7,8.87,5);
$this->Rect(18.87,111.7,100,5);
$this->Rect(118.87,111.7,60,5);
$this->Rect(178.87,111.7,27,5);




$this->Rect(10,116.7,8.87,5);
$this->Rect(18.87,116.7,100,5);
$this->Rect(118.87,116.7,60,5);
$this->Rect(178.87,116.7,27,5);




$this->Rect(10,121.7,8.87,5);
$this->Rect(18.87,121.7,100,5);
$this->Rect(118.87,121.7,60,5);
$this->Rect(178.87,121.7,27,5);



//77777777777777777777777777777777777777777777777777777777777777777777777777777777777777777777777777777777777
$this->Rect(10,126.7,8.87,5);
$this->Rect(18.87,126.7,100,5);
$this->Rect(118.87,126.7,60,5);
$this->Rect(178.87,126.7,27,5);




$this->Rect(10,131.7,8.87,5);
$this->Rect(18.87,131.7,100,5);
$this->Rect(118.87,131.7,60,5);
$this->Rect(178.87,131.7,27,5);




$this->Rect(10,136.7,8.87,5);
$this->Rect(18.87,136.7,100,5);
$this->Rect(118.87,136.7,60,5);
$this->Rect(178.87,136.7,27,5);




$this->Rect(10,141.7,8.87,5);
$this->Rect(18.87,141.7,100,5);
$this->Rect(118.87,141.7,60,5);
$this->Rect(178.87,141.7,27,5);




$this->Rect(10,146.7,8.87,5);
$this->Rect(18.87,146.7,100,5);
$this->Rect(118.87,146.7,60,5);
$this->Rect(178.87,146.7,27,5);




$this->Rect(10,151.7,8.87,5);
$this->Rect(18.87,151.7,100,5);
$this->Rect(118.87,151.7,60,5);
$this->Rect(178.87,151.7,27,5);




$this->Rect(10,156.7,8.87,5);
$this->Rect(18.87,156.7,100,5);
$this->Rect(118.87,156.7,60,5);
$this->Rect(178.87,156.7,27,5);




$this->Rect(10,161.7,8.87,5);
$this->Rect(18.87,161.7,100,5);
$this->Rect(118.87,161.7,60,5);
$this->Rect(178.87,161.7,27,5);




$this->Rect(10,166.7,8.87,5);
$this->Rect(18.87,166.7,100,5);
$this->Rect(118.87,166.7,60,5);
$this->Rect(178.87,166.7,27,5);




$this->Rect(10,171.7,8.87,5);
$this->Rect(18.87,171.7,100,5);
$this->Rect(118.87,171.7,60,5);
$this->Rect(178.87,171.7,27,5);




$this->Rect(10,176.7,8.87,5);
$this->Rect(18.87,176.7,100,5);
$this->Rect(118.87,176.7,60,5);
$this->Rect(178.87,176.7,27,5);



$this->Rect(10,181.7,8.87,5);
$this->Rect(18.87,181.7,100,5);
$this->Rect(118.87,181.7,60,5);
$this->Rect(178.87,181.7,27,5);




$this->Rect(10,186.7,8.87,5);
$this->Rect(18.87,186.7,100,5);
$this->Rect(118.87,186.7,60,5);
$this->Rect(178.87,186.7,27,5);




$this->Rect(10,191.7,8.87,5);
$this->Rect(18.87,191.7,100,5);
$this->Rect(118.87,191.7,60,5);
$this->Rect(178.87,191.7,27,5);




$this->Rect(10,196.7,8.87,5);
$this->Rect(18.87,196.7,100,5);
$this->Rect(118.87,196.7,60,5);
$this->Rect(178.87,196.7,27,5);




$this->Rect(10,201.7,8.87,5);
$this->Rect(18.87,201.7,100,5);
$this->Rect(118.87,201.7,60,5);
$this->Rect(178.87,201.7,27,5);




$this->Rect(10,206.7,8.87,5);
$this->Rect(18.87,206.7,100,5);
$this->Rect(118.87,206.7,60,5);
$this->Rect(178.87,206.7,27,5);




$this->Rect(10,211.7,8.87,5);
$this->Rect(18.87,211.7,100,5);
$this->Rect(118.87,211.7,60,5);
$this->Rect(178.87,211.7,27,5);




$this->Rect(10,216.7,8.87,5);
$this->Rect(18.87,216.7,100,5);
$this->Rect(118.87,216.7,60,5);
$this->Rect(178.87,216.7,27,5);




$this->Rect(10,221.7,8.87,5);
$this->Rect(18.87,221.7,100,5);
$this->Rect(118.87,221.7,60,5);
$this->Rect(178.87,221.7,27,5);




$this->Rect(10,226.7,8.87,5);
$this->Rect(18.87,226.7,100,5);
$this->Rect(118.87,226.7,60,5);
$this->Rect(178.87,226.7,27,5);




$this->Rect(10,231.7,8.87,5);
$this->Rect(18.87,231.7,100,5);
$this->Rect(118.87,231.7,60,5);
$this->Rect(178.87,231.7,27,5);




$this->Rect(10,236.7,8.87,5);
$this->Rect(18.87,236.7,100,5);
$this->Rect(118.87,236.7,60,5);
$this->Rect(178.87,236.7,27,5);



    

}


// Page footer
function Footer()
{include '../../includes/db.php';
    // Position at 1.5 cm from bottom
    $this->Rect(10,241.7,196.72,70);
$sql = mysqli_query($db,"SELECT *,CONCAT(tbl_faculties_staff.faculty_firstname, ' ', tbl_faculties_staff.faculty_middlename, ' ', tbl_faculties_staff.faculty_lastname)  AS fullname FROM tbl_faculties_staff where faculty_id = '$_SESSION[userid]'");
    $row = mysqli_fetch_array($sql);

$this->SetXY(10,255);
$this->SetFontSize(8);
$this->Cell(20,5,'Prepared by:',0,0);
$this->SetFont('Arial','B','10');
$this->Cell(50,5,$row['fullname'],'B',0,'C');//=====================PROFESSOR NAME=================
$this->Cell(5,5,'',0,0);
$this->Cell(30,5,date('M d, Y'),'B',1,'C');

$this->SetFont('Arial','','8');
$this->Cell(20,5,'',0,0);
$this->Cell(50,5,'Professor / Instructor',0,0,'C');
$this->Cell(5,5,'',0,0);
$this->Cell(30,5,'Date',0,1,'C');

$this->Cell(120,5,'',0,0);
$this->Cell(50,5,'Verified by:',0,0);

$this->Ln(10);

$this->Cell(20,5,'Checked by:',0,0);
$this->SetFont('Arial','B','10');
$this->Cell(50,5,'Dr. Santos T. Castillo, Jr.','B',0,'C');//=================ACADEMIC HEAD=================
$this->SetFont('Arial','','8');
$this->Cell(5,5,'',0,0);
$this->Cell(30,5,'','B',0);
$this->Cell(15,5,'',0,0);
$this->SetFont('Arial','B','10');
$this->Cell(50,5,'Aries Roldan','B',1,'C');//=========================REGISTRAR NAME====================
$this->SetFont('Arial','','8');
$this->Cell(20,5,'',0,0);
$this->Cell(50,5,'Campus Director, College Dean',0,0,'C');
$this->Cell(5,5,'',0,0);
$this->Cell(30,5,'Date',0,0,'C');
$this->Cell(15,5,'',0,0);
$this->Cell(50,5,'College Registrar',0,1);

$this->Ln(10);

$this->Cell(20,5,'Received by:',0,0);
$this->SetFont('Arial','B','10');
$this->Cell(50,5,'Marilyn Montefalcon','B',0,'C');//=================RECORD VERIFIER=================
$this->SetFont('Arial','','8');
$this->Cell(5,5,'',0,0);
$this->Cell(30,5,'','B',0);
$this->Cell(5,5,'',0,1);


$this->Cell(20,4,'',0,0);
$this->Cell(50,4,'Record Verifier',0,0,'C');
$this->Cell(5,4,'',0,0);
$this->Cell(30,4,'Date',0,0,'C');
$this->Cell(5,4,'',0,1);

$this->Cell(20,4,'',0,0);
$this->SetFont('Arial','I','7');
$this->Cell(50,4,'(Signature over printed name)',0,0,'C');
$this->Cell(5,5,'',0,0);
$this->Cell(30,4,'',0,0);
$this->Cell(15,4,'',0,0);
$this->Cell(0,4,'Note: PLEASE READ ALL THE INSTRUCTIONS CAREFULLY AT',0,1);
$this->Cell(120,4,'',0,0);
$this->Cell(0,4,'THE BACK BEFORE ACCOMPLISHING THIS FORM.',0,0,'C');
}


}

$pdf = new PDF('P','mm','Legal');
//left top right
$pdf->SetMargins(10,10,10);
$pdf ->AddPage();
// $pdf->SetAutoPageBreak(true,112);


// $pdf->Ln(3);
// $que3 =mysqli_num_rows(mysqli_query($db,"SELECT *,tbl_students.img,CONCAT(tbl_students.lastname, ', ', tbl_students.firstname, ' ', tbl_students.middlename)  as fullname FROM tbl_enrolled_subjects 
// LEFT JOIN tbl_subjects ON tbl_subjects.subj_id = tbl_enrolled_subjects.subj_id
// LEFT JOIN tbl_students ON tbl_students.stud_id = tbl_enrolled_subjects.stud_id
// LEFT JOIN tbl_courses ON tbl_courses.course_id = tbl_students.course_id
// LEFT JOIN tbl_schedules_old ON tbl_schedules_old.class_id = tbl_enrolled_subjects.class_id
// LEFT JOIN tbl_faculties_staff ON tbl_faculties_staff.faculty_id = tbl_schedules_old.faculty_id WHERE tbl_enrolled_subjects.acad_year = '$_SESSION[active_acad]' AND tbl_enrolled_subjects.semester='$_SESSION[active_sem]' AND tbl_subjects.subj_code = '$_GET[code]' AND tbl_schedules_old.section = '$_GET[section]'
// UNION SELECT *,tbl_students.img,CONCAT(tbl_students.lastname, ', ', tbl_students.firstname, ' ', tbl_students.middlename)  as fullname FROM tbl_enrolled_subjects 
// LEFT JOIN tbl_subjects_new ON tbl_subjects_new.subj_id = tbl_enrolled_subjects.subj_id
// LEFT JOIN tbl_students ON tbl_students.stud_id = tbl_enrolled_subjects.stud_id
// LEFT JOIN tbl_courses ON tbl_courses.course_id = tbl_students.course_id
// LEFT JOIN tbl_schedules ON tbl_schedules.class_id = tbl_enrolled_subjects.class_id
// LEFT JOIN tbl_faculties_staff ON tbl_faculties_staff.faculty_id = tbl_schedules.faculty_id WHERE tbl_enrolled_subjects.acad_year = '$_SESSION[active_acad]' AND tbl_enrolled_subjects.semester='$_SESSION[active_sem]' AND tbl_subjects_new.subj_code = '$_GET[code]' AND tbl_schedules.section = '$_GET[section]' "));
// $pdf->SetFont('Arial','','11');
// $pdf->Cell(25,5,'Course Code:',0,0);
// $pdf->Cell(23,5,$_GET['code'],'B',0,'C');
// $pdf->Cell(23,5,'Course Title:',0,0);
// $pdf->Cell(77,5,'','B',0,'C');
// $pdf->Cell(25,5,'No. of Units:',0,0);
// $pdf->Cell(22,5,'','B',1,'C');

// $pdf->Cell(51,5,'Schedule (Time/Day/Room):',0,0);
// $pdf->Cell(102,5,'','B',0,'C');
// $pdf->Cell(20,5,'Class Size:',0,0);
// $pdf->Cell(22,5,$que3,'B',1,'C');

// $pdf->Image('../../img/rog.PNG',10,57,197,40);


// $pdf->Rect(10,96.7,8.87,5);
// $pdf->Rect(18.87,96.7,100,5);
// $pdf->Rect(72.17,96.7,23.43,5);
// $pdf->Rect(95.6,96.7,10.43,5);
// $pdf->Rect(106.03,96.7,9.63,5);
// $pdf->Rect(115.66,96.7,10.45,5);
// $pdf->Rect(126.11,96.7,9.35,5);
// $pdf->Rect(135.46,96.7,11.75,5);
// $pdf->Rect(147.21,96.7,14.9,5);
// $pdf->Rect(162.11,96.7,44.55,5);

// $pdf->Rect(10,101.7,8.87,5);
// $pdf->Rect(18.87,101.7,100,5);
// $pdf->Rect(72.17,101.7,23.43,5);
// $pdf->Rect(95.6,101.7,10.43,5);
// $pdf->Rect(106.03,101.7,9.63,5);
// $pdf->Rect(115.66,101.7,10.45,5);
// $pdf->Rect(126.11,101.7,9.35,5);
// $pdf->Rect(135.46,101.7,11.75,5);
// $pdf->Rect(147.21,101.7,14.9,5);
// $pdf->Rect(162.11,101.7,44.55,5);

// $pdf->Rect(10,106.7,8.87,5);
// $pdf->Rect(18.87,106.7,100,5);
// $pdf->Rect(72.17,106.7,23.43,5);
// $pdf->Rect(95.6,106.7,10.43,5);
// $pdf->Rect(106.03,106.7,9.63,5);
// $pdf->Rect(115.66,106.7,10.45,5);
// $pdf->Rect(126.11,106.7,9.35,5);
// $pdf->Rect(135.46,106.7,11.75,5);
// $pdf->Rect(147.21,106.7,14.9,5);
// $pdf->Rect(162.11,106.7,44.55,5);

// $pdf->Rect(10,111.7,8.87,5);
// $pdf->Rect(18.87,111.7,100,5);
// $pdf->Rect(72.17,111.7,23.43,5);
// $pdf->Rect(95.6,111.7,10.43,5);
// $pdf->Rect(106.03,111.7,9.63,5);
// $pdf->Rect(115.66,111.7,10.45,5);
// $pdf->Rect(126.11,111.7,9.35,5);
// $pdf->Rect(135.46,111.7,11.75,5);
// $pdf->Rect(147.21,111.7,14.9,5);
// $pdf->Rect(162.11,111.7,44.55,5);

// $pdf->Rect(10,116.7,8.87,5);
// $pdf->Rect(18.87,116.7,100,5);
// $pdf->Rect(72.17,116.7,23.43,5);
// $pdf->Rect(95.6,116.7,10.43,5);
// $pdf->Rect(106.03,116.7,9.63,5);
// $pdf->Rect(115.66,116.7,10.45,5);
// $pdf->Rect(126.11,116.7,9.35,5);
// $pdf->Rect(135.46,116.7,11.75,5);
// $pdf->Rect(147.21,116.7,14.9,5);
// $pdf->Rect(162.11,116.7,44.55,5);

// $pdf->Rect(10,121.7,8.87,5);
// $pdf->Rect(18.87,121.7,100,5);
// $pdf->Rect(72.17,121.7,23.43,5);
// $pdf->Rect(95.6,121.7,10.43,5);
// $pdf->Rect(106.03,121.7,9.63,5);
// $pdf->Rect(115.66,121.7,10.45,5);
// $pdf->Rect(126.11,121.7,9.35,5);
// $pdf->Rect(135.46,121.7,11.75,5);
// $pdf->Rect(147.21,121.7,14.9,5);
// $pdf->Rect(162.11,121.7,44.55,5);
// //77777777777777777777777777777777777777777777777777777777777777777777777777777777777777777777777777777777777
// $pdf->Rect(10,126.7,8.87,5);
// $pdf->Rect(18.87,126.7,100,5);
// $pdf->Rect(72.17,126.7,23.43,5);
// $pdf->Rect(95.6,126.7,10.43,5);
// $pdf->Rect(106.03,126.7,9.63,5);
// $pdf->Rect(115.66,126.7,10.45,5);
// $pdf->Rect(126.11,126.7,9.35,5);
// $pdf->Rect(135.46,126.7,11.75,5);
// $pdf->Rect(147.21,126.7,14.9,5);
// $pdf->Rect(162.11,126.7,44.55,5);

// $pdf->Rect(10,131.7,8.87,5);
// $pdf->Rect(18.87,131.7,100,5);
// $pdf->Rect(72.17,131.7,23.43,5);
// $pdf->Rect(95.6,131.7,10.43,5);
// $pdf->Rect(106.03,131.7,9.63,5);
// $pdf->Rect(115.66,131.7,10.45,5);
// $pdf->Rect(126.11,131.7,9.35,5);
// $pdf->Rect(135.46,131.7,11.75,5);
// $pdf->Rect(147.21,131.7,14.9,5);
// $pdf->Rect(162.11,131.7,44.55,5);

// $pdf->Rect(10,136.7,8.87,5);
// $pdf->Rect(18.87,136.7,100,5);
// $pdf->Rect(72.17,136.7,23.43,5);
// $pdf->Rect(95.6,136.7,10.43,5);
// $pdf->Rect(106.03,136.7,9.63,5);
// $pdf->Rect(115.66,136.7,10.45,5);
// $pdf->Rect(126.11,136.7,9.35,5);
// $pdf->Rect(135.46,136.7,11.75,5);
// $pdf->Rect(147.21,136.7,14.9,5);
// $pdf->Rect(162.11,136.7,44.55,5);

// $pdf->Rect(10,141.7,8.87,5);
// $pdf->Rect(18.87,141.7,100,5);
// $pdf->Rect(72.17,141.7,23.43,5);
// $pdf->Rect(95.6,141.7,10.43,5);
// $pdf->Rect(106.03,141.7,9.63,5);
// $pdf->Rect(115.66,141.7,10.45,5);
// $pdf->Rect(126.11,141.7,9.35,5);
// $pdf->Rect(135.46,141.7,11.75,5);
// $pdf->Rect(147.21,141.7,14.9,5);
// $pdf->Rect(162.11,141.7,44.55,5);

// $pdf->Rect(10,146.7,8.87,5);
// $pdf->Rect(18.87,146.7,100,5);
// $pdf->Rect(72.17,146.7,23.43,5);
// $pdf->Rect(95.6,146.7,10.43,5);
// $pdf->Rect(106.03,146.7,9.63,5);
// $pdf->Rect(115.66,146.7,10.45,5);
// $pdf->Rect(126.11,146.7,9.35,5);
// $pdf->Rect(135.46,146.7,11.75,5);
// $pdf->Rect(147.21,146.7,14.9,5);
// $pdf->Rect(162.11,146.7,44.55,5);

// $pdf->Rect(10,151.7,8.87,5);
// $pdf->Rect(18.87,151.7,100,5);
// $pdf->Rect(72.17,151.7,23.43,5);
// $pdf->Rect(95.6,151.7,10.43,5);
// $pdf->Rect(106.03,151.7,9.63,5);
// $pdf->Rect(115.66,151.7,10.45,5);
// $pdf->Rect(126.11,151.7,9.35,5);
// $pdf->Rect(135.46,151.7,11.75,5);
// $pdf->Rect(147.21,151.7,14.9,5);
// $pdf->Rect(162.11,151.7,44.55,5);

// $pdf->Rect(10,156.7,8.87,5);
// $pdf->Rect(18.87,156.7,100,5);
// $pdf->Rect(72.17,156.7,23.43,5);
// $pdf->Rect(95.6,156.7,10.43,5);
// $pdf->Rect(106.03,156.7,9.63,5);
// $pdf->Rect(115.66,156.7,10.45,5);
// $pdf->Rect(126.11,156.7,9.35,5);
// $pdf->Rect(135.46,156.7,11.75,5);
// $pdf->Rect(147.21,156.7,14.9,5);
// $pdf->Rect(162.11,156.7,44.55,5);

// $pdf->Rect(10,161.7,8.87,5);
// $pdf->Rect(18.87,161.7,100,5);
// $pdf->Rect(72.17,161.7,23.43,5);
// $pdf->Rect(95.6,161.7,10.43,5);
// $pdf->Rect(106.03,161.7,9.63,5);
// $pdf->Rect(115.66,161.7,10.45,5);
// $pdf->Rect(126.11,161.7,9.35,5);
// $pdf->Rect(135.46,161.7,11.75,5);
// $pdf->Rect(147.21,161.7,14.9,5);
// $pdf->Rect(162.11,161.7,44.55,5);

// $pdf->Rect(10,166.7,8.87,5);
// $pdf->Rect(18.87,166.7,100,5);
// $pdf->Rect(72.17,166.7,23.43,5);
// $pdf->Rect(95.6,166.7,10.43,5);
// $pdf->Rect(106.03,166.7,9.63,5);
// $pdf->Rect(115.66,166.7,10.45,5);
// $pdf->Rect(126.11,166.7,9.35,5);
// $pdf->Rect(135.46,166.7,11.75,5);
// $pdf->Rect(147.21,166.7,14.9,5);
// $pdf->Rect(162.11,166.7,44.55,5);

// $pdf->Rect(10,171.7,8.87,5);
// $pdf->Rect(18.87,171.7,100,5);
// $pdf->Rect(72.17,171.7,23.43,5);
// $pdf->Rect(95.6,171.7,10.43,5);
// $pdf->Rect(106.03,171.7,9.63,5);
// $pdf->Rect(115.66,171.7,10.45,5);
// $pdf->Rect(126.11,171.7,9.35,5);
// $pdf->Rect(135.46,171.7,11.75,5);
// $pdf->Rect(147.21,171.7,14.9,5);
// $pdf->Rect(162.11,171.7,44.55,5);

// $pdf->Rect(10,176.7,8.87,5);
// $pdf->Rect(18.87,176.7,100,5);
// $pdf->Rect(72.17,176.7,23.43,5);
// $pdf->Rect(95.6,176.7,10.43,5);
// $pdf->Rect(106.03,176.7,9.63,5);
// $pdf->Rect(115.66,176.7,10.45,5);
// $pdf->Rect(126.11,176.7,9.35,5);
// $pdf->Rect(135.46,176.7,11.75,5);
// $pdf->Rect(147.21,176.7,14.9,5);
// $pdf->Rect(162.11,176.7,44.55,5);

// $pdf->Rect(10,181.7,8.87,5);
// $pdf->Rect(18.87,181.7,100,5);
// $pdf->Rect(72.17,181.7,23.43,5);
// $pdf->Rect(95.6,181.7,10.43,5);
// $pdf->Rect(106.03,181.7,9.63,5);
// $pdf->Rect(115.66,181.7,10.45,5);
// $pdf->Rect(126.11,181.7,9.35,5);
// $pdf->Rect(135.46,181.7,11.75,5);
// $pdf->Rect(147.21,181.7,14.9,5);
// $pdf->Rect(162.11,181.7,44.55,5);

// $pdf->Rect(10,186.7,8.87,5);
// $pdf->Rect(18.87,186.7,100,5);
// $pdf->Rect(72.17,186.7,23.43,5);
// $pdf->Rect(95.6,186.7,10.43,5);
// $pdf->Rect(106.03,186.7,9.63,5);
// $pdf->Rect(115.66,186.7,10.45,5);
// $pdf->Rect(126.11,186.7,9.35,5);
// $pdf->Rect(135.46,186.7,11.75,5);
// $pdf->Rect(147.21,186.7,14.9,5);
// $pdf->Rect(162.11,186.7,44.55,5);

// $pdf->Rect(10,191.7,8.87,5);
// $pdf->Rect(18.87,191.7,100,5);
// $pdf->Rect(72.17,191.7,23.43,5);
// $pdf->Rect(95.6,191.7,10.43,5);
// $pdf->Rect(106.03,191.7,9.63,5);
// $pdf->Rect(115.66,191.7,10.45,5);
// $pdf->Rect(126.11,191.7,9.35,5);
// $pdf->Rect(135.46,191.7,11.75,5);
// $pdf->Rect(147.21,191.7,14.9,5);
// $pdf->Rect(162.11,191.7,44.55,5);

// $pdf->Rect(10,196.7,8.87,5);
// $pdf->Rect(18.87,196.7,100,5);
// $pdf->Rect(72.17,196.7,23.43,5);
// $pdf->Rect(95.6,196.7,10.43,5);
// $pdf->Rect(106.03,196.7,9.63,5);
// $pdf->Rect(115.66,196.7,10.45,5);
// $pdf->Rect(126.11,196.7,9.35,5);
// $pdf->Rect(135.46,196.7,11.75,5);
// $pdf->Rect(147.21,196.7,14.9,5);
// $pdf->Rect(162.11,196.7,44.55,5);

// $pdf->Rect(10,201.7,8.87,5);
// $pdf->Rect(18.87,201.7,100,5);
// $pdf->Rect(72.17,201.7,23.43,5);
// $pdf->Rect(95.6,201.7,10.43,5);
// $pdf->Rect(106.03,201.7,9.63,5);
// $pdf->Rect(115.66,201.7,10.45,5);
// $pdf->Rect(126.11,201.7,9.35,5);
// $pdf->Rect(135.46,201.7,11.75,5);
// $pdf->Rect(147.21,201.7,14.9,5);
// $pdf->Rect(162.11,201.7,44.55,5);

// $pdf->Rect(10,206.7,8.87,5);
// $pdf->Rect(18.87,206.7,100,5);
// $pdf->Rect(72.17,206.7,23.43,5);
// $pdf->Rect(95.6,206.7,10.43,5);
// $pdf->Rect(106.03,206.7,9.63,5);
// $pdf->Rect(115.66,206.7,10.45,5);
// $pdf->Rect(126.11,206.7,9.35,5);
// $pdf->Rect(135.46,206.7,11.75,5);
// $pdf->Rect(147.21,206.7,14.9,5);
// $pdf->Rect(162.11,206.7,44.55,5);

// $pdf->Rect(10,211.7,8.87,5);
// $pdf->Rect(18.87,211.7,100,5);
// $pdf->Rect(72.17,211.7,23.43,5);
// $pdf->Rect(95.6,211.7,10.43,5);
// $pdf->Rect(106.03,211.7,9.63,5);
// $pdf->Rect(115.66,211.7,10.45,5);
// $pdf->Rect(126.11,211.7,9.35,5);
// $pdf->Rect(135.46,211.7,11.75,5);
// $pdf->Rect(147.21,211.7,14.9,5);
// $pdf->Rect(162.11,211.7,44.55,5);

// $pdf->Rect(10,216.7,8.87,5);
// $pdf->Rect(18.87,216.7,100,5);
// $pdf->Rect(72.17,216.7,23.43,5);
// $pdf->Rect(95.6,216.7,10.43,5);
// $pdf->Rect(106.03,216.7,9.63,5);
// $pdf->Rect(115.66,216.7,10.45,5);
// $pdf->Rect(126.11,216.7,9.35,5);
// $pdf->Rect(135.46,216.7,11.75,5);
// $pdf->Rect(147.21,216.7,14.9,5);
// $pdf->Rect(162.11,216.7,44.55,5);

// $pdf->Rect(10,221.7,8.87,5);
// $pdf->Rect(18.87,221.7,100,5);
// $pdf->Rect(72.17,221.7,23.43,5);
// $pdf->Rect(95.6,221.7,10.43,5);
// $pdf->Rect(106.03,221.7,9.63,5);
// $pdf->Rect(115.66,221.7,10.45,5);
// $pdf->Rect(126.11,221.7,9.35,5);
// $pdf->Rect(135.46,221.7,11.75,5);
// $pdf->Rect(147.21,221.7,14.9,5);
// $pdf->Rect(162.11,221.7,44.55,5);

// $pdf->Rect(10,226.7,8.87,5);
// $pdf->Rect(18.87,226.7,100,5);
// $pdf->Rect(72.17,226.7,23.43,5);
// $pdf->Rect(95.6,226.7,10.43,5);
// $pdf->Rect(106.03,226.7,9.63,5);
// $pdf->Rect(115.66,226.7,10.45,5);
// $pdf->Rect(126.11,226.7,9.35,5);
// $pdf->Rect(135.46,226.7,11.75,5);
// $pdf->Rect(147.21,226.7,14.9,5);
// $pdf->Rect(162.11,226.7,44.55,5);

// $pdf->Rect(10,231.7,8.87,5);
// $pdf->Rect(18.87,231.7,100,5);
// $pdf->Rect(72.17,231.7,23.43,5);
// $pdf->Rect(95.6,231.7,10.43,5);
// $pdf->Rect(106.03,231.7,9.63,5);
// $pdf->Rect(115.66,231.7,10.45,5);
// $pdf->Rect(126.11,231.7,9.35,5);
// $pdf->Rect(135.46,231.7,11.75,5);
// $pdf->Rect(147.21,231.7,14.9,5);
// $pdf->Rect(162.11,231.7,44.55,5);

// $pdf->Rect(10,236.7,8.87,5);
// $pdf->Rect(18.87,236.7,100,5);
// $pdf->Rect(72.17,236.7,23.43,5);
// $pdf->Rect(95.6,236.7,10.43,5);
// $pdf->Rect(106.03,236.7,9.63,5);
// $pdf->Rect(115.66,236.7,10.45,5);
// $pdf->Rect(126.11,236.7,9.35,5);
// $pdf->Rect(135.46,236.7,11.75,5);
// $pdf->Rect(147.21,236.7,14.9,5);
// $pdf->Rect(162.11,236.7,44.55,5);

// $pdf->Rect(10,241.7,8.87,5);
// $pdf->Rect(18.87,241.7,100,5);
// $pdf->Rect(72.17,241.7,23.43,5);
// $pdf->Rect(95.6,241.7,10.43,5);
// $pdf->Rect(106.03,241.7,9.63,5);
// $pdf->Rect(115.66,241.7,10.45,5);
// $pdf->Rect(126.11,241.7,9.35,5);
// $pdf->Rect(135.46,241.7,11.75,5);
// $pdf->Rect(147.21,241.7,14.9,5);
// $pdf->Rect(162.11,241.7,44.55,5);

// $pdf->Rect(10,246.7,8.87,5);
// $pdf->Rect(18.87,246.7,100,5);
// $pdf->Rect(72.17,246.7,23.43,5);
// $pdf->Rect(95.6,246.7,10.43,5);
// $pdf->Rect(106.03,246.7,9.63,5);
// $pdf->Rect(115.66,246.7,10.45,5);
// $pdf->Rect(126.11,246.7,9.35,5);
// $pdf->Rect(135.46,246.7,11.75,5);
// $pdf->Rect(147.21,246.7,14.9,5);
// $pdf->Rect(162.11,246.7,44.55,5);

// $pdf->Rect(10,246.7,196.72,70);


// $pdf->SetXY(10,255);
// $pdf->SetFontSize(8);
// $pdf->Cell(20,5,'Prepared by:',0,0);
// $pdf->Cell(50,5,'','B',0);//==============================PRFESSOR NAME==========================
// $pdf->Cell(5,5,'',0,0);
// $pdf->Cell(30,5,'','B',1);

// $pdf->Cell(20,5,'',0,0);
// $pdf->Cell(50,5,'Professor / Instructor',0,0,'C');
// $pdf->Cell(5,5,'',0,0);
// $pdf->Cell(30,5,'Date',0,1,'C');

// $pdf->Cell(120,5,'',0,0);
// $pdf->Cell(50,5,'Verified by:',0,0);

// $pdf->Ln(10);

// $pdf->Cell(20,5,'Checked by:',0,0);
// $pdf->Cell(50,5,'','B',0);//==============================ACADEMIC HEAD==============================
// $pdf->Cell(5,5,'',0,0);
// $pdf->Cell(30,5,'','B',0);
// $pdf->Cell(15,5,'',0,0);
// $pdf->Cell(50,5,'','B',1);//==============================REGISTRAR NAME=========================

// $pdf->Cell(20,5,'',0,0);
// $pdf->Cell(50,5,'Academic Head',0,0,'C');
// $pdf->Cell(5,5,'',0,0);
// $pdf->Cell(30,5,'Date',0,0,'C');
// $pdf->Cell(15,5,'',0,0);
// $pdf->Cell(50,5,'College Registrar',0,1);

// $pdf->Ln(10);

// $pdf->Cell(20,5,'Received by:',0,0);
// $pdf->Cell(50,5,'','B',0);//==============================RECORD VERIFIER==============================
// $pdf->Cell(5,5,'',0,0);
// $pdf->Cell(30,5,'','B',0);
// $pdf->Cell(5,5,'',0,1);


// $pdf->Cell(20,4,'',0,0);
// $pdf->Cell(50,4,'Record Verifier',0,0,'C');
// $pdf->Cell(5,4,'',0,0);
// $pdf->Cell(30,4,'Date',0,0,'C');
// $pdf->Cell(5,4,'',0,1);

// $pdf->Cell(20,4,'',0,0);
// $pdf->SetFont('Arial','I','7');
// $pdf->Cell(50,4,'(Signature over printed name)',0,0,'C');
// $pdf->Cell(5,5,'',0,0);
// $pdf->Cell(30,4,'',0,0);
// $pdf->Cell(15,4,'',0,0);
// $pdf->Cell(0,4,'Note: PLEASE READ ALL THE INSTRUCTIONS CAREFULLY AT',0,1);
// $pdf->Cell(120,4,'',0,0);
// $pdf->Cell(0,4,'THE BACK BEFORE ACCOMPLISHING THIS FORM.',0,0,'C');

// $pdf->SetXY(10,91.7);
// $y=$pdf->GetY();
// $xy=5;

// $pdf->SetFont('Arial','','9');
// for ($x = 1; $x <= 30; $x++) {
//     echo 
//     $pdf->SetXY(10,$y+$xy);
//     $pdf->Cell(8.98,5,$x,0,0,'C');
//     $xy+=5;
// } 
$pdf->SetFont('Arial','','11');
$pdf->SetXY(10,91.7);
$que = mysqli_query($db,
    "SELECT *,tbl_students.img,CONCAT(tbl_students.lastname, ', ', tbl_students.firstname, ' ', tbl_students.middlename)  as fullname 
    FROM tbl_enrolled_subjects 
    LEFT JOIN tbl_subjects ON tbl_subjects.subj_id = tbl_enrolled_subjects.subj_id
    LEFT JOIN tbl_students ON tbl_students.stud_id = tbl_enrolled_subjects.stud_id
    LEFT JOIN tbl_courses ON tbl_courses.course_id = tbl_students.course_id
    LEFT JOIN tbl_schedules_old ON tbl_schedules_old.class_id = tbl_enrolled_subjects.class_id
    LEFT JOIN tbl_faculties_staff ON tbl_faculties_staff.faculty_id = tbl_schedules_old.faculty_id 
    WHERE tbl_enrolled_subjects.acad_year = '$_SESSION[active_acad]' 
    AND tbl_enrolled_subjects.semester='$_SESSION[active_sem]' 
    AND tbl_subjects.subj_code = '$_GET[code]' 
    AND tbl_schedules_old.section = '$_GET[section]'

    UNION 

    SELECT *,tbl_students.img,CONCAT(tbl_students.lastname, ', ', tbl_students.firstname, ' ', tbl_students.middlename)  as fullname FROM tbl_enrolled_subjects 
    LEFT JOIN tbl_subjects_new ON tbl_subjects_new.subj_id = tbl_enrolled_subjects.subj_id
    LEFT JOIN tbl_students ON tbl_students.stud_id = tbl_enrolled_subjects.stud_id
    LEFT JOIN tbl_courses ON tbl_courses.course_id = tbl_students.course_id
    LEFT JOIN tbl_schedules ON tbl_schedules.class_id = tbl_enrolled_subjects.class_id
    LEFT JOIN tbl_faculties_staff ON tbl_faculties_staff.faculty_id = tbl_schedules.faculty_id 
    WHERE tbl_enrolled_subjects.acad_year = '$_SESSION[active_acad]' 
    AND tbl_enrolled_subjects.semester='$_SESSION[active_sem]' 
    AND tbl_subjects_new.subj_code = '$_GET[code]' 
    AND tbl_schedules.section = '$_GET[section]' 
    ORDER BY fullname");
    
    $y = $pdf->Gety();
    $xy = 5;
    $x=1;
    
while($row = mysqli_fetch_array($que)){
    $qwe = mysqli_query($db,"SELECT * FROM tbl_schoolyears LEFT JOIN tbl_year_levels ON tbl_year_levels.year_id = tbl_schoolyears.year_id where stud_id = '$row[stud_id]' AND sem_id = '$_SESSION[active_sem]' AND ay_id = '$_SESSION[active_acad]'");
        while($row1 = mysqli_fetch_array($qwe)){
            // $pdf ->SetXY(10,$y+$xy);
            $fullname = strtoupper(utf8_decode($row['fullname']));
                    # code...
            $pdf->Cell(8.98,5,$x,1,0);
            $fontsize = 11;
            $tempFontSize = $fontsize;
            $cellwidth = 98;
            while ($pdf->GetStringWidth($fullname) > $cellwidth){
                $pdf->SetFontSize($tempFontSize -= 0.1);}
            $pdf->Cell(100,5,$fullname,1,0);
            $pdf->SetFont('Arial','','11');
            $fontsize1 = 10;
            $tempFontSize2 = $fontsize1;
            $cellwidth1 = 58;
            while ($pdf->GetStringWidth($row['course_abv']) > $cellwidth1){
                $pdf->SetFontSize($tempFontSize2 -= 0.1);}
            $pdf->Cell(60,5,$row['course_abv'],1,0);
            $pdf->SetFont('Arial','','11');
            $pdf->Cell(0,5,$row1['year_abv'],1,1,'C');
            
            $xy += 5;
            $x += 1;
            if ($x == '31') {
                # code...
                $pdf->AddPage();
                $pdf->SetFont('Arial','','11');
                $pdf->SetXY(10,91.7);
                if ($x == '61') {
                # code...
                $pdf->AddPage();
                $pdf->SetFont('Arial','','11');
                $pdf->SetXY(10,91.7);

                }
            }
}}
$pdf->SetFont('Arial','B','12');
$pdf->Cell(200,5,'*********sfac****************************Nothing Follows ' . ($x-1) . ' Students****************************sfac**********',0,1,'C');
    



$pdf ->Output();
?>