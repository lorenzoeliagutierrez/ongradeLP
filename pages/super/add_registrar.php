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
    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-5 connectedSortable">
          <h3>Add Registrar</h3>
          <div class="box box-primary">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form class="form-horizontal" method="POST">
                <div class="form-group">
                  <label for="fname" class="col-sm-3 control-label">First Name:</label>
                  <div class="col-sm-9">
                    <input type="text" name="fname" required class="form-control" id="fname" placeholder="Registrar's First Name...">
                  </div>
                </div>
                <div class="form-group">
                  <label for="sname" class="col-sm-3 control-label">Last Name:</label>
                  <div class="col-sm-9">
                    <input type="text" name="sname" required class="form-control" id="sname" placeholder="Registrar's Last Name...">
                  </div>
                </div>
                <div class="form-group">
                  <label for="email" class="col-sm-3 control-label">Email Address:</label>
                  <div class="col-sm-9">
                    <input type="email" name="email" required class="form-control" id="email" placeholder="Email Address...">
                  </div>
                </div>
                <div class="form-group">
                  <label for="username" class="col-sm-3 control-label">Username:</label>
                  <div class="col-sm-9">
                    <input type="text" name="username" required class="form-control" id="username" placeholder="Username...">
                  </div>
                </div>
                <div class="form-group">
                  <label for="password" class="col-sm-3 control-label">Password:</label>
                  <div class="col-sm-9">
                    <input type="password" name="password" required class="form-control" id="password" placeholder="Password...">
                  </div>
                </div>
                <div>
                  <button type="submit" name="add_registrar" class="btn btn-info pull-right">Add Registrar</button>
                </div>
              </form>
<?php
if (isset($_POST['add_registrar'])) {
  $fname = mysqli_real_escape_string($db, $_POST['fname']);
  $lname = mysqli_real_escape_string($db, $_POST['sname']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password =mysqli_real_escape_string($db,$_POST['password']);
  $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

  $run_sql = mysqli_query($db,"INSERT INTO tbl_admins (admin_fname,admin_lname,email,activation_code,username,password) VALUES ('$fname','$lname','$email','','$username','$hashedPwd')");

  if($run_sql == true){
              $_SESSION['added'] = 1;
              echo "<script>alert('Successfull added!'); window.location='add_registrar.php'</script>";
              // header("Refresh:1; url=subject.php");
      }
  else{
    echo "<script>alert('Something went wrong!'); window.location='add_registrar.php'</script>";
  }

}
?>
            </div>
            <!-- /.box-body -->
          </div>
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-7 connectedSortable">
          <h3>Registrar List</h3>
        <div class="box box-success">
          <div class="box-body">
            <table id="example1" class="table table-striped table-bordered" >
                            <thead style="background: #ccc">
                                <tr>
                                    <th>Fisrt Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                <?php include '../../includes/db.php';
                                $query = mysqli_query($db, "SELECT * FROM tbl_admins");
                                while ($row= mysqli_fetch_array ($query)){
                                    $id=$row['admin_id'];
                                    ?><tr>
                                    <td><?php echo $row['admin_fname']; ?></td>
                                    <td><?php echo $row['admin_lname']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><a class="btn btn-danger" style="float:right" for="DeleteAdmin" href="#delete<?php echo $id;?>" data-toggle="modal" data-target="#delete<?php echo $id;?>">
                                        <i class="glyphicon glyphicon-trash icon-white"></i> Delete
                                    </a>
                                    <a class="btn btn-primary" style="float:right" for="ViewAdmin" href="edit_registrar.php<?php echo '?admin_id='.$id; ?>">
                                    <i class="fa fa-edit"></i> Update</a>

                                    <div class="modal fade" id="delete<?php  echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 style="font-weight: bold" class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-user"></i> Delete Registrar</h4>
                                        </div>
                                        <div class="modal-body">
                                                <div class="alert alert-danger">
                                                    Are you sure you want to delete <?php echo $row['admin_fname'].' '.$row['admin_lname'] ?>?
                                                </div>
                                                <div class="modal-footer">
                                                <button class="btn btn-inverse" data-dismiss="modal" aria-hidden="true"><i class="glyphicon glyphicon-remove icon-white"></i> No</button>
                                                <a href="delete_registrar.php<?php echo '?admin_id='.$id; ?>" style="margin-bottom:5px;" class="btn btn-primary"><i class="glyphicon glyphicon-ok icon-white"></i> Yes</a>
                                                </div>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                   </td>
                                </tr>
                                <?php } ?>

                            </tbody>
                            </table>
          </div>
        </div> 
          
        </section>
        <!-- right col -->
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
