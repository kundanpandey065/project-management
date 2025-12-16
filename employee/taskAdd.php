<?php
include 'header.php';
$user_id = 1; //Admin
$query = $conn->prepare("SELECT * FROM users where id != :id order by id desc");
$query->bindParam(':id',$user_id);
$query->execute();
$user_result = $query->fetchAll();
$user_row = count($user_result);


// $user_id = 1; //Admin
$query = $conn->prepare("SELECT * FROM project order by id desc");
$query->execute();
$project_result = $query->fetchAll();
$project_row = count($project_result);


$status_id = 2; // Not show in progress
$query = $conn->prepare("SELECT * FROM task_status where id != :status_id order by id asc");
$query->bindParam(':status_id',$status_id);
$query->execute();
$task_status_result = $query->fetchAll();
$task_status_row = count($task_status_result);


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
                        <h4 class="mb-sm-0 font-size-18">Add Task</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Task</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

        <form id="formValidation" action="backend/taskAdd.php" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="formrow-firstname-input" class="form-label">Task Name</label>
                                        <input type="text" class="form-control" name="title">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="formrow-firstname-input" class="form-label">Project Name</label>
                                        <select class="form-control" name="project_id" onchange="selectProject(this.value);">                                           
                                            <option selected disabled>--Select One--</option>  
                                            <?php
                                                if ($project_row>0) {
                                                   foreach ($project_result as $value) {
                                                       ?>
                                                       <option value="<?php echo  $value['id']; ?>"><?php echo  $value['title']; ?></option>
                                                       <?php
                                                   }
                                                }
                                            ?>    
                                        </select>
                                    </div>
                                </div>                                 
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="formrow-firstname-input" class="form-label">Assigned To</label>
                                        <select class="form-control" name="assigned_to" id="assigned_to">                                           
                                            <option selected disabled>--Select One--</option> 
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="formrow-firstname-input" class="form-label">Priority</label>
                                        <select class="form-control" name="priority">                                           
                                            <option selected disabled>--Select One--</option>  
                                            <option value="low">Low</option>  
                                            <option value="medium">Medium</option>  
                                            <option value="high">High</option> 
                                        </select>
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
                                        <label for="formrow-firstname-input" class="form-label">Task Description</label>
                                        <textarea class="form-control" name="description" rows="7"></textarea>
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
                                <label class="form-label" for="project-status-input">Task Status</label>
                                <select class="form-control" name="task_status_id">                                           
                                    <option selected disabled>--Select One--</option>  
                                    <?php
                                        if ($task_status_row>0) {
                                           foreach ($task_status_result as $value) {
                                               ?>
                                               <option value="<?php echo  $value['id']; ?>"><?php echo  $value['status_name']; ?></option>
                                               <?php
                                           }
                                        }
                                    ?>    
                                </select>
                            </div>

                            <div>
                                <label class="form-label" for="project-visibility-input">Weightage</label>
                                <select name="weightage"  class="form-control">                                      
                                    <option selected disabled>--Select One--</option>  
                                    <option value="1">1</option>  
                                    <option value="2">2</option>  
                                    <option value="3">3</option> 
                                    <option value="4">4</option> 
                                    <option value="5">5</option> 
                                    <option value="6">6</option> 
                                    <option value="7">7</option> 
                                    <option value="8">8</option> 
                                    <option value="9">9</option> 
                                    <option value="10">10</option> 
                                </select>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
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
                                        <label for="formrow-firstname-input" class="form-label">Due Date</label>
                                        <input type="date" class="form-control" name="due_date">
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

    function selectProject(value){
        // alert("Hello"+value);
        let projectID = value;
        $.ajax({
            method: "post", 
            url: "ajax/getTeamByProject.php", 
            data: {"projectID": projectID}, 
            success: function(result){
            $("#assigned_to").html(result);
                // console.log(result)
        }});

    }

</script>


<script>
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>


  <script>
//     $(document).ready(function(){
//       $("#formValidation").validate({
//         rules :{            
//           title: {
//               required: true
//             },
//             description: {
//               required: true,
//             },
//             start_date: {
//               required: true,
//             },
//             end_date: {
//               required: true,
//             }
//             status: {
//               required: true,
//             },
//             project_member: {
//               required: true,
//             },
//             created_by: {
//               required: true,
//             },
//         },
//     });

// });
</script>


