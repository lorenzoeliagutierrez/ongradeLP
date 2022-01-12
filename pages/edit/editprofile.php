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
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Profile</h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Edit Profile</h3>
            </div>
            <!-- /.box-header -->
            <form method="POST" autocomplete="off" enctype="multipart/form-data">
            <div class="box-body">
              <div class="row">
                <div class="col-md-6 col-sm-offset-3">
                    
                      <?php 
                                if($_SESSION['role'] == "Registrar"){
                                    $user = mysqli_query($db,"SELECT * from tbl_admins where admin_id = '".$_SESSION['userid']."' ");
                                    while($row = mysqli_fetch_array($user)){
                                        $_SESSION['user'] = $row['admin_lastname'];
                                        echo '
                                              <div class="form-group">
                                                  <label>Username:</label>
                                                  <input required name="username" id="username" class="form-control input-sm" type="text" value="'.$row['username'].'" />
                                              </div>
                                              <div class="form-group">
                                                  <label>Image:</label><img style="height:50px;width:50px; float:right" src="data:image/jpeg;base64,'.base64_encode( $row['img'] ).'" class="img-circle" alt="User Image">
                                                  <input type="file" name="image">
                                              </div>
                                              <div class="form-group">
                                                  <label>Email:</label>
                                                  <input required name="email" id="email" class="form-control input-sm" type="email" value="'.$row['email'].'" />
                                              </div>
                                              <div class="form-group">
                                                <label>Password:</label>
                                                <input required name="password" id="password" class="form-control input-sm" type="password" value="" />
                                              </div>
                                              <div class="form-group">
                                                <label>Confirm Password:</label>
                                                <input required name="confirm" id="confirm" class="form-control input-sm" type="password" value="" />
                                              </div>
                                              ';
                                        }
                                }
                                elseif($_SESSION['role'] == "Student"){
                                    $user = mysqli_query($db,"SELECT * from tbl_students where stud_id = '".$_SESSION['userid']."' ");
                                    while($row = mysqli_fetch_array($user)){
                                        $_SESSION['user'] = $row['firstname'].' '.$row['lastname'];
                                        echo '<div class="form-group">
                                                  <label>Username:</label>
                                                  <input required name="username" id="username" class="form-control input-sm" type="text" value="'.$row['username'].'" />
                                              </div>
                                              <div class="form-group">
                                                  <label>Image:</label><img style="height:50px;width:50px; float:right" src="data:image/jpeg;base64,'.base64_encode( $row['img'] ).'" class="img-circle" alt="User Image">
                                                  <input type="file" name="image">
                                              </div>
                                              <div class="form-group">
                                                  <label>Email:</label>
                                                  <input required name="email" id="email" class="form-control input-sm" type="email" value="'.$row['email'].'" />
                                              </div>
                                              <div class="form-group">
                                                <label>Password:</label>
                                                <input required name="password" id="password" class="form-control input-sm" type="password" value="" />
                                              </div>
                                              <div class="form-group">
                                                <label>Confirm Password:</label>
                                                <input required name="confirm" id="confirm" class="form-control input-sm" type="password" value="" />
                                              </div>
                                              ';
                                    }
                                }
                                elseif($_SESSION['role'] == "Super Administrator"){
                                    $user = mysqli_query($db,"SELECT * from tbl_super_admins where sa_id = '".$_SESSION['userid']."' ");
                                    while($row = mysqli_fetch_array($user)){
                                        $_SESSION['user'] = $row['name'];
                                        echo '
                                              <div class="form-group">
                                                  <label>Username:</label>
                                                  <input required name="username" id="username" class="form-control input-sm" type="text" value="'.$row['username'].'" />
                                              </div>
                                              <div class="form-group">
                                                  <label>Image:</label><img style="height:50px;width:50px; float:right" src="data:image/jpeg;base64,'.base64_encode( $row['img'] ).'" class="img-circle" alt="User Image">
                                                  <input type="file" name="image">
                                              </div>
                                              <div class="form-group">
                                                  <label>Email:</label>
                                                  <input required name="email" id="email" class="form-control input-sm" type="email" value="'.$row['email'].'" />
                                              </div>
                                              <div class="form-group">
                                                <label>Password:</label>
                                                <input required name="password" id="password" class="form-control input-sm" type="password" value="" />
                                              </div>
                                              <div class="form-group">
                                                <label>Confirm Password:</label>
                                                <input required name="confirm" id="confirm" class="form-control input-sm" type="password" value="" />
                                              </div>
                                              ';
                                        }
                                } 
                                elseif($_SESSION['role'] == "Faculty Staff"){
                                    $user = mysqli_query($db,"SELECT * from tbl_faculties_staff where faculty_id = '".$_SESSION['userid']."' ");
                                    while($row = mysqli_fetch_array($user)){
                                        $_SESSION['user'] = $row['faculty_firstname'];
                                        echo '
                                              <div class="form-group">
                                                  <label>Username:</label>
                                                  <input required name="username" id="username" class="form-control input-sm" type="text" value="'.$row['username'].'" />
                                              </div>
                                              <div class="form-group">
                                                  <label>Image:</label><img style="height:50px;width:50px; float:right" src="data:image/jpeg;base64,'.base64_encode( $row['img'] ).'" class="img-circle" alt="User Image">
                                                  <input type="file" name="image">
                                              </div>
                                              <div class="form-group">
                                                  <label>Email:</label>
                                                  <input required name="email" id="email" class="form-control input-sm" type="email" value="'.$row['email'].'" />
                                              </div>
                                              <div class="form-group">
                                                <label>Password:</label>
                                                <input required name="password" id="password" class="form-control input-sm" type="password" value="" />
                                              </div>
                                              <div class="form-group">
                                                <label>Confirm Password:</label>
                                                <input required name="confirm" id="confirm" class="form-control input-sm" type="password" value="" />
                                              </div>
                                              ';
                                        }
                                }
                        
                      ?>

                <div>
                  <input type="submit" name="edit" class="btn btn-info pull-right" value="Save"/>
                </div>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <?php 
              include '../../includes/db.php';
              
                

                if (isset($_POST['edit'])) {

  $link = mysqli_connect("localhost","root","","enrollment") or die("Error ".mysqli_error($link));
                $id = mysqli_real_escape_string($db,$_SESSION['userid']);
                $username = mysqli_real_escape_string($db,$_POST['username']);
                $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
                $email = mysqli_real_escape_string($db,$_POST['email']);
                $password = mysqli_real_escape_string($db,$_POST['password']);
                $confirm = mysqli_real_escape_string($db,$_POST['confirm']);
                  
    // $query = "INSERT INTO news(`title`,`content`,`image`,`date`,`author`) VALUES ('$title','$content','$image','$date','$author')";
    //   $link->query($query) or die("Error : ".mysqli_error($link));      
    // mysqli_close($link);

if ($password == $confirm) {
  if ($_SESSION['role'] == "Registrar") {
                  $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                  $query = "UPDATE tbl_admins SET username = '".$username."', img = '".$image."', email = '".$email."', password = '".$hashedPwd."'  where admin_id = '".$id."'";
                  $link->query($query) or die("Error : ".mysqli_error($link));
                  echo "<script>alert('Update Success!');window.location='editprofile.php'</script>";      
                  
                }
                elseif ($_SESSION['role'] == "Student") {
                  $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                  $query = mysqli_query($db, "UPDATE tbl_students SET username = '".$username."', img = '".$image."', email = '".$email."', password = '".$hashedPwd."'  where stud_id = '".$id."'");
                echo "<script>alert('Update Success!');window.location='editprofile.php'</script>";
                }
                elseif ($_SESSION['role'] == "Super Administrator") {
                  $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                  $query = "UPDATE tbl_super_admins SET username = '".$username."', img = '".$image."', email = '".$email."', password = '".$hashedPwd."'  where sa_id = '".$id."'";
                  $link->query($query) or die("Error : ".mysqli_error($link));
                  echo "<script>alert('Update Success!');window.location='editprofile.php'</script>"; 
                }elseif ($_SESSION['role'] == "Faculty Staff") {
                  $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                  $query = "UPDATE tbl_faculties_staff SET username = '".$username."', img = '".$image."', email = '".$email."', password = '".$hashedPwd."'  where faculty_id = '".$id."'";
                  $link->query($query) or die("Error : ".mysqli_error($link));
                  echo "<script>alert('Update Success!');window.location='editprofile.php'</script>"; 
                }
}else{
  echo "<script>alert('Password did not match!')</script>";
}
                
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
