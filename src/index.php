<?php
const SERVER = 'mysql212.phy.lolipop.lan';
const DBNAME = 'LAA1517469-sample';
const USER = 'LAA1517469';
const PASS = 'Pass0828';

$connect = 'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8';
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/index.css">
    <title>モンスター一覧</title>
</head>

<body>
    <h1>モンスター一覧</h1>
    <hr>
    <button onclick="location.href='touroku_input.php'">新規登録</button>
    <button onclick="location.href='branch.php'">戻る</button>

    <form method="post" action="">
        <label for="search"></label>
        <input type="text" id="search" name="search">
        <button type="submit">検索</button>
    </form>

    <?php
    $pdo = new PDO($connect, USER, PASS);
    echo "<table><th>モンスターID</th><th>モンスター名</th><th>別　名</th><th>異　名</th><th>種　族</th><th>種　別</th><th>生息地</th>";

    if (isset($_POST['search']) && !empty($_POST['search'])) {
        $search = $_POST['search'];
        $stmt = $pdo->prepare("SELECT * FROM Monster 
                              WHERE monster_name LIKE :search 
                              OR alias LIKE :search 
                              OR other_name LIKE :search 
                              OR race LIKE :search 
                              OR type LIKE :search 
                              OR hunting_ground LIKE :search");
        $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
        $stmt->execute();
    } else {
        $stmt = $pdo->query('SELECT * FROM Monster');
    }

    foreach ($stmt as $row) {
        echo '<tr>';
        echo '<td>';
        echo '<form action="monster.php" method="post">';
        echo '<input type="hidden" name="id" value="', $row['monster_id'], '">';
        echo '<button type="submit">', $row['monster_id'], '</button>';
        echo '</form>';
        echo '</td>';
        echo '<td>', $row['monster_name'], '</td>';
        echo '<td>', $row['alias'], '</td>';
        echo '<td>', $row['other_name'], '</td>';
        echo '<td>', $row['race'], '</td>';
        echo '<td>', $row['type'], '</td>';
        echo '<td>', $row['hunting_ground'], '</td>';
        echo '</tr>';
        echo "\n";
    }
    echo "</table>";
    ?>
</body>

</html>




