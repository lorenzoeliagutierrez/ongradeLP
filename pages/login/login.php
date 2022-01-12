<?php 
ob_start();
session_start();
?>
<!DOCTYPE html>
<html>
<!-- ============================================HEAD CSS LINKS============================================= -->
                                    <?php include '../../includes/head_css.php'; ?>
<!-- ============================================./HEAD CSS LINKS============================================= -->
<body class="hold-transition skin-blue sidebar-mini" style="width: auto;height: auto; background-image: linear-gradient(rgba(00,0,0,0),rgba(47,23,15,.65)), url('../../assets/img/hallway.jpg');
  background-attachment: fixed;
  background-position: auto;
  background-size: cover;">

  
    <!-- Content Header (Page header) -->
    <section class="content-header" style="text-align: center;">
      <h1 style="color: white;"><a href="http://clpc-32/ces">Student Academic Record Management System</a> </h1>
    </section>

    <!-- Main content -->
    <section class="content" style="padding-top: 100px ">
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-md-4 col-md-offset-4">
          <div class="box" style="border: 2px #ccc solid">
            <div class="box-header" style="text-align: center;font-size: 30px">
              <h1 class="box-title"><strong>LOGIN</strong></h1>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form class="form-horizontal" method="POST" autocomplete="off">
                <div class="form-group">
                  <div class="col-sm-10 col-sm-offset-1">
                  <label for="username" class="control-label"><strong>Username</strong></label>
                    <input required name="username" id="username" class="form-control input-sm" type="text" placeholder="Username..." autofocus="on" autocomplete="off" />
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-10 col-sm-offset-1">
                  <label for="password" class="control-label"><strong>Password</strong></label>
                    <input required name="password" id="password" class="form-control input-sm" type="password" placeholder="Password..." autocomplete="off" />
                  </div>
                </div>  
                <div style="text-align: center;">
                  <button type="submit" name="btn_login" class="col-sm-10 col-sm-offset-1 btn btn-info btn-md">Login</button>
                </div>
                  <a href="forgot_pass.php" class="col-sm-12" style="padding-top: 10px;">Forgot Password?</a>
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
  

      <?php
        include "../../includes/db.php";
        if(isset($_POST['btn_login']))
        // { 
        //     $username = mysqli_real_escape_string($db, $_POST['username']);
        //     $password = mysqli_real_escape_string($db, $_POST['password']);


        //     $admin = mysqli_query($db, "SELECT * from tbl_admins where username = '$username' ");
        //     $numrow = mysqli_num_rows($admin);

        //     $student = mysqli_query($db, "SELECT * from students_tbl where username = '$username' ");
        //     $numrow1 = mysqli_num_rows($student);

        //     if($numrow > 0)
        //     {   
        //         while($row = mysqli_fetch_array($admin)){
        //           $_SESSION['role'] = "Administrator";
        //           $_SESSION['userid'] = $row['admin_id'];
        //         }    
        //         echo "<script>alert('Login Successfully!'); window.location='../dashboard/dashboard.php'</script>";
        //     }
        //     elseif($numrow1 > 0)
        //       { 
        //         while($row = mysqli_fetch_array($student)){
        //           $_SESSION['role'] = "Student";
        //           $_SESSION['userid'] = $row['stud_id'];
        //         } 
        //         echo "<script>alert('Login Successfully!'); window.location='../user/user.php'</script>";
        //       }
        //      else
        //         {
        //         echo "<script>alert('Invalid Account!'); window.location='login.php'</script>";
        //         }
             
        // }




        { 
            $username = mysqli_real_escape_string($db, $_POST['username']);
            $password = mysqli_real_escape_string($db, $_POST['password']);

            $super_admin = mysqli_query($db, "SELECT * from tbl_super_admins where username = '$username' ");
            $numrow2 = mysqli_num_rows($super_admin);

            $admin = mysqli_query($db, "SELECT * from tbl_admins where username = '$username' ");
            $numrow = mysqli_num_rows($admin);

            $student = mysqli_query($db, "SELECT * from tbl_students where username = '$username' ");
            $numrow1 = mysqli_num_rows($student);

            $faculty = mysqli_query($db, "SELECT * from tbl_faculties_staff where username = '$username' ");
            $numrow3 = mysqli_num_rows($faculty);

            $faculty_adviser = mysqli_query($db, "SELECT * from tbl_faculties where username = '$username' ");
            $numrow4 = mysqli_num_rows($faculty_adviser);


            if($numrow > 0)
            {   
                while($row = mysqli_fetch_array($admin))
                {
                  $hashedPwdCheck = password_verify($password, $row['password']);
                  if ($hashedPwdCheck == false) 
                  {
                    echo "<script>alert('Your password is invalid!'); window.location='login.php'</script>";
                    exit();
                  } 
                  elseif ($hashedPwdCheck == true) 
                  {
                    $_SESSION['role'] = "Registrar";
                    $_SESSION['userid'] = $row['admin_id'];
                  }    
                  header("location:../dashboard/dashboard.php");
                }
            }
            elseif($numrow1 > 0)
              {   
                while($row = mysqli_fetch_array($student))
                {
                  $hashedPwdCheck1 = password_verify($password, $row['password']);
                  if ($hashedPwdCheck1 == false) 
                  {
                    echo "<script>alert('Your password is invalid!'); window.location='login.php'</script>";
                    exit();
                  } 
                  elseif ($hashedPwdCheck1 == true) 
                  {
                   $_SESSION['role'] = "Student";
                   $_SESSION['userid'] = $row['stud_id'];
                  } 
                 header("location:../dashboard/dashboard.php");
                }
              }
            elseif($numrow2 > 0)
              {   
                while($row = mysqli_fetch_array($super_admin))
                {
                  $hashedPwdCheck1 = password_verify($password, $row['password']);
                  if ($hashedPwdCheck1 == false) 
                  {
                    echo "<script>alert('Your password is invalid!'); window.location='login.php'</script>";
                    exit();
                  } 
                  elseif ($hashedPwdCheck1 == true) 
                  {
                   $_SESSION['role'] = "Super Administrator";
                   $_SESSION['userid'] = $row['sa_id'];
                  } 
                  header("location:../dashboard/dashboard.php");
                }
              }
            elseif($numrow3 > 0)
              {   
                while($row = mysqli_fetch_array($faculty))
                {
                  $hashedPwdCheck1 = password_verify($password, $row['password']);
                  if ($hashedPwdCheck1 == false) 
                  {
                    echo "<script>alert('Your password is invalid!'); window.location='login.php'</script>";
                    exit();
                  } 
                  elseif ($hashedPwdCheck1 == true) 
                  {
                   $_SESSION['role'] = "Faculty Staff";
                   $_SESSION['userid'] = $row['faculty_id'];
                   $_SESSION['updated_by'] = $row['faculty_lastname'].', '.$row['faculty_firstname'];            
                  } 
                  header("location:../dashboard/dashboard.php");
                }
              }
              elseif($numrow4 > 0)
              {   
                while($row = mysqli_fetch_array($faculty_adviser))
                {
                  $hashedPwdCheck1 = password_verify($password, $row['password']);
                  if ($hashedPwdCheck1 == false) 
                  {
                    echo "<script>alert('Your password is invalid!'); window.location='login.php'</script>";
                    exit();
                  } 
                  elseif ($hashedPwdCheck1 == true) 
                  {
                   $_SESSION['role'] = "Faculty Adviser";
                   $_SESSION['userid'] = $row['faculty_id'];
                  } 
                  header("location:../dashboard/dashboard.php");
                }
              }
             else
                {
                echo "<script>alert('Invalid Account!'); window.location='login.php'</script>";
                }
             
        }
      ?>

<!-- =================================================FOOTER================================================== -->
                                 
<!-- =================================================FOOTER================================================== -->

<!-- =================================================SCRIPT================================================== -->
                                    <?php include '../../includes/script.php'; ?>
<!-- =================================================SCRIPT================================================== -->

</body>
</html>