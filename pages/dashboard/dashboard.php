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
      <h1>Dashboard</h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <?php
                            $result = mysqli_query($db,"SELECT * FROM tbl_schoolyears WHERE remark='Approved' AND ay_id = '$_SESSION[active_acad]' AND sem_id = '$_SESSION[active_sem]'");
                            $num_rows = mysqli_num_rows($result);
            ?>
              <h3><?php echo $num_rows; ?></h3>
              <p>Enrolled Students</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-people-outline"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <?php
                            $result = mysqli_query($db,"SELECT * FROM tbl_schoolyears WHERE remark='Approved' AND status = 'New' AND ay_id = '$_SESSION[active_acad]' AND sem_id = '$_SESSION[active_sem]'");
                            $num_rows = mysqli_num_rows($result);
            ?>
              <h3><?php echo $num_rows; ?></h3>
              <p>New Students</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-people"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <?php
                            $result = mysqli_query($db,"SELECT * FROM tbl_schoolyears WHERE remark='Approved' AND status = 'Old' AND ay_id = '$_SESSION[active_acad]' AND sem_id = '$_SESSION[active_sem]'");
                            $num_rows = mysqli_num_rows($result);
            ?>
              <h3><?php echo $num_rows; ?></h3>
              <p>Old Students</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-people"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <?php
                            $result = mysqli_query($db,"SELECT * FROM tbl_schoolyears WHERE remark='Pending' AND ay_id = '$_SESSION[active_acad]' AND sem_id = '$_SESSION[active_sem]'");
                            $num_rows = mysqli_num_rows($result);
            ?>
              <h3><?php echo $num_rows; ?></h3>
              <p>Pending Enrollees</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-people"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <!-- <section class="col-lg-5 connectedSortable">

        </section> -->
        <!-- right col -->
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
