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
      <h1>View TOR</h1>
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
                                  FROM tbl_students where curri = 'New Curri'
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
          WHERE stud_id= '$_SESSION[userid]' and curri='New Curri'")or die(mysqli_error($db));
          while ($row = mysqli_fetch_array($que))
              echo'<script>{
                location.replace("../transcript/tor2.php?stud_id='.$_SESSION['userid'].'")}
                  </script>';
           

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
