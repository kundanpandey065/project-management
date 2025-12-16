<?php
// session_start();

date_default_timezone_set('Asia/Kolkata');

// if ((!isset($_SESSION['USERID'])) || (empty($_SESSION['USERID']))) {
//   $USERID = $_SESSION['USERID'];
// }


$servername = "localhost";
$username = "root";
$password = "";
$database = "project_management";

// $servername = "localhost";
// $username = "projectd_projectd";
// $password = "projectd@123";
// $database = "projectd_ideal_public_school";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully"; 
        // die();
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }                      
?>