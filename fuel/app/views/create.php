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
    <form action="/auth/create" method="post">
        <table>
            <tr>
                <th>
                    名前
                </th>
                <td>
                    <input type="text" name="username">
                </td>
            </tr>
            <tr>
                <th>
                    パスワード
                </th>
                <td>
                    <input type="text" name="password">
                </td>
            </tr>
            <tr>
                <th>
                    メールアドレス
                </th>
                <td>
                    <input type="text" name="email">
                </td>
            </tr>
        </table>
        <input type="submit" value="登録する">
    </form>      
</body>
</html>