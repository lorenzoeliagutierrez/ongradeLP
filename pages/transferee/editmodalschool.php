<?php echo '
<div id="editmodalschool'.$row['school_id'].'" class="modal fade">
<form method="POST">
  <div class="modal-dialog modal-sm" style="width:50% !important;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Edit Subject</h4>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" value="'.$row['school_id'].'" name="hidden_id" id="hidden_id"/>
                <div class="row">
              <div class="box-body">
                <div class="form-group">
                  <label for="school_name" class="col-sm-3 control-label">Subject Code</label>
                  <div class="col-sm-9">
                    <input type="text" name="school_name" class="form-control text text-block" required id="school_name" value="'.$row['school_name'].'">
                  </div>
                </div>
                <div class="form-group">
                  <label for="school_abv" class="col-sm-3 control-label">Subject Code</label>
                  <div class="col-sm-9">
                    <input type="text" name="school_abv" class="form-control text text-block" required id="school_abv" value="'.$row['school_abv'].'">
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
        </div>
              <!-- /.box-footer -->
          </div>

        </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" name="btn_save" value="Save"/>
        </div>
    </div>
  </div>
</form>
</div>';

if (isset($_POST['btn_save'])) {
  $hidden_id = mysqli_real_escape_string($db,$_POST['hidden_id']);
  $school_name = mysqli_real_escape_string($db,$_POST['school_name']);
  $school_abv = mysqli_real_escape_string($db,$_POST['school_abv']);

  $query = mysqli_query($db,"UPDATE schools_tbl SET school_name = '".$school_name."', school_abv = '".$school_abv."' where school_id = '".$hidden_id."'");

  echo "<script>alert('Successfully Updated!');</script>";
  header("Refresh:0; url=".$_SERVER['REQUEST_URI']);

  if(mysqli_error($db)){
            header ("location: ".$_SERVER['REQUEST_URI']);
    }
}

?>