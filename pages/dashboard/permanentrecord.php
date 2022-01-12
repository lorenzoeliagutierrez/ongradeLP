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
      <h1>Student Permanent Record</h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
            <div class="row">
            <div class="col-md-12">
              <form method="POST">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <select name="name" id="name" data-style="btn btn-primary btn-round" required class="form-control select-2">
                      <option selected disabled>Student Name</option>
                              <?php 
                                $q1 = mysqli_query($db,"
                                  SELECT *, CONCAT(tbl_students.lastname, ' ', tbl_students.firstname, ' ', tbl_students.middlename)  as fullname 
                                  FROM tbl_students 
                                  ");
                                while($row1=mysqli_fetch_array($q1)){
                                    echo '<option value="'.$row1['stud_id'].'">'.$row1['fullname'].'</option>';
                                  }
                              ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <select name="acad" id="acad" data-style="btn btn-primary btn-round" required class="form-control select-2">
                      <option selected disabled>School Year</option>
                              <?php 
                                $q1 = mysqli_query($db,"
                                  SELECT * 
                                  FROM tbl_acadyears 
                                  order by academic_year DESC
                                  ");
                                while($row1=mysqli_fetch_array($q1)){
                                    echo '<option value="'.$row1['academic_year'].'">'.$row1['academic_year'].'</option>';
                                  }
                              ?>
                    </select>
                  </div>
                </div>
                
                <div class="col-md-4">
                  <div class="form-group">
                    <select name="sem" id="sem" data-style="btn btn-primary btn-round" required class="form-control select-2">
                      <option selected disabled>Semester</option>
                              <?php 
                                $q = mysqli_query($db,"
                                  SELECT * 
                                  FROM tbl_semesters
                                  ");
                                while($row=mysqli_fetch_array($q)){
                                    echo '<option value="'.$row['semester'].'">'.$row['semester'].'</option>';
                                  }
                              ?>
                    </select>
                  </div>
                </div>
              </div> <!--end row -->

                <div class="row">
                  <div class="">
                    <div class="form-group">
                      <center><button type="submit" name="search" class="btn btn-md btn-primary">Search</button></center>
                    </div>
                  </div>
                </div>
                
                
              </form>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-12">
              <?php if (isset($_POST['search'])) {
                $stud_id = mysqli_real_escape_string($db,$_POST['name']);
                $schoolyear = mysqli_real_escape_string($db,$_POST['acad']);
                $sem = mysqli_real_escape_string($db,$_POST['sem']);

                $asd = mysqli_query($db, "
                  SELECT * 
                  FROM tbl_schoolyears 
                  LEFT JOIN tbl_courses on tbl_courses.course_id = tbl_schoolyears.course_id 
                  WHERE ay_id = '$schoolyear' and sem_id = '$sem' and stud_id = '$stud_id'");
                while ($r = mysqli_fetch_array($asd)) {

                ?>

              <div class="box">
                <div class="box-body">
                  <h4><strong><?php $name = mysqli_query($db,"SELECT *,CONCAT(tbl_students.lastname, ', ', tbl_students.firstname, ' ', tbl_students.middlename)  AS fullname from tbl_students where stud_id ='$stud_id' ");
                    $row = mysqli_fetch_array($name);

                    echo $row['fullname'];
                    ?></strong></h4>
                </div>
              </div>
            
            <div class="box">
            <!-- /.box-header -->
            <div class="box-header">
              <h2 class="box-title"><?php echo $schoolyear.' - '.$sem.' - '.$r['course']; ?></strong></h2>
              <a href="../forms/studentpermanentrecord.php?sy=<?php echo $schoolyear; ?>&sem=<?php echo $sem; ?>&stud=<?php echo $stud_id; ?>" name="search" class="btn btn-md btn-primary pull-right">View Permanent Record</a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-condensed">
                <thead>
                <tr>
                  <th>Subject Code</th>
                  <th>Subject Description</th>
                  <th>Prelim</th>
                  <th>Midterm</th>
                  <th>Finalterm</th>
                  <th>Final Grade</th>
                  <th>Num. Grade</th>
                  <th>Remarks</th>
                </tr>
                </thead>
                <tbody>
                            <?php 
                            include '../../includes/db.php';
                            $l= mysqli_query($db, "
                              SELECT * 
                              FROM tbl_students 
                              WHERE stud_id = '$stud_id'");
                            while($rows = mysqli_fetch_array ($l)){
                                if($rows['curri'] == "Old Curri")
                                {
                                    $sqls = mysqli_query($db,"SELECT *,tbl_subjects.subj_code,tbl_subjects.subj_desc FROM tbl_enrolled_subjects LEFT JOIN tbl_subjects ON tbl_subjects.subj_id = tbl_enrolled_subjects.subj_id where tbl_enrolled_subjects.acad_year = '$schoolyear' AND tbl_enrolled_subjects.semester = '$sem' AND stud_id = '$stud_id'")or die($db);
                                    while($roe = mysqli_fetch_array($sqls))
                                    {
                                      
                                     ?>
                                                            <tr>
                                                              <td><?php echo $roe['subj_code']; ?></td>
                                                              <td><?php echo $roe['subj_desc']; ?></td>
                                                              <td><?php echo $roe['prelim']; ?></td>
                                                              <td><?php echo $roe['midterm']; ?></td>
                                                              <td><?php echo $roe['finalterm']; ?></td>
                                                              <td><?php echo $roe['ofgrade']; ?></td>
                                                              <td><?php echo $roe['numgrade']; ?></td>
                                                              <?php if ($roe['remarks'] == 'Passed') {
                                                                echo '<td style="color:green;">'.$roe['remarks'].'</td>';
                                                              }elseif($roe['remarks'] == 'Failed'){
                                                                echo '<td style="color:red;">'.$roe['remarks'].'</td>';
                                                              }else{
                                                                echo '<td>'. $roe['remarks'].'</td>';
                                                              } ?>
                                                              
                                                            </tr>
                              <?php }
                                }
                                  else{
                              $sqls = mysqli_query($db,"SELECT *,tbl_subjects_new.subj_code,tbl_subjects_new.subj_desc FROM tbl_enrolled_subjects LEFT JOIN tbl_subjects_new ON tbl_subjects_new.subj_id = tbl_enrolled_subjects.subj_id where tbl_enrolled_subjects.acad_year = '$schoolyear' AND tbl_enrolled_subjects.semester = '$sem' AND stud_id = '$stud_id'")or die($db);
                            while($roe = mysqli_fetch_array($sqls)){
                              ?>
                                                    <tr>
                                                      <td><?php echo $roe['subj_code']; ?></td>
                                                      <td><?php echo $roe['subj_desc']; ?></td>
                                                      <td><?php echo $roe['prelim']; ?></td>
                                                      <td><?php echo $roe['midterm']; ?></td>
                                                      <td><?php echo $roe['finalterm']; ?></td>
                                                      <td><?php echo $roe['ofgrade']; ?></td>
                                                      <td><?php echo $roe['numgrade']; ?></td>
                                                      <?php if ($roe['remarks'] == 'Passed') {
                                                        echo '<td style="color:green;">'. $roe['remarks'].'</td>';
                                                      }elseif($roe['remarks'] == 'Failed'){
                                                        echo '<td style="color:red;">'. $roe['remarks'].'</td>';
                                                      }else{
                                                        echo '<td>'. $roe['remarks'].'</td>';
                                                      } ?>
                                                    </tr>
                            <?php
                            }
                            }}}} ?>
                                                        
                                      

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
