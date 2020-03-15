<?php
	require 'php/connect_to_db.php';

	$select_sql = mysqli_query($link, 'SELECT `title`, `author` FROM `books`');

	while ($result = mysqli_fetch_array($select_sql)) {
		echo "{$result['title']} - {$result['author']}<br>";

	}
?>