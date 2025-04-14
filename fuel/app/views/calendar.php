<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>calendar</title>
    <?= \Asset::css('calendar.css'); ?>
    
</head>
<body>
    <h1><?= $current_month ?> のカレンダー</h1>

    <!-- 前月、次月ボタン -->
    <div>
        <a href="?month=<?= $prev_month ?>">前月</a>
        <a href="?month=<?= $next_month ?>">次月</a>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>日</th>
                <th>月</th>
                <th>火</th>
                <th>水</th>
                <th>木</th>
                <th>金</th>
                <th>土</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($calendar as $week) : ?>
                <tr>
                    <?php foreach ($week as $day) : ?>
                        <td class="<?= $day === null ? 'empty' : '' ?>">
                            <?= $day ? date('d', strtotime($day)) : '' ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="/register">新規登録する</a>
</body>
</html>