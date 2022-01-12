<?php session_start();
ob_start(); ?>
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
              <h1 class="box-title"><strong>Forgot Password?</strong></h1>
              <h4>Please enter your email address and we'll send you instruction on how to reset your password</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form class="form-horizontal" method="POST" >
                <div class="form-group">
                  <div class="col-sm-10 col-sm-offset-1">
                    <input required name="email" id="email" class="form-control input-sm" type="email" placeholder="Email..." autocomplete="off" autofocus="on" />
                  </div>
                </div>
                
                <div style="text-align: center;">
                  <button type="submit" name="send" class="col-sm-10 col-sm-offset-1 btn btn-info btn-md">Submit</button>
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
  

      <?php
        include "../../includes/db.php";
        if(isset($_POST['send']))
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
            $email = mysqli_real_escape_string($db, $_POST['email']);
            $code = rand(100,999);

            $super_admin = mysqli_query($db, "SELECT * from super_tbl where email = '$email' ");
            $numrow2 = mysqli_num_rows($super_admin);

            $admin = mysqli_query($db, "SELECT * from tbl_admins where email = '$email' ");
            $numrow = mysqli_num_rows($admin);

            $student = mysqli_query($db, "SELECT * from students_tbl where email = '$email' ");
            $numrow1 = mysqli_num_rows($student);

            $faculty = mysqli_query($db, "SELECT * from faculties_tbl where email = '$email' ");
            $numrow3 = mysqli_num_rows($faculty);


            if($numrow > 0)
            {   
                $query2 = mysqli_query($db,"update tbl_admins set activation_code='$code' where email='$email' ") or die(mysqli_error($db)); 
            }
            elseif($numrow1 > 0)
              {   
                $query2 = mysqli_query($db,"update students_tbl set activation_code='$code' where email='$email' ") or die(mysqli_error($db)); 
              }
            elseif($numrow2 > 0)
              {   
                $query2 = mysqli_query($db,"update super_tbl set activation_code='$code' where email='$email' ") or die(mysqli_error($db)); 
              }
            elseif($numrow3 > 0)
              {   
                $query2 = mysqli_query($db,"update faculties_tbl set activation_code='$code' where email='$email' ") or die(mysqli_error($db)); 
              }
             else
                {
                echo "<script>alert('Email does not exist in our database!'); window.location='forgot_pass.php'</script>";
                die();
                }
             

require('../php-mailer-master/PHPMailerAutoload.php');

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'fajut.vhan@gmail.com';                 // SMTP username
    $mail->Password = 'zyxwvutsrqpo';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
    //Recipients
    $mail->setFrom('fajut.vhan@gmail.com', 'SFAC-Student Record Management System');
    $mail->addAddress($email);     // Add a recipient

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Reset Password';
    $mail->Body    = '<a href="http://localhost/softeng/pages/login/reset_pass.php?email='.$email.'&activation_code='.$code.'"><strong>Click Here</strong></a> to reset password';
   

    $mail->send();
    echo "<script>alert('Message has been sent to your email!');window.location='forgot_pass.php'</script>";
} 
    catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}

}?>

<!-- =================================================FOOTER================================================== -->
                                 
<!-- =================================================FOOTER================================================== -->

<!-- =================================================SCRIPT================================================== -->
                                    <?php include '../../includes/script.php'; ?>
<!-- =================================================SCRIPT================================================== -->

</body>
</html>