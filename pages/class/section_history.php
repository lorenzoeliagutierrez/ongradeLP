<?php
include '../../includes/session.php';
include '../../includes/db.php';
?>
<!DOCTYPE html>
<html>
<!-- ============================================HEAD CSS LINKS============================================= -->
                                    <?php include '../../includes/head_css.php'; ?>
<!-- ============================================./HEAD CSS LINKS============================================= -->
<body class="hold-transition skin-blue sidebar-mini">
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
      <h1>Section(s) for <?php echo $_GET['code']; ?></h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
          <div class="box">
            <div class="box-header">
              <?php $que= mysqli_query($db,"
                SELECT * 
        FROM tbl_subjects_new 
        where subj_code = '$_GET[code]' 
        UNION 
        SELECT * 
        FROM tbl_subjects 
        where subj_code = '$_GET[code]' LIMIT 1");
              while ($row = mysqli_fetch_array($que)) {
                ?>
              <h2 class="box-title"><strong>Section(s) for <?php echo $_GET['code'].' - '.$row['subj_desc']; ?></strong></h2>
            <?php } ?>
              <a href="javascript:history.back()" class="btn btn-primary pull-right">Back</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Section Name</th>
                  <th>Time</th>
                  <th>Day</th>
                  <th>Room</th>
                  <center><th>Actions</th></center>
                </tr>
                </thead>
                <tbody>
<?php 

// $que = mysqli_query($db,"SELECT *,CONCAT(tbl_students.lastname, ', ', tbl_students.firstname, ' ', tbl_students.middlename)  as fullname FROM tbl_enrolled_subjects 
// LEFT JOIN tbl_subjects ON tbl_subjects.subj_id = tbl_enrolled_subjects.subj_id
// LEFT JOIN tbl_students ON tbl_students.stud_id = tbl_enrolled_subjects.stud_id
// LEFT JOIN tbl_schedules_old ON tbl_schedules_old.class_id = tbl_enrolled_subjects.class_id
// LEFT JOIN tbl_faculties_staff ON tbl_faculties_staff.faculty_id = tbl_schedules_old.faculty_id WHERE tbl_enrolled_subjects.acad_year = '$_SESSION[active_acad]' AND tbl_enrolled_subjects.semester='$_SESSION[active_sem]' AND tbl_subjects.subj_code = '$_GET[code]'
// UNION SELECT *,CONCAT(tbl_students.lastname, ', ', tbl_students.firstname, ' ', tbl_students.middlename)  as fullname FROM tbl_enrolled_subjects 
// LEFT JOIN tbl_subjects_new ON tbl_subjects_new.subj_id = tbl_enrolled_subjects.subj_id
// LEFT JOIN tbl_students ON tbl_students.stud_id = tbl_enrolled_subjects.stud_id
// LEFT JOIN tbl_schedules_old ON tbl_schedules_old.class_id = tbl_enrolled_subjects.class_id
// LEFT JOIN tbl_faculties_staff ON tbl_faculties_staff.faculty_id = tbl_schedules_old.faculty_id WHERE tbl_enrolled_subjects.acad_year = '$_SESSION[active_acad]' AND tbl_enrolled_subjects.semester='$_SESSION[active_sem]' AND tbl_subjects_new.subj_code = '$_GET[code]'");
// while($row = mysqli_fetch_array($que)){
//   echo'<tr>
//                   <td>'.$row['fullname'].'</td>
                  
//                   <td><a href="class_stud.php" class=""btn btn-primary>View Class</a></td>
//                 </tr>';
// }
$que = mysqli_query($db,
  "SELECT DISTINCT section, time, day, room 
  FROM tbl_schedules_old 
  WHERE tbl_schedules_old.faculty_id = '$_SESSION[userid]' 
  AND class_code='$_GET[code]' 
  AND acad_year = '$_GET[ay]' 
  AND semester = '$_GET[sem]'
  UNION 
  SELECT DISTINCT section, time, day, room  
  FROM tbl_schedules 
  WHERE tbl_schedules.faculty_id = '$_SESSION[userid]' 
  AND class_code='$_GET[code]' 
  AND acad_year = '$_GET[ay]' 
  AND semester = '$_GET[sem]'");

while($row = mysqli_fetch_array($que)){
  echo'<tr>
                  <td>'.$row['section'].'</td>
                  <td>'.$row['time'].'</td>
                  <td>'.$row['day'].'</td>
                  <td>'.$row['room'].'</td>
                  <td><center>
                    <!--<a href="class_stud.php?code='.$_GET['code'].'&section='.$row['section'].'" class="btn btn-danger">Enter Grade | Enter Absences | Transfer Section</a>-->
                    <a href="../class/history_rog.php?code='.$_GET['code'].'&section='.$row['section'].'&sem='.$_GET['sem'].'&ay='.$_GET['ay'].'" class="btn btn-success">View ROG</a>
                    <a href="../class/class_list_hist.php?code='.$_GET['code'].'&section='.$row['section'].'&sem='.$_GET['sem'].'&ay='.$_GET['ay'].'" class="btn btn-primary">View Class List</a></center>
                  </td>
                </tr>';
}
?>
                


                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
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
