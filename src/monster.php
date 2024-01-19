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
    <link rel="stylesheet" href="./css/monster.css">
    <title>詳細</title>
    <style>
        body {
            text-align: center;
        }

        table {
            margin: 0 auto;
        }

        .monster-gazou {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>詳細</h1>
    <hr>
    <?php
    $sql = $pdo->prepare('SELECT * FROM Monster WHERE monster_id = ?');
    $sql->execute([$_POST['id']]);

    $row = $sql->fetch(PDO::FETCH_ASSOC);

    if ($row) {
    ?>
    <div class="monster-gazou">
        <img src="./image/<?php echo $row['gazou'] ?>" class="card-img-top" alt="商品の画像" style="max-width: 50%;
  max-height: 50%;">
    </div>

    <form action="update_monster.php" method="POST">
    モンスターID:
    <?php echo $row['monster_id']; ?>
    <input type="hidden" name="monster_id" value="<?php echo $row['monster_id']; ?>"><br>
    モンスター名:
    <textarea name="monster_name"rows="1" cols="20"><?php echo $row['monster_name']; ?></textarea><br>
    別名:
    <textarea name="alias"rows="1" cols="20"><?php echo $row['alias']; ?></textarea><br>
    異名:
    <textarea name="other_name"rows="1" cols="20"><?php echo $row['other_name']; ?></textarea><br>
    種族:
    <textarea name="race"rows="2" cols="30"><?php echo $row['race']; ?></textarea><br>
    種別:
    <textarea name="type"rows="1" cols="30"><?php echo $row['type']; ?></textarea><br>
    危険度:
    <textarea name="danger_level"rows="3" cols="30"><?php echo $row['danger_level']; ?></textarea><br>
    生息地:
    <textarea name="hunting_ground"rows="5" cols="50"><?php echo $row['hunting_ground']; ?></textarea><br>
    説明:
    <textarea name="monster_setu"rows="5" cols="50"><?php echo $row['monster_setu']; ?></textarea><br>
    登場作品:
    <textarea name="opus"rows="4" cols="40"><?php echo $row['opus']; ?></textarea><br>
    画像:
    <textarea name="gazou"rows="1" cols="10"><?php echo $row['gazou']; ?></textarea><br><br>


        <input type="submit" value="更新">
    </form>

    <form action="delete_monster.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['monster_id']; ?>">
        <input type="submit" value="削除">
    </form>

    <?php
    } else {
        echo "<p>見つかりませんでした</p>";
    }
    ?>

    <button onclick="location.href='index.php'">トップに戻る</button>
</body>
</html>
