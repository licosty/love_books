<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
    <title>LoveBooks</title>
    <style>
        label{display: inline-block;width: 170px;}
        form > div{margin-bottom: 5px;}
        .b input{width: 200px;}
    </style>
</head>
<body>
	<h3>Заполните необходимые для редактирования поля</h3>

	<?php
	include "connect_to_db.php";

	if (isset($_POST["title"])) {

		$book_id = $_POST['id'];
		$book_title = $_POST['title'];
		$book_author = $_POST['author'];
		$book_genre = $_POST['genre'];
		$book_year = $_POST['year'];
		$book_annotation = $_POST['annotation'];
		$book_available = $_POST['select'];


		$update_columns = array();

		if (trim($book_title) !== "") 		{ $update_columns[] .= "title = '" 			. $book_title . "'"; }
		if (trim($book_author) !== "")		{ $update_columns[] .= "author = '" 		. $book_author . "'"; }
		if (trim($book_genre) !== "") 		{ $update_columns[] .= "genre = '" 			. $book_genre . "'"; }
		if (trim($book_year) !== "") 		{ $update_columns[] .= "`year` = '" 		. $book_year . "'"; }
		if (trim($book_annotation) !== "") 	{ $update_columns[] .= "annotations = '" 	. $book_annotation . "'"; }
		if ($book_available === 'available'){ $update_columns[] .= "available = 'В наличии'";}
    	else 								{ $update_columns[] .= "available = 'Нет в наличии'";}
    

		if (sizeof($update_columns) > 0) {
			$update_sql = mysqli_query($link, "UPDATE books SET " . implode(", ", $update_columns) . " WHERE id = " . $book_id);
		}



		if ($update_sql) {
			echo "<p>Запись с ID: ". $book_id . " успешно обновлена.</p>";
		} else {
			echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
		}
	}
?>

	<form action="" method="post">
		<div class="b">
			<label for="id">Выбирите ID строки *:</label>
			<input type="number" id="id" name="id" required="" min="1">
		</div>
		<div class="b">
			<label for="title">Название книги:</label>
			<input type="text" name="title">
		</div>
		<div class="b">
			<label for="author">Имя автора:</label>
			<input type="text" name="author">
		</div>
		<div class="b">
			<label for="genre">Жанр:</label>
			<input type="text" name="genre">
		</div>
		<div class="b">
			<label for="year">Год издания:</label>
			<input type="text" name="year" placeholder="Введите год в формате YYYY" pattern="[1-2][0-9]{3}">
		</div>
		<div class="b">
			<label for="annotation">Аннотация:</label>
			<input type="text" name="annotation">
		</div>
		<div>
			<label for="select">Наличие:</label>
			<select name="select" >
				<option selected="" value="available">В наличии</option>
				<option value="not_available">Нет в наличии</option> 
			</select>
		</div>
		<input type="submit" value="Сохранить">
		<input type="button" name="return" value="Вернуться к списку" onclick="window.location = '../index.php'">
	</form>

</body>
</html>