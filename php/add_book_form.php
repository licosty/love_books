<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>LoveBooks</title>
  <style>
    label{display: inline-block;width: 100px;}
    form > div{margin-bottom: 5px;}
    .i input {width: 200px;}
  </style>
</head>
<body>
  <h2>Добавить книгу в список</h2>

	<?php

  include "connect_to_db.php";

  if (isset($_POST["title"]))
  {
    $selected_value = $_POST['select'];

    if ($selected_value === 'available') {
      $selected_value = 'В наличии';
    } else {
      $selected_value = 'Нет в наличии';
    }

    $add_sql = mysqli_query($link, "
      INSERT INTO books 
      VALUES 
      (NULL, '{$_POST['title']}', '{$_POST['author']}', '{$_POST['genre']}', '{$_POST['year']}', '{$_POST['annotation']}', '$selected_value')");

    if ($add_sql) {
      echo '<p>Книга успешно добавлена.</p>';
    } else {
      echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
    }
  }

  ?>
  <form action="" method="post">

    <div class="i">
      <label for="title">Название:</label>
      <input type="text" id="title" name="title" required="" autofocus="">
    </div>
    <div class="i">
      <label for="author">Автор:</label>
      <input type="text" id="author" name="author" required="">
    </div>
    <div class="i">
      <label for="genre">Жанр:</label>
      <input type="text" id="genre" name="genre">
    </div>
    <div class="i">
      <label for="year">Год:</label>
      <input type="text" id="year" name="year" placeholder="Введите год в формате YYYY" pattern="[1-2][0-9]{3}">
    </div>
    <div class="i">
      <label for="annotation">Аннотация:</label>
      <input type="text" id="annotation" name="annotation">
    </div>
    <div>
      <label for="select">Наличие:</label>
      <select id="select" name="select" >
        <option selected="" value="available">В наличии</option>
        <option value="not_available">Нет в наличии</option> 
      </select>
    </div>
    <div>
      <input type="submit" value="Сохранить">
      <input type="reset" value="Очистить">
      <input type="button" name="return" value="Вернуться к списку" onclick="window.location = '../index.php'">
    </div>
  </form>
</body>
</html>