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
      <h1>List of Enrolled Student(s) in <strong><?php echo $_GET['code']; ?></strong> - Section <strong><?php echo $_GET['section'] ?></strong> - A.Y. <strong><?php echo $_SESSION['active_acad'].'-'.$_SESSION['active_sem'] ?></strong></h1>
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
              <?php $que= mysqli_query($db,"
                SELECT * 
                FROM tbl_subjects_new 
                where subj_code = '$_GET[code]' 
                UNION 
                SELECT * 
                FROM tbl_subjects where subj_code = '$_GET[code]' LIMIT 1");
              while ($row = mysqli_fetch_array($que)) {
                ?>
              <h2 class="box-title">Students Enrolled in <strong><?php echo $_GET['code'].' - '.$row['subj_desc']; ?></strong> - Section <strong><?php echo $_GET['section'] ?></strong></h2>
            <?php } ?>
              <a href="javascript:history.back()" class="btn btn-primary pull-right">Back</a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover dataTable">
                <thead>
                <tr>
                 <th>Image</th>
                  <th>Student#</th>
                  <th>Student Name</th>
                  <th>Course</th>
                  <th>Prelim</th>
                  <th>Midterm</th>
                  <th>Finalterm</th>
                  <th>Final Grade</th>
                  <th>Numerical Grade</th>
                  <th>Updated At</th>
                  <th>Updated By</th>
                  <th>Remarks</th>
                  <th>Absences</th>
                  <th>Option</th>
                </tr>
                </tr>
                </thead>
                <tbody>
                  <?php 

                  $que = mysqli_query($db,
                        "SELECT *,tbl_students.img,CONCAT(tbl_students.lastname, ', ', tbl_students.firstname, ' ', tbl_students.middlename)  AS fullname
                        FROM tbl_enrolled_subjects 
                        LEFT JOIN tbl_subjects ON tbl_subjects.subj_id = tbl_enrolled_subjects.subj_id
                        LEFT JOIN tbl_students ON tbl_students.stud_id = tbl_enrolled_subjects.stud_id
                        LEFT JOIN tbl_courses ON tbl_courses.course_id = tbl_students.course_id
                        LEFT JOIN tbl_schedules_old ON tbl_schedules_old.class_id = tbl_enrolled_subjects.class_id
                        LEFT JOIN tbl_faculties_staff ON tbl_faculties_staff.faculty_id = tbl_schedules_old.faculty_id
                        WHERE tbl_enrolled_subjects.acad_year = '$_SESSION[active_acad]' 
                        AND tbl_enrolled_subjects.semester='$_SESSION[active_sem]' 
                        AND tbl_subjects.subj_code = '$_GET[code]' 
                        AND tbl_schedules_old.section = '$_GET[section]'
                        And tbl_enrolled_subjects.enroll_status = 'Approved'

                        UNION
                        SELECT *,tbl_students.img,CONCAT(tbl_students.lastname, ', ', tbl_students.firstname, ' ', tbl_students.middlename)  AS fullname
                        FROM tbl_enrolled_subjects 
                        LEFT JOIN tbl_subjects_new ON tbl_subjects_new.subj_id = tbl_enrolled_subjects.subj_id
                        LEFT JOIN tbl_students ON tbl_students.stud_id = tbl_enrolled_subjects.stud_id
                        LEFT JOIN tbl_courses ON tbl_courses.course_id = tbl_students.course_id
                        LEFT JOIN tbl_schedules ON tbl_schedules.class_id = tbl_enrolled_subjects.class_id
                        LEFT JOIN tbl_faculties_staff ON tbl_faculties_staff.faculty_id = tbl_schedules.faculty_id 
                        WHERE tbl_enrolled_subjects.acad_year = '$_SESSION[active_acad]' 
                        AND tbl_enrolled_subjects.semester='$_SESSION[active_sem]' 
                        AND tbl_subjects_new.subj_code = '$_GET[code]' 
                        AND tbl_schedules.section = '$_GET[section]'
                        And tbl_enrolled_subjects.enroll_status = 'Approved'
                        ORDER BY fullname");

                  while($row = mysqli_fetch_array($que)){
                    echo'<tr> <style>
                      .zoom:hover{
                        -ms-transform: scale(3);
                        -webkit-transform: scale(3);
                        transform: scale(3);
                        margin-left: 50px;
                      }
                    </style>
                                    <td>'; if(empty($row['img'])){
                                                        echo'<img class="img zoom" style="height:80px; width:80px;" src="../../img/user2.png" />';
                                                      }else{ echo' <img class="img zoom" style="height:80px; width:80px;" src="data:image/jpeg;base64,'.base64_encode( $row['img'] ).'" "/>';} 
                                                      echo'</td>
                                    <td>'.$row['stud_no'].'</td>
                                    <td>'.strtoupper($row['fullname']).'</td>
                                    <td>'.$row['course'].'</td>
                                    <td>'.$row['prelim'].'</td>
                                    <td>'.$row['midterm'].'</td>
                                    <td>'.$row['finalterm'].'</td>
                                    <td>'.$row['ofgrade'].'</td>
                                    <td>'.$row['numgrade'].'</td>
                                    <td>'.$row['last_update'].'</td>
                                    <td>'.$row['updated_by'].'</td>';

                                    if ($row['remarks']== 'Failed') {
                                          echo'<td style="color: red"> '.$row['remarks'].'</td>';
                                    }
                                    elseif($row['remarks']== 'Passed'){
                                          echo'<td style="color: green"> '.$row['remarks'].'</td>';
                                    }
                                    else{
                                      echo'<td> '.$row['remarks'].'</td>';
                                    }

                              echo'<td>'.$row['absences'].'</td>
                              
                                    <td>
                                      <a href="../class/edit_class_stud.php?stud_id='.$row['stud_id'].'&code='.$_GET['code'].'&section='.$row['section'].'" class="btn btn-danger">Transfer to other Section</a>
                                      <button class="btn btn-success btn-sm" data-target="#editModal'.$row['enrolled_subj_id'].'" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Enter Grade</button>
                                    </td>
                          </tr> 

                                  <!--==========================ENTER GRADE MODAL==========================-->
                  <div id="editModal'.$row['enrolled_subj_id'].'" class="modal fade">
                  <form method="POST" class="form-horizontal">
                    <div class="modal-dialog modal-sm" style="width:40% !important;">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h4 class="modal-title">Enter Grade for <strong>'.$row['fullname'].'</strong></h4>
                          </div>
                          <div class="modal-body">
                          <div class="row">
                              <div class="col-md-12">
                                  <input type="hidden" value="'.$row['enrolled_subj_id'].'" name="hidden_id" id="hidden_id"/>
                                  <div class="row">
                              <div class="box-header with-border">
                                <h3 class="box-title"></h3>
                              </div>
                                <div class="box-body">
                                  <div class="form-group">
                                    <label for="acadyear" class="col-sm-3 control-label">Prelim</label>
                                    <div class="col-sm-9">';
                                    if ($row['special_tut'] == '0' || $row['special_tut'] == ''){
                                      if($_SESSION['active_sem'] == 'Summer'){
                                        echo'
                                      <input type="text" disabled name="prelim" class="form-control" id="prelim" value="'.$row['prelim'].'">';}
                                      else{ echo '
                                      <input type="text" name="prelim" class="form-control" id="prelim" value="'.$row['prelim'].'">';}
                                    }else{
                                      echo'
                                      <input type="text" disabled name="prelim" class="form-control" id="prelim" value="'.$row['prelim'].'">';
                                    }
                                    echo'</div>
                                  </div>
                                  <div class="form-group">
                                    <label for="acadyear" class="col-sm-3 control-label">Midterm</label>
                                    <div class="col-sm-9">
                                      <input type="text" name="midterm" class="form-control" id="midterm" value="'.$row['midterm'].'">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="acadyear" class="col-sm-3 control-label">Final Term</label>
                                    <div class="col-sm-9">
                                      <input type="text" name="finalterm" class="form-control" id="finalterm" value="'.$row['finalterm'].'">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="acadyear" class="col-sm-3 control-label">Final Grade</label>
                                    <div class="col-sm-9">
                                      <input type="text" disabled name="ofgrade" class="form-control" id="ofgrade" value="'.$row['ofgrade'].'">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="acadyear" class="col-sm-3 control-label">Num Grade</label>
                                    <div class="col-sm-9">
                                      <input type="text" disabled name="numgrade" class="form-control" id="numgrade" value="'.$row['numgrade'].'">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="acadyear" class="col-sm-3 control-label">Absences</label>
                                    <div class="col-sm-9">
                                      <input type="text" name="absences" class="form-control" id="absences" value="'.$row['absences'].'">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="acadyear" class="col-sm-3 control-label">Remarks</label>
                                    <div class="col-sm-9">
                                      <input type="text" disabled name="remarks" class="form-control" id="remarks" value="'.$row['remarks'].'">
                                    </div>
                                  </div>
                                </div>
                                <!-- /.box-body -->
                          </div>
                                <!-- /.box-footer -->
                            </div>

                          </div>
                          </div>
                          <div class="modal-footer">
                              <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
                              <input type="submit" class="btn btn-primary btn-sm" name="btn_save" value="Save"/>
                          </div>
                      </div>
                    </div>
                  </form>
                  </div>';
                  
if (isset($_POST['btn_save'])) 
{
                    $enrolled_subj_id = mysqli_real_escape_string($db,$_POST['hidden_id']);

      if ($_SESSION['active_sem'] == 'First Semester' || $_SESSION['active_sem'] == 'Second Semester') 
      {
                        if ($row['special_tut'] == '0' || $row['special_tut'] == '')
                        {
                                if (empty($_POST['prelim'])) {
                                  $prelim = mysqli_real_escape_string($db,'0');
                                }else{
                                $prelim = mysqli_real_escape_string($db,$_POST['prelim']);
                                }
                                if (empty($_POST['midterm'])) {
                                  $midterm = mysqli_real_escape_string($db,'0');
                                }else{
                                $midterm = mysqli_real_escape_string($db,$_POST['midterm']);
                                }
                                if (empty($_POST['finalterm'])) {
                                  $finalterm = mysqli_real_escape_string($db,'0');
                                }else{
                                $finalterm = mysqli_real_escape_string($db,$_POST['finalterm']);
                                }
                                $ofgrade = mysqli_real_escape_string($db,number_format( (float)(($prelim * 0.3) + ($midterm * 0.3) + ($finalterm * 0.4)), 2, '.', '' ) );

                                if ($prelim== '0' || $midterm == '0' || $finalterm == '0') {
                                  $remarks = mysqli_real_escape_string($db,'INC');
                                  $numgrade = mysqli_real_escape_string($db,'INC');
                                }else{
                                      if ($ofgrade <= 74) {
                                        $numgrade = mysqli_real_escape_string($db,'5.00');
                                        $remarks = mysqli_real_escape_string($db,'Failed');
                                      }elseif ($ofgrade <= 79){
                                        $numgrade = mysqli_real_escape_string($db,'3.00');
                                        $remarks = mysqli_real_escape_string($db,'Passed');
                                      }elseif ($ofgrade <= 82.49){
                                        $numgrade = mysqli_real_escape_string($db,'2.75');
                                        $remarks = mysqli_real_escape_string($db,'Passed');
                                      }elseif ($ofgrade <= 84.49){
                                        $numgrade = mysqli_real_escape_string($db,'2.50');
                                        $remarks = mysqli_real_escape_string($db,'Passed');
                                      }elseif ($ofgrade <= 87.49){
                                        $numgrade = mysqli_real_escape_string($db,'2.25');
                                        $remarks = mysqli_real_escape_string($db,'Passed');
                                      }elseif ($ofgrade <= 92.49){
                                        $numgrade = mysqli_real_escape_string($db,'2.00');
                                        $remarks = mysqli_real_escape_string($db,'Passed');
                                      }elseif ($ofgrade <= 95.49){
                                        $numgrade = mysqli_real_escape_string($db,'1.75');
                                        $remarks = mysqli_real_escape_string($db,'Passed');
                                      }elseif ($ofgrade <= 97.49){
                                        $numgrade = mysqli_real_escape_string($db,'1.50');
                                        $remarks = mysqli_real_escape_string($db,'Passed');
                                      }elseif ($ofgrade <= 99.49){
                                        $numgrade = mysqli_real_escape_string($db,'1.25');
                                        $remarks = mysqli_real_escape_string($db,'Passed');
                                      }elseif ($ofgrade == 100){
                                        $numgrade = mysqli_real_escape_string($db,'1.00');
                                        $remarks = mysqli_real_escape_string($db,'Passed');
                                      }
                                    }
                                     $absences = mysqli_real_escape_string($db,$_POST['absences']);
                                     
                                     
                                     


                    $query = mysqli_query($db,"
                      UPDATE tbl_enrolled_subjects 
                      SET prelim='".$prelim."',
                    midterm='".$midterm."',
                    finalterm='".$finalterm."',
                    ofgrade='".$ofgrade."',
                    numgrade='".$numgrade."',
                    absences='".$absences."',
                    remarks='".$remarks."',
                    last_update ='".date('Y-m-d H:i:s')."', 
                    updated_by ='".$_SESSION['role']." - ".$_SESSION['name']."' 
                      WHERE enrolled_subj_id = '".$enrolled_subj_id."'")or die(mysqli_error($db));
                    if($query == true)
                      { 
                        header("Refresh:0");
                        message("Successfully Updated!","success");
                      }else{
                        header("Refresh:0");
                        message("Something went wrong!","danger");
                      }
                          }
                          else
                          { 
                            if (empty($_POST['midterm'])) {
                        $midterm = mysqli_real_escape_string($db,'0');
                      }else{
                      $midterm = mysqli_real_escape_string($db,$_POST['midterm']);
                      }
                      if (empty($_POST['finalterm'])) {
                        $finalterm = mysqli_real_escape_string($db,'0');
                      }else{
                      $finalterm = mysqli_real_escape_string($db,$_POST['finalterm']);
                      }
                      $ofgrade = mysqli_real_escape_string($db,number_format( (float)( ($midterm * 0.4) + ($finalterm * 0.6)), 2, '.', '' ) );

                      if ($midterm == '0' || $finalterm == '0') {
                        $remarks = mysqli_real_escape_string($db,'INC');
                        $numgrade = mysqli_real_escape_string($db,'INC');
                      }else{
                      if ($ofgrade <= 74) {
                        $numgrade = mysqli_real_escape_string($db,'5.00');
                        $remarks = mysqli_real_escape_string($db,'Failed');
                      }elseif ($ofgrade <= 79){
                        $numgrade = mysqli_real_escape_string($db,'3.00');
                        $remarks = mysqli_real_escape_string($db,'Passed');
                      }elseif ($ofgrade <= 82.49){
                        $numgrade = mysqli_real_escape_string($db,'2.75');
                        $remarks = mysqli_real_escape_string($db,'Passed');
                      }elseif ($ofgrade <= 84.49){
                        $numgrade = mysqli_real_escape_string($db,'2.50');
                        $remarks = mysqli_real_escape_string($db,'Passed');
                      }elseif ($ofgrade <= 87.49){
                        $numgrade = mysqli_real_escape_string($db,'2.25');
                        $remarks = mysqli_real_escape_string($db,'Passed');
                      }elseif ($ofgrade <= 92.49){
                        $numgrade = mysqli_real_escape_string($db,'2.00');
                        $remarks = mysqli_real_escape_string($db,'Passed');
                      }elseif ($ofgrade <= 95.49){
                        $numgrade = mysqli_real_escape_string($db,'1.75');
                        $remarks = mysqli_real_escape_string($db,'Passed');
                      }elseif ($ofgrade <= 97.49){
                        $numgrade = mysqli_real_escape_string($db,'1.50');
                        $remarks = mysqli_real_escape_string($db,'Passed');
                      }elseif ($ofgrade <= 99.49){
                        $numgrade = mysqli_real_escape_string($db,'1.25');
                        $remarks = mysqli_real_escape_string($db,'Passed');
                      }elseif ($ofgrade == 100){
                        $numgrade = mysqli_real_escape_string($db,'1.00');
                        $remarks = mysqli_real_escape_string($db,'Passed');
                      }}
                        $absences = mysqli_real_escape_string($db,$_POST['absences']);
                        
                        $prelim = '';

                        $query = mysqli_query($db,"
                          UPDATE tbl_enrolled_subjects 
                          SET prelim='".$prelim."',
                          midterm='".$midterm."',
                          finalterm='".$finalterm."',
                          ofgrade='".$ofgrade."',
                          numgrade='".$numgrade."',
                          absences='".$absences."',
                          remarks='".$remarks."',
                          last_update ='".date('Y-m-d H:i:s')."',
                          updated_by ='".$_SESSION['role']." - ".$_SESSION['name']."'
                          WHERE enrolled_subj_id = '".$enrolled_subj_id."'")or die(mysqli_error($db));
                        if($query == true)
                          { 
                            header("Refresh:0");
                            message("Successfully Updated!","success");
                          }else{
                            header("Refresh:0");
                            message("Something went wrong!","danger");
                          }
                          }



                   
                    
                  //====================================IF SUMMER TERM==============================
}else{
                    
                      if (empty($_POST['midterm'])) {
                        $midterm = mysqli_real_escape_string($db,'0');
                      }else{
                      $midterm = mysqli_real_escape_string($db,$_POST['midterm']);
                      }
                      if (empty($_POST['finalterm'])) {
                        $finalterm = mysqli_real_escape_string($db,'0');
                      }else{
                      $finalterm = mysqli_real_escape_string($db,$_POST['finalterm']);
                      }
                      $ofgrade = mysqli_real_escape_string($db,number_format( (float)( ($midterm * 0.4) + ($finalterm * 0.6)), 2, '.', '' ) );

                      if ($midterm == '0' || $finalterm == '0') {
                        $remarks = mysqli_real_escape_string($db,'INC');
                        $numgrade = mysqli_real_escape_string($db,'INC');
                      }else{
                      if ($ofgrade <= 74) {
                        $numgrade = mysqli_real_escape_string($db,'5.00');
                        $remarks = mysqli_real_escape_string($db,'Failed');
                      }elseif ($ofgrade <= 79){
                        $numgrade = mysqli_real_escape_string($db,'3.00');
                        $remarks = mysqli_real_escape_string($db,'Passed');
                      }elseif ($ofgrade <= 82.49){
                        $numgrade = mysqli_real_escape_string($db,'2.75');
                        $remarks = mysqli_real_escape_string($db,'Passed');
                      }elseif ($ofgrade <= 84.49){
                        $numgrade = mysqli_real_escape_string($db,'2.50');
                        $remarks = mysqli_real_escape_string($db,'Passed');
                      }elseif ($ofgrade <= 87.49){
                        $numgrade = mysqli_real_escape_string($db,'2.25');
                        $remarks = mysqli_real_escape_string($db,'Passed');
                      }elseif ($ofgrade <= 92.49){
                        $numgrade = mysqli_real_escape_string($db,'2.00');
                        $remarks = mysqli_real_escape_string($db,'Passed');
                      }elseif ($ofgrade <= 95.49){
                        $numgrade = mysqli_real_escape_string($db,'1.75');
                        $remarks = mysqli_real_escape_string($db,'Passed');
                      }elseif ($ofgrade <= 97.49){
                        $numgrade = mysqli_real_escape_string($db,'1.50');
                        $remarks = mysqli_real_escape_string($db,'Passed');
                      }elseif ($ofgrade <= 99.49){
                        $numgrade = mysqli_real_escape_string($db,'1.25');
                        $remarks = mysqli_real_escape_string($db,'Passed');
                      }elseif ($ofgrade == 100){
                        $numgrade = mysqli_real_escape_string($db,'1.00');
                        $remarks = mysqli_real_escape_string($db,'Passed');
                      }}
                        $absences = mysqli_real_escape_string($db,$_POST['absences']);
                        
                        $prelim = '';

                        $query = mysqli_query($db,"
                          UPDATE tbl_enrolled_subjects 
                          SET  prelim='".$prelim."',
                          midterm='".$midterm."',
                          finalterm='".$finalterm."',
                          ofgrade='".$ofgrade."',
                          numgrade='".$numgrade."',
                          absences='".$absences."',
                          remarks='".$remarks."',
                          last_update ='".date('Y-m-d H:i:s')."',
                          updated_by ='".$_SESSION['role']." - ".$_SESSION['name']."'
                           WHERE enrolled_subj_id = '".$enrolled_subj_id."'")or die(mysqli_error($db));
                        if($query == true)
                          { 
                            header("Refresh:0");
                            message("Successfully Updated!","success");
                          }else{
                            header("Refresh:0");
                            message("Something went wrong!","danger");
                          }
                    }
                    
                    



                    
                  }}
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
