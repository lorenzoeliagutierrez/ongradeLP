<?php

include 'db.php';
  echo '
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="../dashboard/dashboard.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>SN</span>
      <!-- logo for regular state and mobile devices -->
      <img src="../../img/sfac.jpg" style="height: 50px; width: 50px; float: left;">
      <span class="logo-lg">SFAC-LP</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">';
           
        if($_SESSION['role'] == "Registrar"){
                                    $user = mysqli_query($db,"SELECT * from tbl_admins where admin_id = '".$_SESSION['userid']."' ");
                                    while($row = mysqli_fetch_array($user)){
                                        $_SESSION['user'] = $row['admin_firstname'].' '.$row['admin_lastname'];
                                        echo '
          <img src="data:image/jpeg;base64,'.base64_encode( $row['img'] ).'" class="user-image" alt="User Image">';
                                    }
                                }
                                elseif($_SESSION['role'] == "Student"){
                                    $user = mysqli_query($db,"SELECT * from tbl_students where stud_id = '".$_SESSION['userid']."' ");
                                    while($row = mysqli_fetch_array($user)){
                                        $_SESSION['user'] = $row['firstname'].' '.$row['lastname'];
                                        echo '
          <img src="data:image/jpeg;base64,'.base64_encode( $row['img'] ).'" class="user-image" alt="User Image">';
                                    }
                                }
                                elseif($_SESSION['role'] == "Super Administrator"){
                                    $user = mysqli_query($db,"SELECT * from tbl_super_admins where sa_id = '".$_SESSION['userid']."' ");
                                    while($row = mysqli_fetch_array($user)){
                                        $_SESSION['user'] = $row['name'];
                                        echo '
          <img src="data:image/jpeg;base64,'.base64_encode( $row['img'] ).'" class="user-image" alt="User Image">';
                                    }
                                }
                                elseif($_SESSION['role'] == "Faculty Staff"){
                                    $user = mysqli_query($db,"SELECT * from tbl_faculties_staff where faculty_id = '".$_SESSION['userid']."' ");
                                    while($row = mysqli_fetch_array($user)){
                                        $_SESSION['user'] = $row['faculty_firstname'];
                                        echo '
          <img src="data:image/jpeg;base64,'.base64_encode( $row['img'] ).'" class="user-image" alt="User Image">';
                                    }
                                }

            echo '
              <span class="hidden-xs">';
                                if($_SESSION['role'] == "Registrar"){
                                    $user = mysqli_query($db,"SELECT * from tbl_admins where admin_id = '".$_SESSION['userid']."' ");
                                    while($row = mysqli_fetch_array($user)){
                                        $_SESSION['user'] = $row['admin_firstname'].' '.$row['admin_lastname'];
                                        echo $row['admin_firstname'];
                                    }
                                }
                                elseif($_SESSION['role'] == "Student"){
                                    $user = mysqli_query($db,"SELECT * from tbl_students where stud_id = '".$_SESSION['userid']."' ");
                                    while($row = mysqli_fetch_array($user)){
                                        $_SESSION['user'] = $row['firstname'].' '.$row['lastname'];
                                        echo $row['firstname'].' '.$row['lastname'];
                                    }
                                }
                                elseif($_SESSION['role'] == "Super Administrator"){
                                    $user = mysqli_query($db,"SELECT * from tbl_super_admins where sa_id = '".$_SESSION['userid']."' ");
                                    while($row = mysqli_fetch_array($user)){
                                        $_SESSION['user'] = $row['name'];
                                        echo $row['name'];
                                    }
                                }
                                elseif($_SESSION['role'] == "Faculty Staff"){
                                  echo 'se';
                                    $user = mysqli_query($db,"SELECT * from tbl_faculties_staff where faculty_id = '".$_SESSION['userid']."' ");
                                    while($row = mysqli_fetch_array($user)){
                                        $_SESSION['user'] = $row['faculty_firstname'];
                                        echo $row['faculty_firstname'];
                                    }
                                } 
                   echo '               
              </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">';
              
        if($_SESSION['role'] == "Administrator"){
                                    $user = mysqli_query($db,"SELECT * from tbl_admins where admin_id = '".$_SESSION['userid']."' ");
                                    while($row = mysqli_fetch_array($user)){
                                        $_SESSION['user'] = $row['admin_firstname'].' '.$row['admin_lastname'];
                                        echo '
          <img src="data:image/jpeg;base64,'.base64_encode( $row['img'] ).'" class="img-circle" alt="User Image">';
                                    }
                                }
                                elseif($_SESSION['role'] == "Student"){
                                    $user = mysqli_query($db,"SELECT * from tbl_students where stud_id = '".$_SESSION['userid']."' ");
                                    while($row = mysqli_fetch_array($user)){
                                        $_SESSION['user'] = $row['firstname'].' '.$row['lastname'];
                                        echo '
          <img src="data:image/jpeg;base64,'.base64_encode( $row['img'] ).'" class="img-circle" alt="User Image">';
                                    }
                                }
                                elseif($_SESSION['role'] == "Super Administrator"){
                                    $user = mysqli_query($db,"SELECT * from tbl_super_admins where sa_id = '".$_SESSION['userid']."' ");
                                    while($row = mysqli_fetch_array($user)){
                                        $_SESSION['user'] = $row['name'];
                                        echo '
          <img src="data:image/jpeg;base64,'.base64_encode( $row['img'] ).'" class="img-circle" alt="User Image">';
                                    }
                                }
                                elseif($_SESSION['role'] == "Faculty Staff"){
                                    $user = mysqli_query($db,"SELECT * from tbl_faculties_staff where faculty_id = '".$_SESSION['userid']."' ");
                                    while($row = mysqli_fetch_array($user)){
                                        $_SESSION['user'] = $row['faculty_firstname'];
                                        echo '
          <img src="data:image/jpeg;base64,'.base64_encode( $row['img'] ).'" class="img-circle" alt="User Image">';
                                    }
                                }

                                echo '
                <p>
                  '.$_SESSION['user'].'
                  <small>'.$_SESSION['role'].'</small>
                </p>
                
              </li>
              <!-- Menu Footer-->
              <div class="user-footer">
              <li>
                <div class="pull-left">
                  <a href="../edit/editprofile.php" class="btn btn-default btn-flat"><i class="fa fa-edit" aria-hidden="true"></i> Edit Profile</a>
                </div>
              </li>
              <li>
                <div class="pull-right">
                  <a href="../login/logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
              </div>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>'; ?>