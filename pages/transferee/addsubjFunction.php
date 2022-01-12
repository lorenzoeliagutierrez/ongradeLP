<?php
include '../../includes/db.php';
	if(isset($_POST['add_subj'])){
		$subj_code = mysqli_real_escape_string($db,$_POST['subj_code']);
		$subj_desc = mysqli_real_escape_string($db,$_POST['subj_desc']);
		$units = mysqli_real_escape_string($db,$_POST['units']);
		

		$chk = mysqli_query($db,"SELECT * from trans_subj_tbl where subj_code = '".$subj_code."' AND subj_desc = '".$subj_desc."'");
		$ct = mysqli_num_rows($chk);

		if($ct == 0){
			$query = mysqli_query($db,"INSERT INTO trans_subj_tbl (subj_code,subj_desc,unit_id) values ('$subj_code','$subj_desc','$units')"); 
			
			if($query == true){
	            $_SESSION['added'] = 1;
	            echo "<script>alert('Subject Successfully added!');window.location='trans_subj.php'</script>";
	            // header("Refresh:1; url=subject.php");
			}
		}
		else{
			$_SESSION['duplicate'] = 1;
	             echo "<script>alert('Subject already exist!');window.location='trans_subj.php'</script>";
	            
            // header("Refresh:1; url=subject.php");
		}
	}
?>