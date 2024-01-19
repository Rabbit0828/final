<?php
// データベース接続の定数
const SERVER = 'mysql212.phy.lolipop.lan';
const DBNAME = 'LAA1517469-sample';
const USER = 'LAA1517469';
const PASS = 'Pass0828';

// DSNを構築
$connect = 'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8';

// エラーハンドリング付きでPDOインスタンスを作成
try {
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("データベース接続エラー: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $full_name = $_POST['full_name'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO Users (username, password, email, phone_number, full_name) VALUES (:username, :password, :email, :phone_number, :full_name)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashed_password);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone_number', $phone_number);
    $stmt->bindParam(':full_name', $full_name);

    try {
        $stmt->execute();
        echo "新規登録成功！";
    } catch (PDOException $e) {
        echo "エラー: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規登録</title>
</head>
<body>

<h2>新規登録</h2>
<form method="post" action="">
 
    <label for="register-username">ユーザー名:</label>
    <input type="text" id="register-username" name="username" required><br>

    <label for="register-password">パスワード:</label>
    <input type="password" id="register-password" name="password" required><br>

    <label for="register-email">メールアドレス:</label>
    <input type="email" id="register-email" name="email" required><br>

    <label for="register-phone">電話番号:</label>
    <input type="tel" id="register-phone" name="phone_number"><br>

    <label for="register-fullname">氏名:</label>
    <input type="text" id="register-fullname" name="full_name" required><br>


    <input type="submit" name="register" value="新規登録">
</form>


<p>すでにアカウントをお持ちの方は<a href="login.php">こちら</a></p>

</body>
</html>
