<?php
    include 'header.php';

    $query = $conn->prepare("SELECT * FROM contact order by id desc");
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
                        <!-- <div>
                            <a href="toppersAdd.php" class="btn btn-primary">Add Contact</a>
                        </div> -->
                        <h4>Contact List</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                <li class="breadcrumb-item active">Contact List</li>
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
                                                <th class="align-middle">Name</th>
                                                <th class="align-middle">Email</th>
                                                <th class="align-middle">Mobile</th>
                                                <th class="align-middle">Message</th>
                                                <th class="align-middle"></th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <?php
                                            $sr_no = 1;
                                            if (isset($row)) {
                                               if ($row>0) {
                                                 foreach ($result as $value) { 
                                                 $id = $value['id'];  
                                                 $name = $value['name'];  
                                                 $email = $value['email'];  
                                                 $mobile = $value['mobile'];
                                                 $msg = $value['msg'];
                                            ?>
                                            <tr>                                  
                                                <td><?php if(!empty($sr_no)){ echo $sr_no;  }  ?>
                                                </td>
                                                <td><?php if(!empty($name)){ echo $name;  }  ?>
                                                </td>
                                                <td><?php if(!empty($email)){ echo $email;  }  ?>
                                                </td>
                                                <td><?php if(!empty($mobile)){ echo $mobile;  }  ?> 
                                                </td>
                                                <td><?php if(!empty($msg)){ echo $msg;  }  ?>
                                                </td>
                                                <td>
                                                    <a href="backend/contactDelete.php?id=<?php echo $id; ?>"><span class="badge badge-pill badge-soft-danger font-size-14"><i class="far fa-trash-alt"></i></span></a>
                                                </td>
                                            </tr>
                                                    <?php
                                                    $sr_no = $sr_no+1;
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