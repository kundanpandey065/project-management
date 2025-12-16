<?php
session_start();

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

if (isset($_POST['submitFormBtn'])) {
	require '../include/connection.php';
	$id = $_POST['id'];
	$title = $_POST['title'];
	$blog_type_id = $_POST['blog_type_id'];
	$url = $_POST['url'];
	$description = $_POST['description'];
	$updated_at = date('Y-m-d H:i:s');

	if (!empty($_FILES['img']['name'])) {
		$img_name = $_FILES['img']['name'];
		$img_full_name = date('ymdhis').''.$img_name;
		$img_tmp_name = $_FILES['img']['tmp_name'];
		$path = "../../upload/blog/".$img_full_name;


		$query = $conn->prepare("SELECT * From blog where id = :id");
		$query->bindParam(':id',$id);
		$query->execute();
		$result = $query->fetchAll();
		if ((count($result)>0)) {
			$feature_img = $result[0]['feature_img'];			
			if(!empty($feature_img)) {
				$img_url = "../../upload/blog/".$feature_img;
			    unlink($img_url);
			}
		}

		


		if(move_uploaded_file($img_tmp_name, $path)){
			$query = $conn->prepare("UPDATE blog SET 
									feature_img = :feature_img,
									title = :title,
									blog_type_id = :blog_type_id;
									url = :url,
									description = :description,
									updated_at = :updated_at where id=:id");
			$query->bindParam(':feature_img',$img_full_name);
			$query->bindParam(':title',$title);
			$query->bindParam(':blog_type_id',$blog_type_id);
			$query->bindParam(':url',$url);
			$query->bindParam(':description',$description);
			$query->bindParam(':updated_at',$updated_at);
			$query->bindParam(':id',$id);
			if($query->execute()){
				$_SESSION['amsg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="mdi mdi-check-all me-2"></i>Added Successfully<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
		    	header("location:../blogList.php");
		    }else{
		    	$_SESSION['amsg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="mdi mdi-block-helper me-2"></i>Something went wrong<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
		    	header("location:../blogList.php");
		    }

		}
	}else{
		$query = $conn->prepare("UPDATE blog SET
								title = :title,
								blog_type_id = :blog_type_id;
								url = :url,
								description = :description,
								updated_at = :updated_at where id=:id");
		$query->bindParam(':title',$title);
		$query->bindParam(':blog_type_id',$blog_type_id);
		$query->bindParam(':url',$url);
		$query->bindParam(':description',$description);	
		$query->bindParam(':updated_at',$updated_at);
		$query->bindParam(':id',$id);
		if($query->execute()){
			$_SESSION['amsg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="mdi mdi-check-all me-2"></i>Added Successfully<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
	    	header("location:../blogList.php");
	    }else{
	    	$_SESSION['amsg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="mdi mdi-block-helper me-2"></i>Something went wrong<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
	    	header("location:../blogList.php");
	    }
	}



			

}else{
	echo "string";
}

?>