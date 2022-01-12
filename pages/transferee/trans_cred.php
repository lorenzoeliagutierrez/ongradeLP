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
      <h1>Add Transferee Subjects to be Credited to SFAC</h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Add Subjects from Other School (for Transfer Students)</h3>
            </div>
            <div class="box-body">
              <form autocomplete="off" method="POST" class="form-horizontal">

                <!-- <div class="form-group">
                  <label for="studno" class="col-sm-3 control-label">StudentNo.</label>
                  <div class="col-sm-9">
                    <input type="text" name="studno" class="form-control" required id="studno" placeholder="StudentNo...">
                  </div>
                </div> -->
                <div class="form-group">
                  <label for="name" class="col-sm-3 control-label">Student Name</label>
                  <div class="col-sm-9">
                    <select name="name" id="name" data-style="btn-primary" required class="form-control input-sm select-2">
                        <option selected disabled>-- Select Student --</option>
                        <?php
                                $q = mysqli_query($db,"SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname FROM students_tbl");
                                while($row=mysqli_fetch_array($q)){
                                    echo '<option value="'.$row['stud_id'].'">'.$row['fullname'].'</option>';
                                }
                            ?>
                      </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="schl_name" class="col-sm-3 control-label">School Name</label>
                  <div class="col-sm-9">
                    <select name="schl_name" id="schl_name" data-style="btn-primary" required class="form-control input-sm select-2">
                        <option selected disabled>-- Select School --</option>
                        <?php
                                $q = mysqli_query($db,"SELECT *, CONCAT(schools_tbl.school_name, ' ', '- ', ' ', schools_tbl.school_abv) as schl_name from schools_tbl");
                                while($row=mysqli_fetch_array($q)){
                                    echo '<option value="'.$row['school_id'].'">'.$row['schl_name'].'</option>';
                                }
                            ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="trans_subj" class="col-sm-3 control-label">Subject from other School</label>
                  <div class="col-sm-9">
                    <select name="trans_subj" id="trans_subj" data-style="btn-primary" required class="form-control input-sm select-2">
                        <option selected disabled>-- Select Subjects --</option>
                        <?php
                                $q = mysqli_query($db,"SELECT *, CONCAT(trans_subj_tbl.subj_code, ' ', '- ', ' ', trans_subj_tbl.subj_desc) as trans_subj from trans_subj_tbl");
                                while($row=mysqli_fetch_array($q)){
                                    echo '<option value="'.$row['trans_subj_id'].'">'.$row['trans_subj'].'</option>';
                                }
                            ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="subj_name" class="col-sm-3 control-label">Subject Credited</label>
                  <div class="col-sm-9">
                    <select name="subj_name" id="subj_name" data-style="btn-primary" required class="form-control input-sm select-2">
                        <option selected disabled>-- Select Credited Subject --</option>
                        <?php
                                $q = mysqli_query($db,"SELECT *, CONCAT(subjects_tbl.subj_code, ' ', '- ', ' ', subjects_tbl.subj_desc) as subj_name from subjects_tbl");
                                while($row=mysqli_fetch_array($q)){
                                    echo '<option value="'.$row['subj_id'].'">'.$row['subj_name'].'</option>';
                                }
                            ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="fgrade" class="col-sm-3 control-label">Final Grade</label>
                  <div class="col-sm-9">
                    <input type="text" name="fgrade" class="form-control" required id="fgrade" placeholder="Final Grade...">
                  </div>
                </div>
                <div class="form-group">
                  <label for="credits" class="col-sm-3 control-label">Credits Earned</label>
                  <div class="col-sm-9">
                    <input type="text" name="credits" class="form-control" required id="credits" placeholder="Credits...">
                  </div>
                </div>
                <div>
                  <button type="submit" name="add_trans_cred_subj" class="btn btn-info pull-right">Add Credited Subject</button>
                </div>
<?php 
include '../../includes/db.php';

if (isset($_POST['add_trans_cred_subj'])) {
  $stud_name = mysqli_real_escape_string($db, $_POST['name']);
  $schl_name = mysqli_real_escape_string($db, $_POST['schl_name']);
  $trans_subj = mysqli_real_escape_string($db, $_POST['trans_subj']);
  $subj_name = mysqli_real_escape_string($db, $_POST['subj_name']);
  $fgrade = mysqli_real_escape_string($db, $_POST['fgrade']);
  $credits = mysqli_real_escape_string($db, $_POST['credits']);

  $query = mysqli_query($db,"INSERT INTO trans_equiv_reg_tbl (stud_id,school_id,trans_subj_id,subj_id,fgrade,credits) values ('$stud_name','$schl_name','$trans_subj','$subj_name','$fgrade','$credits')"); 
    echo "<script>alert('Successfully Added!');window.location='trans_cred.php'</script>";

}?>

              </form>
            </div>
          </div>
        </section>
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
