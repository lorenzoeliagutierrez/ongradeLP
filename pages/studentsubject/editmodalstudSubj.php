<?php echo '
<div id="editModal'.$row['stud_subj_id'].'" class="modal fade">
<form method="POST">
  <div class="modal-dialog modal-sm" style="width:50% !important;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Edit Student Subject</h4>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" value="'.$row['stud_subj_id'].'" name="hidden_id" id="hidden_id"/>
                <input type="hidden" value="'.$row['stud_id'].'" name="stud_id" id="studhidden_id"/>
                <div class="row">
            <div class="box-header with-border">
              <h3 class="box-title">Details</h3>
            </div>
              <div class="box-body">
                <div class="form-group">
                  <label for="subject" class="col-sm-3 control-label">Subject</label>
                  <div class="col-sm-9">
                    <select name="subject" id="subject" data-style="btn-primary" class="form-control input-sm">
                        <option value="'.$row['subj_id'].'" selected>'.$row['subj_name'].'</option>';
                                $q = mysqli_query($db,"SELECT *, CONCAT(subjects_tbl.subj_code, ' ', '- ', ' ', subjects_tbl.subj_desc) as subj_name from subjects_tbl where subj_id not in ('".$row['subj_id']."')");
                                        while($row1=mysqli_fetch_array($q)){
                                    echo '<option value="'.$row1['subj_id'].'">'.$row1['subj_name'].'</option>';
                                }
                echo '</select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="acad_year" class="col-sm-3 control-label">Academic Year</label>
                  <div class="col-sm-9">
                    <select name="acad_year" id="acad_year" data-style="btn-primary" class="form-control input-sm">
                        <option value="'.$row['ay_id'].'" selected>'.$row['academic_year'].'</option>';
                                $q = mysqli_query($db,"SELECT * from acadyears_tbl where ay_id not in ('".$row['ay_id']."')");
                                while($row2=mysqli_fetch_array($q)){
                                   echo '<option value="'.$row2['ay_id'].'">'.$row2['academic_year'].'</option>';
                        }
                echo '</select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="yearlevel" class="col-sm-3 control-label">Year Level</label>
                  <div class="col-sm-9">
                    <select name="yearlevel" id="yearlevel" data-style="btn-primary" class="form-control input-sm">
                        <option value="'.$row['year_id'].'" selected>'.$row['year_level'].'</option>';
                                $q = mysqli_query($db,"SELECT * from yearlevel_tbl where year_id not in ('".$row['year_id']."')");
                                while($row3=mysqli_fetch_array($q)){
                                    echo '<option value="'.$row3['year_id'].'">'.$row3['year_level'].'</option>';
                                }
                echo '</select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="sem" class="col-sm-3 control-label">Semester</label>
                  <div class="col-sm-9">
                    <select name="sem" id="sem" data-style="btn-primary" class="form-control input-sm">
                        <option value="'.$row['sem_id'].'" selected>'.$row['semester'].'</option>';
                                $q = mysqli_query($db,"SELECT * from semester_tbl where sem_id not in ('".$row['sem_id']."')");
                                while($row4=mysqli_fetch_array($q)){
                                    echo '<option value="'.$row4['sem_id'].'">'.$row4['semester'].'</option>';
                                }
                echo '</select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="grade" class="col-sm-3 control-label">Final Grade</label>
                  <div class="col-sm-9">
                    <input type="text" name="grade" class="form-control" id="grade" value="'.$row['ofgrade'].'">
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