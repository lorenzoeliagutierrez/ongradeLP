<?php
include '../../includes/db.php';
	if(isset($_POST['assign_subj'])){
		$student = $_POST['student'];
		$acad_year = $_POST['acad_year'];
		$yearlevel = $_POST['yearlevel'];
		$sem = $_POST['sem'];
		

		$chk = mysqli_query($db,"SELECT * from enrolled_subj_tbl where stud_id = '".$student."' AND subj_id = '".$subject."'");
		$ct = mysqli_num_rows($chk);

		if($ct == 0){
			$query = mysqli_query($db,"INSERT INTO stud_subj_tbl (stud_id,ay_id,year_id,sem_id,subj_id,ofgrade,credits) values ('$student','$acad_year','$yearlevel','$sem', '$subject','','')"); 
			
			if($query == true){
	            $_SESSION['added'] = 1;
	            echo "<script>alert('Successfully added!'); window.location='assignsubject.php'</script>";
	            // header("Refresh:1; url=subject.php");
			}
		}
		else{
			$_SESSION['duplicate'] = 1;
	            echo "<script>alert('Student already take this subject!');</script>";
	            header("Refresh:0; url=".$_SERVER['REQUEST_URI']);
            // header("Refresh:1; url=subject.php");
		}
	}
?>