<?php
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
              $squery = mysqli_query($db, "SELECT * ,courses_tbl.course,majors_tbl.major_name, CONCAT(students_tbl.surname, ', ', students_tbl.firstname, ' ', students_tbl.middlename)  as fullname FROM students_tbl
                LEFT JOIN courses_tbl ON courses_tbl.course_id = students_tbl.course_id
                LEFT JOIN majors_tbl ON majors_tbl.major_id = students_tbl.major_id WHERE stud_id = '$_GET[view_subj_id]' ");
              while($row = mysqli_fetch_array($squery))
       { echo '
            <form method="GET" action="../transcript/tor.php">
              <h3 class="box-title"><input name="stud_id" type="hidden" value="'.$row['stud_id'].'"><strong>'.$row['fullname'].'</strong></h3><input style="float: right;" type="submit" class="btn btn-primary btn-sm" value="View Transcript"/>
            </form>';
          // ==========================BSCS============================
        if($row['course'] == 'Bachelor of Science in Computer Science' && $row['major_name']== 'N/A') 
          {
            echo'
            <form method="GET" action="../curriculum/curri-db.php">
              <input name="stud_id" type="hidden" value="'.$row['stud_id'].'"><input style="float: right;" type="submit" class="btn btn-primary btn-sm" value="View Curriculum"/>
            </form>
            </div>';
          }
        elseif ($row['course'] == 'Associate in Computer Technology' && $row['major_name']== 'N/A') 
          {
            echo'
            <form method="GET" action="../curriculum/curri-db-tuyir.php">
              <input name="stud_id" type="hidden" value="'.$row['stud_id'].'"><input style="float: right;" type="submit" class="btn btn-primary btn-sm" value="View Curriculum"/>
            </form>
            </div>';
          }
          // ==========================END BSCS============================

          // ==========================BSBA============================
        elseif ($row['course'] == 'Bachelor of Science in Business Administrations' && $row['major_name']== 'Marketing Management') 
          {
            echo'
            <form method="GET" action="../curriculum/curri-ba-mktg-mgmt.php">
              <input name="stud_id" type="hidden" value="'.$row['stud_id'].'"><input style="float: right;" type="submit" class="btn btn-primary btn-sm" value="View Curriculum"/>
            </form>
            </div>';
          }
          elseif ($row['course'] == 'Bachelor of Science in Business Administrations' && $row['major_name']== 'Management') 
          {
            echo'
            <form method="GET" action="../curriculum/curri-ba-mgmt.php">
              <input name="stud_id" type="hidden" value="'.$row['stud_id'].'"><input style="float: right;" type="submit" class="btn btn-primary btn-sm" value="View Curriculum"/>
            </form>
            </div>';
          }
          // ==========================END BSBA============================

          // ==========================BSED============================
          // EDUC: curri-educ-fil (Filipino), curri-educ-eng (English), curri-educ-math (Mathematics), curri-educ-phys (Physical Science), curri-educ-bio (Biological Science)
        elseif ($row['course'] == 'Bachelor in Secondary Education' && $row['major_name']== 'Biological Science') 
          {
            echo'
            <form method="GET" action="../curriculum/curri-educ-bio.php">
              <input name="stud_id" type="hidden" value="'.$row['stud_id'].'"><input style="float: right;" type="submit" class="btn btn-primary btn-sm" value="View Curriculum"/>
            </form>
            </div>';
          }
        elseif ($row['course'] == 'Bachelor in Secondary Education' && $row['major_name']== 'English') 
          {
            echo'
            <form method="GET" action="../curriculum/curri-educ-eng.php">
              <input name="stud_id" type="hidden" value="'.$row['stud_id'].'"><input style="float: right;" type="submit" class="btn btn-primary btn-sm" value="View Curriculum"/>
            </form>
            </div>';
          }
        elseif ($row['course'] == 'Bachelor in Secondary Education' && $row['major_name']== 'Filipino') 
          {
            echo'
            <form method="GET" action="../curriculum/curri-educ-fil.php">
              <input name="stud_id" type="hidden" value="'.$row['stud_id'].'"><input style="float: right;" type="submit" class="btn btn-primary btn-sm" value="View Curriculum"/>
            </form>
            </div>';
          }
        elseif ($row['course'] == 'Bachelor in Secondary Education' && $row['major_name']== 'Physical Science') 
          {
            echo'
            <form method="GET" action="../curriculum/curri-educ-phys.php">
              <input name="stud_id" type="hidden" value="'.$row['stud_id'].'"><input style="float: right;" type="submit" class="btn btn-primary btn-sm" value="View Curriculum"/>
            </form>
            </div>';
          }
        elseif ($row['course'] == 'Bachelor in Secondary Education' && $row['major_name']== 'Mathematics') 
          {
            echo'
            <form method="GET" action="../curriculum/curri-educ-math.php">
              <input name="stud_id" type="hidden" value="'.$row['stud_id'].'"><input style="float: right;" type="submit" class="btn btn-primary btn-sm" value="View Curriculum"/>
            </form>
            </div>';
          }
          // ==========================END BSED============================

          // ==========================END BEED============================
        elseif ($row['course'] == 'Bachelor in Elementary Education' && $row['major_name']== 'Early Childhood Education') 
          {
            echo'
            <form method="GET" action="../curriculum/curri-educ-eced.php">
              <input name="stud_id" type="hidden" value="'.$row['stud_id'].'"><input style="float: right;" type="submit" class="btn btn-primary btn-sm" value="View Curriculum"/>
            </form>
            </div>';
          }
        elseif ($row['course'] == 'Bachelor in Elementary Education' && $row['major_name']== 'Special Education') 
          {
            echo'
            <form method="GET" action="../curriculum/curri-educ-sped.php">
              <input name="stud_id" type="hidden" value="'.$row['stud_id'].'"><input style="float: right;" type="submit" class="btn btn-primary btn-sm" value="View Curriculum"/>
            </form>
            </div>';
          }
          // ==========================END BEED============================

          // ==========================HRM============================
        elseif ($row['course'] == 'Bachelor of Science in Hotel and Restaurant Management' && $row['major_name']== 'N/A') 
          {
            echo'
            <form method="GET" action="../curriculum/curri-hrm.php">
              <input name="stud_id" type="hidden" value="'.$row['stud_id'].'"><input style="float: right;" type="submit" class="btn btn-primary btn-sm" value="View Curriculum"/>
            </form>
            </div>';
          }
        elseif ($row['course'] == 'Associate in Hotel and Restaurant Management' && $row['major_name']== 'N/A') 
          {
            echo'
            <form method="GET" action="../curriculum/curri-hrm-tuyir.php">
              <input name="stud_id" type="hidden" value="'.$row['stud_id'].'"><input style="float: right;" type="submit" class="btn btn-primary btn-sm" value="View Curriculum"/>
            </form>
            </div>';
          }
          // ==========================END HRM============================
        elseif ($row['course'] == 'Teacher Certification Program' && $row['major_name']== 'N/A') 
          {
            echo'
            <form method="GET" action="../curriculum/curri-pro-ed.php">
              <input name="stud_id" type="hidden" value="'.$row['stud_id'].'"><input style="float: right;" type="submit" class="btn btn-primary btn-sm" value="View Curriculum"/>
            </form>
            </div>';
          }
        elseif ($row['course'] == 'Bridging Program' && $row['major_name']== 'N/A') 
          {
            echo'
            <form method="GET" action="../curriculum/curri-bridging.php">
              <input name="stud_id" type="hidden" value="'.$row['stud_id'].'"><input style="float: right;" type="submit" class="btn btn-primary btn-sm" value="View Curriculum"/>
            </form>
            </div>';
          }
          
            }?>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="examp" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Subject</th>
                  <th>Academic Year</th>
                  <th>Year Level</th>
                  <th>Semester</th>
                  <th>Final Grade</th>
                  <th>Credits</th>
                  <th>Action</th>
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
          LEFT JOIN subjects_tbl ON subjects_tbl.subj_id = stud_subj_tbl.subj_id WHERE students_tbl.stud_id = '$_GET[view_subj_id]' ORDER BY academic_year");
          while($row = mysqli_fetch_array($squery))
       { echo '
                <tr>
                  <td>'.$row['subj_name'].'</td>
                  <td>'.$row['academic_year'].'</td>
                  <td>'.$row['year_level'].'</td>
                  <td>'.$row['semester'].'</td>
                  <td>'.$row['ofgrade'].'</td>
                  <td>'.$row['credits'].'</td>
                  <td><button class="btn btn-primary btn-sm" data-target="#editModal'.$row['stud_subj_id'].'" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></td>
                </tr>';
                include 'editmodalstudSubj.php';
      }
                ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Subject</th>
                  <th>Academic Year</th>
                  <th>Year Level</th>
                  <th>Semester</th>
                  <th>Final Grade</th>
                  <th>Credits</th>
                  <th hidden="">Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      <?php  include 'editfunctionstudSubj.php'; ?>
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
