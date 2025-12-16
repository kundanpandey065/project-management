<?php 
session_start();
if (isset($_POST['submitFormBtn'])) {
	require '../include/connection.php';

	$video_link = $_POST['video_link'];
	$video_gallery_type_id = $_POST['video_gallery_type_id'];
	$is_deleted = "no";

	$year = date('Y');
	$created_at = date('Y-m-d H:i:s');
	$updated_at = date('Y-m-d H:i:s');
	$query = $conn->prepare("INSERT INTO video_gallery(video_link,video_gallery_type_id,is_deleted,year,created_at,updated_at) values(:video_link,:video_gallery_type_id,:is_deleted,:year,:created_at,:updated_at)");
	$query->bindParam(':video_link',$video_link);
	$query->bindParam(':video_gallery_type_id',$video_gallery_type_id);
	$query->bindParam(':is_deleted',$is_deleted);
	$query->bindParam(':year',$year);
	$query->bindParam(':created_at',$created_at);
	$query->bindParam(':updated_at',$updated_at);
	if($query->execute()){		
		$_SESSION['amsg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="mdi mdi-check-all me-2"></i>Added Successfully<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
		header("location:../videoGalleryList.php");
	}else{
		$_SESSION['amsg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="mdi mdi-block-helper me-2"></i>Something went wrong<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
		header("location:../videoGalleryList.php");			    			
	}
	
}else{
	header("location:../login.php");
}





?>