<?php
// ダミーデータ
$dummyData = [
  ['amount' => 1200, 'created_at' => '2025-04-11 09:15:00'],
  ['amount' => 3400, 'created_at' => '2025-04-10 14:50:00'],
  ['amount' => 2000, 'created_at' => '2025-04-09 11:25:00'],
  ['amount' => 1500, 'created_at' => '2025-04-10 17:30:00'],
  
];

// フィルター処理
$filterDate = $_GET['date'] ?? '';
$filterAmount = $_GET['amount'] ?? '';

$filteredData = array_filter($dummyData, function ($item) use ($filterDate, $filterAmount) {
  $dateMatch = $filterDate === '' || strpos($item['created_at'], $filterDate) === 0;
  $amountMatch = $filterAmount === '' || $item['amount'] == $filterAmount;
  return $dateMatch && $amountMatch;
});
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>計上履歴（検索付き）</title>
  <link rel="stylesheet" href="style1.css">
</head>
<body>
  <div class="container">
    <h2>計上済み売上</h2>

   <!-- 🔍 検索フォーム -->
   <form method="GET" class="filter-form">
  <div class="filter-group">
    <label for="date">日付で検索：</label>
    <input type="date" name="date" id="date" value="<?= htmlspecialchars($filterDate) ?>">
  </div>
  <div class="filter-group">
    <label for="amount">金額で検索：</label>
    <input type="number" name="amount" id="amount" value="<?= htmlspecialchars($filterAmount) ?>">
  </div>
  <div class="filter-buttons">
    <button type="submit">検索</button>
    <a href="register.php" class="reset-button">リセット</a>
  </div>
</form>



    <!-- 📋 テーブル -->
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>金額</th>
          <th>計上日時</th>
        </tr>
      </thead>
      <tbody>
        <?php if (count($filteredData) > 0): ?>
          <?php foreach ($filteredData as $index => $item): ?>
            <tr>
              <td><?= $index + 1 ?></td>
              <td><?= number_format($item['amount']) ?> 円</td>
              <td><?= $item['created_at'] ?></td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr><td colspan="3">該当するデータがありません。</td></tr>
        <?php endif; ?>
      </tbody>
    </table>

    <a class="back-button" href="index.php">← 戻る</a>
  </div>
</body>
</html>
