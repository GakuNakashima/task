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
    <form action="/register/create" method="post">
        <input type="hidden" name="<?php echo \Config::get('security.csrf_token_key'); ?>" value="<?php echo Security::fetch_token(); ?>">
        <table>
            <tr>
                <th>
                    日付
                </th>
                <td>
                    <input type="date" name="date">
                </td>
            </tr>
            <tr>
                <th>
                    カテゴリー
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
                    値段
                </th>
                <td>
                    <input type="text" name="amount">
                </td>
            </tr>
            <tr>
                <th>
                    メモ
                </th>
                <td>
                    <input type="text" name="description">
                </td>
            </tr>
        </table>
        <input type="submit" value="登録する">
    </form>      
</body>
</html>