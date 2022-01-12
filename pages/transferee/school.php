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
<!-- ================================================./HEADER================================================= -->
<!-- ================================================SIDEBAR LEFT============================================ -->
                                    <?php include '../../includes/sidebar_left.php'; ?>
<!-- ================================================./SIDEBAR LEFT============================================ -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Add School (for Transferees)</h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Add School (for Transfer Students Only)</h3>
            </div>
            <div class="box-body">
              <form autocomplete="off" method="POST" class="form-horizontal">
                <div class="form-group">
                  <label for="schl_name" class="col-sm-3 control-label">School Name</label>
                  <div class="col-sm-9">
                    <input type="text" name="schl_name" class="form-control" required id="schl_name" placeholder="School Name...">
                  </div>
                </div>
                <div class="form-group">
                  <label for="schl_acr" class="col-sm-3 control-label">School Acronym</label>
                  <div class="col-sm-9">
                    <input type="text" name="schl_acr" class="form-control" required id="schl_acr" placeholder="School Acronym...">
                  </div>
                </div>
                <div>
                  <button type="submit" name="add_schl" class="btn btn-info pull-right">Add School</button>
                </div>

<?php 

include '../../includes/db.php';

if (isset($_POST['add_schl'])) {
  $schl_name = mysqli_real_escape_string($db, $_POST['schl_name']);
  $schl_acr = mysqli_real_escape_string($db, $_POST['schl_acr']);

  $query = mysqli_query($db,"INSERT into schools_tbl (school_name,school_abv) VALUES ('$schl_name','$schl_acr')");
  echo "<script>alert('School Successfully Added!');window.location='school.php'</script>";
}

?>

              </form>
            </div>
          </div>
       
        </section>
        <!-- right col -->

        <section class="content">
          <div class="row">
            <div class="col-lg-12">
              <div class="box box-success">
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>School Name</th>
                  <th>Option</th>
                </tr>
                </thead>
                <tbody>
            <?php
        $squery = mysqli_query($db, "SELECT * ,CONCAT(schools_tbl.school_name, ' ', '- ', ' ', schools_tbl.school_abv) as schl_name FROM schools_tbl");
          while($row = mysqli_fetch_array($squery))
            
       { $id=$row['school_id'];
              echo '
                <tr>
                  <td>'.$row['schl_name'].'</td>
                  <td><button class="btn btn-primary btn-sm" data-target="#editmodalschool'.$row['school_id'].'" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>';?>
                    <a class="btn btn-danger btn-sm" for="DeleteAdmin" href="#delete<?php echo $id;?>" data-toggle="modal" data-target="#delete<?php echo $id;?>">
                                        <i class="glyphicon glyphicon-trash icon-white"></i> Drop
                                    </a>
                    <div class="modal fade" id="delete<?php  echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 style="font-weight: bold" class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-user"></i> Drop Subject</h4>
                                        </div>
                                        <div class="modal-body">
                                                <div class="alert alert-danger">
                                                    Are you sure you want to Drop <?php echo $row['schl_name']?>?
                                                </div>
                                                <div class="modal-footer">
                                                <button class="btn btn-inverse" data-dismiss="modal" aria-hidden="true"><i class="glyphicon glyphicon-remove icon-white"></i> No</button>
                                                <a href="drop_subj.php<?php echo '?enrolled_subj_id='.$id; ?>" style="margin-bottom:5px;" class="btn btn-primary"><i class="glyphicon glyphicon-ok icon-white"></i> Yes</a>
                                                </div>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                    

                  </td>
                </tr><?php include 'editmodalschool.php'; ?>
  <?php } ?>    
                
              </tbody>
            </table>
                </div>
              </div>
            </div>
          </div>
        </section>
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
