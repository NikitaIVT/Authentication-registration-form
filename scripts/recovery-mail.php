<?php
require_once 'connect.php';

$email = $_POST['email'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return 0;
}

$sql = "SELECT * FROM users WHERE Email LIKE '" . $email . "'";
if ($result = mysqli_query($connect, $sql)) {
	$mail_exists = $result->num_rows;
	if ($mail_exists == 0) {
		die("Пользователя с такой почтой не существует, проверьте введеный адрес.");
	}
}
$hash = md5($email . time());

$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=utf-8\r\n";
$headers .= "From: <mail@example.com>\r\n";

$message = '
        <html>
        <head>
        <title>Восстановление пароля</title>
        </head>
        <body>
        <p>Чтобы восстановить пароль, перейдите по <a href="http://localhost/infosoft-test/scripts/recovery-new-password.php?hash=' . $hash . '">ссылке</a></p>
        <p>Если не открывается, то вставьте localhost/infosoft-test/scripts/recovery-new-password.php?hash=' . $hash . ' в адрессную строку.
        </body>
        </html>
        ';
mysqli_query($connect, "UPDATE `users` SET Hash='$hash' WHERE Email='$email'");
mail($email, "Восстановление пароля", $message, $headers);
header('Location: ../signin.html?msg=3');
?>