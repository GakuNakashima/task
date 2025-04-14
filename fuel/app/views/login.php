<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <?= \Asset::css('form.css'); ?>
</head>
<body>
    <form action="/auth/login" method="post">
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
        <a href="/auth/create">新規登録する</a>
    </form>  
    
</body>
</html>