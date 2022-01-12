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
      <h1>My Grade for <?php echo $_SESSION['active_sem'].' '.$_SESSION['active_acad']; ?></h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <div class="col-sm-12">
          <?php check_message(); ?>
          <div class="box">
            <!-- /.box-header -->
            <div class="box-header">
              <h2 class="box-title">Hi <strong><?php echo $_SESSION['user'] ?></strong> this is your Grade(s) for <strong><?php echo $_SESSION['active_sem'].' '.$_SESSION['active_acad']; ?></strong></h2>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-condensed">
                <thead>
                <tr>
                  <th>Subject Code</th>
                  <th>Subject Description</th>
                  <th>Absences</th>
                  <th>Prelim</th>
                  <th>Midterm</th>
                  <th>Finalterm</th>
                  <th>Final Grade</th>
                  <th>Num. Grade</th>
                  <th>Remarks</th>
                </tr>
                </thead>
                <tbody>
<?php include '../../includes/db.php';

// query stdent
if ($_SESSION['userid'] != $_GET['stud_id']) {
  header("location: ../404/404.php");
}

$l= mysqli_query($db, "SELECT * FROM tbl_students WHERE stud_id = '".$_GET['stud_id']."'");
while($rows = mysqli_fetch_array ($l)){
  if($rows['curri'] == "New Curri"){ 
    $q = mysqli_query($db,"SELECT *, CONCAT(tbl_students.lastname, ', ', tbl_students.firstname, ' ', tbl_students.middlename)  as fullname,CONCAT(tbl_faculties_staff.faculty_lastname, ', ', tbl_faculties_staff.faculty_firstname, ' ', tbl_faculties_staff.faculty_middlename)  as faculty_fullname,tbl_subjects_new.subj_id,tbl_schedules.class_id,tbl_faculties_staff.faculty_id, CONCAT(tbl_faculties_staff.faculty_lastname, ', ', tbl_faculties_staff.faculty_firstname, ' ', tbl_faculties_staff.faculty_middlename)  as faculty_fullname FROM tbl_enrolled_subjects
  LEFT JOIN tbl_students ON tbl_students.stud_id = tbl_enrolled_subjects.stud_id
  LEFT JOIN tbl_schedules ON tbl_schedules.class_id = tbl_enrolled_subjects.class_id
  LEFT JOIN tbl_faculties_staff ON tbl_faculties_staff.faculty_id = tbl_schedules.faculty_id
  LEFT JOIN tbl_subjects_new ON tbl_subjects_new.subj_id = tbl_enrolled_subjects.subj_id
  WHERE tbl_enrolled_subjects.stud_id = '$_GET[stud_id]' AND tbl_enrolled_subjects.acad_year = '$_SESSION[active_acad]' AND tbl_enrolled_subjects.semester = '$_SESSION[active_sem]'") or die(mysqli_error($db));
while($row = mysqli_fetch_array ($q)){
  $id=$row['enrolled_subj_id']; ?>
    <tr>
                          <td><?php echo $row['subj_code']; ?></td>
                          <td><?php echo $row['subj_desc']; ?></td>
                          <td><?php echo $row['absences']; ?></td>
                          <td><?php echo $row['prelim']; ?></td>
                          <td><?php echo $row['midterm']; ?></td>
                          <td><?php echo $row['finalterm']; ?></td>
                          <td><?php echo $row['ofgrade']; ?></td>
                          <td><?php echo $row['numgrade']; ?></td>
                          
                            <?php if ($row['remarks']== 'Failed') {
                              echo'<td style="background-color: red"> '.$row['remarks'].'</td>';
                            }elseif($row['remarks']== 'INC'){
                              echo'<td style="background-color: yellow"> '.$row['remarks'].'</td>';
                            }elseif($row['remarks']== 'Passed'){
                              echo'<td style="background-color: green"> '.$row['remarks'].'</td>';
                            }else{
                              echo'<td> '.$row['remarks'].'</td>';
                            } ?>
                            
                        </tr>
<?php } ?>
                      </tbody>
                    </table>
                  </div>

<?php   }else{
  $q = mysqli_query($db,"SELECT *, CONCAT(tbl_students.lastname, ', ', tbl_students.firstname, ' ', tbl_students.middlename)  as fullname,tbl_subjects.subj_id,tbl_schedules_old.class_id,tbl_faculties_staff.faculty_id, CONCAT(tbl_faculties_staff.faculty_lastname, ', ', tbl_faculties_staff.faculty_firstname, ' ', tbl_faculties_staff.faculty_middlename)  as faculty_fullname FROM tbl_enrolled_subjects
  LEFT JOIN tbl_students ON tbl_students.stud_id = tbl_enrolled_subjects.stud_id
  LEFT JOIN tbl_schedules_old ON tbl_schedules_old.class_id = tbl_enrolled_subjects.class_id
  LEFT JOIN tbl_faculties_staff ON tbl_faculties_staff.faculty_id = tbl_schedules_old.faculty_id
  LEFT JOIN tbl_subjects ON tbl_subjects.subj_id = tbl_enrolled_subjects.subj_id
  WHERE tbl_enrolled_subjects.stud_id = '$_GET[stud_id]' AND tbl_enrolled_subjects.acad_year = '$_SESSION[active_acad]' AND tbl_enrolled_subjects.semester = '$_SESSION[active_sem]'") or die(mysqli_error($db));
while($row = mysqli_fetch_array ($q)){
  $id=$row['enrolled_subj_id']; ?>
    <tr>
                          <td><?php echo $row['subj_code']; ?></td>
                          <td><?php echo $row['subj_desc']; ?></td>
                          <td><?php echo $row['absences']; ?></td>
                          <td><?php echo $row['prelim']; ?></td>
                          <td><?php echo $row['midterm']; ?></td>
                          <td><?php echo $row['finalterm']; ?></td>
                          <td><?php echo $row['ofgrade']; ?></td>
                          <td><?php echo $row['numgrade']; ?></td>
                          <td><?php echo $row['remarks']; ?></td>
                        </tr>
<?php } ?>
                      </tbody>
                    </table>
                  </div>
<?php }
} ?>
                


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
