<?php
require_once 'connect.php';

if (ctype_graph($_GET['hash'])) {
    $hash = $_GET['hash'];
    $sql = "SELECT `id`, `Validation` FROM `users` WHERE `hash`='" . $hash . "'";
    if ($result = mysqli_query($connect, $sql)) {
    	while ( $row = mysqli_fetch_assoc($result) ) { 
            if ($row['Validation'] == 0) {
             	mysqli_query($connect, "UPDATE `users` SET `Validation`=1 WHERE `id`=". $row['id'] );
             	header('Location: ../signin.html?msg=1');
    		}
    	}
    }
}
?>