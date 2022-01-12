<?php

	if(isset($_POST['btn_save'])){
		$ay_id = mysqli_real_escape_string($db,$_POST['hidden_id']);
		$acadyear = mysqli_real_escape_string($db,$_POST['acadyear']);
		
			$chk = mysqli_query($db,
				"SELECT * 
				FROM acadyears_tbl 
				WHERE academic_year = '".$acadyear."' ");
		$ct = mysqli_num_rows($chk);

		if($ct == 0){
			$query = mysqli_query($db,
				"UPDATE acadyears_tbl 
				SET academic_year ='".$acadyear."' WHERE ay_id = $ay_id"); 

			if($query == true){
	            $_SESSION['added'] = 1;
	            echo "<script>alert('Successfully Updated!'); window.location='acadyear.php'</script>";
	            // header("Refresh:1; url=subject.php");
			}
			
			if(mysqli_error($db)){
            header ("location: ".$_SERVER['REQUEST_URI']);
			}
		
		}
		else{
			$_SESSION['duplicate'] = 1;
	            echo "<script>alert('Academic Year already exist!'); window.location='acadyear.php'</script>";
            // header("Refresh:1; url=subject.php");
		}
	}
?>