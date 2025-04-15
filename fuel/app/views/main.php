<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php echo $date; ?>


    <p>

        <?php
            $previous_day_url = \Uri::create('main/previous/' . $date);
        ?>
        <a href="<?php echo $previous_day_url; ?>">前の日を表示</a>

        <?php
            $following_day_url = \Uri::create('main/following/' . $date);
        ?>
        <a href="<?php echo $following_day_url; ?>">次の日を表示</a>
    </p>


    <form method="GET" action="/main/calendar">
        <label>日付を選択:</label>
        <input type="date" name="selected_date" value="<?php echo $date; ?>">
        <button type="submit">この日付を表示</button>
    </form>

    <a href="/register">登録する</a>

    <?php foreach ($transactions as $transaction) : ?>
        <p><?php echo $transaction['category']; ?>: <?php echo $transaction['amount']; ?></p>
        <p><?php echo $transaction['description']; ?></p>
    <?php endforeach; ?>

</body>
</html>