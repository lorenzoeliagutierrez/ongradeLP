<?php

	if(isset($_POST['btn_save'])){
		$stud_subj_id = $_POST['hidden_id'];
		$stud_id = $_POST['stud_id'];
		$subject = $_POST['subject'];
		$acad_year = $_POST['acad_year'];
		$yearlevel = $_POST['yearlevel'];
		$sem = $_POST['sem'];
		$grade = $_POST['grade'];

		// $chk = mysqli_query($db,"SELECT * from stud_subj_tbl where stud_id = '".$stud_id."' AND subj_id = '".$subject."'");
		// $ct = mysqli_num_rows($chk);

		// if($ct == 0){
			$query = mysqli_query($db,"UPDATE stud_subj_tbl SET ay_id = '".$acad_year."', year_id = '".$yearlevel."', sem_id = '".$sem."', subj_id = '".$subject."', ofgrade = '".$grade."' where stud_subj_id = '".$stud_subj_id."' "); 
			
			if($query == true){
	        $_SESSION['edit'] = 1;
	        echo "<script>alert('Successfully Updated!');</script>";
	            header("Refresh:0; url=".$_SERVER['REQUEST_URI']);
	    }
	            // header;
			
		
		if(mysqli_error($db)){
            header ("location: ".$_SERVER['REQUEST_URI']);
		}

	}
	// else{
	// 		$_SESSION['duplicate'] = 1;
	//             echo "<script>alert('Student already take this subject!');</script>";
	//             header("Refresh:0; url=".$_SERVER['REQUEST_URI']);
 //            // header("Refresh:1; url=subject.php");
	// 	}
	// }

?>