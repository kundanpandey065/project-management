<?php
include 'header.php';

$query = $conn->prepare("SELECT * FROM user_role order by id desc");
$query->execute();
$user_role_result = $query->fetchAll();
$user_role_row = count($user_role_result);

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
                        <h4 class="mb-sm-0 font-size-18">Add Blog</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Blog</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <!-- <h4 class="card-title mb-4">Form Grid Layout</h4> -->
                            <form id="formValidation" action="backend/usersAdd.php" method="post" enctype="multipart/form-data"> 
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="formrow-firstname-input" class="form-label">Profile Image</label>
                                            <input type="file" onchange="readURL(this);" class="form-control" name="img" accept="image/png, image/jpg, image/jpeg, ">
                                            <div>
                                                <small class="text-danger"><strong>Note:</strong> Please upload compressed  image .</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="formrow-firstname-input" class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="formrow-firstname-input" class="form-label">Email</label>
                                            <input type="text" class="form-control" name="email">
                                        </div>
                                    </div>
                                   <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="formrow-firstname-input" class="form-label">Is active</label>
                                            <select class="form-control" name="is_active">                                           
                                                <option value="1">Active</option>  
                                                <option value="0">Deactive</option>  
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="formrow-firstname-input" class="form-label">User Role</label>
                                            <select class="form-control" name="role_id">
                                                <option selected disabled>--Select One--</option>
                                                <?php
                                                    if ($user_role_row>0) {
                                                       foreach ($user_role_result as $value) {
                                                           ?>
                                                           <option value="<?php echo  $value['id']; ?>"><?php echo  $value['role_type']; ?></option>
                                                           <?php
                                                       }
                                                    }
                                                ?>                                                
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary w-md" name="submitFormBtn"><i class="fa-regular fa-paper-plane fa-shake"></i> &nbsp Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->

                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Picture Preview</h4>
                            <div>
                                <img id="blah" src="https://placehold.co/400x400/png" class="img-fluid" />   
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
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
