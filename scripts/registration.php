<?php
require_once 'connect.php';

$email = $_POST['email'];
$name = $_POST['name'];
$fullname = $_POST['fullname'];
$date_of_birth = $_POST['date-of-birth'];
$date_of_birth = date('Y.m.d', strtotime($date_of_birth));
$password = $_POST['password'];
$password = password_hash($password, PASSWORD_BCRYPT);
$hash = md5($date_of_birth . time());

$sql = "SELECT * FROM users WHERE Email LIKE '" . $email . "'";
if (($result = mysqli_query($connect, $sql)) && (filter_var($email, FILTER_VALIDATE_EMAIL)) && (preg_match('/[^а-я]+/msi', $name)) 
     && (preg_match('/[^а-я]+/msi', $fullname))) {
	$mail_exists = $result->num_rows;
	if ($mail_exists != 0) {
		header('Location: ../registration.html?error=1');
        } else {

        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        $headers .= "From: <mail@example.com>\r\n";

        $message = '
                <html>
                <head>
                <title>Подтвердите почту</title>
                </head>
                <body>
                <p>Чтобы подтвердить вашу почту, перейдите по <a href="localhost/infosoft-test/scripts/validation.php?hash=' . $hash . '">ссылке</a></p>
                <p>Если не открывается, то вставьте localhost/infosoft-test/scripts/validation.php?hash=' . $hash . ' в адрессную строку.
                </body>
                </html>
                ';

        $sql = "INSERT INTO users (Name, Fullname, Date_of_Birth, Email, Hash, Password) VALUES ('$name', '$fullname', '$date_of_birth', '$email', '$hash', '$password')";

        mail($email, "Подтвердите Email на сайте", $message, $headers);

        if (mysqli_query($connect, $sql)) {
        	echo "Registred successfully";
        }
        else {
        	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($connect);
        header('Location: ../signin.html?msg=0');
        }
}
?>
