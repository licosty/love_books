<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>LoveBooks</title>
    <style>
        label{display: inline-block;width: 170px;}
        form > div{margin-bottom: 5px;}
        td:nth-child(2){text-align:left;}
        table{border-spacing: 0;border-collapse: collapse; margin-top: 10px; margin-bottom: 10px;}
        td, th{padding: 10px;border: 1px solid black;}
        td {text-align: center;}
    </style>
</head>
<body>
	<h2>Прием и выдача книг</h2>


    <form action="search.php" method="post">
        <br>
        <div>
            <input type="search" name="query" placeholder="Поиск по книгам...">
            <input type="submit" value="Искать">
        </div>
    </form> 
    <form action="" method="post">
        <div>
            <label for="id">Выбирите ID строки *:</label>
            <input type="number" id="id" name="id" required="">
            <input type="submit" value="Проверить наличие">
        </div>
    </form>           

    <?php 
    include "connect_to_db.php";

    if (isset($_POST['id'])) {


        $available_sql = mysqli_query($link, "
            SELECT `id`, `title`, `author`, `genre`, `year`, `available`
            FROM `books`
            WHERE id = " . $_POST['id'] . " LIMIT 20");

        echo "<table><tr>
        <th>ID</th>
        <th width='200'>Название</th>
        <th width='150'>Автор</th>
        <th>Жанр</th>
        <th>Год</th>
        <th>Наличие</th>
        </tr>";

        $result = mysqli_fetch_array($available_sql);
        echo "<tr>";
        echo "<td>" . $result['id']             . "</td>";
        echo "<td>" . $result['title']          . "</td>";
        echo "<td>" . $result['author']         . "</td>";
        echo "<td>" . $result['genre']          . "</td>";
        echo "<td>" . $result['year']           . "</td>";
        echo "<td>" . $result['available']      . "</td>";
        echo "</tr>";
        echo "</table>";
        
        $_SESSION['id'] = $result['id'];
        echo "<div>";
        if ($result['available'] == 'В наличии') {
            ?>
            <input type="button" name="get_book" value="Получить книгу" onclick="window.location = 'get_book.php'">

            <?php
        } else {
            ?>
            <input type="button" name="give_book" value="Вернуть книгу" onclick="window.location = 'give_book.php'">
            <?php

        }
    }

    ?>   
    
        <!--<input type="button" name="get_book" value="Получить книгу" onclick="window.location = 'get_book.php'">
        <input type="button" name="give_book" value="Вернуть книгу" onclick="window.location = 'give_book.php'">-->
        <input type="button" name="return" value="Вернуться к списку" onclick="window.location = '../index.php'">

    </div>
    


</body>
</html>