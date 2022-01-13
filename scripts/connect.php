<?php
	$connect = mysqli_connect('localhost', 'root', '', 'infosoft-test-users');
	if (!$connect) {
		die('Ошибка подключения к базе данных.');
	}
?>