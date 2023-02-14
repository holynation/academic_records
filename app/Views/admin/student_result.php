<?php include_once ROOTPATH."template/header.php"; ?>

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="form-group col-sm-4 col-md-2">
                                    <label for="">Academic Session</label>
                                    <select class="form-control" name="session" id="session" required >
                                        <option value="" >..select session...</option>
                                        <?php echo buildOptionFromQuery($db,'select id,session_name as value from academic_session'); ?>
                                    </select>
                                </div>
                              
                                <div class="form-group col-sm-4 col-md-2">
                                    <label for="">Student</label>
                                    <select name="matric" id="matric" class="form-control">
                                        <option value="">..select student...</option>
                                        <?php echo buildOptionFromQuery($db,"SELECT student.matric_number as id, matric_number as value from student_biodata student"); ?>
                                    </select>
                                </div>
                                <div class="form-group col-sm-4 col-md-2 mt-4">
                                    <input type="submit" value="Load Result" class="btn btn-primary pull-right" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php if (@$result): ?>
                
                <div class="card">
                    <div class="card-inner mx-4 my-3">
                        <?php 
                        $action = array('delete'=>'delete/course_score','edit'=>'edit/course_score');
                        $tableAttr = array('class'=>'table table-striped', 'id'=> 'datatable-buttons');
                        echo $queryHtmlTableObjModel->buildOrdinaryTable($result,$action,[],$tableAttr);
                        ?>
                    </div>
                </div>
                <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-top">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button
                              type="button"
                              class="btn-close"
                              data-bs-dismiss="modal"
                              aria-label="Close"
                            ></button>
                      </div>
                      <div class="modal-body">
                        <p id="edit-container">
                          
                        </p>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
            <?php endif; ?>

            <div>
            <?php if (@$student): ?>
              <h3><?php echo strtoupper($student->fullname) ?> RESULT (<?= $header; ?>)</h3>
              <button data-bs-toggle='modal' data-bs-target='#modal-add' class="btn btn-success"> <i class="fa fa-plus"></i>Add Student Result</button>
            <?php
            // loadClass($this->load,'student_biodata');
            // $std = $this->student_biodata->getWhere(array('matric_number'=>$_GET['matric']),$c,0,null,false);
            // $std =@$std[0];
             ?>

            <div class="modal fade" tabindex="-1" id="modal-add" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-dialog-top" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                            <h5 class="modal-title">Enter Result</h5>
                            <button
                              type="button"
                              class="btn-close"
                              data-bs-dismiss="modal"
                              aria-label="Close"
                            ></button>
                      </div>
                      <div class="modal-body">
                        <div class="alert alert-info">You will only be able to add a score that has been registered by the student</div>
                        <p>
                          <form action="<?php echo base_url('mc/add/course_score/1') ?>" method='post' id='result_form'>
                            <div class="form-group mb-3">
                              <label for="student_course_registration_id">Student Registered Course</label>
                              <select class="form-control" name="student_course_registration_id" id="student_course_registration_id">
                                <?php 
                                  $query="select student_course_registration.id,concat(course_code,'(',course_unit,' unit)') as value from student_course_registration join session_semester_course on session_semester_course.ID=student_course_registration.session_semester_course_id join course on course.id=session_semester_course.course_id where student_biodata_id=? and academic_session_id=? and not exists(select * from course_score where student_course_registration_id=student_course_registration.ID)";
                                  $option = buildOptionFromQuery($db,$query,array($student->ID,$_GET['session']));
                                 ?>
                                 <option value="">..select course..</option>
                                 <?php echo $option ?>
                              </select>
                            </div>
                            <div class="form-group mb-3">
                              <label for="ca_score">Enter CA score</label>
                              <input type="number" class="form-control" id="ca_score" name="ca_score">
                            </div>
                            <div class="form-group mb-3">
                              <label for="exam_score">Enter Exam Score</label>
                              <input type="number" class="form-control" id="exam_score" name="exam_score">
                            </div>

                            <button class="btn btn-success pull-right" type="submit" name="edu-submit">Add</button>
                            <div class="clearfix"></div>
                          </form>
                        </p>
                      </div>
                  </div>
              </div>
            </div>
            <?php endif ?>
          </div>
        </div>
    </div>
    <!-- / Content & end for last graph-->
<?php include_once ROOTPATH."template/footer.php"; ?>
 <script>
    let formGrp = $('div[class=form-group]');
    let formLabel = $('label[for]');
    formGrp.addClass('mb-3');
    formLabel.addClass('form-label');

    function addMoreEvent() {
        $('span[data-ajax-edit=1] a').click(function(event){
          event.preventDefault();
          var link = $(this).attr('href');
          var action = $(this).text();
          sendAjax(null,link,'','get',showUpdateForm);
        });

        $('#result_form').submit(function(event) {
           event.preventDefault();
           submitAjaxForm($(this));
        });
    }
    function showUpdateForm(target,data) {
       var data = JSON.parse(data);
       if (data.status==false) {
         showNotification(false,data.message);
         return;
       }
      var container = $('#edit-container');
        container.html(data.message);
        //rebind the autoload functions inside
        $('#modal-edit').modal('show');
    }
    function ajaxFormSuccess(target,data) {
      showNotification(data.status,data.message);
      if (data.status) {
        location.reload();
      }
    }
 </script>
