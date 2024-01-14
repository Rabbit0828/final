<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/touroku_input.css">
    <title>モンスター登録</title>
</head>
<body>
    <h1>モンスター登録</h1>
    <hr>
    <form action="touroku_output.php" method="POST">
        モンスター名:
        <textarea name="monster_name" rows="1" cols="20" required></textarea><br>
        別名:
        <textarea name="alias" rows="1" cols="20" required></textarea><br>
        異名:
        <textarea name="other_name" rows="1" cols="20" required></textarea><br>
        種族:
        <textarea name="race" rows="2" cols="30" required></textarea><br>
        種別:
        <textarea name="type" rows="1" cols="30" required></textarea><br>
        危険度:
        <textarea name="danger_level" rows="3" cols="30" required></textarea><br>
        狩猟地:
        <textarea name="hunting_ground" rows="5" cols="50" required></textarea><br>
        説明:
        <textarea name="monster_setu" rows="5" cols="50" required></textarea><br>
        登場作品:
        <textarea name="opus" rows="4" cols="40" required></textarea><br>
        画像:
        <textarea name="gazou" rows="1" cols="10" required></textarea><br><br>
        <input type="submit" value="登録">
    </form>
</body>
</html>


