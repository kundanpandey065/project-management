<?php
session_start();
if(isset($_POST['adminLogin'])){ 
require '../include/connection.php';

    $email = $_POST['email'];
    $password1 = $_POST['password'];
    $password = base64_encode($password1);
    $is_active = 1;
    $query = $conn->prepare("SELECT * FROM users where email =:email && password=:password && is_active = :is_active");
    $query->bindParam(':email',$email);
    $query->bindParam(':password',$password); 
    $query->bindParam(':is_active',$is_active); 
    $query->execute(); 
    $result = $query->fetchAll();
    $row = count($result);
    if($row==1){
      $_SESSION['USERID'] = $result[0]['id'];
      $_SESSION['ROLEID'] = $result[0]['role_id'];

      if ($_SESSION['ROLEID'] === 1) {
        header("location:../myadmin/index.php");
      }else{
        header("location:../employee/index.php");
      }


      // echo $_SESSION['empIDSESS'];
      // die();
      // header("location:../index.php");
    }else{
      $_SESSION['amsg'] = '<div class="alert alert-danger py-2">
                          <strong>Oops.!</strong> Somthing went Wrong</a>.
                        </div>';
      header("location:../login.php");
    }      
}else{
      $_SESSION['amsg'] = '<div class="alert alert-danger py-2">
                          <strong>Oops.!</strong> You should <a href="#" class="alert-link">Somthing went Wrong</a>.
                        </div>';
      header("location:../login.php");
    }     


?>