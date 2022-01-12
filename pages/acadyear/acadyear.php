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
<!-- =================================================./HEADER================================================== -->
<!-- ================================================SIDEBAR LEFT============================================ -->
                                    <?php include '../../includes/sidebar_left.php'; ?>
<!-- ================================================./SIDEBAR LEFT============================================ -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Academic Year</h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        
        <div class="col-sm-10 col-sm-offset-1">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Academic Years</h3><button style="float: right;" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addAcadModal"><i class="fa fa-plus" aria-hidden="true"></i> Add Academic Year</button>
            </div>
               
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Academic Year</th>
                  <th>Option</th>
                </tr>
                </thead>
                <tbody>
                     <?php
                      $squery = mysqli_query($db, 
                        "SELECT * 
                        FROM acadyears_tbl 
                        ORDER BY academic_year DESC");
                          while($row = mysqli_fetch_array($squery))
                            { echo '
                                <tr>
                                  <td>'.$row['academic_year'].'</td>
                                  <td><button class="btn btn-primary btn-sm" data-target="#editModal'.$row['ay_id'].'" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></td>
                                </tr>';
                                include 'editmodal.php';
                            }
                      ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <?php include 'editfunction.php'; ?>
        <?php include 'addModal.php'; ?>
        <?php include 'addModalfunction.php'; ?>
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
