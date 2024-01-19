<?php
const SERVER = 'mysql212.phy.lolipop.lan';
const DBNAME = 'LAA1517469-sample';
const USER = 'LAA1517469';
const PASS = 'Pass0828';

$connect = 'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8';

try {
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/user.css">
    <title>ユーザー編集</title>
    <style>
        body {
            text-align: center;
        }

        table {
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <h1>ユーザー編集</h1>
    <hr>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
        $user_id = $_POST['user_id'];
        $sql = $pdo->prepare('SELECT * FROM Users WHERE user_id = ?');
        $sql->execute([$user_id]);

        $row = $sql->fetch(PDO::FETCH_ASSOC);

        if ($row) {
    ?>
            <form action="update_user.php" method="POST">
                <table>
                    <tr>
                        <td>ユーザーID:</td>
                        <td><?php echo $row['user_id']; ?></td>
                        <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                    </tr>
                    <tr>
                        <td>ユーザー名:</td>
                        <td><input type="text" name="username" value="<?php echo $row['username']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><input type="email" name="email" value="<?php echo $row['email']; ?>"></td>
                    </tr>
                    <tr>
                        <td>電話番号:</td>
                        <td><input type="tel" name="phone_number" value="<?php echo $row['phone_number']; ?>"></td>
                    </tr>
                    <tr>
                        <td>氏名:</td>
                        <td><input type="text" name="full_name" value="<?php echo $row['full_name']; ?>"></td>
                    </tr>
                </table>

                <br>
                <input type="submit" value="更新">
            </form>

            <form action="delete_user.php" method="POST">
                <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                <input type="submit" value="削除">
            </form>
    <?php
        } else {
            echo "<p>ユーザーが見つかりませんでした。</p>";
        }
    } else {
        echo "<p>ユーザーIDが提供されていません。</p>";
    }
    ?>

    <button onclick="location.href='user.php'">トップに戻る</button>
</body>
</html>
