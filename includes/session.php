<?php 
session_start();
ob_start();
include 'db.php';

$sql= mysqli_query($db,"SELECT *, tbl_acadyears.ay_id FROM tbl_active_acads
      LEFT JOIN tbl_acadyears ON tbl_acadyears.ay_id = tbl_active_acads.ay_id")or die(mysqli_error($db));
while ($row= mysqli_fetch_array($sql))
	{$_SESSION['active_acad'] = $row['academic_year'];}

$sql= mysqli_query($db,"SELECT *, tbl_semesters.sem_id FROM tbl_active_sem
      LEFT JOIN tbl_semesters ON tbl_semesters.sem_id = tbl_active_sem.sem_id")or die(mysqli_error($db));
while ($row= mysqli_fetch_array($sql))
	{$_SESSION['active_sem'] = $row['semester'];}

if(!isset($_SESSION['userid'])){
	header("Location: ../login/login.php");
}
function message($msg="", $msgtype="") {
	  if(!empty($msg)) {
	    // then this is "set message"
	    // make sure you understand why $this->message=$msg wouldn't work
	    $_SESSION['message'] = $msg;
	    $_SESSION['msgtype'] = $msgtype;
	  } else {
	    // then this is "get message"
			return $message;
	  }
	}
function check_message(){
	
if(isset($_SESSION['message'])){
	if(isset($_SESSION['msgtype'])){
		if ($_SESSION['msgtype']=="info"){
	 		echo  '
	 				<div class="alert alert-info alert1">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="material-icons">close</i>
            </button>
            <span><b> '. $_SESSION['message'] . '</b></span>
          </div>';
	 				 
			}elseif($_SESSION['msgtype']=="error"){
				echo  '
					<div class="alert alert-danger alert1" >
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="material-icons">close</i>
            </button>
            <span><b> '. $_SESSION['message'] . '</b></span>
          </div>';
									
			}elseif($_SESSION['msgtype']=="success"){
				echo  '
					<div class="alert alert-success alert1 ">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="material-icons">close</i>
            </button>
            <span><b> '. $_SESSION['message'] . '</b></span>
          </div>';
          
			}elseif($_SESSION['msgtype']=="warning"){
				echo  '
					<div class="alert alert-warning alert1 ">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="material-icons">close</i>
            </button>
            <span><b> '. $_SESSION['message'] . '</b></span>
          </div>';
				}	
				unset($_SESSION['message']);
	 			unset($_SESSION['msgtype']);
	   		}
  
		}	

	}