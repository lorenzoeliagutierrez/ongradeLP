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
      <h1 allign="center">CLASS HISTORY</h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
            <div class="col-md-12">
              <form method="POST">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <select name="acad" id="acad" data-style="btn btn-primary btn-round" required class="form-control select-2">
                      <option selected disabled>School Year</option>
                              <?php 
                                $q1 = mysqli_query($db,"SELECT * from tbl_acadyears order by academic_year DESC");
                                while($row1=mysqli_fetch_array($q1)){
                                    echo '<option value="'.$row1['academic_year'].'">'.$row1['academic_year'].'</option>';
                                  }
                              ?>
                    </select>
                  </div>
                </div>
                
                <div class="col-md-3">
                  <div class="form-group">
                    <select name="sem" id="sem" data-style="btn btn-primary btn-round" required class="form-control select-2">
                      <option selected disabled>Semester</option>
                              <?php 
                                $q = mysqli_query($db,"SELECT * from tbl_semesters");
                                while($row=mysqli_fetch_array($q)){
                                    echo '<option value="'.$row['semester'].'">'.$row['semester'].'</option>';
                                  }
                              ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <button type="submit" name="search" class="btn btn-sm btn-primary pull-right">Search</button>
                  </div>
                </div>
                
              </div></form>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-body">
                  <h4><strong><?php $name = mysqli_query($db,"SELECT *,CONCAT(tbl_faculties_staff.faculty_lastname, ', ', tbl_faculties_staff.faculty_firstname, ' ', tbl_faculties_staff.faculty_middlename)  AS fullname from tbl_faculties_staff where faculty_id ='$_GET[stud_id]' ");
                    $row = mysqli_fetch_array($name);

                    echo $row['fullname'];
                    ?></strong></h4>
                </div>
              </div>
              <?php if (isset($_POST['search'])) {
                $schoolyear = mysqli_real_escape_string($db,$_POST['acad']);
                $sem = mysqli_real_escape_string($db,$_POST['sem']);

                ?>
            <div class="box">
            <!-- /.box-header -->
            <div class="box-header">
              <h2 class="box-title"><?php echo $schoolyear.' - '.$sem; ?></strong></h2>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-condensed">
                <thead>
                <tr>
                  <th>Subject Code</th>
                  <th>Subject Description</th>
                  
                </tr>
                </thead>
                <tbody>
<?php 
include '../../includes/db.php';
$quer = mysqli_query($db,
  "SELECT class_id,class_code,tbl_subjects_new.subj_desc 
  FROM tbl_schedules 
  LEFT JOIN tbl_subjects_new ON tbl_subjects_new.subj_id = tbl_schedules.subj_id 
  WHERE tbl_schedules.faculty_id = '$_SESSION[userid]' 
  AND acad_year = '$schoolyear' 
  AND semester = '$sem'
  GROUP BY class_code");
while($row1 = mysqli_fetch_array($quer)){

echo'
                        <tr>
                          <td>'.$row1['class_code'].' - '.$row1['subj_desc'].'</td>
                  <td><a href="section_history.php?code='.$row1['class_code'].'&desc='.$row1['subj_desc'].'&sem='.$sem.'&ay='.$schoolyear.'" class="btn btn-info">View Class</a></td>
                        </tr>';

}} ?>
                            
          

                      </tbody>
                    </table>
                  </div>

            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
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
