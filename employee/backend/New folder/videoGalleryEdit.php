<?php
session_start();

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

if (isset($_POST['submitFormBtn'])) {
	require '../include/connection.php';

	$id = $_POST['id'];
	$video_link = $_POST['video_link'];
	$video_gallery_type_id = $_POST['video_gallery_type_id'];
	$is_deleted = "no";
	$updated_at = date('Y-m-d H:i:s');

	$query = $conn->prepare("UPDATE video_gallery SET 
							video_link = :video_link,
							video_gallery_type_id = :video_gallery_type_id,
							is_deleted = :is_deleted;
							updated_at = :updated_at where id=:id");
	$query->bindParam(':video_link',$video_link);
	$query->bindParam(':video_gallery_type_id',$video_gallery_type_id);
	$query->bindParam(':is_deleted',$is_deleted);
	$query->bindParam(':updated_at',$updated_at);
	$query->bindParam(':id',$id);
	if($query->execute()){
		$_SESSION['amsg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="mdi mdi-check-all me-2"></i>Added Successfully<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    	header("location:../videoGalleryList.php");
    }else{
    	$_SESSION['amsg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="mdi mdi-block-helper me-2"></i>Something went wrong<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    	header("location:../videoGalleryList.php");
    }

			

}else{
	echo "string";
}

?>