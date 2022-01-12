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
      <h1>Student Subject</h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <?php
              $squery = mysqli_query($db, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname FROM students_tbl WHERE stud_id = '".$_SESSION['userid']."' ");
              while($row = mysqli_fetch_array($squery))
       { echo '
            <form method="GET" action="../transcript/tor.php">
              <h3 class="box-title"><input name="stud_id" type="hidden" value="'.$row['stud_id'].'"><strong>'.$row['fullname'].'</strong></h3>
            </form>
            </div>';}
            ?>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Subject</th>
                  <th>Academic Year</th>
                  <th>Year Level</th>
                  <th>Semester</th>
                  <th>Final Grade</th>
                </tr>
                </thead>
                <tbody>
      <?php
        $squery = mysqli_query($db, "SELECT * ,CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname, semester_tbl.semester, yearlevel_tbl.year_level, acadyears_tbl.academic_year, CONCAT(subjects_tbl.subj_code, ' ', '- ', ' ', subjects_tbl.subj_desc) as subj_name, stud_subj_tbl.ofgrade
          FROM stud_subj_tbl
          LEFT JOIN students_tbl ON students_tbl.stud_id = stud_subj_tbl.stud_id
          LEFT JOIN acadyears_tbl ON acadyears_tbl.ay_id = stud_subj_tbl.ay_id
          LEFT JOIN yearlevel_tbl ON yearlevel_tbl.year_id = stud_subj_tbl.year_id
          LEFT JOIN semester_tbl ON semester_tbl.sem_id = stud_subj_tbl.sem_id
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '".$_SESSION['userid']."' ORDER BY academic_year");
          while($row = mysqli_fetch_array($squery))
       { echo '
                <tr>
                  <td>'.$row['subj_name'].'</td>
                  <td>'.$row['academic_year'].'</td>
                  <td>'.$row['year_level'].'</td>
                  <td>'.$row['semester'].'</td>
                  <td>'.$row['ofgrade'].'</td>
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
