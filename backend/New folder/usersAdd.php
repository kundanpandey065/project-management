<?php 
session_start();
if (isset($_POST['submitFormBtn'])) {
	require '../include/connection.php';

	$img_name = $_FILES['img']['name'];
	$feature_img = date('ymdhis').''.$img_name;
	$img_tmp_name = $_FILES['img']['tmp_name'];
	$path = "../../upload/users/".$feature_img;

	$name = $_POST['name'];
	$email = $_POST['email'];
	$username = explode("@", $email)[0];
	$password = 'MTIzNDU2';
    $name = $_POST['name'];  
    $email = $_POST['email'];  
    $is_active = $_POST['is_active'];
    $role_id = $_POST['role_id'];  


	if(move_uploaded_file($img_tmp_name, $path)){
			$year = date('Y');
			$created_at = date('Y-m-d H:i:s');
			$updated_at = date('Y-m-d H:i:s');
			$query = $conn->prepare("INSERT INTO users(img,name,email,username,password,is_active,role_id,created_at,updated_at) values(:img,:name,:email,:username,:password,:is_active,:role_id,:created_at,:updated_at)");
			$query->bindParam(':img',$feature_img);
			$query->bindParam(':name',$name);
			$query->bindParam(':email',$email);
			$query->bindParam(':username',$username);
			$query->bindParam(':password',$password);
			$query->bindParam(':is_active',$is_active);
			$query->bindParam(':role_id',$role_id);
			$query->bindParam(':created_at',$created_at);
			$query->bindParam(':updated_at',$updated_at);
			if($query->execute()){		
				$_SESSION['amsg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="mdi mdi-check-all me-2"></i>Added Successfully<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
				header("location:../usersList.php");
			}else{
				$_SESSION['amsg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="mdi mdi-block-helper me-2"></i>Something went wrong<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
				header("location:../usersList.php");			    			
			}
	}
}else{
	header("location:../login.php");
}





?>