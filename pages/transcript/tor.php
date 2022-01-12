<?php
require ('../fpdf/fpdf.php');
include '../../includes/db.php';

    // $server = 'localhost';
    // $username = 'root';
    // $password = '';
    // $db = 'enrollment';

    // $db = new mysqli($server, $username, $password, $db);

    date_default_timezone_set('Asia/Manila');

//get invoices data
$query = mysqli_query($db,"SELECT * FROM tbl_students LEFT JOIN tbl_genders ON tbl_genders.gender_id = tbl_students.gender_id
    where stud_id = '".$_GET['stud_id']."'");
    $row = mysqli_fetch_array($query);


       
             

class PDF extends FPDF
{

// Page header
function Header()
{   
    // Logo(x axis, y axis, height, width)
    $this->Image('../../img/logo.png',18,3,19,19);
    // font(font type,style,font size)
    $this->SetFont('Arial','B',30);
    $this->SetTextColor(255,0,0);
    // Dummy cell
    $this->Cell(50);
    // //cell(width,height,text,border,end line,[align])
    $this->Cell(110,5,'Saint Francis of Assisi College',0,0,'C');
    // Line break
    $this->Ln(7);
    $this->SetTextColor(0,0,0);
    $this->SetFont('Arial','B',10);
    // dummy cell
    $this->Cell(50);
    // //cell(width,height,text,border,end line,[align])
    $this->Cell(90,3,'96 Bayanan, City of Bacoor, Cavite',0,0,'C');
    // Line break
    $this->Ln(15);
    $this->SetFont('Arial','B',13);
    // //cell(width,height,text,border,end line,[align])
    $this->Cell(190,4,'OFFICE OF THE COLLEGE REGISTRAR',0,0,'C');
    // Line break
    $this->Ln(8);
    $this->SetFont('Arial','B',18);
    // //cell(width,height,text,border,end line,[align])
    $this->Cell(190,8,'OFFICIAL TRANSCRIPT OF RECORDS',0,0,'C');
    // Line break
    $this->Ln(15);
}


// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-25);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    $this->SetTextColor(255,0,0);
    // Page number
    $this->Cell(0,5,'Note: Any erasure or alteration on this transcript of records invalidates the whole document.',0,1,'C');
    $this->SetFont('Arial','',8);
    $this->SetTextColor(0,0,0);
    $this->Cell(0,5,'mbm\''.date('y').'',0,0,'R');
}


}


$pdf = new PDF('P','mm','Legal');
//left top right
$pdf->SetMargins(10,10,10);
$pdf ->AddPage();

$pdf->Image('nama.png',3,3,210);
//cell(width,height,text,border,end line,[align])
//STUDENT NAME/GENDER
$pdf ->Ln(3);
$pdf->SetFont('Arial','','10');
$pdf ->Cell(15 ,5,'Name:',0,0); 
$pdf->SetFont('Arial','B','12');
$pdf ->Cell(44 ,5,$row['lastname'],'B',0,'');
$pdf ->Cell(44 ,5,$row['firstname'],'B',0,'');
$pdf ->Cell(43 ,5,$row['middlename'],'B',0,'');
$pdf->SetFont('Arial','','10');
$pdf ->Cell(17 ,5,'Gender:',0,0);
$pdf->SetFont('Arial','B','12');
$pdf ->Cell(35 ,5,$row['gender'],'B',1,'C'); //end of line

$pdf ->Ln(1);
$pdf ->Cell(15 ,3,'',0,0); 
$pdf->SetFont('Arial','','8');
$pdf ->Cell(44 ,3,'lastname',0,0);
$pdf ->Cell(44 ,3,'First Name',0,0);
$pdf ->Cell(43 ,3,'Middle Name',0,1);

$pdf ->Cell(20 ,3,'',0,1);
//BIRTHDATE/BIRTHPLACE
$pdf->SetFont('Arial','','10');
$pdf ->Cell(23 ,5,'Date of Birth:',0,0); 
$pdf->SetFont('Arial','B','12');
$pdf ->Cell(80 ,5,$row['birthdate'],'B',0,'C');
$pdf->SetFont('Arial','','10');
$pdf ->Cell(25 ,5,'Place of Birth:',0,0);
$pdf->SetFont('Arial','B','12');
$pdf ->Cell(70 ,5,$row['birthplace'],'B',1,'C'); //end of line;

$pdf ->Cell(20 ,3,'',0,1);
//FATHER/MOTHER
$pdf->SetFont('Arial','','10');
$pdf ->Cell(15 ,5,'Father:',0,0); 
$pdf->SetFont('Arial','B','12');
$pdf ->Cell(84 ,5,$row['flastname'].', '.$row['ffirstname'].' '.$row['fmiddlename'] ,'B',0,'C');
$pdf->SetFont('Arial','','10');
$pdf ->Cell(15 ,5,'Mother:',0,0);
$pdf->SetFont('Arial','B','12');
$pdf ->Cell(84 ,5,$row['mlastname'].', '.$row['mfirstname'].' '.$row['mmiddlename'] ,'B',1,'C'); //end of line;

$pdf ->Cell(20 ,3,'',0,1);
//ADDRESS
$pdf->SetFont('Arial','','10');
$pdf ->Cell(35 ,5,'Permanent Address:',0,0); 
$pdf->SetFont('Arial','B','12');
$pdf ->Cell(163 ,5,$row['address'],'B',1,'C');

$pdf ->Cell(20 ,3,'',0,1);
//ADMISSION
$pdf->SetFont('Arial','','10');
$pdf ->Cell(33 ,5,'Date of Admission:',0,0); 
$pdf->SetFont('Arial','B','12');
$pdf ->Cell(64 ,5,'','B',0,'C');
$pdf->SetFont('Arial','','10');
$pdf ->Cell(37 ,5,'Admission Credential:',0,0);
$pdf->SetFont('Arial','B','12');
$pdf ->Cell(64 ,5,'','B',1,'C'); //end of line;

$pdf ->Cell(20 ,3,'',0,1);
//HIGHSCHOOL & ACADYEAR
$pdf->SetFont('Arial','','10');
$pdf ->Cell(47 ,5,'Highschool Graduated From:',0,0); 
$pdf->SetFont('Arial','B','10');
$pdf ->Cell(94 ,5,$row['hs'],'B',0,'C');
$pdf->SetFont('Arial','','10');
$pdf ->Cell(27 ,5,'Academic Year:',0,0);
$pdf->SetFont('Arial','B','12');
$pdf ->Cell(30 ,5,'','B',1,'C'); //end of line;

$pdf ->Cell(20 ,3,'',0,1);
//CHED & STUD NO
$pdf->SetFont('Arial','','10');
$pdf ->Cell(36 ,5,'CHED Special Order:',0,0); 
$pdf->SetFont('Arial','B','12');
$pdf ->Cell(94 ,5,'CHED','B',0,'C');
$pdf->SetFont('Arial','','10');
$pdf ->Cell(35 ,5,'Student CourseNo.:',0,0);
$pdf->SetFont('Arial','B','12');
$pdf ->Cell(33 ,5,$row['stud_no'],'B',1,'C'); //end of line;

$pdf ->Cell(20 ,3,'',0,1);
//DEGREE/TITLE & DATE GRADUATED
$pdf->SetFont('Arial','','10');
$pdf ->Cell(38 ,5,'Degree/Title Obtained:',0,0); 
$pdf->SetFont('Arial','B','12');
$pdf ->Cell(97 ,5,'CHED','B',0,'C');
$pdf->SetFont('Arial','','10');
$pdf ->Cell(30 ,5,'Date Graduated:',0,0);
$pdf->SetFont('Arial','B','12');
$pdf ->Cell(33 ,5,'','B',1,'C'); //END STUDENT DETAILS;

$pdf ->Cell(190 ,3,'',0,1);


//BOX
$pdf->SetFont('Arial','B','10');
$pdf ->Cell(45 ,7,'GRADING SYSTEM','L,T,R',1,'C');
$pdf->SetFont('Arial','','7');
$pdf ->Cell(45 ,1,'','L,R',1);
$pdf ->Cell(22 ,4,'1.00 - 100','L',0);
$pdf ->Cell(23 ,4,'= Outstanding','R',1);
$pdf ->Cell(22 ,4,'1.25 - 98-99','L',0);
$pdf ->Cell(23 ,4,'= Excellent','R',1);
$pdf ->Cell(22 ,4,'1.50 - 96-97','L',0);
$pdf ->Cell(23 ,4,'= Very Superior','R',1);
$pdf ->Cell(22 ,4,'1.75 - 93-95','L',0);
$pdf ->Cell(23 ,4,'= Superior','R',1);
$pdf ->Cell(22 ,4,'2.00 - 88-92','L',0);
$pdf ->Cell(23 ,4,'= Very Good','R',1);
$pdf ->Cell(22 ,4,'2.25 - 85-87','L',0);
$pdf ->Cell(23 ,4,'= Good','R',1);
$pdf ->Cell(22 ,4,'2.50 - 83-84','L',0);
$pdf ->Cell(23 ,4,'= Fair','R',1);
$pdf ->Cell(22 ,4,'2.75 - 80-82-','L',0);
$pdf ->Cell(23 ,4,'= Satisfactory','R',1);
$pdf ->Cell(22 ,4,'3.00 - 75-79','L',0);
$pdf ->Cell(23 ,4,'= Passed','R',1);
$pdf ->Cell(22 ,4,'5.00 Below 74','L',0);
$pdf ->Cell(23 ,4,'= Failed','R',1);
$pdf ->Cell(20 ,4,'NE','L',0);
$pdf ->Cell(25 ,4,'= No Exam','R',1);
$pdf ->Cell(20 ,4,'OD','L',0);
$pdf ->Cell(25 ,4,'= Officially Dropped','R',1);
$pdf ->Cell(20 ,4,'INC','L',0);
$pdf ->Cell(25 ,4,'= Incomplete','R',1);
$pdf ->Cell(45 ,1,'','L,R',1);
$pdf->SetFont('Arial','B','8');
$pdf ->Cell(45 ,4,'Note: Effective A.Y. 2003-2004','L,B,R',1,'C');

$pdf->SetFont('Arial','','7');
$pdf ->Cell(45 ,5,'','L,R',1,'');
$pdf ->Cell(45 ,4,'','L,R',1);
$pdf ->Cell(45 ,4,'Prepared by:','L,R',1);
$pdf ->Cell(45 ,4,'','L,R',1,'');
$pdf ->Cell(45 ,4,'','L,R',1);
$pdf ->Cell(45 ,4,'','L,R',1);
$pdf->SetFont('Arial','B','9');
$pdf ->Cell(45 ,5,'MARILYN B. MONTIFALCON','L,R',1);
$pdf->SetFont('Arial','','7');
$pdf ->Cell(45 ,4,'College Evaluator','L,R',1);
$pdf ->Cell(10 ,4,'Date:','L',0);
$pdf ->Cell(30 ,4,Date('F d Y'),'B',0);
$pdf ->Cell(5 ,4,'','R',1);
$pdf ->Cell(45 ,4,'','L,R',1);
$pdf ->Cell(45 ,4,'','L,R',1);
$pdf ->Cell(45 ,4,'','L,R',1);
$pdf ->Cell(45 ,4,'','L,R',1);
$pdf ->Cell(45 ,4,'','L,R',1);
$pdf ->Cell(45 ,4,'','L,B,R',1);

$pdf ->Cell(45 ,2,'','L,R',1);
$pdf ->Cell(45 ,4,'Remarks:','L,R',1);
$pdf ->Cell(3 ,4,'','L');
$pdf ->Cell(39 ,4,'','B');
$pdf ->Cell(3 ,4,'','R',1);
$pdf ->Cell(3 ,4,'','L');
$pdf ->Cell(39 ,4,'','B');
$pdf ->Cell(3 ,4,'','R',1);
$pdf ->Cell(3 ,4,'','L');
$pdf ->Cell(39 ,4,'','B');
$pdf ->Cell(3 ,4,'','R',1);
$pdf ->Cell(3 ,4,'','L');
$pdf ->Cell(39 ,4,'','B');
$pdf ->Cell(3 ,4,'','R',1);
$pdf ->Cell(3 ,4,'','L');
$pdf ->Cell(39 ,4,'','B');
$pdf ->Cell(3 ,4,'','R',1);
$pdf ->Cell(3 ,4,'','L');
$pdf ->Cell(39 ,4,'','B');
$pdf ->Cell(3 ,4,'','R',1);
$pdf ->Cell(3 ,4,'','L');
$pdf ->Cell(39 ,4,'','B');
$pdf ->Cell(3 ,4,'','R',1);
$pdf ->Cell(3 ,4,'','L');
$pdf ->Cell(39 ,4,'','B');
$pdf ->Cell(3 ,4,'','R',1);
$pdf ->Cell(3 ,4,'','L');
$pdf ->Cell(39 ,4,'','B');
$pdf ->Cell(3 ,4,'','R',1);
$pdf ->Cell(45 ,1,'','L,R,B',1);

$pdf ->Cell(45 ,5,'','L,R',1);
$pdf ->Cell(45 ,5,'','L,R',1);
$pdf ->Cell(45 ,5,'Not valid without','L,R',1,'C');
$pdf ->Cell(45 ,5,'the college seal','L,R',1,'C');
$pdf ->Cell(45 ,5,'','L,R',1);
$pdf ->Cell(45 ,5,'','L,R,B',1);

$pdf ->Rect(55 ,133,25, 151);
$pdf ->Rect(80 ,133,97, 151);
$pdf ->Rect(177 ,133,18, 151);
$pdf ->Rect(195 ,133,12, 151);

$pdf ->SetXY(55,126);

$pdf->SetFont('Arial','B','8');
$pdf ->Cell(25 ,7,'Course Code','1',0,'C');
$pdf ->Cell(97 ,7,'Descriptive Title of Subjects','1',0,'C');
$pdf ->Cell(18 ,7,'Final Grade','1',0,'C');
$pdf ->Cell(12 ,7,'Credits','1',1,'C');

$pdf ->SetXY(55,284);
$pdf ->Cell(25 ,4,'Note:','L',0,'C');
$pdf ->Cell(127 ,4,'','R',1,'C');
$pdf ->SetXY(55,288);
$pdf ->Cell(152 ,4,'','R',1,'C');
$pdf ->SetXY(55,292);
$pdf ->Cell(152 ,4,'','R,B',1,'C');

$pdf ->SetXY(55,133);
// ==============================================FOR TRANSFEREE==============================================

// $sy=mysqli_query($db,"SELECT * from tbl_schoolyears left join tbl_year_levels on tbl_schoolyears.year_id=tbl_year_levels.year_id where stud_id='$_GET[stud_id]' and year_level='1st Year' and sem_id='First Semester' ")or die(mysqli_error($db));
// $syrow=mysqli_fetch_array($sy);

// $squery = mysqli_query($db, "SELECT * ,CONCAT(tbl_students.lastname, ', ', tbl_students.firstname, ' ', tbl_students.middlename)  as fullname,   tbl_subjects_new.subj_code, tbl_subjects_new.subj_desc, tbl_enrolled_subjects.numgrade
//           FROM tbl_enrolled_subjects
//           LEFT JOIN tbl_students ON tbl_students.stud_id = tbl_enrolled_subjects.stud_id
//           LEFT JOIN tbl_subjects_new ON tbl_subjects_new.subj_id = tbl_enrolled_subjects.subj_id WHERE tbl_students.stud_id = '$_GET[stud_id]'  AND semester = '".$syrow['sem_id']."' and acad_year = '".$syrow['ay_id']."' ")or die(mysqli_error($db));
//            $y = 5;
//             $yy = $pdf->Gety();
//               if (mysqli_num_rows($squery) >= 1) 
//               {
//                 $pdf ->SetXY(55,$yy);        
//                       $pdf->SetFont('Arial','B','10');
//                       $pdf ->Cell(152 ,5,'First Year, First Semester '.$syrow['ay_id'].'',0,0,'C');
//                 while($row2 = mysqli_fetch_array($squery))
//                   {
                      
                    
//                         $pdf ->SetXY(55,$yy+$y);
//                         $pdf->SetFont('Arial','','10');
//                         $pdf ->Cell(25 ,5,$row2['subj_code'],0,0);
//                         $pdf ->Cell(97 ,5,$row2['subj_desc'],0,0);
//                         $pdf ->Cell(18 ,5,$row2['numgrade'],0,0,'C');
//                         $pdf ->Cell(12 ,5,$row2['unit_total'],0,1,'C');
//                         $y += 5;
                      
//                   }
//               }
//             else
//               {
//                 $sy=mysqli_query($db,"SELECT * from tbl_schoolyears left join tbl_year_levels on tbl_schoolyears.year_id=tbl_year_levels.year_id where stud_id='$_GET[stud_id]' and year_level='1st Year' and sem_id='Second Semester' ")or die(mysqli_error($db));
// $syrow=mysqli_fetch_array($sy);

// $squery = mysqli_query($db, "SELECT * ,CONCAT(tbl_students.lastname, ', ', tbl_students.firstname, ' ', tbl_students.middlename)  as fullname,   tbl_subjects_new.subj_code, tbl_subjects_new.subj_desc, tbl_enrolled_subjects.numgrade
//           FROM tbl_enrolled_subjects
//           LEFT JOIN tbl_students ON tbl_students.stud_id = tbl_enrolled_subjects.stud_id
//           LEFT JOIN tbl_subjects_new ON tbl_subjects_new.subj_id = tbl_enrolled_subjects.subj_id WHERE tbl_students.stud_id = '$_GET[stud_id]'  AND semester = '".$syrow['sem_id']."' and acad_year = '".$syrow['ay_id']."' ")or die(mysqli_error($db));
//            $y = 5;
//             $yy = $pdf->Gety();
//               if (mysqli_num_rows($squery) >= 1) 
//               {
//                 $pdf ->SetXY(55,$yy);        
//                       $pdf->SetFont('Arial','B','10');
//                       $pdf ->Cell(152 ,5,'First Year, Second Semester '.$syrow['ay_id'].'',0,0,'C');
//                 while($row2 = mysqli_fetch_array($squery))
//                   {
                      
                    
//                         $pdf ->SetXY(55,$yy+$y);
//                         $pdf->SetFont('Arial','','10');
//                         $pdf ->Cell(25 ,5,$row2['subj_code'],0,0);
//                         $pdf ->Cell(97 ,5,$row2['subj_desc'],0,0);
//                         $pdf ->Cell(18 ,5,$row2['numgrade'],0,0,'C');
//                         $pdf ->Cell(12 ,5,$row2['unit_total'],0,1,'C');
//                         $y += 5;
                      
//                   }
//               }else{
//                   $sy=mysqli_query($db,"SELECT * from tbl_schoolyears left join tbl_year_levels on tbl_schoolyears.year_id=tbl_year_levels.year_id where stud_id='$_GET[stud_id]' and year_level='2nd Year' and sem_id='First Semester' ")or die(mysqli_error($db));
// $syrow=mysqli_fetch_array($sy);

// $squery = mysqli_query($db, "SELECT * ,CONCAT(tbl_students.lastname, ', ', tbl_students.firstname, ' ', tbl_students.middlename)  as fullname,   tbl_subjects_new.subj_code, tbl_subjects_new.subj_desc, tbl_enrolled_subjects.numgrade
//           FROM tbl_enrolled_subjects
//           LEFT JOIN tbl_students ON tbl_students.stud_id = tbl_enrolled_subjects.stud_id
//           LEFT JOIN tbl_subjects_new ON tbl_subjects_new.subj_id = tbl_enrolled_subjects.subj_id WHERE tbl_students.stud_id = '$_GET[stud_id]'  AND semester = '".$syrow['sem_id']."' and acad_year = '".$syrow['ay_id']."' ")or die(mysqli_error($db));
//            $y = 5;
//             $yy = $pdf->Gety();
//               if (mysqli_num_rows($squery) >= 1) 
//               {
//                 $pdf ->SetXY(55,$yy);        
//                       $pdf->SetFont('Arial','B','10');
//                       $pdf ->Cell(152 ,5,'Second Year, First Semester '.$syrow['ay_id'].'',0,0,'C');
//                 while($row2 = mysqli_fetch_array($squery))
//                   {
                      
                    
//                         $pdf ->SetXY(55,$yy+$y);
//                         $pdf->SetFont('Arial','','10');
//                         $pdf ->Cell(25 ,5,$row2['subj_code'],0,0);
//                         $pdf ->Cell(97 ,5,$row2['subj_desc'],0,0);
//                         $pdf ->Cell(18 ,5,$row2['numgrade'],0,0,'C');
//                         $pdf ->Cell(12 ,5,$row2['unit_total'],0,1,'C');
//                         $y += 5;
                      
//                   }
//               }else{
//                 $sy=mysqli_query($db,"SELECT * from tbl_schoolyears left join tbl_year_levels on tbl_schoolyears.year_id=tbl_year_levels.year_id where stud_id='$_GET[stud_id]' and year_level='2nd Year' and sem_id='Second Semester' ")or die(mysqli_error($db));
// $syrow=mysqli_fetch_array($sy);

// $squery = mysqli_query($db, "SELECT * ,CONCAT(tbl_students.lastname, ', ', tbl_students.firstname, ' ', tbl_students.middlename)  as fullname,   tbl_subjects_new.subj_code, tbl_subjects_new.subj_desc, tbl_enrolled_subjects.numgrade
//           FROM tbl_enrolled_subjects
//           LEFT JOIN tbl_students ON tbl_students.stud_id = tbl_enrolled_subjects.stud_id
//           LEFT JOIN tbl_subjects_new ON tbl_subjects_new.subj_id = tbl_enrolled_subjects.subj_id WHERE tbl_students.stud_id = '$_GET[stud_id]'  AND semester = '".$syrow['sem_id']."' and acad_year = '".$syrow['ay_id']."' ")or die(mysqli_error($db));
//            $y = 5;
//             $yy = $pdf->Gety();
//               if (mysqli_num_rows($squery) >= 1) 
//               {
//                 $pdf ->SetXY(55,$yy);        
//                       $pdf->SetFont('Arial','B','10');
//                       $pdf ->Cell(152 ,5,'Second Year, Second Semester '.$syrow['ay_id'].'',0,0,'C');
//                 while($row2 = mysqli_fetch_array($squery))
//                   {
                      
                    
//                         $pdf ->SetXY(55,$yy+$y);
//                         $pdf->SetFont('Arial','','10');
//                         $pdf ->Cell(25 ,5,$row2['subj_code'],0,0);
//                         $pdf ->Cell(97 ,5,$row2['subj_desc'],0,0);
//                         $pdf ->Cell(18 ,5,$row2['numgrade'],0,0,'C');
//                         $pdf ->Cell(12 ,5,$row2['unit_total'],0,1,'C');
//                         $y += 5;
                      
//                   }
//               }else{
//                 $sy=mysqli_query($db,"SELECT * from tbl_schoolyears left join tbl_year_levels on tbl_schoolyears.year_id=tbl_year_levels.year_id where stud_id='$_GET[stud_id]' and year_level='3rd Year' and sem_id='First Semester' ")or die(mysqli_error($db));
// $syrow=mysqli_fetch_array($sy);

// $squery = mysqli_query($db, "SELECT * ,CONCAT(tbl_students.lastname, ', ', tbl_students.firstname, ' ', tbl_students.middlename)  as fullname,   tbl_subjects_new.subj_code, tbl_subjects_new.subj_desc, tbl_enrolled_subjects.numgrade
//           FROM tbl_enrolled_subjects
//           LEFT JOIN tbl_students ON tbl_students.stud_id = tbl_enrolled_subjects.stud_id
//           LEFT JOIN tbl_subjects_new ON tbl_subjects_new.subj_id = tbl_enrolled_subjects.subj_id WHERE tbl_students.stud_id = '$_GET[stud_id]'  AND semester = '".$syrow['sem_id']."' and acad_year = '".$syrow['ay_id']."' ")or die(mysqli_error($db));
//            $y = 5;
//             $yy = $pdf->Gety();
//               if (mysqli_num_rows($squery) >= 1) 
//               {
//                 $pdf ->SetXY(55,$yy);        
//                       $pdf->SetFont('Arial','B','10');
//                       $pdf ->Cell(152 ,5,'Third Year, First Semester '.$syrow['ay_id'].'',0,0,'C');
//                 while($row2 = mysqli_fetch_array($squery))
//                   {
                      
                    
//                         $pdf ->SetXY(55,$yy+$y);
//                         $pdf->SetFont('Arial','','10');
//                         $pdf ->Cell(25 ,5,$row2['subj_code'],0,0);
//                         $pdf ->Cell(97 ,5,$row2['subj_desc'],0,0);
//                         $pdf ->Cell(18 ,5,$row2['numgrade'],0,0,'C');
//                         $pdf ->Cell(12 ,5,$row2['unit_total'],0,1,'C');
//                         $y += 5;
                      
//                   }
//               }else{
//                 $sy=mysqli_query($db,"SELECT * from tbl_schoolyears left join tbl_year_levels on tbl_schoolyears.year_id=tbl_year_levels.year_id where stud_id='$_GET[stud_id]' and year_level='3rd Year' and sem_id='Second Semester' ")or die(mysqli_error($db));
// $syrow=mysqli_fetch_array($sy);

// $squery = mysqli_query($db, "SELECT * ,CONCAT(tbl_students.lastname, ', ', tbl_students.firstname, ' ', tbl_students.middlename)  as fullname,   tbl_subjects_new.subj_code, tbl_subjects_new.subj_desc, tbl_enrolled_subjects.numgrade
//           FROM tbl_enrolled_subjects
//           LEFT JOIN tbl_students ON tbl_students.stud_id = tbl_enrolled_subjects.stud_id
//           LEFT JOIN tbl_subjects_new ON tbl_subjects_new.subj_id = tbl_enrolled_subjects.subj_id WHERE tbl_students.stud_id = '$_GET[stud_id]'  AND semester = '".$syrow['sem_id']."' and acad_year = '".$syrow['ay_id']."' ")or die(mysqli_error($db));
//            $y = 5;
//             $yy = $pdf->Gety();
//               if (mysqli_num_rows($squery) >= 1) 
//               {
//                 $pdf ->SetXY(55,$yy);        
//                       $pdf->SetFont('Arial','B','10');
//                       $pdf ->Cell(152 ,5,'Third Year, Second Semester '.$syrow['ay_id'].'',0,0,'C');
//                 while($row2 = mysqli_fetch_array($squery))
//                   {
                      
                    
//                         $pdf ->SetXY(55,$yy+$y);
//                         $pdf->SetFont('Arial','','10');
//                         $pdf ->Cell(25 ,5,$row2['subj_code'],0,0);
//                         $pdf ->Cell(97 ,5,$row2['subj_desc'],0,0);
//                         $pdf ->Cell(18 ,5,$row2['numgrade'],0,0,'C');
//                         $pdf ->Cell(12 ,5,$row2['unit_total'],0,1,'C');
//                         $y += 5;
                      
//                   }
//               }else{
//                 $sy=mysqli_query($db,"SELECT * from tbl_schoolyears left join tbl_year_levels on tbl_schoolyears.year_id=tbl_year_levels.year_id where stud_id='$_GET[stud_id]' and year_level='4th Year' and sem_id='First Semester' ")or die(mysqli_error($db));
// $syrow=mysqli_fetch_array($sy);

// $squery = mysqli_query($db, "SELECT * ,CONCAT(tbl_students.lastname, ', ', tbl_students.firstname, ' ', tbl_students.middlename)  as fullname,   tbl_subjects_new.subj_code, tbl_subjects_new.subj_desc, tbl_enrolled_subjects.numgrade
//           FROM tbl_enrolled_subjects
//           LEFT JOIN tbl_students ON tbl_students.stud_id = tbl_enrolled_subjects.stud_id
//           LEFT JOIN tbl_subjects_new ON tbl_subjects_new.subj_id = tbl_enrolled_subjects.subj_id WHERE tbl_students.stud_id = '$_GET[stud_id]'  AND semester = '".$syrow['sem_id']."' and acad_year = '".$syrow['ay_id']."' ")or die(mysqli_error($db));
//            $y = 5;
//             $yy = $pdf->Gety();
//               if (mysqli_num_rows($squery) >= 1) 
//               {
//                 $pdf ->SetXY(55,$yy);        
//                       $pdf->SetFont('Arial','B','10');
//                       $pdf ->Cell(152 ,5,'Fourth Year, First Semester '.$syrow['ay_id'].'',0,0,'C');
//                 while($row2 = mysqli_fetch_array($squery))
//                   {
                      
                    
//                         $pdf ->SetXY(55,$yy+$y);
//                         $pdf->SetFont('Arial','','10');
//                         $pdf ->Cell(25 ,5,$row2['subj_code'],0,0);
//                         $pdf ->Cell(97 ,5,$row2['subj_desc'],0,0);
//                         $pdf ->Cell(18 ,5,$row2['numgrade'],0,0,'C');
//                         $pdf ->Cell(12 ,5,$row2['unit_total'],0,1,'C');
//                         $y += 5;
                      
//                   }
//               }else{
//                 $sy=mysqli_query($db,"SELECT * from tbl_schoolyears left join tbl_year_levels on tbl_schoolyears.year_id=tbl_year_levels.year_id where stud_id='$_GET[stud_id]' and year_level='2nd Year' and sem_id='Second Semester' ")or die(mysqli_error($db));
// $syrow=mysqli_fetch_array($sy);

// $squery = mysqli_query($db, "SELECT * ,CONCAT(tbl_students.lastname, ', ', tbl_students.firstname, ' ', tbl_students.middlename)  as fullname,   tbl_subjects_new.subj_code, tbl_subjects_new.subj_desc, tbl_enrolled_subjects.numgrade
//           FROM tbl_enrolled_subjects
//           LEFT JOIN tbl_students ON tbl_students.stud_id = tbl_enrolled_subjects.stud_id
//           LEFT JOIN tbl_subjects_new ON tbl_subjects_new.subj_id = tbl_enrolled_subjects.subj_id WHERE tbl_students.stud_id = '$_GET[stud_id]'  AND semester = '".$syrow['sem_id']."' and acad_year = '".$syrow['ay_id']."' ")or die(mysqli_error($db));
//            $y = 5;
//             $yy = $pdf->Gety();
//               if (mysqli_num_rows($squery) >= 1) 
//               {
//                 $pdf ->SetXY(55,$yy);        
//                       $pdf->SetFont('Arial','B','10');
//                       $pdf ->Cell(152 ,5,'Fourth Year, Second Semester '.$syrow['ay_id'].'',0,0,'C');
//                 while($row2 = mysqli_fetch_array($squery))
//                   {
                      
                    
//                         $pdf ->SetXY(55,$yy+$y);
//                         $pdf->SetFont('Arial','','10');
//                         $pdf ->Cell(25 ,5,$row2['subj_code'],0,0);
//                         $pdf ->Cell(97 ,5,$row2['subj_desc'],0,0);
//                         $pdf ->Cell(18 ,5,$row2['numgrade'],0,0,'C');
//                         $pdf ->Cell(12 ,5,$row2['unit_total'],0,1,'C');
//                         $y += 5;
                      
//                   }
//               }else{
//                 $pdf ->SetXY(55,$yy);
//                 $pdf->SetFont('Arial','B','10');
//                 $pdf ->Cell(152 ,5,'SFAC*****************************nothing follows*****************************SFAC',0,0,'C');
//               }//else 4 2

//               }//else 4 1

//               }//else 3 2

//               }//else 3 1

//               }//else 2 2

//               }//else 2 1

//               }//else 1st year 2 sem

//               }//else of mother IF statement


                $sy=mysqli_query($db,"SELECT * from tbl_schoolyears left join tbl_year_levels on tbl_schoolyears.year_id=tbl_year_levels.year_id where stud_id='$_GET[stud_id]' and year_level='1st Year' and sem_id='Second Semester' ")or die(mysqli_error($db));
$syrow=mysqli_fetch_array($sy);

$squery = mysqli_query($db, "SELECT * ,CONCAT(tbl_students.lastname, ', ', tbl_students.firstname, ' ', tbl_students.middlename)  as fullname,   tbl_subjects_new.subj_code, tbl_subjects_new.subj_desc, tbl_enrolled_subjects.numgrade
          FROM tbl_enrolled_subjects
          LEFT JOIN tbl_students ON tbl_students.stud_id = tbl_enrolled_subjects.stud_id
          LEFT JOIN tbl_subjects_new ON tbl_subjects_new.subj_id = tbl_enrolled_subjects.subj_id WHERE tbl_students.stud_id = '$_GET[stud_id]'  AND semester = '".$syrow['sem_id']."' and acad_year = '".$syrow['ay_id']."' ")or die(mysqli_error($db));
           $y = 5;
            $yy = $pdf->Gety();
              if (mysqli_num_rows($squery) >= 1) 
              {
                $pdf ->SetXY(55,$yy);        
                      $pdf->SetFont('Arial','B','10');
                      $pdf ->Cell(152 ,5,'First Year, Second Semester '.$syrow['ay_id'].'',0,0,'C');
                while($row2 = mysqli_fetch_array($squery))
                  {
                      
                    
                        $pdf ->SetXY(55,$yy+$y);
                        $pdf->SetFont('Arial','','10');
                        $pdf ->Cell(25 ,5,$row2['subj_code'],0,0);
                        $pdf ->Cell(97 ,5,$row2['subj_desc'],0,0);
                        $pdf ->Cell(18 ,5,$row2['numgrade'],0,0,'C');
                        $pdf ->Cell(12 ,5,$row2['unit_total'],0,1,'C');
                        $y += 5;
                      
                  }
              }else{
                  $sy=mysqli_query($db,"SELECT * from tbl_schoolyears left join tbl_year_levels on tbl_schoolyears.year_id=tbl_year_levels.year_id where stud_id='$_GET[stud_id]' and year_level='2nd Year' and sem_id='First Semester' ")or die(mysqli_error($db));
$syrow=mysqli_fetch_array($sy);

$squery = mysqli_query($db, "SELECT * ,CONCAT(tbl_students.lastname, ', ', tbl_students.firstname, ' ', tbl_students.middlename)  as fullname,   tbl_subjects_new.subj_code, tbl_subjects_new.subj_desc, tbl_enrolled_subjects.numgrade
          FROM tbl_enrolled_subjects
          LEFT JOIN tbl_students ON tbl_students.stud_id = tbl_enrolled_subjects.stud_id
          LEFT JOIN tbl_subjects_new ON tbl_subjects_new.subj_id = tbl_enrolled_subjects.subj_id WHERE tbl_students.stud_id = '$_GET[stud_id]'  AND semester = '".$syrow['sem_id']."' and acad_year = '".$syrow['ay_id']."' ")or die(mysqli_error($db));
           $y = 5;
            $yy = $pdf->Gety();
              if (mysqli_num_rows($squery) >= 1) 
              {
                $pdf ->SetXY(55,$yy);        
                      $pdf->SetFont('Arial','B','10');
                      $pdf ->Cell(152 ,5,'Second Year, First Semester '.$syrow['ay_id'].'',0,0,'C');
                while($row2 = mysqli_fetch_array($squery))
                  {
                      
                    
                        $pdf ->SetXY(55,$yy+$y);
                        $pdf->SetFont('Arial','','10');
                        $pdf ->Cell(25 ,5,$row2['subj_code'],0,0);
                        $pdf ->Cell(97 ,5,$row2['subj_desc'],0,0);
                        $pdf ->Cell(18 ,5,$row2['numgrade'],0,0,'C');
                        $pdf ->Cell(12 ,5,$row2['unit_total'],0,1,'C');
                        $y += 5;
                      
                  }
              }else{
                $sy=mysqli_query($db,"SELECT * from tbl_schoolyears left join tbl_year_levels on tbl_schoolyears.year_id=tbl_year_levels.year_id where stud_id='$_GET[stud_id]' and year_level='2nd Year' and sem_id='Second Semester' ")or die(mysqli_error($db));
$syrow=mysqli_fetch_array($sy);

$squery = mysqli_query($db, "SELECT * ,CONCAT(tbl_students.lastname, ', ', tbl_students.firstname, ' ', tbl_students.middlename)  as fullname,   tbl_subjects_new.subj_code, tbl_subjects_new.subj_desc, tbl_enrolled_subjects.numgrade
          FROM tbl_enrolled_subjects
          LEFT JOIN tbl_students ON tbl_students.stud_id = tbl_enrolled_subjects.stud_id
          LEFT JOIN tbl_subjects_new ON tbl_subjects_new.subj_id = tbl_enrolled_subjects.subj_id WHERE tbl_students.stud_id = '$_GET[stud_id]'  AND semester = '".$syrow['sem_id']."' and acad_year = '".$syrow['ay_id']."' ")or die(mysqli_error($db));
           $y = 5;
            $yy = $pdf->Gety();
              if (mysqli_num_rows($squery) >= 1) 
              {
                $pdf ->SetXY(55,$yy);        
                      $pdf->SetFont('Arial','B','10');
                      $pdf ->Cell(152 ,5,'Second Year, Second Semester '.$syrow['ay_id'].'',0,0,'C');
                while($row2 = mysqli_fetch_array($squery))
                  {
                      
                    
                        $pdf ->SetXY(55,$yy+$y);
                        $pdf->SetFont('Arial','','10');
                        $pdf ->Cell(25 ,5,$row2['subj_code'],0,0);
                        $pdf ->Cell(97 ,5,$row2['subj_desc'],0,0);
                        $pdf ->Cell(18 ,5,$row2['numgrade'],0,0,'C');
                        $pdf ->Cell(12 ,5,$row2['unit_total'],0,1,'C');
                        $y += 5;
                      
                  }
              }else{
                $sy=mysqli_query($db,"SELECT * from tbl_schoolyears left join tbl_year_levels on tbl_schoolyears.year_id=tbl_year_levels.year_id where stud_id='$_GET[stud_id]' and year_level='3rd Year' and sem_id='First Semester' ")or die(mysqli_error($db));
$syrow=mysqli_fetch_array($sy);

$squery = mysqli_query($db, "SELECT * ,CONCAT(tbl_students.lastname, ', ', tbl_students.firstname, ' ', tbl_students.middlename)  as fullname,   tbl_subjects_new.subj_code, tbl_subjects_new.subj_desc, tbl_enrolled_subjects.numgrade
          FROM tbl_enrolled_subjects
          LEFT JOIN tbl_students ON tbl_students.stud_id = tbl_enrolled_subjects.stud_id
          LEFT JOIN tbl_subjects_new ON tbl_subjects_new.subj_id = tbl_enrolled_subjects.subj_id WHERE tbl_students.stud_id = '$_GET[stud_id]'  AND semester = '".$syrow['sem_id']."' and acad_year = '".$syrow['ay_id']."' ")or die(mysqli_error($db));
           $y = 5;
            $yy = $pdf->Gety();
              if (mysqli_num_rows($squery) >= 1) 
              {
                $pdf ->SetXY(55,$yy);        
                      $pdf->SetFont('Arial','B','10');
                      $pdf ->Cell(152 ,5,'Third Year, First Semester '.$syrow['ay_id'].'',0,0,'C');
                while($row2 = mysqli_fetch_array($squery))
                  {
                      
                    
                        $pdf ->SetXY(55,$yy+$y);
                        $pdf->SetFont('Arial','','10');
                        $pdf ->Cell(25 ,5,$row2['subj_code'],0,0);
                        $pdf ->Cell(97 ,5,$row2['subj_desc'],0,0);
                        $pdf ->Cell(18 ,5,$row2['numgrade'],0,0,'C');
                        $pdf ->Cell(12 ,5,$row2['unit_total'],0,1,'C');
                        $y += 5;
                      
                  }
              }else{
                $sy=mysqli_query($db,"SELECT * from tbl_schoolyears left join tbl_year_levels on tbl_schoolyears.year_id=tbl_year_levels.year_id where stud_id='$_GET[stud_id]' and year_level='3rd Year' and sem_id='Second Semester' ")or die(mysqli_error($db));
$syrow=mysqli_fetch_array($sy);

$squery = mysqli_query($db, "SELECT * ,CONCAT(tbl_students.lastname, ', ', tbl_students.firstname, ' ', tbl_students.middlename)  as fullname,   tbl_subjects_new.subj_code, tbl_subjects_new.subj_desc, tbl_enrolled_subjects.numgrade
          FROM tbl_enrolled_subjects
          LEFT JOIN tbl_students ON tbl_students.stud_id = tbl_enrolled_subjects.stud_id
          LEFT JOIN tbl_subjects_new ON tbl_subjects_new.subj_id = tbl_enrolled_subjects.subj_id WHERE tbl_students.stud_id = '$_GET[stud_id]'  AND semester = '".$syrow['sem_id']."' and acad_year = '".$syrow['ay_id']."' ")or die(mysqli_error($db));
           $y = 5;
            $yy = $pdf->Gety();
              if (mysqli_num_rows($squery) >= 1) 
              {
                $pdf ->SetXY(55,$yy);        
                      $pdf->SetFont('Arial','B','10');
                      $pdf ->Cell(152 ,5,'Third Year, Second Semester '.$syrow['ay_id'].'',0,0,'C');
                while($row2 = mysqli_fetch_array($squery))
                  {
                      
                    
                        $pdf ->SetXY(55,$yy+$y);
                        $pdf->SetFont('Arial','','10');
                        $pdf ->Cell(25 ,5,$row2['subj_code'],0,0);
                        $pdf ->Cell(97 ,5,$row2['subj_desc'],0,0);
                        $pdf ->Cell(18 ,5,$row2['numgrade'],0,0,'C');
                        $pdf ->Cell(12 ,5,$row2['unit_total'],0,1,'C');
                        $y += 5;
                      
                  }
              }else{
                $sy=mysqli_query($db,"SELECT * from tbl_schoolyears left join tbl_year_levels on tbl_schoolyears.year_id=tbl_year_levels.year_id where stud_id='$_GET[stud_id]' and year_level='4th Year' and sem_id='First Semester' ")or die(mysqli_error($db));
$syrow=mysqli_fetch_array($sy);

$squery = mysqli_query($db, "SELECT * ,CONCAT(tbl_students.lastname, ', ', tbl_students.firstname, ' ', tbl_students.middlename)  as fullname,   tbl_subjects_new.subj_code, tbl_subjects_new.subj_desc, tbl_enrolled_subjects.numgrade
          FROM tbl_enrolled_subjects
          LEFT JOIN tbl_students ON tbl_students.stud_id = tbl_enrolled_subjects.stud_id
          LEFT JOIN tbl_subjects_new ON tbl_subjects_new.subj_id = tbl_enrolled_subjects.subj_id WHERE tbl_students.stud_id = '$_GET[stud_id]'  AND semester = '".$syrow['sem_id']."' and acad_year = '".$syrow['ay_id']."' ")or die(mysqli_error($db));
           $y = 5;
            $yy = $pdf->Gety();
              if (mysqli_num_rows($squery) >= 1) 
              {
                $pdf ->SetXY(55,$yy);        
                      $pdf->SetFont('Arial','B','10');
                      $pdf ->Cell(152 ,5,'Fourth Year, First Semester '.$syrow['ay_id'].'',0,0,'C');
                while($row2 = mysqli_fetch_array($squery))
                  {
                      
                    
                        $pdf ->SetXY(55,$yy+$y);
                        $pdf->SetFont('Arial','','10');
                        $pdf ->Cell(25 ,5,$row2['subj_code'],0,0);
                        $pdf ->Cell(97 ,5,$row2['subj_desc'],0,0);
                        $pdf ->Cell(18 ,5,$row2['numgrade'],0,0,'C');
                        $pdf ->Cell(12 ,5,$row2['unit_total'],0,1,'C');
                        $y += 5;
                      
                  }
              }else{
                $sy=mysqli_query($db,"SELECT * from tbl_schoolyears left join tbl_year_levels on tbl_schoolyears.year_id=tbl_year_levels.year_id where stud_id='$_GET[stud_id]' and year_level='2nd Year' and sem_id='Second Semester' ")or die(mysqli_error($db));
$syrow=mysqli_fetch_array($sy);

$squery = mysqli_query($db, "SELECT * ,CONCAT(tbl_students.lastname, ', ', tbl_students.firstname, ' ', tbl_students.middlename)  as fullname,   tbl_subjects_new.subj_code, tbl_subjects_new.subj_desc, tbl_enrolled_subjects.numgrade
          FROM tbl_enrolled_subjects
          LEFT JOIN tbl_students ON tbl_students.stud_id = tbl_enrolled_subjects.stud_id
          LEFT JOIN tbl_subjects_new ON tbl_subjects_new.subj_id = tbl_enrolled_subjects.subj_id WHERE tbl_students.stud_id = '$_GET[stud_id]'  AND semester = '".$syrow['sem_id']."' and acad_year = '".$syrow['ay_id']."' ")or die(mysqli_error($db));
           $y = 5;
            $yy = $pdf->Gety();
              if (mysqli_num_rows($squery) >= 1) 
              {
                $pdf ->SetXY(55,$yy);        
                      $pdf->SetFont('Arial','B','10');
                      $pdf ->Cell(152 ,5,'Fourth Year, Second Semester '.$syrow['ay_id'].'',0,0,'C');
                while($row2 = mysqli_fetch_array($squery))
                  {
                      
                    
                        $pdf ->SetXY(55,$yy+$y);
                        $pdf->SetFont('Arial','','10');
                        $pdf ->Cell(25 ,5,$row2['subj_code'],0,0);
                        $pdf ->Cell(97 ,5,$row2['subj_desc'],0,0);
                        $pdf ->Cell(18 ,5,$row2['numgrade'],0,0,'C');
                        $pdf ->Cell(12 ,5,$row2['unit_total'],0,1,'C');
                        $y += 5;
                      
                  }
              }else{
                $pdf ->SetXY(55,$yy);
                $pdf->SetFont('Arial','B','10');
                $pdf ->Cell(152 ,5,'SFAC*****************************nothing follows*****************************SFAC',0,0,'C');
              }//else 4 2
              
              }//else 4 1

              }//else 3 2

              }//else 3 1

              }//else 2 2

              }//else 2 1

              }//else 1st year 2 sem



$pdf ->Output();
?>