<?php
    include 'header.php';
    $is_active = 1;
    $query = $conn->prepare("SELECT * FROM users where is_active = :is_active order by id desc");
    $query->bindParam(':is_active',$is_active);
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
                            <a href="usersAdd.php" class="btn btn-primary">Add User</a>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">User List</li>
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
                                               <th class="align-middle">Image</th>
                                               <th class="align-middle">Name</th>
                                               <th class="align-middle">Email</th>
                                               <th class="align-middle">Username</th>
                                               <th class="align-middle">Status</th>
                                               <th class="align-middle">Role</th>
                                               <th class="align-middle"></th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <?php
                                            if (isset($row)) {
                                               if ($row>0) {
                                                 foreach ($result as $value) { 
                                                 $id = $value['id'];  
                                                 $img = $value['img'];  
                                                 $name = $value['name'];  
                                                 $email = $value['email'];  
                                                 $username = $value['username'];  
                                                 $is_active = $value['is_active'];
                                                 $role_id = $value['role_id'];  

                                                if (!empty($role_id)) {
                                                   $query = $conn->prepare("SELECT * FROM user_role where id = :role_id");
                                                   $query->bindParam(':role_id',$role_id);
                                                   $query->execute();
                                                   $user_role_result = $query->fetchAll();
                                                   $user_role_row = count($user_role_result);
                                                   if ($user_role_row>0) {
                                                     $user_role_result_role_type = $user_role_result[0]['role_type'];
                                                   }
                                                }

                                            ?>
                                            <tr>         
                                                <td>
                                                <img class="img-thumbnail " src="../upload/users/<?php if(!empty($img)){ echo $img;}  ?>" style="width: 50px;height: 50px;object-fit: cover;border-radius: 50%;">
                                                </td>                                 
                                                <td><?php if(!empty($name)){ echo $name;} ?></td>
                                                <td><?php if(!empty($email)){ echo $email;} ?></td>
                                                <td><?php if(!empty($username)){ echo $username;} ?></td>                                            
                                                <td><?php
                                                    if (!empty($is_active)) {
                                                        if ($is_active==1) {
                                                           ?>
                                                           <span class="badge badge-pill badge-soft-success font-size-11">Active</span>
                                                           <?php
                                                        }else{
                                                            ?>
                                                           <span class="badge badge-pill badge-soft-danger font-size-11">Deactive</span>
                                                           <?php
                                                        }
                                                    }?>
                                                </td>
                                                <td><?php if(!empty($user_role_result_role_type)){ echo $user_role_result_role_type;} ?></td>
                                                <td>
                                                    <div class="dropdown actionBox">                
                                                    <a href="#" class="dropdown-toggle card-drop" data-bs-toggle="dropdown" aria-expanded="false">     
                                                        <i class="mdi mdi-dots-horizontal font-size-18"></i></a>                
                                                        <ul class="dropdown-menu dropdown-menu-end"> 
                                                            <li><a href="userPerformanceDetail.php?userid=<?php echo $id; ?>" class="dropdown-item edit-list" data-edit-id="7"><i class="fa-solid fa-chart-simple font-size-16 text-success me-1"></i> Performance</a></li>                    
                                                            <!-- <li><a href="taskEdit.php?id=<?php echo $id; ?>" class="dropdown-item edit-list" data-edit-id="7"><i class="mdi mdi-pencil font-size-16 text-success me-1"></i> Edit</a></li>                    
                                                            <li><a href="taskDetail.php?id=<?php echo $id; ?>" class="dropdown-item edit-list" data-edit-id="7"><i class="mdi mdi-format-list-bulleted-square font-size-16 text-primary me-1"></i> Detail</a></li>      -->               
                                                            <!-- <li><a href="#removeItemModal" data-bs-toggle="modal" class="dropdown-item remove-list" data-remove-id="7"><i class="mdi mdi-trash-can font-size-16 text-danger me-1"></i> Remove</a></li> -->
                                                        </ul>            
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