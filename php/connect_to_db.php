<?php
	$host = 'localhost';
	$user = 'love-books';
	$pass = '1234';
	$db_name = 'love-books';
	$link = mysqli_connect($host, $user, $pass, $db_name);

	if (!$link) {
		echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
		exit;
	}
?>