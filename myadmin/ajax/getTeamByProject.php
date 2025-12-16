<?php 
session_start();
if (!empty($_POST['projectID'])) {
	require '../../include/connection.php';

	$projectID = $_POST['projectID'];
	// echo $projectID;


	$userOption = "";

	$query = $conn->prepare("SELECT * FROM project_members where project_id = :project_id");
    $query->bindParam(':project_id',$projectID);
    $query->execute();
    $project_member_result = $query->fetchAll();
    $project_member_row = count($project_member_result);
    if ($project_member_row>0) {
        foreach ($project_member_result as $value) { 
        	$user_id = $value['user_id'];  
	           $query = $conn->prepare("SELECT * FROM users where id = :user_id");
	           $query->bindParam(':user_id',$user_id);
	           $query->execute();
	           $user_result = $query->fetchAll();
	           $user_row = count($user_result);
	           if ($user_row>0) {
	             $userID = $user_result[0]['id'];
	             $userName = $user_result[0]['name'];

	             $userOption .= '<option value="'.$userID.'">'.$userName.'</option>';

	           }
	        }  
    }

    // echo json_encode($userOption);

    echo $userOption;



}



?>