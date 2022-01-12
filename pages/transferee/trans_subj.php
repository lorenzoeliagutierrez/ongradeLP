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
              <form autocomplete="off" method="POST" class="form-horizontal" action="addsubjFunction.php">

                <!-- <div class="form-group">
                  <label for="studno" class="col-sm-3 control-label">StudentNo.</label>
                  <div class="col-sm-9">
                    <input type="text" name="studno" class="form-control" required id="studno" placeholder="StudentNo...">
                  </div>
                </div>
                <div class="form-group">
                  <label for="name" class="col-sm-3 control-label">Student Name</label>
                  <div class="col-sm-9">
                    <select name="name" id="name" data-style="btn-primary" required class="form-control input-sm select-2">
                        <option selected disabled>-- Select Student --</option> -->
                        <?php
                                // $q = mysqli_query($db,"SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname FROM students_tbl");
                                // while($row=mysqli_fetch_array($q)){
                                //     echo '<option value="'.$row['stud_id'].'">'.$row['fullname'].'</option>';
                                // }
                            ?>
                    <!--   </select>
                  </div>
                </div> -->
                <!-- <div class="form-group">
                  <label for="name" class="col-sm-3 control-label">Subject from other School</label>
                  <div class="col-sm-9">
                    <select name="name" id="name" data-style="btn-primary" required class="form-control input-sm select-2">
                        <option selected disabled>-- Select Subjects --</option> -->
                        <?php
                                // $q = mysqli_query($db,"SELECT *, CONCAT(trans_subj_tbl.subj_code, ' ', '- ', ' ', trans_subj_tbl.subj_desc) as trans_subj from trans_subj_tbl");
                                // while($row=mysqli_fetch_array($q)){
                                //     echo '<option value="'.$row['trans_subj_id'].'">'.$row['trans_subj'].'</option>';
                                // }
                            ?>
                   <!--  </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="name" class="col-sm-3 control-label">Subject Credited</label>
                  <div class="col-sm-9">
                    <select name="name" id="name" data-style="btn-primary" required class="form-control input-sm select-2">
                        <option selected disabled>-- Select Credited Subject --</option> -->
                        <?php
                                // $q = mysqli_query($db,"SELECT *, CONCAT(subjects_tbl.subj_code, ' ', '- ', ' ', subjects_tbl.subj_desc) as subj_name from subjects_tbl");
                                // while($row=mysqli_fetch_array($q)){
                                //     echo '<option value="'.$row['subj_id'].'">'.$row['subj_name'].'</option>';
                                // }
                            ?>
                   <!--  </select>
                  </div>
                </div> -->
               
                <div class="form-group">
                  <label for="subj_code" class="col-sm-3 control-label">Subject Code</label>
                  <div class="col-sm-9">
                    <input type="text" name="subj_code" required class="form-control" id="subj_code" placeholder="Subject Code...">
                  </div>
                </div>
                <div class="form-group">
                  <label for="subj_desc" class="col-sm-3 control-label">Subject Description</label>
                  <div class="col-sm-9">
                    <input type="text" name="subj_desc" required class="form-control" id="subj_desc" placeholder="Subject Description...">
                  </div>
                </div>
              <div class="form-group">
                  <label for="units" class="col-sm-3 control-label">Units</label>
                  <div class="col-sm-9">
                    <select name="units" id="units" data-style="btn-primary" required class="form-control input-sm select-2" required>
                        <option selected disabled>-- Select Units --</option>
                        <?php
                                $q = mysqli_query($db,"SELECT * from units_tbl");
                                while($row=mysqli_fetch_array($q)){
                                    echo '<option value="'.$row['unit_id'].'">'.$row['total'].'</option>';
                                }
                            ?>
                      </select>
                  </div>
                </div>
                <div>
                  <button type="submit" name="add_subj" class="btn btn-info pull-right">Add Subject</button>
                </div>
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
