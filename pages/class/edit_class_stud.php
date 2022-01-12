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
      <h1>Upadate/Change Section</h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <divv class="col-sm-10 col-sm-offset-1">
          <?php check_message(); ?>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><strong>Upadate/Change Section</strong></h3>
            </div>
            <!-- /.box-header -->
            <form method="POST" autocomplete="off" enctype="multipart/form-data">
            <div class="box-body">
              <div class="row">
                <div class="col-md-10 col-sm-offset-1">
                  <div class="form-group">
<?php 
$que = mysqli_query($db,
  "SELECT *,CONCAT(tbl_students.lastname, ', ', tbl_students.firstname, ' ', tbl_students.middlename)  as fullname 
  FROM tbl_enrolled_subjects 
  LEFT JOIN tbl_subjects ON tbl_subjects.subj_id = tbl_enrolled_subjects.subj_id
  LEFT JOIN tbl_students ON tbl_students.stud_id = tbl_enrolled_subjects.stud_id
  LEFT JOIN tbl_schedules_old ON tbl_schedules_old.class_id = tbl_enrolled_subjects.class_id
  LEFT JOIN tbl_faculties_staff ON tbl_faculties_staff.faculty_id = tbl_schedules_old.faculty_id 
  WHERE tbl_enrolled_subjects.acad_year = '$_SESSION[active_acad]' 
  AND tbl_enrolled_subjects.semester='$_SESSION[active_sem]' 
  AND tbl_subjects.subj_code = '$_GET[code]' 
  AND tbl_schedules_old.section = '$_GET[section]' 
  AND tbl_enrolled_subjects.stud_id ='$_GET[stud_id]'
  And tbl_enrolled_subjects.enroll_status = 'Approved'

  UNION 

  SELECT *,CONCAT(tbl_students.lastname, ', ', tbl_students.firstname, ' ', tbl_students.middlename)  as fullname 
  FROM tbl_enrolled_subjects 
  LEFT JOIN tbl_subjects_new ON tbl_subjects_new.subj_id = tbl_enrolled_subjects.subj_id
  LEFT JOIN tbl_students ON tbl_students.stud_id = tbl_enrolled_subjects.stud_id
  LEFT JOIN tbl_schedules ON tbl_schedules.class_id = tbl_enrolled_subjects.class_id
  LEFT JOIN tbl_faculties_staff ON tbl_faculties_staff.faculty_id = tbl_schedules.faculty_id 
  WHERE tbl_enrolled_subjects.acad_year = '$_SESSION[active_acad]' 
  AND tbl_enrolled_subjects.semester='$_SESSION[active_sem]' 
  AND tbl_subjects_new.subj_code = '$_GET[code]' 
  AND tbl_schedules.section = '$_GET[section]' 
  AND tbl_enrolled_subjects.stud_id ='$_GET[stud_id]'
  And tbl_enrolled_subjects.enroll_status = 'Approved'
  ");
while($row = mysqli_fetch_array($que)){
?>
                    <label>Name</label>
                    <input name="enrolled_subj_id" id="enrolled_subj_id" class="form-control input-sm" type="hidden" value="<?php echo $row['enrolled_subj_id']; ?>" />
                    <input name="username" disabled id="username" class="form-control input-sm" type="text" value="<?php echo $row['fullname']; ?>" />
                    <?php } ?>
                    <label>Section for (<?php echo $_GET['code'] ?>)</label>
                  
                    <select name="section1" id="section1" data-style="btn-primary" required class="form-control input-sm select-2" required>
                        <option selected disabled>-- Select Section --</option>
                        <?php
$quer = mysqli_query($db,
  "SELECT class_id,section 
  FROM tbl_schedules 
  WHERE class_code = '$_GET[code]'
  AND tbl_schedules.semester='$_SESSION[active_sem]'
  AND tbl_schedules.acad_year = '$_SESSION[active_acad]'
  GROUP BY section
UNION
SELECT class_id,section 
FROM tbl_schedules_old 
WHERE class_code = '$_GET[code]' 
AND tbl_schedules_old.semester='$_SESSION[active_sem]'
AND tbl_schedules_old.acad_year = '$_SESSION[active_acad]'
GROUP BY section");

while($row1 = mysqli_fetch_array($quer)){
                                    echo '<option value="'.$row1['class_id'].'">'.$row1['section'].'</option>';
                                }
                            ?>
                      </select>
                  
                  </div>

                <div>
                  <a href="javascript:history.back()" class="btn btn-primary">Back</a>
                  <input type="submit" name="edit" class="btn btn-danger pull-right" value="Change Section" onclick="return confirm('Are you sure you want to transfer this student?');"/>
                </div>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </form>
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- /.row (main row) -->
<?php 

if (isset($_POST['edit'])) {

  $enrolled_subj_id =mysqli_real_escape_string($db,$_POST['enrolled_subj_id']);
  $section =mysqli_real_escape_string($db,$_POST['section1']);


  $query = mysqli_query($db,
    "UPDATE tbl_enrolled_subjects 
    SET class_id = '$section' 
    WHERE enrolled_subj_id = '$enrolled_subj_id' ")or die(mysqli_error($db));
  if($query == true)
    { 
      header("Refresh:0");
      message("Successfully Updated!","success");
    }else{
      header("Refresh:0");
      message("Something went wrong!","danger");
    }
}

?>
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
