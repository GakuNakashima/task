<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <?= \Asset::css('form.css'); ?>
</head>
<body>
    <?php $error_msg = \Session::get_flash('error_msg'); ?>
    <?php if ($error_msg): ?>
        <p><?php echo $error_msg; ?></p>
    <?php endif; ?>
    
    <form action="/auth/login" method="post">
        <input type="hidden" name="<?php echo \Config::get('security.csrf_token_key'); ?>" value="<?php echo Security::fetch_token(); ?>">
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
        </table>
        <input type="submit" value="ログインする">
        <a href="/auth/createuser">新規登録する</a>
    </form>  
    
</body>
</html>