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
              <h2 class="box-title">List of <strong>Faculties Staff</strong></strong></h2>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Subject Load(s)</th>
                </tr>
                </thead>
                <tbody>
<?php 
$quer = mysqli_query($db,
  "SELECT *,CONCAT(tbl_faculties_staff.faculty_lastname, ', ', tbl_faculties_staff.faculty_firstname, ' ', tbl_faculties_staff.faculty_middlename)  as fullname FROM tbl_faculties_staff");
while($row1 = mysqli_fetch_array($quer)){

// $que = mysqli_query($db,"SELECT DISTINCT class_code FROM tbl_schedules_old WHERE tbl_schedules_old.faculty_id = '$_SESSION[userid]'
// UNION 
// SELECT DISTINCT class_code FROM tbl_schedules WHERE tbl_schedules.faculty_id = '$_SESSION[userid]'");
// while($row = mysqli_fetch_array($que)){
  echo'<tr>
                  <td>'.$row1['fullname'].'</td>
                  <td><a href="view_load.php?faculty_id='.$row1['faculty_id'].'" class="btn btn-primary">View Subject Load</a></td>
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
