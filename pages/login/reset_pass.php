<?php session_start();
ob_start(); ?>
<?php include '../../includes/db.php';
$email = $_GET['email'];
$code = $_GET['activation_code'];?>
<!DOCTYPE html>
<html>
<!-- ============================================HEAD CSS LINKS============================================= -->
                                    <?php include '../../includes/head_css.php'; ?>
<!-- ============================================./HEAD CSS LINKS============================================= -->
<body class="hold-transition skin-blue sidebar-mini">

  
    <!-- Content Header (Page header) -->
    <section class="content-header" style="text-align: center;">
      <h1>Student Academic Record Management System</h1>
    </section>

    <!-- Main content -->
    <section class="content" style="padding-top: 100px ">
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-md-4 col-md-offset-4">
          <div class="box" style="border: 2px #ccc solid">
            <div class="box-header" style="text-align: center;font-size: 30px">
              <h1 class="box-title"><strong>Reset Password</strong></h1>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form class="form-horizontal" method="POST" autocomplete="off" action="reset_exe.php">
                <input type="hidden" name="code" value="<?php echo $code;?>" />
                <input type="hidden" name="email" value="<?php echo $email;?>" />
                <div class="form-group">
                  <div class="col-sm-10 col-sm-offset-1">
                  <label for="password" class="control-label"><strong>Password</strong></label>
                    <input required name="password" id="username" class="form-control input-sm" type="password" placeholder="Password..." />
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-10 col-sm-offset-1">
                  <label for="confirm" class="control-label"><strong>Confirm Password</strong></label>
                    <input required name="confirm" id="comfirm" class="form-control input-sm" type="password" placeholder="Confirm Password..." />
                  </div>
                </div>  
                <div style="text-align: center;">
                  <button type="submit" name="reset" class="col-sm-10 col-sm-offset-1 btn btn-info btn-md">Reset Password</button>
                </div>
              </form>
            </div>
            <!-- /.box-body -->
          </div>
        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  

     

<!-- =================================================FOOTER================================================== -->
                                 
<!-- =================================================FOOTER================================================== -->

<!-- =================================================SCRIPT================================================== -->
                                    <?php include '../../includes/script.php'; ?>
<!-- =================================================SCRIPT================================================== -->

</body>
</html>