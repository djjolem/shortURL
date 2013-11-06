<?php
    include 'DBConnection.php';
    
    session_start();
    $model = new DBConnection;
    
    $user = $_POST["inputEmail"]; 
    $pass = $_POST["inputPassword"]; 
    
    if($model->doesExistUser($user, $pass)){
        $_SESSION['signed'] = 'TRUE'; 
    } else {
        $_SESSION["signed"] = FALSE; 
    }

    header('location: index.php'); 
?>

