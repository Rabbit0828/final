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
    try {
        $pdo = new PDO($connect, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_id'])) {
            $user_id = $_POST['user_id'];
            $sqlDelete = $pdo->prepare('DELETE FROM Users WHERE user_id = ?');

            if ($sqlDelete->execute([$user_id])) {
                echo 'ユーザーの削除に成功しました。';
            } else {
                echo 'ユーザーの削除に失敗しました。';
            }
        } else {
            echo '無効なリクエストです。';
        }

        // ユーザー一覧を表示
        echo "<br><hr><br>";
        echo "<table><th>ユーザーID</th><th>ユーザー名</th><th>Email</th><th>電話番号</th><th>氏名</th>";

        foreach ($pdo->query('SELECT * FROM Users') as $row) {
            echo '<tr>';
            echo '<td>', $row['user_id'], '</td>';
            echo '<td>', $row['username'], '</td>';
            echo '<td>', $row['email'], '</td>';
            echo '<td>', $row['phone_number'], '</td>';
            echo '<td>', $row['full_name'], '</td>';
            echo '</tr>';

            echo "\n";
        }
        echo "</table>";
    } catch (PDOException $e) {
        die("接続失敗: " . $e->getMessage());
    }
    ?>

    <form action="user.php" method="post">
        <button type="submit">トップへ戻る</button>
    </form>
</body>

</html>
