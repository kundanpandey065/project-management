<?php
    include 'header.php';
    $query = $conn->prepare("SELECT * FROM project order by id desc");
    $query->execute();
    $result = $query->fetchAll();
    $row = count($result);
?> 

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
                            <a href="projectAdd.php" class="btn btn-primary">Add Project</a>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Project List</li>
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
                                               <th class="align-middle" style="width: 120px;">Title</th>
                                               <!-- <th class="align-middle">Description</th> -->
                                               <th class="align-middle">Start Date</th>
                                               <th class="align-middle">End Date</th>
                                               <th class="align-middle">Status</th>
                                               <th class="align-middle" style="min-width: 60px;">Team</th>
                                               <th class="align-middle">Created By</th>
                                               <!-- <th class="align-middle"></th> -->
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <?php
                                            $sr_no = 1;
                                            if (isset($row)) {
                                               if ($row>0) {
                                                 foreach ($result as $value) { 
                                                 $id = $value['id'];  
                                                 $title = $value['title'];  
                                                 // $description = $value['description'];  
                                                 $start_date = $value['start_date'];  
                                                 $end_date = $value['end_date'];  
                                                 $status = $value['status'];
                                                 $created_by = $value['created_by'];  
                                                 $created_at = $value['created_at'];

                                                 $teams = ""; 


                                                 if (!empty($created_by)) {
                                                   $query = $conn->prepare("SELECT * FROM users where id = :user_id");
                                                   $query->bindParam(':user_id',$created_by);
                                                   $query->execute();
                                                   $user_role_result = $query->fetchAll();
                                                   $user_role_row = count($user_role_result);
                                                   if ($user_role_row>0) {
                                                     $created_by_name = $user_role_result[0]['name'];
                                                   }
                                                }  


                                                if (!empty($created_by)) {
                                                   $query = $conn->prepare("SELECT * FROM project_members where project_id = :project_id");
                                                   $query->bindParam(':project_id',$id);
                                                   $query->execute();
                                                   $project_members_result = $query->fetchAll();
                                                   $project_members_row = count($project_members_result);

                                                   $extraMember = $project_members_row-3; 

                                                   if ($project_members_row>0) {
                                                    foreach ($project_members_result as $value) { 
                                                        $userID = $value['user_id'];

                                                        if (!empty($userID)) {
                                                           $query = $conn->prepare("SELECT * FROM users where id = :user_id");
                                                           $query->bindParam(':user_id',$userID);
                                                           $query->execute();
                                                           $userResult = $query->fetchAll();
                                                           $userRow = count($userResult);
                                                           if ($userRow>0) {
                                                             $userName = $userResult[0]['name'];
                                                             $userImg = $userResult[0]['img'];

                                                             if ($project_members_row>3) {
                                                                 $teams .= '<a href="javascript: void(0);" class="avatar-group-item" data-img="../upload/users/'.$userImg.' " data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.$userName .' "><img src="../upload/users/'.$userImg.'" alt="" class="rounded-circle avatar-xs"></a>,';
                                                             }else{
                                                                 $teams .= '<a href="javascript: void(0);" class="avatar-group-item" data-img="../upload/users/'.$userImg.' " data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.$userName .' "><img src="../upload/users/'.$userImg.'" alt="" class="rounded-circle avatar-xs"></a>';
                                                             }
                                                           
                                                           
                                                            
                                                           }
                                                        }  

                                                    }
                                                   }
                                                }  




                                            ?>
                                            <tr>   
                                                <td><?php if(!empty($sr_no)){ echo $sr_no;} ?></td>                           
                                                <td >
                                                    <p class="ellipseText mb-0"> 
                                                        <?php if(!empty($title)){ echo $title;} ?>
                                                    </p>                                                        
                                                </td>
                                                <!-- <td><?php if(!empty($description)){ echo $description;} ?></td> -->
                                                <td><?php if(!empty($start_date)){ echo $start_date;} ?></td>                                            
                                                <td><?php if(!empty($end_date)){ echo $end_date;} ?></td>                                            
                                                <td><?php
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
                                                    }?>
                                                </td>


                                                <td class="sorting_1">
                                                   <div class="avatar-group">
                                                    <?php

                                                    if ($project_members_row>3) {
                                                         if(!empty($teams)){ 
                                                            $teamArray = explode(",",$teams);
                                                            if ($teamArray) {
                                                               echo $teamArray[0]."".$teamArray[1]."".$teamArray[2].'<a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.$extraMember.' More"><div class="avatar-xs"> <div class="avatar-title rounded-circle">'.$extraMember.'+</div></div></a>';
                                                            }
                                                        } 
                                                    }else{
                                                         if(!empty($teams)){ echo $teams;} 
                                                    }
                                                    ?>                                                      
                                                   </div>
                                                </td>


                                                <td><?php if(!empty($created_by_name)){ echo $created_by_name;} ?></td>
                                                <td>
                                                    <div class="dropdown actionBox">                
                                                    <a href="#" class="dropdown-toggle card-drop" data-bs-toggle="dropdown" aria-expanded="false">     
                                                        <i class="mdi mdi-dots-horizontal font-size-18"></i></a>                
                                                        <ul class="dropdown-menu dropdown-menu-end">                    
                                                            <!-- <li><a href="projectEdit.php?id=<?php echo $id; ?>" class="dropdown-item edit-list" data-edit-id="7"><i class="mdi mdi-pencil font-size-16 text-success me-1"></i> Edit</a></li>                     -->
                                                            <li><a href="projectDetail.php?id=<?php echo $id; ?>" class="dropdown-item edit-list" data-edit-id="7"><i class="mdi mdi-format-list-bulleted-square font-size-16 text-primary me-1"></i> Detail</a></li>                    
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