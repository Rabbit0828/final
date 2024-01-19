<?php
const SERVER = 'mysql212.phy.lolipop.lan';
const DBNAME = 'LAA1517469-sample';
const USER = 'LAA1517469';
const PASS = 'Pass0828';

$connect = 'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8';
$pdo = new PDO($connect, USER, PASS);

if (isset($_POST['search']) && !empty($_POST['search'])) {
    $search = $_POST['search'];
    $stmt = $pdo->prepare("SELECT * FROM Users 
                          WHERE username LIKE :search 
                          OR email LIKE :search 
                          OR phone_number LIKE :search 
                          OR full_name LIKE :search");
    $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
    $stmt->execute();
} else {
    $stmt = $pdo->query('SELECT * FROM Users');
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/index.css">
    <title>ユーザー一覧</title>
</head>

<body>
    <h1>ユーザー一覧</h1>
    <hr>
    
    <form method="post" action="">
        <label for="search"></label>
        <input type="text" id="search" name="search">
        <button type="submit">検索</button>
    </form>
    <button onclick="location.href='branch.php'">戻る</button>
    <section>
        <table>
            <thead>
                <tr>
                    <th>ユーザーID</th>
                    <th>ユーザー名</th>
                    <th>Email</th>
                    <th>電話番号</th>
                    <th>氏名</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($stmt as $row) {
                    echo '<tr>';
                    echo '<td>';
                    echo '<form action="users.php" method="post">';
                    echo '<input type="hidden" name="user_id" value="', $row['user_id'], '">';
                    echo '<button type="submit">', $row['user_id'], '</button>';
                    echo '</form>';
                    echo '</td>';
                    echo '<td>', $row['username'], '</td>';
                    echo '<td>', $row['email'], '</td>';
                    echo '<td>', $row['phone_number'], '</td>';
                    echo '<td>', $row['full_name'], '</td>';
                    echo '</tr>';
                    echo "\n";
                }
                ?>
            </tbody>
        </table>
    </section>

</body>

</html>
