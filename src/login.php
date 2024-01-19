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
    die("データベース接続エラー: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM Users WHERE username = :username";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($user && password_verify($password, $user['password'])) {

        session_start();
        $_SESSION['user_id'] = $user['user_id'];
        header("Location: branch.php");
        exit();
    } else {
        $login_error = "ユーザー名またはパスワードが正しくありません。";
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
    <link rel="stylesheet" href="./css/login.css">

</head>
<body>

<form method="post" action="">
    <label for="login-username">ユーザー名:</label>
    <input type="text" id="login-username" name="username" required><br>

    <label for="login-password">パスワード:</label>
    <input type="password" id="login-password" name="password" required><br>

    <input type="submit" name="login" value="ログイン">
    <p><a href="register.php">新規登録</a></p>
</form><br>


<?php
if (isset($login_error)) {
    echo "<p style='color: red;'>$login_error</p>";
}
?>

</body>
</html>
