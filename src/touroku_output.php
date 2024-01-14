<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>モンスター登録完了</title>
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>
    <h1>モンスター登録完了</h1>
    <hr>

    <?php
    const SERVER = 'mysql212.phy.lolipop.lan';
    const DBNAME = 'LAA1517469-sample';
    const USER = 'LAA1517469';
    const PASS = 'Pass0828';
    
    $connect = 'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8';

    try {
        $pdo = new PDO($connect, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $monster_name = $_POST['monster_name'];
        $alias = $_POST['alias'];
        $other_name = $_POST['other_name'];
        $race = $_POST['race'];
        $type = $_POST['type'];
        $danger_level = $_POST['danger_level'];
        $hunting_ground = $_POST['hunting_ground'];
        $monster_setu = $_POST['monster_setu'];
        $opus = $_POST['opus'];
        $gazou = $_POST['gazou'];

        $sql = $pdo->prepare("INSERT INTO Monster (monster_name, alias, other_name, race, type, danger_level, hunting_ground, monster_setu, opus, gazou) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->execute([$monster_name, $alias, $other_name, $race, $type, $danger_level, $hunting_ground, $monster_setu, $opus, $gazou]);

        echo "モンスターが正常に登録されました.";
        ?>
        <hr>
        <?php
        echo "<table><th>モンスターID</th><th>モンスター名</th><th>別名</th><th>異名</th><th>種族</th><th>種別</th>";

        foreach ($pdo->query('select * from Monster') as $row) {
            echo '<tr>';
            echo '<td>', $row['monster_id'], '</td>';
            echo '<td>', $row['monster_name'], '</td>';
            echo '<td>', $row['alias'], '</td>';
            echo '<td>', $row['other_name'], '</td>';
            echo '<td>', $row['race'], '</td>';
            echo '<td>', $row['type'], '</td>';
            echo '</tr>';
            
            echo "\n";
        }
        echo "</table>";
    } catch (PDOException $e) {
        echo "エラー: " . $e->getMessage();
    } finally {
        
    }
    ?>

    <form action="index.php" method="post">
        <button type="submit">トップへ戻る</button>
    </form>

</body>
</html>
