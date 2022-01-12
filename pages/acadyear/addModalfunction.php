<?php
	if(isset($_POST['btn_add_acad'])){
		$acadyear = mysqli_real_escape_string($db,$_POST['acadyear']);

		
		$chk = mysqli_query($db,
			"SELECT * 
			FROM acadyears_tbl 
			WHERE academic_year = '".$acadyear."' ");
		$ct = mysqli_num_rows($chk);

		if($ct == 0){
			$query = mysqli_query($db,
				"INSERT INTO acadyears_tbl (academic_year) 
				VALUES ('".$acadyear."')");

			if($query == true){
	            $_SESSION['added'] = 1;
	            echo "<script>alert('Successfull added!'); 
	            	window.location='acadyear.php'</script>";
	            // header("Refresh:1; url=subject.php");
			}
		}
		else{
			$_SESSION['duplicate'] = 1;
	            echo "<script>alert('Academic Year already exist!'); window.location='acadyear.php'</script>";
            // header("Refresh:1; url=subject.php");
		}
	}
?>