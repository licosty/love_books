<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>LoveBooks</title>
	<style>
		label{display: inline-block;width: 170px;}
		form > div{margin-bottom: 5px;}
		td:nth-child(5){text-align:left;}
		table{border-spacing: 0;border-collapse: collapse;}
		td, th{padding: 10px;border: 1px solid black;}

	</style>
</head>
<body>
	<h2>Список книг</h2>

	<form action="php/search.php" method="post">
		<div>
			<input type="search" name="query" placeholder="Поиск по книгам...">
			<input type="submit" value="Искать">
		</div>
	</form>
	<br>

	<?php  
	include "php/connect_to_db.php";

	?>
	<form action="php/remove_book.php" method="post">
		<div>
			<input type="button" name="add" value="Добавить" onclick="window.location = 'php/add_book_form.php'">
			<input type='button' name='change' value='Редактировать' onclick="window.location = 'php/update_book_form.php'">
			<input type='submit' name='remove' value='Удалить выделенные записи'>
			<input type="button" value="Прием и выдача книг" style="float: right;" onclick="window.location = 'php/reception_deliver_books.php'">
		</div>
		
		<?php

		$select_sql = mysqli_query($link, "SELECT id, title, author, genre, `year`, annotations FROM books LIMIT 20");
		if (mysqli_num_rows($select_sql) > 0) {
			echo "<table class='t2'>
			<tr>
			<th>ID</th>
			<th width='200'>Название</th>
			<th width='150'>Автор</th>
			<th>Жанр</th>
			<th>Год</th>
			<th>Аннотация</th>
			<th></th>
			</tr>";

			
			
			
			

			while ($result = mysqli_fetch_array($select_sql)) {
				echo "<tr>";
				echo "<td>" . $result['id'] 			. "</td>";
				echo "<td>" . $result['title'] 			. "</td>";
				echo "<td>" . $result['author'] 		. "</td>";
				echo "<td>" . $result['genre'] 			. "</td>";
				echo "<td>" . $result['year'] 			. "</td>";
				echo "<td>" . $result['annotations'] 	. "</td>";
				echo "<td><input type='checkbox' name='delete_row[]' value='" . $result['id'] . "'></td>";
				echo "</tr>";

			}

			$select_num = mysqli_query($link, "SELECT count(id) FROM books");
			$_SESSION['select_num'] = $select_num;
			
			echo "</table>";
		} else {echo "Вы не добавили еще ни одной книги";}
		
		?>

	</form>	

</body>
</html>