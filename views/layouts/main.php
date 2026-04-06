<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e((string) config('app.name')) ?></title>
    <link rel="stylesheet" href="/public/assets/css/app.css">
</head>
<body>
<header class="site-header">
    <div class="wrap">
        <h1><?= e((string) config('app.name')) ?></h1>
        <a class="admin-link" href="/admin/login">Admin Login</a>
    </div>
</header>
<main class="wrap">
    <?= $content ?>
</main>
</body>
</html>
