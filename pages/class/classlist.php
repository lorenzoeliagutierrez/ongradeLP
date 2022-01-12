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
      <h1>Subject(s) Load</h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
          <?php check_message(); ?>
          <div class="box">
            <!-- /.box-header -->
            <div class="box-header">
              <h2 class="box-title">Hi <strong><?php echo $_SESSION['user'] ?></strong> this is your Subject Load for <strong><?php echo $_SESSION['active_sem'].' '.$_SESSION['active_acad']; ?></strong></h2>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Class Code</th>
                  <th>Option</th>
                </tr>
                </thead>
                <tbody>
<?php 
$quer = mysqli_query($db,
  "SELECT class_id,class_code,tbl_subjects_new.subj_desc 
  FROM tbl_schedules 
  LEFT JOIN tbl_subjects_new ON tbl_subjects_new.subj_id = tbl_schedules.subj_id 
  WHERE tbl_schedules.faculty_id = '$_SESSION[userid]' 
  AND acad_year = '$_SESSION[active_acad]' 
  AND semester = '$_SESSION[active_sem]' 
  GROUP BY class_code
  UNION
  SELECT class_id,class_code,tbl_subjects.subj_desc 
  FROM tbl_schedules_old 
  LEFT JOIN tbl_subjects ON tbl_subjects.subj_id = tbl_schedules_old.subj_id 
  WHERE tbl_schedules_old.faculty_id = '$_SESSION[userid]' 
  AND acad_year = '$_SESSION[active_acad]' 
  AND semester = '$_SESSION[active_sem]' 
  GROUP BY class_code");
while($row1 = mysqli_fetch_array($quer)){

// $que = mysqli_query($db,"SELECT DISTINCT class_code FROM tbl_schedules_old WHERE tbl_schedules_old.faculty_id = '$_SESSION[userid]'
// UNION 
// SELECT DISTINCT class_code FROM tbl_schedules WHERE tbl_schedules.faculty_id = '$_SESSION[userid]'");
// while($row = mysqli_fetch_array($que)){
  echo'<tr>
                  <td>'.$row1['class_code'].' - '.$row1['subj_desc'].'</td>
                  <td><a href="section.php?code='.$row1['class_code'].'&desc='.$row1['subj_desc'].'" class="btn btn-info">View Class</a></td>
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
