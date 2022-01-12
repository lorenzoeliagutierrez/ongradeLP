<?php 

include('../../includes/db.php');

$get_id=$_GET['admin_id'];

mysqli_query($db,"delete from tbl_admins where admin_id = '$get_id' ")or die(mysqli_error($db));

header('location:add_registrar.php');
?>