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

    <?php
    $pdo = new PDO($connect, USER, PASS);
    echo "<table><th>モンスターID</th><th>モンスター名</th><th>別名</th><th>異名</th><th>種族</th><th>種別</th>";

    foreach ($pdo->query('select * from Monster') as $row) {
        echo '<tr>';

        echo '<td>';
        echo '<form action="monster.php" method="post">';
        echo '<input type="hidden" name="id" value="',$row['monster_id'],'">';
        echo '<button type="submit">', $row['monster_id'], '</button>'; 
        echo '</form>';
        echo '</td>';

        echo '<td>', $row['monster_name'], '</td>';
        echo '<td>', $row['alias'], '</td>';
        echo '<td>', $row['other_name'], '</td>';
        echo '<td>', $row['race'], '</td>';
        echo '<td>', $row['type'], '</td>';
        echo '</tr>';
        
        echo "\n";
    }
    echo "</table>";
    ?>
</body>

</html>