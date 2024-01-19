<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/branch.css">
    <title>branch</title>
</head>
<body>


<p>ユーザーID <?php echo $user_id; ?> でログイン中</p>


<ul>
    <h2>ユーザー管理</h2>  
    <li><a href="user.php" class="menu-link"><img src="user_icon.png" alt="ユーザーアイコン"></a></li>
    <h2>モンスター管理</h2>
    <li><a href="index.php" class="menu-link"><img src="monster_icon.png" alt="モンスターアイコン"></a></li>
</ul>


<form method="post" action="logout.php">
    <input type="submit" value="ログアウト">
</form>

</body>
</html>
