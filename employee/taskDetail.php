<?php
include 'header.php';

if (empty($_GET['id'])) {
   die();
}


$task_id = $_GET['id'];
$query = $conn->prepare("SELECT * FROM tasks where id = :task_id");
$query->bindParam(':task_id',$task_id);
$query->execute();
$result = $query->fetchAll();
$row = count($result);
if (isset($row)) {
    $task_id = $result[0]['id'];  
    $project_id = $result[0]['project_id'];  
    $title = $result[0]['title'];  
    $description = $result[0]['description'];  
    $priority = $result[0]['priority'];  
    $start_date = $result[0]['start_date'];  
    $due_date = $result[0]['due_date'];  
    $task_status_id = $result[0]['task_status_id'];
    $weightage = $result[0]['weightage'];
    $assigned_by = $result[0]['assigned_by'];  
    $created_at = $result[0]['created_at'];

    $start_date = date_create($result[0]['start_date']);
    $due_date = date_create($result[0]['due_date']);
}  

$query = $conn->prepare("SELECT * FROM task_attachments where task_id = :task_id");
$query->bindParam(':task_id',$task_id);
$query->execute();
$task_attachment_result = $query->fetchAll();
$task_attachment_row = count($task_attachment_result);


if (!empty($task_id)) {
   $query = $conn->prepare("SELECT * FROM task_members where task_id = :task_id");
   $query->bindParam(':task_id',$task_id);
   $query->execute();
   $task_member_result = $query->fetchAll();
   $task_member_row = count($task_member_result);           
} 



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
                        <h4 class="mb-sm-0 font-size-18">Task Detail</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Task Detail</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-4">
                                    <img src="../assets/images/companies/img-1.png" alt="" class="avatar-sm">
                                </div>
                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="text-truncate font-size-15"><?php if(!empty($title)){ echo $title;} ?></h5>
                                    <!-- <p class="text-muted">Separate existence is a myth. For science, music, sport, etc.</p> -->
                                    <?php
                                        if (!empty($status)) {
                                            if ($status=="planned") {
                                               ?>
                                               <span class="badge badge-pill badge-soft-success font-size-11">Active</span>
                                               <?php
                                            }else if ($status=="ongoing"){
                                                ?>
                                               <span class="badge badge-pill badge-soft-info font-size-11">Ongoing</span>
                                               <?php
                                            }else if ($status=="completed"){
                                                ?>
                                               <span class="badge badge-pill badge-soft-danger font-size-11">Completed</span>
                                               <?php
                                            }else if ($status=="on_hold"){
                                                ?>
                                               <span class="badge badge-pill badge-soft-warning font-size-11">On Hold</span>
                                               <?php
                                            }
                                        }
                                    ?>
                                </div>
                            </div>

                            <h5 class="font-size-15 mt-4">task Details :</h5>

                            <p class="text-muted"><?php if(!empty($description)){ echo $description;} ?></p>

                          
                            
                            <div class="row task-dates">
                                <div class="col-sm-4 col-6">
                                    <div class="mt-4">
                                        <h5 class="font-size-14"><i class="bx bx-calendar me-1 text-primary"></i> Start Date</h5>
                                        <p class="text-muted mb-0">
                                            <?php echo date_format($start_date,"d"); ?> <?php echo date_format($start_date,"M"); ?>, <?php echo date_format($start_date,"Y"); ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="col-sm-4 col-6">
                                    <div class="mt-4">
                                        <h5 class="font-size-14"><i class="bx bx-calendar-check me-1 text-primary"></i> Due Date</h5>
                                        <p class="text-muted mb-0"><?php echo date_format($due_date,"d"); ?> <?php echo date_format($due_date,"M"); ?>, <?php echo date_format($due_date,"Y"); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Team Members</h4>

                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap">
                                    <tbody>
                                        <?php                                      


                                        if ($task_member_row>0) {
                                           foreach($task_member_result as $value){
                                             $user_id = $value['user_id'];
                                             if (!empty($user_id)) {
                                                   $query = $conn->prepare("SELECT * FROM users where id = :user_id");
                                                   $query->bindParam(':user_id',$user_id);
                                                   $query->execute();
                                                   $user_role_result = $query->fetchAll();
                                                   $user_role_row = count($user_role_result);
                                                   if ($user_role_row>0) {
                                                     $user_profile = $user_role_result[0]['img'];
                                                     $user_name = $user_role_result[0]['name'];
                                                     $user_role_id = $user_role_result[0]['role_id'];
                                                     $user_designation_id = $user_role_result[0]['designation_id'];
                                                   }
                                                }  


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
                                            <tr>
                                                <td style="width: 50px;"><img src="../upload/users/<?php if(!empty($user_profile)){ echo $user_profile;}  ?>" class="rounded-circle avatar-xs" alt=""></td>
                                                <td><h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="text-dark"><?php if(!empty($user_name)){ echo $user_name;} ?></a></h5></td>
                                                <td>
                                                    <div>
                                                        <a href="javascript: void(0);" class="badge bg-primary-subtle text-primary font-size-11"><?php if(!empty($user_designation_name)){ echo $user_designation_name;} ?></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                           }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 



            <div class="row">
                <!-- <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Overview</h4>
                            <div id="overview-chart" class="apex-charts" dir="ltr"></div>
                        </div>
                    </div>
                </div> -->
                <!-- end col -->

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Attached Files</h4>
                            <div class="table-responsive">
                                <table class="table table-nowrap align-middle table-hover mb-0">
                                    <tbody>
                                        <?php
                                        if (isset($task_attachment_row)) {    
                                            if ($task_attachment_row>0) {
                                                foreach($task_attachment_result as $value){
                                                    $task_id = $value['id'];  
                                                    $file_name = $value['file_name']; 
                                                    ?>
                                                    <tr>
                                                        <td style="width: 45px;">
                                                            <div class="avatar-sm">
                                                                <span class="avatar-title rounded-circle bg-primary-subtle text-primary font-size-24">
                                                                    <i class="bx bxs-file-doc"></i>
                                                                </span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <h5 class="font-size-14 mb-1"><a href="javascript: void(0);" class="text-dark"><?php if(!empty($file_name)){ echo $file_name;} ?></a></h5>
                                                            <!-- <small>Size : 3.25 MB</small> -->
                                                        </td>
                                                        <td>
                                                            <div class="text-center">
                                                                <a href="../upload/task_attachment/<?php echo $file_name = $value['file_name']; ?>" class="text-dark"><i class="bx bx-download h3 m-0" download></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>


                                                    <?php 

                                                } 
                                            }
                                        } 

                                        ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Comments</h4>

                            <div class="d-flex mb-4">
                                <div class="flex-shrink-0 me-3">
                                    <img class="d-flex-object rounded-circle avatar-xs" alt="" src="../assets/images/users/avatar-2.jpg">
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="font-size-13 mb-1">David Lambert</h5>
                                    <p class="text-muted mb-1">
                                        Separate existence is a myth.
                                    </p>
                                </div>
                                <div class="ms-3">
                                    <a href="javascript: void(0);" class="text-primary">Reply</a>
                                </div>
                            </div>

                            <div class="d-flex mb-4">
                                <div class="flex-shrink-0 me-3">
                                    <img class="d-flex-object rounded-circle avatar-xs" alt="" src="../assets/images/users/avatar-3.jpg">
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="font-size-13 mb-1">Steve Foster</h5>
                                    <p class="text-muted mb-1">
                                        <a href="javascript: void(0);" class="text-success">@Henry</a>
                                        To an English person it will like simplified
                                    </p>
                                    <div class="d-flex mt-3">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar-xs">
                                                <span class="avatar-title rounded-circle bg-primary-subtle text-primary font-size-16">
                                                    J
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div class="flex-grow-1">
                                            <h5 class="font-size-13 mb-1">Jeffrey Walker</h5>
                                            <p class="text-muted mb-1">
                                                as a skeptical Cambridge friend
                                            </p>
                                        </div>
                                        <div class="ms-3">
                                            <a href="javascript: void(0);" class="text-primary">Reply</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <a href="javascript: void(0);" class="text-primary">Reply</a>
                                </div>
                            </div>

                            <div class="d-flex mb-4">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar-xs">
                                        <span class="avatar-title rounded-circle bg-primary-subtle text-primary font-size-16">
                                            S
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="flex-grow-1">
                                    <h5 class="font-size-13 mb-1">Steven Carlson</h5>
                                    <p class="text-muted mb-1">
                                        Separate existence is a myth.
                                    </p>
                                </div>
                                <div class="ms-3">
                                    <a href="javascript: void(0);" class="text-primary">Reply</a>
                                </div>
                            </div>

                            <div class="text-center mt-4 pt-2">
                                <a href="javascript: void(0);" class="btn btn-primary btn-sm">View more</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>




            
        </div> <!-- container-fluid -->
    </div>
</div>


<?php
include 'footer.php';
?> 

<script src="assets/libs/tinymce/tinymce.min.js"></script>
<script src="assets/js/pages/form-editor.init.js"></script>

<script>
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>


  <script>
    $(document).ready(function(){
      $("#formValidation").validate({
        rules :{            
          img: {
              required: true
            },
          name: {
              required: true,
            },
            email: {
              required: true,
              email: true
            },
          is_active: {
              required: true,
            },
          role_id: {
              required: true,
            }
        },
    });

});
</script>


<script>
    var options={chart:{height:290,type:"bar",toolbar:{show:!1}},plotOptions:{bar:{columnWidth:"14%",endingShape:"rounded"}},dataLabels:{enabled:!1},series:[{name:"Overview",data:[42,56,40,64,26,42,56,35,62]}],grid:{yaxis:{lines:{show:!1}}},yaxis:{title:{text:"% (Percentage)"}},xaxis:{labels:{rotate:-90},categories:["1","2","3","4","5","6","7","8","9"],title:{text:"Week"}},colors:["#556ee6"]},chart=new ApexCharts(document.querySelector("#overview-chart"),options);chart.render();
</script>