<?php
// DB接続
$host = 'localhost';
$dbname = 'register_db';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // ✅ sales_at に修正
    $stmt = $pdo->query("SELECT * FROM sales ORDER BY sales_at DESC");
    $sales = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "DBエラー: " . $e->getMessage();
    exit;
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>売上履歴</title>
    <link rel="stylesheet" href="style1.css"> <!-- ✅ style.css → style1.css に変更 -->
</head>

<body>
    <div class="container">
        <h2>売上履歴</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>金額</th>
                    <th>日時</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sales as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= number_format($row['amount']) ?> 円</td>
                        <!-- ✅ カラム名を sales_at に修正 -->
                        <td><?= htmlspecialchars($row['sales_at']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a class="back-button" href="index.php">← 戻る</a>
    </div>
</body>

</html>