<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>LoveBooks</title>
</head>
<body>
	<?php
	include "connect_to_db.php";

	$ids_to_delete = array();

	if (empty($_POST['delete_row'])) {
		echo "Вы не задали ID строки для обновления данных!";
	} 

	if(isset($_POST['delete_row'])) {
		foreach($_POST['delete_row'] as $selected){
			$ids_to_delete[] = $selected;
		}

		if (sizeof($ids_to_delete) > 0) {
	
			$delete_sql = mysqli_query($link, "DELETE FROM books WHERE id IN (" . implode(",", array_map('intval', $ids_to_delete)) . ")");

			if ($delete_sql) {
				echo "Записи c id: " . implode(',', array_map('intval', $ids_to_delete)) . " успешно удалены!";
			}

			$drop_id_column = mysqli_query($link, "ALTER TABLE books DROP COLUMN id;");
			if ($drop_id_column) {
				$add_id_column = mysqli_query($link, "ALTER TABLE books ADD COLUMN id INT AUTO_INCREMENT PRIMARY KEY FIRST;");
			}
		}

	}

	?>
	<p><input type="button" name="return" value="Вернуться к списку" onclick="window.location = '../index.php'"></p>
</body>
</html>