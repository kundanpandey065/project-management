<?php
include 'header.php';
$user_id = 1; //Admin
$query = $conn->prepare("SELECT * FROM users where id != :id order by id desc");
$query->bindParam(':id',$user_id);
$query->execute();
$user_result = $query->fetchAll();
$user_row = count($user_result);

?> 



<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Add Project</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Project</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <form id="formValidation" action="backend/projectAdd.php" method="post" enctype="multipart/form-data"> 
                <div class="row">
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body">                            
                                <div class="row">
                                    <!-- <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="formrow-firstname-input" class="form-label">Profile Image</label>
                                            <input type="file" onchange="readURL(this);" class="form-control" name="img" accept="image/png, image/jpg, image/jpeg, ">
                                            <div>
                                                <small class="text-danger"><strong>Note:</strong> Please upload compressed  image .</small>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="formrow-firstname-input" class="form-label">Title</label>
                                            <input type="text" class="form-control" name="title">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="formrow-firstname-input" class="form-label">Attachments</label>
                                            <input type="file" onchange="readURL(this);" class="form-control" name="attachment[]" accept="application/pdf" multiple>
                                            <div>
                                                <small class="text-danger"><strong>Note:</strong> Correct File name before upload it</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="formrow-firstname-input" class="form-label">Project Member</label>
                                            <select name="project_member[]"  class="form-control js-example-basic-multiple"  multiple="multiple" data-placeholder="Choose ...">                                      
                                                <?php
                                                    if ($user_row>0) {
                                                       foreach ($user_result as $value) {

                                                        $role_id = $value['role_id'];
                                                        $user_designation_id = $value['designation_id'];

                                                         if (!empty($user_designation_id)) {
                                                           $query = $conn->prepare("SELECT * FROM user_designation where id = :user_designation_id");
                                                           $query->bindParam(':user_designation_id',$user_designation_id);
                                                           $query->execute();
                                                           $user_designation_result = $query->fetchAll();
                                                           $user_designation_row = count($user_designation_result);
                                                           if ($user_designation_row>0) {
                                                             $user_designation_name = $user_designation_result[0]['designation_name'];
                                                           }
                                                        }  

                                                           ?>
                                                           <option value="<?php echo  $value['id']; ?>"><?php echo  $value['name']; ?>--(<?php echo  $user_designation_name; ?>)</option>
                                                           <?php
                                                       }
                                                    }
                                                ?>    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="formrow-firstname-input" class="form-label">Project Description</label>
                                            <textarea class="form-control" name="description" id="summernote"></textarea>
                                        </div>
                                    </div>                                  
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary w-md" name="submitFormBtn"><i class="fa-regular fa-paper-plane fa-shake"></i> &nbsp Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-3">Publish</h5>

                                <div class="mb-3">
                                    <label class="form-label" for="project-status-input">Status</label>
                                    <select class="form-control" name="status">                                           
                                        <option selected disabled>--Select One--</option>  
                                        <option value="planned">Planned</option>  
                                        <option value="ongoing">Ongoing</option>  
                                        <option value="completed">Completed</option>  
                                        <option value="on_hold">On Hold</option>  
                                    </select>
                                </div>

                                <div>
                                    <label class="form-label" for="project-visibility-input">Visibility</label>
                                    <select class="form-select" name="visibility">
                                        <option value="Private">Private</option>
                                        <option value="Public">Public</option>
                                        <option value="Team">Team</option>
                                    </select>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="formrow-firstname-input" class="form-label">Start Date</label>
                                            <input type="date" class="form-control" name="start_date">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="formrow-firstname-input" class="form-label">End Date</label>
                                            <input type="date" class="form-control" name="end_date">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>  
            </form>         
            
        </div> <!-- container-fluid -->
    </div>
</div>


<?php
include 'footer.php';
?> 



<script>
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>


  <script>
    $(document).ready(function(){
      $("#formValidation").validate({
        rules :{            
          title: {
              required: true
            },
            description: {
              required: true,
            },
            start_date: {
              required: true,
            },
            end_date: {
              required: true,
            }
            status: {
              required: true,
            },
            project_member: {
              required: true,
            },
            created_by: {
              required: true,
            },
        },
    });

});
</script>


