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
    <link rel="stylesheet" href="css/index.css">
    <title>削除確認</title>
</head>

<body>
    <h1>削除確認</h1>
    <hr>
    <?php
    $pdo = new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('delete from Monster where monster_id=?');
    if($sql->execute([$_POST['id']])){
        echo '削除に成功しました。';
    }
    else{
        echo '削除に失敗しました。';
    }
    ?>
    <br><hr><br>
    <table>

    <?php
    echo "<table><th>モンスターID</th><th>モンスター名</th><th>別　名</th><th>異　名</th><th>種　族</th><th>種　別</th><th>生息地</th>";

    foreach ($pdo->query('select * from Monster') as $row) {
        echo '<tr>';
        echo '<td>', $row['monster_id'], '</td>';
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
    </table>
    <form action="index.php" metod="post">
    <button onclick="location.href='index.php'">トップへ戻る</button>
</form>
</body>

</html>

