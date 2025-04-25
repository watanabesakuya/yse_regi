<?php
// ダミーデータ（売上履歴）
$salesHistory = [
    ['amount' => 1500, 'created_at' => '2025-04-10 14:00:00'],
    ['amount' => 2200, 'created_at' => '2025-04-09 11:30:00'],
    ['amount' => 1900, 'created_at' => '2025-04-08 10:45:00'],
    ['amount' => 900, 'created_at' => '2025-04-025 23:45:00'],
    ['amount' => 2900, 'created_at' => '2025-04-025 19:35:00'],
];
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>売上履歴</title>
    <link rel="stylesheet" href="style1.css">
</head>

<body>
    <div class="container">
        <h2>売上履歴</h2>
        <table>
            <thead>
                <tr>
                    <th>売上日時</th>
                    <th>金額</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($salesHistory as $index => $sale): ?>
                    <tr>
                        <td><?= $sale['created_at'] ?></td>
                        <td><?= number_format($sale['amount']) ?>円</td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a class="back-button" href="index.php">← 戻る</a>
    </div>
</body>

</html>