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
    die("接続失敗: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = $pdo->prepare('UPDATE Users SET
        username = :username,
        email = :email,
        phone_number = :phone_number,
        full_name = :full_name
        WHERE user_id = :user_id');

    $params = array(
        ':user_id' => $_POST['user_id'],
        ':username' => $_POST['username'],
        ':email' => $_POST['email'],
        ':phone_number' => $_POST['phone_number'],
        ':full_name' => $_POST['full_name']
    );

    try {
        $sql->execute($params);
        echo "ユーザーが正常に更新されました。";
    } catch (PDOException $e) {
        echo "ユーザーの更新エラー: " . $e->getMessage();
    }
} else {
    echo "無効なリクエストです";
}
?>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/update_user.css">
</head>
<body>
    <hr>
    <?php
    $sql = $pdo->prepare('SELECT * FROM Users WHERE user_id = ?');
    $sql->execute([$_POST['user_id']]);
    $row = $sql->fetch(PDO::FETCH_ASSOC);

    if ($row) {
    ?>
    <form action="update_user.php" method="POST">
        <label>ユーザーID:</label>
        <span><?php echo $row['user_id']; ?></span><br>
        <label for="username">ユーザー名:</label>
        <input type="text" id="username" name="username" value="<?php echo $row['username']; ?>"><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>"><br>
        <label for="phone_number">電話番号:</label>
        <input type="tel" id="phone_number" name="phone_number" value="<?php echo $row['phone_number']; ?>"><br>
        <label for="full_name">氏名:</label>
        <input type="text" id="full_name" name="full_name" value="<?php echo $row['full_name']; ?>"><br>

        <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
        
    </form>

    <?php
    } else {
        echo "<p>見つかりませんでした</p>";
    }
    ?>

    <button onclick="location.href='user.php'">トップに戻る</button>
</body>
</html>
