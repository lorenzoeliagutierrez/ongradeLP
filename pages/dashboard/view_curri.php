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
      <h1>View Curriculum</h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
            <div class="row">
            <div class="col-md-12">
              <form method="POST">
              <div class="row">
                <div class="col-lg-12">
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
                $_SESSION['userid'] = mysqli_real_escape_string($db,$_POST['name']);

              $que = mysqli_query($db,
          "SELECT * 
          FROM tbl_students 
          LEFT JOIN tbl_courses ON tbl_courses.course_id = tbl_students.course_id
          LEFT JOIN tbl_genders ON tbl_genders.gender_id = tbl_students.gender_id 
          WHERE stud_id= '$_SESSION[userid]'");
        while ($row = mysqli_fetch_array($que))
               if($row['course_id'] == '1' && $row['curri']== 'Old Curri'){
                echo'<script>{
                location.replace("../view_curri/view_curri_cs_old.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'")}
                  </script>';
              }
              elseif ($row['course_id'] == '1' && $row['curri']== 'New Curri') {
                echo'<script>{
                location.replace("../view_curri/view_curri_cs_new.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'")}
                  </script>';
              }
              elseif($row['course_id'] == '6' && $row['curri']== 'Old Curri'){
                echo'<script>{
                location.replace("../view_curri/view_curri_ahrm_old.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'")}
                  </script>';
              }
              elseif($row['course_id'] == '2' && $row['curri']== 'Old Curri'){
                echo'<script>{
                location.replace("../view_curri/view_curri_hrm_old.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'")}
                  </script>';
              }
              elseif($row['course_id'] == '15' && $row['curri']== 'New Curri'){
                echo'<script>{
                location.replace("../view_curri/view_curri_hrm_new.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'")}
                  </script>';
              }
              elseif($row['course_id'] == '3' && $row['curri']== 'New Curri'){
                echo'<script>{
                location.replace("../view_curri/view_curri_bamm_new.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'")}
                  </script>';
              }
              elseif($row['course_id'] == '3' && $row['curri']== 'Old Curri'){
                echo'<script>{
                location.replace("../view_curri/view_curri_bamm_old.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'")}
                  </script>';
              }
              elseif($row['course_id'] == '14' && $row['curri']== 'Old Curri'){
                echo'<script>{
                location.replace("../view_curri/view_curri_bam_old.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'")}
                  </script>';
              }
              elseif($row['course_id'] == '25' && $row['curri']== 'New Curri'){
                echo'<script>{
                location.replace("../view_curri/view_curri_bafm_new.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'")}
                  </script>';
              }
              elseif($row['course_id'] == '24' && $row['curri']== 'New Curri'){
                echo'<script>{
                location.replace("../view_curri/view_curri_tcp_new.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'")}
                  </script>';
              }
              elseif($row['curri']== 'New Curri' && $row['course_id'] == '13' || $row['course_id'] == '17'){
                echo'<script>{
                location.replace("../view_curri/view_curri_eced_new.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'")}
                  </script>';
              }
              elseif($row['curri']== 'New Curri' && $row['course_id'] == '19'){
                echo'<script>{
                location.replace("../view_curri/view_curri_beed_new.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'")}
                  </script>';
              }
              elseif($row['curri']== 'Old Curri' && $row['course_id'] == '13'){
                echo'<script>{
                location.replace("../view_curri/view_curri_eced_old.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'")}
                  </script>';
              }
              elseif($row['curri']== 'New Curri' && $row['course_id'] == '18'){
                echo'<script>{
                location.replace("../view_curri/view_curri_bped_new.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'")}
                  </script>';
              }
              elseif($row['curri']== 'New Curri' && $row['course_id'] == '16'){
                echo'<script>{
                location.replace("../view_curri/view_curri_sped_new.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'")}
                  </script>';
              }
              elseif($row['curri']== 'New Curri' && $row['course_id'] == '10'){
                echo'<script>{
                location.replace("../view_curri/view_curri_eng_new.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'")}
                  </script>';
              }
              elseif($row['curri']== 'New Curri' && $row['course_id'] == '11'){
                echo'<script>{
                location.replace("../view_curri/view_curri_fili_new.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'")}
                  </script>';
              }
              elseif($row['curri']== 'New Curri' && $row['course_id'] == '12'){
                echo'<script>{
                location.replace("../view_curri/view_curri_math_new.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'")}
                  </script>';
              }
              elseif($row['curri']== 'Old Curri' && $row['course_id'] == '10'){
                echo'<script>{
                location.replace("../view_curri/view_curri_eng_old.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'")}
                  </script>';
              }
              elseif($row['curri']== 'Old Curri' && $row['course_id'] == '11'){
                echo'<script>{
                location.replace("../view_curri/view_curri_fili_old.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'")}
                  </script>';
              }
              elseif($row['curri']== 'Old Curri' && $row['course_id'] == '12'){
                echo'<script>{
                location.replace("../view_curri/view_curri_math_old.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'")}
                  </script>';
              }

                ?>
          
                            <?php
                            } ?>
                                                        
                                      

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
