<?php
// DB接続設定
$host = 'localhost';
$dbname = 'register_db';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // データ取得クエリ
$stmt = $pdo->query("SELECT * FROM sales ORDER BY id ASC");
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
    <link rel="stylesheet" href="style_sales.css">
</head>

<body>
    <div class="container">
        <h2>売上履歴</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>金額</th>
                    <th>売上日時</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($sales)): ?>
                    <?php foreach ($sales as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']) ?></td>
                            <td><?= number_format($row['amount']) ?> 円</td>
                            <td><?= htmlspecialchars($row['sales_at']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">売上データがありません。</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="index.php" class="back-button">← 戻る</a>
    </div>
</body>

</html>