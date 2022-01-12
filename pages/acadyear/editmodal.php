<?php echo '
<div id="editModal'.$row['ay_id'].'" class="modal fade">
<form method="POST" class="form-horizontal">
  <div class="modal-dialog modal-sm" style="width:35% !important;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Edit Academic Year</h4>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" value="'.$row['ay_id'].'" name="hidden_id" id="hidden_id"/>
                <div class="row">
            <div class="box-header with-border">
              <h3 class="box-title">Academic Year Details</h3>
            </div>
              <div class="box-body">
                <div class="form-group">
                  <label for="acadyear" class="col-sm-3 control-label">Academic Year</label>
                  <div class="col-sm-9">
                    <input type="text" name="acadyear" class="form-control" required id="acadyear" value="'.$row['academic_year'].'">
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
</div>';?>