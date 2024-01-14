
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
    $sql = $pdo->prepare('UPDATE Monster SET
        monster_name = :monster_name,
        alias = :alias,
        other_name = :other_name,
        race = :race,
        type = :type,
        danger_level = :danger_level,
        hunting_ground = :hunting_ground,
        monster_setu = :monster_setu,
        opus = :opus,
        gazou = :gazou
        WHERE monster_id = :monster_id');

    $params = array(
        ':monster_id' => $_POST['monster_id'],
        ':monster_name' => $_POST['monster_name'],
        ':alias' => $_POST['alias'],
        ':other_name' => $_POST['other_name'],
        ':race' => $_POST['race'],
        ':type' => $_POST['type'],
        ':danger_level' => $_POST['danger_level'],
        ':hunting_ground' => $_POST['hunting_ground'],
        ':monster_setu' => $_POST['monster_setu'],
        ':opus' => $_POST['opus'],
        ':gazou' => $_POST['gazou']
    );

    try {
        $sql->execute($params);
        echo "モンスターが正常に更新されました。";
    } catch (PDOException $e) {
        echo "モンスターの更新エラー: " . $e->getMessage();
    }
} else {
    echo "無効なリクエストです";
}
?>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/update_monster.css">
</head>
<body>
    <hr>
    <?php
    $sql = $pdo->prepare('SELECT * FROM Monster WHERE monster_id = ?');
    $sql->execute([$_POST['monster_id']]);
    $row = $sql->fetch(PDO::FETCH_ASSOC);

    if ($row) {
    ?>
    <div class="monster-gazou">
        <img src="./image/<?php echo $row['gazou'] ?>" class="card-img-top" alt="商品の画像" style="width: 600px;">
    </div>

    <form action="update_monster.php" method="POST">
        <label>モンスターID:</label>
        <span><?php echo $row['monster_id']; ?></span><br>
        <label>モンスター名:</label>
        <span><?php echo $row['monster_name']; ?></span><br>
        <label>別名:</label>
        <span><?php echo $row['alias']; ?></span><br>
        <label>異名:</label>
        <span><?php echo $row['other_name']; ?></span><br>
        <label>種族:</label>
        <span><?php echo $row['race']; ?></span><br>
        <label>種別:</label>
        <span><?php echo $row['type']; ?></span><br>
        <label>危険度:</label>
        <span><?php echo $row['danger_level']; ?></span><br>
        <label>狩猟地:</label>
        <span><?php echo $row['hunting_ground']; ?></span><br>
        <label>説明:</label>
        <span><?php echo $row['monster_setu']; ?></span><br>
        <label>登場作品:</label>
        <span><?php echo $row['opus']; ?></span><br>
        <label>画像:</label>
        <span><?php echo $row['gazou']; ?></span><br>

    </form>

    <?php
    } else {
        echo "<p>見つかりませんでした</p>";
    }
    ?>

    <button onclick="location.href='index.php'">トップに戻る</button>
</body>
