<?php
	
	include "connect_to_db.php";
	session_start();
	
		$get_sql = mysqli_query($link, "UPDATE books SET available = 'В наличии' WHERE id = " . $_SESSION['id']);

		if ($get_sql) {
			echo "Книга успешно возвращена";
		}
	
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>LoveBooks</title>
</head>
<body>
	
	<input type="button" name="return" value="Вернуться к списку" onclick="window.location = '../index.php'">

</body>
</html>