<?php
// ダミーデータ
$dummyData = [
  ['amount' => 1200, 'created_at' => '2025-04-11 09:15:00'],
  ['amount' => 3400, 'created_at' => '2025-04-10 14:50:00'],
  ['amount' => 2000, 'created_at' => '2025-04-09 11:25:00'],
  ['amount' => 1500, 'created_at' => '2025-04-10 17:30:00'],
];

// フィルタ条件取得
$filterDate = $_GET['date'] ?? '';
$filterAmountMin = $_GET['amount_min'] ?? '';
$filterAmountMax = $_GET['amount_max'] ?? '';

// フィルタ処理
$filteredData = array_filter($dummyData, function($item) use ($filterDate, $filterAmountMin, $filterAmountMax) {
  // (A) 日付フィルタ
  if ($filterDate !== '') {
    if (substr($item['created_at'], 0, 10) !== $filterDate) {
      return false;
    }
  }

  // (B) 金額範囲フィルタ
  if ($filterAmountMin !== '' && $item['amount'] < $filterAmountMin) {
    return false;
  }
  if ($filterAmountMax !== '' && $item['amount'] > $filterAmountMax) {
    return false;
  }

  return true;
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

    <!-- 検索フォーム -->
    <form method="GET" class="filter-form">
  <div class="filter-group">
    <label for="date">日付で検索：</label>
    <input type="date" name="date" id="date" value="<?= htmlspecialchars($filterDate) ?>">
  </div>
  
  <div class="filter-group">
    <label for="amount_min">金額範囲（最小）：</label>
    <input type="number" name="amount_min" id="amount_min" value="<?= htmlspecialchars($filterAmountMin) ?>" placeholder="最小金額">
  </div>

  <div class="filter-group">
    <label for="amount_max">金額範囲（最大）：</label>
    <input type="number" name="amount_max" id="amount_max" value="<?= htmlspecialchars($filterAmountMax) ?>" placeholder="最大金額">
  </div>

  <div class="filter-buttons">
    <button type="submit">検索</button>
    <button type="button" onclick="location.href='register.php'">リセット</button>
  </div>
</form>


    <!-- テーブル表示 -->
    <table>
      <thead>
        <tr><th>ID</th><th>金額</th><th>計上日時</th></tr>
      </thead>
      <tbody>
        <?php if (count($filteredData) > 0): ?>
          <?php foreach ($filteredData as $i => $row): ?>
            <tr>
              <td><?= $i+1 ?></td>
              <td><?= number_format($row['amount']) ?> 円</td>
              <td><?= $row['created_at'] ?></td>
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
