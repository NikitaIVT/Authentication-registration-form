<?php
require_once 'connect.php';

$email = $_POST['email'];
$password = $_POST['password'];
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return 0;
}

$sql = "SELECT * FROM users WHERE Email LIKE '$email'";
if (($result = mysqli_query($connect, $sql)) && (filter_var($email, FILTER_VALIDATE_EMAIL))) {
	$mail_exists = $result->num_rows;
	if ($mail_exists == 0) {
		header('Location: ../signin.html?error=1');
	} else {
		$sql = "SELECT `Password`  FROM `users` WHERE `Email`='$email'";
		$result = mysqli_query($connect, "SELECT Password FROM users WHERE email='$email'");
		$row = mysqli_fetch_array($result);
		$hash = $row[0];

		if (password_verify($password, $hash)) {
			echo "Норм";
			$sql = "SELECT * FROM `users`";
			$result = mysqli_query($connect, $sql);
			$rows = (object)$result;
			for ($i = 0; $i < $rows->num_rows; $i++) {
				$row = $result->fetch_array(MYSQLI_ASSOC);
				print_r($row);
			}
			/*header('Location: ');*/
		} else {
			header('Location: ../signin.html?error=1');
		}
	}
}
?>