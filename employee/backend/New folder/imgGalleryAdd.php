<?php 
session_start();
if (isset($_POST['submitFormBtn'])) {
	require '../include/connection.php';

	$img_name = $_FILES['img']['name'];
	$feature_img = date('ymdhis').''.$img_name;
	$img_tmp_name = $_FILES['img']['tmp_name'];
	$path = "../../upload/gallery/".$feature_img;

	$gallery_type_id = $_POST['gallery_type_id'];
	$is_deleted = "no";

	if(move_uploaded_file($img_tmp_name, $path)){
			$year = date('Y');
			$created_at = date('Y-m-d H:i:s');

			$query = $conn->prepare("INSERT INTO image_gallery(feature_img,year,gallery_type_id,is_deleted,created_at) values(:feature_img,:year,:gallery_type_id,:is_deleted,:created_at)");
			$query->bindParam(':feature_img',$feature_img);
			$query->bindParam(':year',$year);
			$query->bindParam(':gallery_type_id',$gallery_type_id);
			$query->bindParam(':is_deleted',$is_deleted);
			$query->bindParam(':created_at',$created_at);
			if($query->execute()){		
				$_SESSION['amsg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="mdi mdi-check-all me-2"></i>Added Successfully<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
				header("location:../imgGalleryList.php");
			}else{
				$_SESSION['amsg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="mdi mdi-block-helper me-2"></i>Something went wrong<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
				header("location:../imgGalleryList.php");			    			
			}
	}
}else{
	header("location:../login.php");
}





?>