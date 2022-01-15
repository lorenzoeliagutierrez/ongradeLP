<?php
include '../../includes/session.php';
include '../../includes/db.php';
?>
<!DOCTYPE html>
<html>
<!-- ============================================HEAD CSS LINKS============================================= -->
                                    <?php include '../../includes/head_css.php'; ?>
<!-- ============================================./HEAD CSS LINKS============================================= -->
<body class="hold-transition skin-red sidebar-mini">
<!-- =================================================HEADER================================================== -->
                                      <?php include '../../includes/header.php'; ?>
<!-- ================================================./HEADER================================================= -->
<!-- ================================================SIDEBAR LEFT============================================ -->
                                    <?php include '../../includes/sidebar_left.php'; ?>
<!-- ================================================./SIDEBAR LEFT============================================ -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 allign="center">CURRICULUM RESIDENCY EVALUATION</h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <div class="col-sm-12">
          <?php check_message(); ?>
            <table id="" class="table table-condensed table-striped">
                <thead>
                  <col width="80">
                  <col width="250">
                  <col width="50">
                  <col width="50">
                  <col width="80">
                  <col width="80">
                <tr>
                  <th>Subj Code</th>
                  <th>Subj Description</th>
                  <th>Total Unit</th>
                  <th>Credit Earned</th>
                  <th>Remark</th>
                  <th>Taken</th>
                </tr>
                </thead>

                <tbody>
<?php 
// $q = mysqli_query($db,"SELECT * FROM tbl_schoolyears LEFT JOIN tbl_students ON tbl_students.stud_id = tbl_schoolyears.stud_id LEFT JOIN tbl_courses ON tbl_courses.course_id = tbl_schoolyears.course_id WHERE tbl_schoolyears.stud_id = '$_GET[stud_id]'");
// while($row1 = mysqli_fetch_array($q)){
// $query = mysqli_query($db,"SELECT * FROM tbl_subjects WHERE course_id = '$row1[course_id]' AND year_id = '1' AND sem_id = '1'");
// while($row = mysqli_fetch_array($query)){
//   echo '        
//                 <tr>
//                   <td>'.$row['subj_code'].'</td>
//                   <td>'.$row['subj_desc'].'</td>
//                   <td>'.$row['unit_total'].'</td>
//                   <td></td>
//                   <td></td>
//                 </tr>';
//               }
// }
?>




                


                </tbody>
              </table>
              <table id="" class="table table-condensed table-striped">
                <thead>
                  <col width="80">
                  <col width="250">
                  <col width="50">
                  <col width="50">
                  <col width="80">
                  <col width="80">
                <h4><strong>1st Year, 1st Sem</strong></h4>
                </thead>

                <tbody>
<?php 
if ($_SESSION['userid'] != $_GET['stud_id']) {
  header("location: ../404/404.php");
}

$q = mysqli_query($db,"SELECT * FROM tbl_schoolyears LEFT JOIN tbl_students ON tbl_students.stud_id = tbl_schoolyears.stud_id LEFT JOIN tbl_courses ON tbl_courses.course_id = tbl_schoolyears.course_id WHERE tbl_schoolyears.stud_id = '$_GET[stud_id]'");
while($row1 = mysqli_fetch_array($q)){
 
    $query = mysqli_query($db,"SELECT * FROM tbl_subjects_new WHERE course_id = '$row1[course_id]' AND year_id = '1' AND sem_id = '1'");
  

while($row = mysqli_fetch_array($query)){
  echo '        
                <tr>
                  <td>'.$row['subj_code'].'</td>
                  <td>'.$row['subj_desc'].'</td>
                  <td>'.$row['unit_total'].'</td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>';
              }
}
?>




                


                </tbody>
              </table>
              <table id="" class="table table-condensed table-striped">
                <thead>
                  <col width="80">
                  <col width="250">
                  <col width="50">
                  <col width="50">
                  <col width="80">
                  <col width="80">
                <h4><strong>1st Year, 2nd Sem</strong></h4>
                </thead>

                <tbody>
<?php 
$q = mysqli_query($db,"SELECT * FROM tbl_schoolyears LEFT JOIN tbl_students ON tbl_students.stud_id = tbl_schoolyears.stud_id LEFT JOIN tbl_courses ON tbl_courses.course_id = tbl_schoolyears.course_id WHERE tbl_schoolyears.stud_id = '$_GET[stud_id]'");
while($row1 = mysqli_fetch_array($q)){

    $query = mysqli_query($db,"SELECT * FROM tbl_subjects_new WHERE course_id = '$row1[course_id]' AND year_id = '1' AND sem_id = '2'");
  
while($row = mysqli_fetch_array($query)){
  echo '        
                <tr>
                  <td>'.$row['subj_code'].'</td>
                  <td>'.$row['subj_desc'].'</td>
                  <td>'.$row['unit_total'].'</td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>';
              }
}
?>




                


                </tbody>
              </table>
              <table id="" class="table table-condensed table-striped">
                <thead>
                  <col width="80">
                  <col width="250">
                  <col width="50">
                  <col width="50">
                  <col width="80">
                  <col width="80">
                <h4><strong>2nd Year, 1st Sem</strong></h4>
                </thead>

                <tbody>
<?php 
$q = mysqli_query($db,"SELECT * FROM tbl_schoolyears LEFT JOIN tbl_students ON tbl_students.stud_id = tbl_schoolyears.stud_id LEFT JOIN tbl_courses ON tbl_courses.course_id = tbl_schoolyears.course_id WHERE tbl_schoolyears.stud_id = '$_GET[stud_id]'");
while($row1 = mysqli_fetch_array($q)){
    $query = mysqli_query($db,"SELECT * FROM tbl_subjects_new WHERE course_id = '$row1[course_id]' AND year_id = '2' AND sem_id = '1'");
  
while($row = mysqli_fetch_array($query)){
  echo '        
                <tr>
                  <td>'.$row['subj_code'].'</td>
                  <td>'.$row['subj_desc'].'</td>
                  <td>'.$row['unit_total'].'</td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>';
              }
}
?>




                


                </tbody>
              </table>
              </table>
              <table id="" class="table table-condensed table-striped">
                <thead>
                  <col width="80">
                  <col width="250">
                  <col width="50">
                  <col width="50">
                  <col width="80">
                  <col width="80">
                <h4><strong>2nd Year, 2nd Sem</strong></h4>
                </thead>

                <tbody>
<?php 
$q = mysqli_query($db,"SELECT * FROM tbl_schoolyears LEFT JOIN tbl_students ON tbl_students.stud_id = tbl_schoolyears.stud_id LEFT JOIN tbl_courses ON tbl_courses.course_id = tbl_schoolyears.course_id WHERE tbl_schoolyears.stud_id = '$_GET[stud_id]'");
while($row1 = mysqli_fetch_array($q)){
    $query = mysqli_query($db,"SELECT * FROM tbl_subjects_new WHERE course_id = '$row1[course_id]' AND year_id = '2' AND sem_id = '2'");
  
while($row = mysqli_fetch_array($query)){
  echo '        
                <tr>
                  <td>'.$row['subj_code'].'</td>
                  <td>'.$row['subj_desc'].'</td>
                  <td>'.$row['unit_total'].'</td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>';
              }
}
?>




                


                </tbody>
              </table>
              </table>
              <table id="" class="table table-condensed table-striped">
                <thead>
                  <col width="80">
                  <col width="250">
                  <col width="50">
                  <col width="50">
                  <col width="80">
                  <col width="80">
                <h4><strong>3rd Year, 1st Sem</strong></h4>
                </thead>

                <tbody>
<?php 
$q = mysqli_query($db,"SELECT * FROM tbl_schoolyears LEFT JOIN tbl_students ON tbl_students.stud_id = tbl_schoolyears.stud_id LEFT JOIN tbl_courses ON tbl_courses.course_id = tbl_schoolyears.course_id WHERE tbl_schoolyears.stud_id = '$_GET[stud_id]'");
while($row1 = mysqli_fetch_array($q)){
    $query = mysqli_query($db,"SELECT * FROM tbl_subjects_new WHERE course_id = '$row1[course_id]' AND year_id = '3' AND sem_id = '1'");
  
while($row = mysqli_fetch_array($query)){
  echo '        
                <tr>
                  <td>'.$row['subj_code'].'</td>
                  <td>'.$row['subj_desc'].'</td>
                  <td>'.$row['unit_total'].'</td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>';
              }
}
?>




                


                </tbody>
              </table>
              </table>
              <table id="" class="table table-condensed table-striped">
                <thead>
                  <col width="80">
                  <col width="250">
                  <col width="50">
                  <col width="50">
                  <col width="80">
                  <col width="80">
                <h4><strong>3rd Year, 2nd Sem</strong></h4>
                </thead>

                <tbody>
<?php 
$q = mysqli_query($db,"SELECT * FROM tbl_schoolyears LEFT JOIN tbl_students ON tbl_students.stud_id = tbl_schoolyears.stud_id LEFT JOIN tbl_courses ON tbl_courses.course_id = tbl_schoolyears.course_id WHERE tbl_schoolyears.stud_id = '$_GET[stud_id]'");
while($row1 = mysqli_fetch_array($q)){
    $query = mysqli_query($db,"SELECT * FROM tbl_subjects_new WHERE course_id = '$row1[course_id]' AND year_id = '3' AND sem_id = '2'");
  
while($row = mysqli_fetch_array($query)){
  echo '        
                <tr>
                  <td>'.$row['subj_code'].'</td>
                  <td>'.$row['subj_desc'].'</td>
                  <td>'.$row['unit_total'].'</td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>';
              }
}
?>




                


                </tbody>
              </table>
              </table>
              <table id="" class="table table-condensed table-striped">
                <thead>
                  <col width="80">
                  <col width="250">
                  <col width="50">
                  <col width="50">
                  <col width="80">
                  <col width="80">
                <h4><strong>4th Year, 1st Sem</strong></h4>
                </thead>

                <tbody>
<?php 
$q = mysqli_query($db,"SELECT * FROM tbl_schoolyears LEFT JOIN tbl_students ON tbl_students.stud_id = tbl_schoolyears.stud_id LEFT JOIN tbl_courses ON tbl_courses.course_id = tbl_schoolyears.course_id WHERE tbl_schoolyears.stud_id = '$_GET[stud_id]'");
while($row1 = mysqli_fetch_array($q)){
    $query = mysqli_query($db,"SELECT * FROM tbl_subjects_new WHERE course_id = '$row1[course_id]' AND year_id = '4' AND sem_id = '1'");
  
while($row = mysqli_fetch_array($query)){
  echo '        
                <tr>
                  <td>'.$row['subj_code'].'</td>
                  <td>'.$row['subj_desc'].'</td>
                  <td>'.$row['unit_total'].'</td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>';
              }
}
?>




                


                </tbody>
              </table>
              </table>
              <table id="" class="table table-condensed table-striped">
                <thead>
                  <col width="80">
                  <col width="250">
                  <col width="50">
                  <col width="50">
                  <col width="80">
                  <col width="80">
                <h4><strong>4th Year, 2nd Sem</strong></h4>
                </thead>

                <tbody>
<?php 
$q = mysqli_query($db,"SELECT * FROM tbl_schoolyears LEFT JOIN tbl_students ON tbl_students.stud_id = tbl_schoolyears.stud_id LEFT JOIN tbl_courses ON tbl_courses.course_id = tbl_schoolyears.course_id WHERE tbl_schoolyears.stud_id = '$_GET[stud_id]'");
while($row1 = mysqli_fetch_array($q)){
    $query = mysqli_query($db,"SELECT * FROM tbl_subjects_new WHERE course_id = '$row1[course_id]' AND year_id = '4' AND sem_id = '2'");
  
while($row = mysqli_fetch_array($query)){
  echo '        
                <tr>
                  <td>'.$row['subj_code'].'</td>
                  <td>'.$row['subj_desc'].'</td>
                  <td>'.$row['unit_total'].'</td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>';
              }
}
?>




                


                </tbody>
              </table>
          <!-- /.box -->
        </div>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!-- =================================================FOOTER================================================== -->
                                    <?php include '../../includes/footer.php'; ?>
<!-- =================================================FOOTER================================================== -->

<!-- =================================================SCRIPT================================================== -->
                                    <?php include '../../includes/script.php'; ?>
<!-- =================================================SCRIPT================================================== -->

</body>
</html>
