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
<!-- =================================================./HEADER================================================== -->
<!-- ================================================SIDEBAR LEFT============================================ -->
                                    <?php include '../../includes/sidebar_left.php'; ?>
<!-- ================================================./SIDEBAR LEFT============================================ -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Subject</h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">

        <div class="col-sm-8 col-sm-offset-2">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Assign Subject</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form class="form-horizontal" method="POST" action="addstudSubj.php">
                <div class="form-group">
                  <label for="student" class="col-sm-3 control-label">Name</label>
                  <div class="col-sm-9">
                    <select name="student" id="student" data-style="btn-primary" required class="form-control input-sm select-2">
                        <option selected disabled>-- Select Student --</option>
                        <?php
                                $q = mysqli_query($db,"SELECT *, CONCAT(tbl_students.lastname, ', ', tbl_students.firstname, ' ', tbl_students.middlename)  as fullname FROM tbl_students");
                                while($row=mysqli_fetch_array($q)){
                                    echo '<option value="'.$row['stud_id'].'">'.$row['fullname'].'</option>';
                                }
                            ?>
                      </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="acad_year" class="col-sm-3 control-label">Academic Year</label>
                  <div class="col-sm-9">
                    <select name="acad_year" id="acad_year" data-style="btn-primary" required class="form-control input-sm select-2">
                        <option selected disabled>-- Select Academic Year --</option>
                        <?php
                                $q = mysqli_query($db,"SELECT * from tbl_acadyears");
                                while($row=mysqli_fetch_array($q)){
                                    echo '<option value="'.$row['ay_id'].'">'.$row['academic_year'].'</option>';
                                }
                            ?>
                      </select>
                  </div>
                </div>
              <div class="form-group">
                  <label for="yearlevel" class="col-sm-3 control-label">Year Level</label>
                  <div class="col-sm-9">
                    <select name="yearlevel" id="yearlevel" data-style="btn-primary" required class="form-control input-sm select-2">
                        <option selected disabled>-- Select Year Level --</option>
                        <?php
                                $q = mysqli_query($db,"SELECT * from tbl_year_levels");
                                while($row=mysqli_fetch_array($q)){
                                    echo '<option value="'.$row['year_id'].'">'.$row['year_level'].'</option>';
                                }
                            ?>
                      </select>
                  </div>
                </div>  
              <div class="form-group">
                  <label for="sem" class="col-sm-3 control-label">Semester</label>
                  <div class="col-sm-9">
                    <select name="sem" id="sem" data-style="btn-primary" required class="form-control input-sm select-2">
                        <option selected disabled>-- Select Semester --</option>
                        <?php
                                $q = mysqli_query($db,"SELECT * from tbl_semesters");
                                while($row=mysqli_fetch_array($q)){
                                    echo '<option value="'.$row['sem_id'].'">'.$row['semester'].'</option>';
                                }
                            ?>
                      </select>
                  </div>
                </div>
                
                <div>
                  <button type="submit" name="assign_subj" class="btn btn-info pull-right">Assign Subject</button>
                </div>
              </form>
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
