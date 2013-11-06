<?php

$email = $_POST["inputEmail"];
$pass1 = $_POST["inputPassword1"]; 
$pass2 = $_POST["inputPassword2"]; 

if ($email == "" || $pass1 == "" || $pass2 == ""){
    header('location: newaccount.php?error=Error');
} else {
}

?>

