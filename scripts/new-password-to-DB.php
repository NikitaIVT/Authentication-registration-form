<?php
require_once 'connect.php';

if (ctype_graph($_POST['hash'])) {
    $hash = $_POST['hash'];
    $password = $_POST['password'];
    $password = password_hash($password, PASSWORD_BCRYPT);
    $sql = "SELECT `id`, `Password` FROM `users` WHERE `hash`='" . $hash . "'";
    if ($result = mysqli_query($connect, "SELECT `id` FROM `users` WHERE `hash`='" . $hash . "'")) {
    	while ( $row = mysqli_fetch_assoc($result) ) { 
         	mysqli_query($connect, "UPDATE `users` SET Password='$password' WHERE `id`=". $row['id'] );
         	header('Location: ../signin.html?msg=2');
    	}
    }
}
?>