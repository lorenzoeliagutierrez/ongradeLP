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
<?php 
if($_SESSION['role'] == "Super Administrator"){
  echo '';

?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Profile</h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Edit Registrar's Profile</h3>
            </div>
            <!-- /.box-header -->
            <form method="POST" autocomplete="off">
            <div class="box-body">
              <div class="row">
                <div class="col-md-10 col-sm-offset-1">
<?php 
$qwerty = mysqli_query($db,"SELECT * from tbl_admins where admin_id = '".$_GET['admin_id']."' ");
                                    while($row = mysqli_fetch_array($qwerty)){
?>
                  <div class="form-group">
                    <label for="fname" class="col-sm-3 control-label">First Name:</label>
                    <div class="col-sm-9">
                      <input type="text" name="fname" required class="form-control" id="fname" value="<?php echo $row['admin_fname'] ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="sname" class="col-sm-3 control-label">Last Name:</label>
                    <div class="col-sm-9">
                      <input type="text" name="sname" required class="form-control" id="sname" value="<?php echo $row['admin_lname'] ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email Address:</label>
                    <div class="col-sm-9">
                      <input type="email" name="email" required class="form-control" id="email" value="<?php echo $row['email'] ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="username" class="col-sm-3 control-label">Username:</label>
                    <div class="col-sm-9">
                      <input type="text" name="username" required class="form-control" id="username" value="<?php echo $row['username'] ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Password:</label>
                    <div class="col-sm-9">
                      <input type="password" name="password" required class="form-control" id="password">
                    </div>
                  </div>
                  <div>
                  <?php } ?>
                    <button type="submit" name="edit" class="btn btn-info pull-right"><i class="fa fa-save"></i> Save</button>
                  </div>
                  </div>
                </div>
            </div>
            <!-- /.box-body -->
            <?php 
              include '../../includes/db.php';
              $id =$_GET['admin_id'];
              if (isset($_POST['edit'])) {
                  $fname = mysqli_real_escape_string($db, $_POST['fname']);
                  $lname = mysqli_real_escape_string($db, $_POST['sname']);
                  $email = mysqli_real_escape_string($db, $_POST['email']);
                  $username = mysqli_real_escape_string($db, $_POST['username']);
                  $password =mysqli_real_escape_string($db,$_POST['password']);
                  $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

                  mysqli_query($db," UPDATE tbl_admins SET admin_fname='$fname',admin_lname='$lname', email='$email', username='$username', password='$hashedPwd' WHERE admin_id = '$id' ")or die(mysqli_error($db));
echo "<script>alert('Profile Successfully Updated!'); window.location='add_registrar.php'</script>"; 
                }
            ?>
          </form>
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
<?php } else {
  header("Location: ../404/404.php");
} ?>
