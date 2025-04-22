<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>submit</title>
    <?= \Asset::css('form.css'); ?>
</head>
<body>
    <?php $error_msg = \Session::get_flash('error_msg'); ?>
    <?php if ($error_msg): ?>
        <p><?php echo $error_msg; ?></p>
    <?php endif; ?>
    <form action="/register/update" method="post">
        <table>
            <tr>
                <th>
                    カテゴリー：
                </th>
                <td>
                    <select name="category" id="">
                            <option value="food">food</option>
                            <option value="life">life</option>
                            <option value="transfer">transfer</option>
                            <option value="hobby">hobby</option>
                            <option value="other">other</option>
                        </select>
                </td>
            </tr>   
            <tr>
                <th>
                    値段：
                </th>
                <td>
                    <input type="text" name="amount" value="<?php echo $transactions[0]['amount']; ?>">
                </td>
            </tr>
            <tr>
                <th>
                    メモ：
                </th>
                <td>
                    <input type="text" name="description" value="<?php echo $transactions[0]['description']; ?>">
                </td>
            </tr>
        </table>
        <input type="hidden" name="id" value="<?php echo $transactions[0]['id']; ?>">
        <input type="hidden" name="date" value="<?php echo $transactions[0]['date']; ?>">
        <input type="submit" value="編集する">
    </form>      
</body>
</html>