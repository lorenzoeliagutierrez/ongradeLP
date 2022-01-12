<?php
include 'db.php';
echo '  

<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->



<!-- ===============================================MAIN NAVBAR========================================== -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <div class="user-panel">
        <div class="pull-left image">';

       
        if($_SESSION['role'] == "Registrar"){
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
        </div>
        <div class="pull-left info">
          <p>'.$_SESSION['user'].'</p>
        </div>
      </div>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>';
        if($_SESSION['role'] == "Registrar"){
                            echo '
        <li class="active">
          <a href="../dashboard/dashboard.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <!--<li><a href="../studentsubject/assignsubject.php"><i class="fa fa-cutlery"></i>Assign Subject</a></li>-->
        <li>
          <a href="../faculty/faculty_load.php"><i class="fa fa-list"></i> <span>Faculties Load</span></a>
        </li>
        <li>
          <a href="../dashboard/permanentrecord.php"><i class="fa fa-list"></i> <span>Student Permanent Record</span></a>
        </li>
        <li>
          <a href="../dashboard/view_curri.php"><i class="fa fa-list"></i> <span>View Curriculum</span></a>
        </li>
        <li>
          <a href="../transcript/search_tor.php"><i class="fa fa-list"></i> <span>Transcript of Records</span></a>
        </li>
        <!--<li>
          <a href="../backup/database.php"><i class="fa fa-database"></i> <span>Backup/Restore Database</span></a>
        </li>-->
        '
        ;
      }
      elseif($_SESSION['role'] == "Student"){
                            echo '
        <li>
          <a href="../enrolled_subj/enrolled_subj.php?stud_id='.$_SESSION['userid'].'"><i class="fa fa-book"></i> <span>View Enrolled Subjects</span></a>
        </li>
        <li>
          <a href="../grade/my_grade.php?stud_id='.$_SESSION['userid'].'"><i class="fa fa-book"></i> <span>View Grade</span></a>
        </li>
        <li>
          <a href="../grade/history.php?stud_id='.$_SESSION['userid'].'"><i class="fa fa-book"></i> <span>Grade History</span></a>
        </li>
        <li>
          <a href="../grade/check_list.php?stud_id='.$_SESSION['userid'].'"><i class="fa fa-book"></i> <span>Check List</span></a>
        </li>';
        $que = mysqli_query($db,
          "SELECT * 
          FROM tbl_students 
          LEFT JOIN tbl_courses ON tbl_courses.course_id = tbl_students.course_id
          LEFT JOIN tbl_genders ON tbl_genders.gender_id = tbl_students.gender_id 
          WHERE stud_id= '$_SESSION[userid]'");
        while ($row = mysqli_fetch_array($que))
        {
              if($row['course_id'] == '1' && $row['curri']== 'Old Curri'){
                echo'<li>
                <a href="../view_curri/view_curri_cs_old.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'">
                  <i class="fa fa-book"></i>
                  <span>View Curriculum</span></a>>
                </a>
              </li>';
              }
              elseif ($row['course_id'] == '1' && $row['curri']== 'New Curri') {
                echo'<li>
                <a href="../view_curri/view_curri_cs_new.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'">
                  <i class="fa fa-book"></i>
                  <span>View Curriculum</span></a>>
                </a>
              </li>';
              }
              elseif($row['course_id'] == '6' && $row['curri']== 'Old Curri'){
                echo'<li>
                <a href="../view_curri/view_curri_ahrm_old.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'">
                  <i class="fa fa-book"></i>
                  <span>View Curriculum</span></a>>
                </a>
              </li>';
              }
              elseif($row['course_id'] == '2' && $row['curri']== 'Old Curri'){
                echo'<li>
                <a href="../view_curri/view_curri_hrm_old.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'">
                  <i class="fa fa-book"></i>
                  <span>View Curriculum</span></a>>
                </a>
              </li>';
              }
              elseif($row['course_id'] == '15' && $row['curri']== 'New Curri'){
                echo'<li>
                <a href="../view_curri/view_curri_hrm_new.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'">
                  <i class="fa fa-book"></i>
                  <span>View Curriculum</span></a>>
                </a>
              </li>';
              }
              elseif($row['course_id'] == '3' && $row['curri']== 'New Curri'){
                echo'<li>
                <a href="../view_curri/view_curri_bamm_new.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'">
                  <i class="fa fa-book"></i>
                  <span>View Curriculum</span></a>>
                </a>
              </li>';
              }
              elseif($row['course_id'] == '3' && $row['curri']== 'Old Curri'){
                echo'<li>
                <a href="../view_curri/view_curri_bamm_old.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'">
                  <i class="fa fa-book"></i>
                  <span>View Curriculum</span></a>>
                </a>
              </li>';
              }
              elseif($row['course_id'] == '14' && $row['curri']== 'Old Curri'){
                echo'<li>
                <a href="../view_curri/view_curri_bam_old.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'">
                  <i class="fa fa-book"></i>
                  <span>View Curriculum</span></a>>
                </a>
              </li>';
              }
              elseif($row['course_id'] == '25' && $row['curri']== 'New Curri'){
                echo'<li>
                <a href="../view_curri/view_curri_bafm_new.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'">
                  <i class="fa fa-book"></i>
                  <span>View Curriculum</span></a>>
                </a>
              </li>';
              }
              elseif($row['course_id'] == '24' && $row['curri']== 'New Curri'){
                echo'<li>
                <a href="../view_curri/view_curri_tcp_new.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'">
                  <i class="fa fa-book"></i>
                  <span>View Curriculum</span></a>>
                </a>
              </li>';
              }
              elseif($row['curri']== 'New Curri' && $row['course_id'] == '13' || $row['course_id'] == '17'){
                echo'<li>
                <a href="../view_curri/view_curri_eced_new.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'">
                  <i class="fa fa-book"></i>
                  <span>View Curriculum</span></a>>
                </a>
              </li>';
              }
              elseif($row['curri']== 'New Curri' && $row['course_id'] == '19'){
                echo'<li>
                <a href="../view_curri/view_curri_beed_new.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'">
                  <i class="fa fa-book"></i>
                  <span>View Curriculum</span></a>>
                </a>
              </li>';
              }
              elseif($row['curri']== 'Old Curri' && $row['course_id'] == '13'){
                echo'<li>
                <a href="../view_curri/view_curri_eced_old.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'">
                  <i class="fa fa-book"></i>
                  <span>View Curriculum</span></a>>
                </a>
              </li>';
              }
              elseif($row['curri']== 'New Curri' && $row['course_id'] == '18'){
                echo'<li>
                <a href="../view_curri/view_curri_bped_new.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'">
                  <i class="fa fa-book"></i>
                  <span>View Curriculum</span></a>>
                </a>
              </li>';
              }
              elseif($row['curri']== 'New Curri' && $row['course_id'] == '16'){
                echo'<li>
                <a href="../view_curri/view_curri_sped_new.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'">
                  <i class="fa fa-book"></i>
                  <span>View Curriculum</span></a>>
                </a>
              </li>';
              }
              elseif($row['curri']== 'New Curri' && $row['course_id'] == '10'){
                echo'<li>
                <a href="../view_curri/view_curri_eng_new.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'">
                  <i class="fa fa-book"></i>
                  <span>View Curriculum</span></a>>
                </a>
              </li>';
              }
              elseif($row['curri']== 'New Curri' && $row['course_id'] == '11'){
                echo'<li>
                <a href="../view_curri/view_curri_fili_new.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'">
                  <i class="fa fa-book"></i>
                  <span>View Curriculum</span></a>>
                </a>
              </li>';
              }
              elseif($row['curri']== 'New Curri' && $row['course_id'] == '12'){
                echo'<li>
                <a href="../view_curri/view_curri_math_new.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'">
                  <i class="fa fa-book"></i>
                  <span>View Curriculum</span></a>>
                </a>
              </li>';
              }
              elseif($row['curri']== 'Old Curri' && $row['course_id'] == '10'){
                echo'<li>
                <a href="../view_curri/view_curri_eng_old.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'">
                  <i class="fa fa-book"></i>
                  <span>View Curriculum</span></a>>
                </a>
              </li>';
              }
              elseif($row['curri']== 'Old Curri' && $row['course_id'] == '11'){
                echo'<li>
                <a href="../view_curri/view_curri_fili_old.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'">
                  <i class="fa fa-book"></i>
                  <span>View Curriculum</span></a>>
                </a>
              </li>';
              }
              elseif($row['curri']== 'Old Curri' && $row['course_id'] == '12'){
                echo'<li>
                <a href="../view_curri/view_curri_math_old.php?stud_id='.$_SESSION['userid'].'&course='.$row['course_id'].'">
                  <i class="fa fa-book"></i>
                  <span>View Curriculum</span></a>>
                </a>
              </li>';
              }
        } //end of while loop
      }
      elseif($_SESSION['role'] == "Super Administrator"){
                            echo '
        <li>
          <a href="../dashboard/dashboard.php"><i class="fa fa-book"></i> <span>Dashboard</span></a>
        </li>
        <li>
          <a href="../super/add_registrar.php"><i class="fa fa-book"></i> <span>Add Registrar</span></a>
        </li>';
      }
      elseif($_SESSION['role'] == "Faculty Staff"){
                            echo '
        <li>
          <a href="../dashboard/dashboard.php"><i class="fa fa-book"></i> <span>Dashboard</span></a>
        </li>
        <li>
          <a href="../class/classlist.php"><i class="fa fa-book"></i> <span>Class List</span></a>
        </li>
        <li>
          <a href="../class/class_history.php?stud_id='.$_SESSION['userid'].'"><i class="fa fa-book"></i> <span>Class History</span></a>
        </li>
        ';
      }
      echo '
      </ul>
<!-- ==============================================./MAIN NAVBAR========================================== -->
    </section>
    <!-- /.sidebar -->
  </aside>';

?>