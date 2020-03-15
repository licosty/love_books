<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>LoveBooks</title>
    <style>
        td:nth-child(5){text-align:left;}
        table{border-spacing: 0;border-collapse: collapse;}
        td, th{padding: 10px;border: 1px solid black;}
    </style>
</head>
<body>
	<h2>Результаты поиска</h2>

    <form>
        <input type='button' name='change' value='Редактировать' onclick="window.location = 'update_book_form.php'">
        <input type="button" name="return" value="Вернуться к списку" onclick="window.location = '../index.php'">
        <table>
            

            <?php  
            include "connect_to_db.php";


            $query = trim($_POST['query']);
            $query = mysqli_real_escape_string($link, $query);
            $query = htmlspecialchars($query);

            if (!empty($query)) {

                if (mb_strlen($query) < 3) {
                    echo '<p>Слишком короткий поисковый запрос</p>';
                } elseif (mb_strlen($query) > 128) {
                    echo '<p>Слишком длинный поисковый запрос</p>';
                } else {
                    $select_sql = mysqli_query($link, "
                        SELECT `id`, `title`, `author`, `genre`, `year`, `annotations` FROM `books` 
                        WHERE title LIKE '%$query%'
                        OR author   LIKE '%$query%'
                        OR genre    LIKE '%$query%'
                        OR `year`   LIKE '%$query%'
                        ");

                    if (mysqli_num_rows($select_sql) > 0) {
                        $num = mysqli_num_rows($select_sql);
                        echo '<p>По запросу <b>'.$query.'</b> найдено совпадений: '.$num.'</p>';

                        echo "<tr>
                            <th>ID</th>
                            <th width='200'>Название</th>
                            <th width='150'>Автор</th>
                            <th>Жанр</th>
                            <th>Год</th>
                            <th>Аннотация</th>
                            </tr>";

                        while ($result = mysqli_fetch_array($select_sql)) {
                            echo "<tr>";
                            echo "<td>" . $result['id']             . "</td>";
                            echo "<td>" . $result['title']          . "</td>";
                            echo "<td>" . $result['author']         . "</td>";
                            echo "<td>" . $result['genre']          . "</td>";
                            echo "<td>" . $result['year']           . "</td>";
                            echo "<td>" . $result['annotations']    . "</td>";
                            echo "</tr>";

                        }
                    } else {
                        echo '<p>По вашему запросу ничего не найдено.</p>';
                    }
                }
            } else {
                echo '<p>Задан пустой поисковый запрос.</p>';
            }


            ?>
        </table>
    </form>
	
	 
</body>
</html>