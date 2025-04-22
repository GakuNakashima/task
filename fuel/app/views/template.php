<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <?= \Asset::css('common.css'); ?>
</head>
<body>
    <header>
        <h1><?php echo $site_name; ?></h1>
    </header>

    <div class="container">
        <main>
            <?php echo $content; ?>
        </main>
    </div>
</body>
</html>