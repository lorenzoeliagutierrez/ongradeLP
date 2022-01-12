 <?php
        include "../../includes/db.php";
        if(isset($_POST['reset']))
     {  
        $email = $_POST['email'];
        $code = $_POST['code'];
        $password = mysqli_real_escape_string($db,$_POST['password']);
        $confirm = mysqli_real_escape_string($db,$_POST['confirm']);


          if ($password == $confirm) {
            $super_admin = mysqli_query($db, "SELECT * from super_tbl where email = '$email' ");
            $numrow2 = mysqli_num_rows($super_admin);

            $admin = mysqli_query($db, "SELECT * from tbl_admins where email = '$email' ");
            $numrow = mysqli_num_rows($admin);

            $student = mysqli_query($db, "SELECT * from students_tbl where email = '$email' ");
            $numrow1 = mysqli_num_rows($student);

            $faculty = mysqli_query($db, "SELECT * from faculties_tbl where email = '$email' ");
            $numrow3 = mysqli_num_rows($faculty);

            if ($numrow == 1) {
              $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
              $query3 = mysqli_query($db,"update tbl_admins set password='".$hashedPwd."' where email='".$email."' and activation_code='".$code."'")or die(mysqli_error($db)); 
              echo "<script>alert('Password successfully changed!'); window.location='login.php'</script>";
            }  
            elseif ($numrow1 == 1) {
              $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
               $query3 = mysqli_query($db,"update students_tbl set password='".$hashedPwd."' where email='".$email."' and activation_code='".$code."'")or die(mysqli_error($db)); 
              echo "<script>alert('Password successfully changed!'); window.location='login.php'</script>";
             }
            elseif ($numrow2 == 1) {
              $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
               $query3 = mysqli_query($db,"update super_tbl set password='".$hashedPwd."' where email='".$email."' and activation_code='".$code."'")or die(mysqli_error($db)); 
              echo "<script>alert('Password successfully changed!'); window.location='login.php'</script>";
             }
            elseif ($numrow3 == 1) {
              $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
               $query3 = mysqli_query($db,"update faculties_tbl set password='".$hashedPwd."' where email='".$email."' and activation_code='".$code."'")or die(mysqli_error($db)); 
              echo "<script>alert('Password successfully changed!'); window.location='login.php'</script>";
             }
            else{
              echo "<script>alert('Someting went wrong!'); window.location='login.php'</script>";
            }
          }
          else{
            echo "<script>alert('Password did not match!')</script>";
          }
     }
      ?>