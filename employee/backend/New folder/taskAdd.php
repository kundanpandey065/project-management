<?php 
session_start();
if (isset($_POST['submitFormBtn'])) {
	require '../include/connection.php';



	$project_id = $_POST['project_id'];
	$title = $_POST['title'];
	$description = $_POST['description'];
	// $assigned_to = $_POST['assigned_to'];
	$assigned_by = $_SESSION['USERID'];
	$priority = $_POST['priority'];
	$task_status_id = $_POST['task_status_id'];
	$start_date = $_POST['start_date'];
	$due_date = $_POST['due_date'];
    $weightage = $_POST['weightage'];
      
    $created_at = date('Y-m-d H:i:s');
	$updated_at = date('Y-m-d H:i:s');


	$totalAttachment = count($_FILES['attachment']);


	$query = $conn->prepare("INSERT INTO tasks(project_id,title,description,assigned_by,priority,task_status_id,start_date,due_date,weightage,created_at,updated_at) values(:project_id,:title,:description,:assigned_by,:priority,:task_status_id,:start_date,:due_date,:weightage,:created_at,:updated_at)");
	$query->bindParam(':project_id',$project_id);
	$query->bindParam(':title',$title);
	$query->bindParam(':description',$description);	
	$query->bindParam(':assigned_by',$assigned_by);
	$query->bindParam(':priority',$priority);
	$query->bindParam(':task_status_id',$task_status_id);
	$query->bindParam(':start_date',$start_date);
	$query->bindParam(':due_date',$due_date);
	$query->bindParam(':weightage',$weightage);
	$query->bindParam(':created_at',$created_at);
	$query->bindParam(':updated_at',$updated_at);
	if($query->execute()){		

		$tasks_last_id = $conn->lastInsertId();

		$allMember = $_POST['assigned_to'];
		$allMember = [$allMember];
		$totalCount = count($allMember);

	    for ($i=0; $i < $totalCount; $i++) { 
	    	// $task_member_id = $_POST['assigned_to'][$i];
	    	$task_member_id = $allMember[$i];
	    	$query = $conn->prepare("INSERT INTO task_members(task_id,user_id) values(:task_id,:user_id)");
			$query->bindParam(':task_id',$tasks_last_id);
			$query->bindParam(':user_id',$task_member_id);
			$query->execute();			
	    }


		for ($i=0; $i < $totalAttachment-1; $i++) { 
			$img_name = $_FILES['attachment']['name'][$i];
			$feature_img = date('ymdhis').''.$img_name;
			$img_tmp_name = $_FILES['attachment']['tmp_name'][$i];
			$path = "../../upload/task_attachment/".$feature_img;
			if(move_uploaded_file($img_tmp_name, $path)){				
				$query = $conn->prepare("INSERT INTO task_attachments(task_id,file_name,created_at) values(:task_id,:file_name,:created_at)");
				$query->bindParam(':task_id',$tasks_last_id);
				$query->bindParam(':file_name',$feature_img);
				$query->bindParam(':created_at',$created_at);
				$query->execute();
			}
		}


		$_SESSION['amsg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="mdi mdi-check-all me-2"></i>Added Successfully<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
				header("location:../taskList.php");

		
	}else{
		$_SESSION['amsg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="mdi mdi-block-helper me-2"></i>Something went wrong<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
		header("location:../taskList.php");			    			
	}

}else{
	header("location:../login.php");
}





?>