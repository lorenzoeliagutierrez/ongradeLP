<?php session_start();
include "../../includes/db.php"; ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body, html {
    height: 100%;
    margin: 0;
}

.bg::after {
  content: '';
  height: 100vh;
  width: 100%;
  background-image: url(../../assets/img/hallway.jpg);
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
  display: block;
  filter: blur(0px);
  -webkit-filter: blur(5px);
  transition: all 1000ms;
  }
/*.bg:hover::after {
   
  filter: blur(10px);
  -webkit-filter: blur(10px);
}
.bg:hover .content {
  filter: blur(0px);
  -webkit-filter: blur(0px);
}*/
.footer {
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    color: white;
    text-align: center;
    background: rgba(255, 0, 0, 0.5);
}

.content {
  position: absolute;
  z-index: 1;
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  /*filter: blur(10px);
  -webkit-filter: blur(10px);*/
  }

  .loginBox {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 350px;
  height: 420px;
  padding: 70px 40px;
  box-sizing: border-box;
  background: rgba(0, 0, 0, 0.3999999);
}

.user {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  overflow: hidden;
  position: absolute;
  top: calc(-100px/2);
  left: calc(50% - 50px);
}

h2 {
  margin: 0;
  padding: 0 0 26px;
  color: #fff;
  text-align: center;
}

.loginBox p {
  margin: 0;
  padding: 0;
  font-weight: bold;
  color: #fff;
}

.loginBox input {
  width: 100%;
  margin-bottom: 20px;
}

.loginBox button {
  width: 100%;
  margin-bottom: 20px;
}

.loginBox input[type="text"],
.loginBox input[type="password"] {
  border: none;
  border-bottom: 1px solid #fff;
  background: transparent;
  outline: none;
  height: 40px;
  color: #fff;
  font-size: 16px;
}

::placeholder
{
  color: rgba(255, 255, 255, 0.5);
}

.loginBox button[type="submit"] {
  border: none;
  outline: none;
  height: 40px;
  color: #eee;
  font-size: 16px;
  cursor: pointer;
  border-radius: 20px;
  margin: 12px 0 18px;
  background: rgba(255,0,0, 0.3);
}

.loginBox button[type="submit"]:hover {
background: rgba(255,0,0, 0.3);
  color: #fff;
}

.loginBox a {
  color: #fff;
  font-size: 14px;
  font-weight: bold;
  text-decoration: none;
}
</style>
</head>
<body>


<div class="bg">
    <div class="content">
       <div class="loginBox">    
  <a href="http://clpc-32/ces/index.php"><img class="user" src="../../img/logo.png"></a>
  <h2>Log In Here</h2>
  <form method="POST" autocomplete="off">
    <p>Username</p>
    <input type="text" name="username" placeholder="Enter Username" required  autofocus>
    <p>Password</p>
    <input type="password" name="password" placeholder="Enter Password" required>
    <button type="submit" name="btn_login">Login</button>
    <a href="forgot_pass.php">Forgot Password?</a>
  </form>
</div>
    </div>
</div>

<div class="footer">

    <p>SFAC-Bacoor Campus | Online Grading System | Alrights Reserved &copy; <?php echo date('Y') ?><small style="float: right; margin-right: 5px">COMPSOC Batch 19-20</small></p>
</div>
<?php
        include "../../includes/db.php";
        if(isset($_POST['btn_login'])) 
       
        { $username = mysqli_real_escape_string($db, $_POST['username']);
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
                    echo "<script>alert('Your password is invalid!'); window.location='index2.php'</script>";
                    exit();
                  } 
                  elseif ($hashedPwdCheck == true) 
                  {
                    $_SESSION['role'] = "Registrar";
                    $_SESSION['userid'] = $row['admin_id'];
                    $_SESSION['name'] = $row['admin_lastname'].', '.$row['admin_firstname'];
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
                    echo "<script>alert('Your password is invalid!'); window.location='index2.php'</script>";
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
                    echo "<script>alert('Your password is invalid!'); window.location='index2.php'</script>";
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
                    echo "<script>alert('Your password is invalid!'); window.location='index2.php'</script>";
                    exit();
                  } 
                  elseif ($hashedPwdCheck1 == true) 
                  {
                   $_SESSION['role'] = "Faculty Staff";
                   $_SESSION['userid'] = $row['faculty_id'];
                   $_SESSION['name'] = $row['faculty_lastname'].', '.$row['faculty_firstname'];
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
                    echo "<script>alert('Your password is invalid!'); window.location='index2.php'</script>";
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
                echo "<script>alert('Invalid Account!'); window.location='index2.php'</script>";
                } 
        }
        
      ?>

</body>
</html>
