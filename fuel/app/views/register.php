<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>submit</title>
    <?= \Asset::css('form.css'); ?>
</head>
<body>
    <form action="/register/register" method="post">
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
                            <option value="food">食費</option>
                            <option value="life">日用品</option>
                            <option value="transfer">交通費</option>
                            <option value="hobby">趣味</option>
                            <option value="other">その他</option>
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