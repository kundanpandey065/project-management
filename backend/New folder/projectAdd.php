<?php 
session_start();
if (isset($_POST['submitFormBtn'])) {
	require '../include/connection.php';



	$title = $_POST['title'];
	$description = $_POST['description'];
	$start_date = $_POST['start_date'];
	$end_date = $_POST['end_date'];
    $status = $_POST['status'];
    $visibility = $_POST['visibility'];
    $created_by = $_SESSION['USERID'];  
    $created_at = date('Y-m-d H:i:s');
	$updated_at = date('Y-m-d H:i:s');


	$totalAttachment = count($_FILES['attachment']);

	



		$query = $conn->prepare("INSERT INTO project(title,description,start_date,end_date,status,visibility,created_by,created_at,updated_at) values(:title,:description,:start_date,:end_date,:status,:visibility,:created_by,:created_at,:updated_at)");
		$query->bindParam(':title',$title);
		$query->bindParam(':description',$description);
		$query->bindParam(':start_date',$start_date);
		$query->bindParam(':end_date',$end_date);
		$query->bindParam(':status',$status);
		$query->bindParam(':visibility',$visibility);
		$query->bindParam(':created_by',$created_by);
		$query->bindParam(':created_at',$created_at);
		$query->bindParam(':updated_at',$updated_at);
		if($query->execute()){		

			$project_last_id = $conn->lastInsertId();

		    $totalCount = count($_POST['project_member']);

		    for ($i=0; $i < $totalCount; $i++) { 
		    	$project_member_id = $_POST['project_member'][$i];
		    	$query = $conn->prepare("INSERT INTO project_members(project_id,user_id) values(:project_id,:user_id)");
				$query->bindParam(':project_id',$project_last_id);
				$query->bindParam(':user_id',$project_member_id);
				$query->execute();			
		    }

		    for ($i=0; $i < $totalAttachment-1; $i++) { 
				$img_name = $_FILES['attachment']['name'][$i];
				$feature_img = date('ymdhis').''.$img_name;
				$img_tmp_name = $_FILES['attachment']['tmp_name'][$i];
				$path = "../../upload/project_attachment/".$feature_img;
				if(move_uploaded_file($img_tmp_name, $path)){				
					$query = $conn->prepare("INSERT INTO project_attachments(project_id,file_name,created_at) values(:project_id,:file_name,:created_at)");
					$query->bindParam(':project_id',$project_last_id);
					$query->bindParam(':file_name',$feature_img);
					$query->bindParam(':created_at',$created_at);
					$query->execute();
				}
			}


				$_SESSION['amsg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="mdi mdi-check-all me-2"></i>Added Successfully<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
					header("location:../projectList.php");

			
		}else{
			$_SESSION['amsg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="mdi mdi-block-helper me-2"></i>Something went wrong<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			header("location:../projectList.php");			    			
		}


}else{
	header("location:../login.php");
}





?>