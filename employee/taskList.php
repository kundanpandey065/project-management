<?php
include 'header.php';

$query = $conn->prepare("SELECT * FROM tasks order by id desc");
$query->execute();
$tasks_result = $query->fetchAll();
$tasks_row = count($tasks_result);




?> 


<style>
    .ellipseText{
      width: 300px; 
    }
</style>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div class="msgWrap">
                <?php
                  if (isset($_SESSION['amsg'])) {
                      echo $_SESSION['amsg'];
                      unset($_SESSION['amsg']);
                  }
                ?>
            </div>                
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <!-- <h4 class="mb-sm-0 font-size-18">Event List</h4> -->

                        <div>
                            <a href="taskAdd.php" class="btn btn-primary">Add Task</a>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Task List</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

 

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 table-responsive">  
                                    <table id="datatable" class="table align-middle table-nowrap table-hover mb-0" data-page-length='20'>
                                        <thead>
                                            <tr>
                                               <th class="align-middle">Sr. No.</th>
                                               <th class="align-middle">Task Name</th>
                                               <!-- <th class="align-middle">Project Name</th> -->
                                               <!-- <th class="align-middle">Description</th> -->
                                               <th class="align-middle">Start/Due Date</th>
                                               <th class="align-middle">Priority</th>
                                               <th class="align-middle">Weightage</th>
                                               <th class="align-middle">Created By</th>
                                               <th class="align-middle"></th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <?php
                                            $sr_no = 1;
                                            if (isset($tasks_row)) {
                                               if ($tasks_row>0) {
                                                 foreach ($tasks_result as $value) { 
                                                 $id = $value['id'];  
                                                 $project_id = $value['project_id'];  
                                                 $title = $value['title'];  
                                                 $description = $value['description']; 
                                                 $assigned_by = $value['assigned_by']; 
                                                 $priority = $value['priority']; 
                                                 $task_status_id = $value['task_status_id'];
                                                 $weightage = $value['weightage'];
                                                 $created_at = $value['created_at'];  
                                                 $updated_at = $value['updated_at'];

                                                 $start_date = date_create($value['start_date']);
                                                 $due_date = date_create($value['due_date']);


                                                 if (!empty($assigned_by)) {
                                                   $query = $conn->prepare("SELECT * FROM users where id = :user_id");
                                                   $query->bindParam(':user_id',$assigned_by);
                                                   $query->execute();
                                                   $assigned_by_result = $query->fetchAll();
                                                   $assigned_by_row = count($assigned_by_result);
                                                   if ($assigned_by_row>0) {
                                                     $assigned_by_name = $assigned_by_result[0]['name'];
                                                   }
                                                }  

                                                 if (!empty($project_id)) {
                                                    $query = $conn->prepare("SELECT * FROM project where id = :id");
                                                    $query->bindParam(':id',$project_id);
                                                    $query->execute();
                                                    $project_result = $query->fetchAll();
                                                    $project_row = count($project_result);
                                                    if ($project_row>0) {                                                        
                                                      $project_name = $project_result[0]['title'];
                                                    }
                                                }


                                                

                                            ?>

                                            <tr class="<?php echo ($task_status_id === 2) ? 'inProgressBorder' : ''; ?>" >
                                                <td class="position-relative">
                                                    
                                                        <?php
                                                         if ((!empty($id)) && ($task_status_id === 2)) {
                                                            $query = $conn->prepare("SELECT * FROM task_members where task_id = :task_id");
                                                            $query->bindParam(':task_id',$id);
                                                            $query->execute();
                                                            $task_members_result = $query->fetchAll();
                                                            $task_members_row = count($task_members_result);
                                                            if ($task_members_row>0) {
                                                                foreach ($task_members_result as $value) { 
                                                                    $task_members_user_id = $value['user_id'];
                                                                    $query = $conn->prepare("SELECT * FROM users where id = :task_members_user_id");
                                                                    $query->bindParam(':task_members_user_id',$task_members_user_id);
                                                                    $query->execute();
                                                                    $assigned_to_result = $query->fetchAll();
                                                                    $assigned_to_row = count($assigned_to_result);
                                                                    if (isset($assigned_to_row)) {
                                                                        if ($assigned_to_row>0) {
                                                                            foreach ($assigned_to_result as $value) {
                                                                                $assigned_to_name = $value['name'];
                                                                                ?>
                                                                                <div class="nameOnTableRow">
                                                                                <p class="mb-0 text-white"> 
                                                                                    <!-- <?php if(!empty($assigned_to_name)){ echo $assigned_to_name;} ?> -->
                                                                                     Working on it</p>
                                                                                </div>
                                                                                <?php
                                                                            }
                                                                        }
                                                                    }
                                                                    
                                                                }                                                     
                                                            }
                                                        }  
                                                        ?>
                                                    <?php if(!empty($sr_no)){ echo $sr_no;} ?></td>
                                                <td>
                                                    <div>                    
                                                        <h5 class="text-truncate font-size-14 ellipseText text-dark"><?php if(!empty($title)){ echo $title;} ?></h5>                    
                                                        <p class="text-muted mb-0 ellipseText"><?php if(!empty($project_name)){ echo $project_name;} ?></p>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>                    
                                                        <h5 class="text-truncate font-size-14 text-dark"><?php echo date_format($start_date,"d"); ?> <?php echo date_format($start_date,"M"); ?>, <?php echo date_format($start_date,"Y"); ?></h5>
                                                        <p class="text-muted mb-0"><?php echo date_format($due_date,"d"); ?> <?php echo date_format($due_date,"M"); ?>, <?php echo date_format($due_date,"Y"); ?></p>
                                                    </div>
                                                </td>                                          
                                                <td><?php
                                                    if (!empty($priority)) {
                                                        if ($priority=="low") {
                                                           ?>
                                                           <span class="badge badge-pill badge-soft-success font-size-11">Low</span>
                                                           <?php
                                                        }else if ($priority=="medium"){
                                                            ?>
                                                           <span class="badge badge-pill badge-soft-info font-size-11">Medium</span>
                                                           <?php
                                                        }else if ($priority=="high"){
                                                            ?>
                                                           <span class="badge badge-pill badge-soft-danger font-size-11">High</span>
                                                           <?php
                                                        }
                                                    }?>
                                                </td>
                                                <td><span class="badge badge-pill badge-soft-success font-size-11"><?php if(!empty($weightage)){ echo $weightage;} ?></span></td>
                                                <td><?php if(!empty($assigned_by_name)){ echo $assigned_by_name;} ?></td>

                                                <td>
                                                    <div class="dropdown actionBox">                
                                                    <a href="#" class="dropdown-toggle card-drop" data-bs-toggle="dropdown" aria-expanded="false">     
                                                        <i class="mdi mdi-dots-horizontal font-size-18"></i></a>                
                                                        <ul class="dropdown-menu dropdown-menu-end">                    
                                                            <!-- <li><a href="taskEdit.php?id=<?php echo $id; ?>" class="dropdown-item edit-list" data-edit-id="7"><i class="mdi mdi-pencil font-size-16 text-success me-1"></i> Edit</a></li>                     -->
                                                            <li><a href="taskDetail.php?id=<?php echo $id; ?>" class="dropdown-item edit-list" data-edit-id="7"><i class="mdi mdi-format-list-bulleted-square font-size-16 text-primary me-1"></i> Detail</a></li>                    
                                                            <!-- <li><a href="#removeItemModal" data-bs-toggle="modal" class="dropdown-item remove-list" data-remove-id="7"><i class="mdi mdi-trash-can font-size-16 text-danger me-1"></i> Remove</a></li> -->
                                                        </ul>            
                                                    </div>
                                                </td>


                                                
                                            </tr>
                                                    <?php
                                                     $sr_no+=1; 
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
                </div>
            </div>
            <!-- end row -->
            
        </div>
    </div>
    <!-- End Page-content -->





<?php
    include 'footer.php';
?>     



<script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<script src="assets/js/pages/datatables.init.js"></script> 
<script src="assets/js/pages/form-validation.init.js"></script>
<script src="assets/libs/parsleyjs/parsley.min.js"></script>
<script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>







<script>
    $('#datatable').DataTable({
    "ordering": false
});
</script>