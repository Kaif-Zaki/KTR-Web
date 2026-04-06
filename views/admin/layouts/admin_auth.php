<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e((string) ($pageTitle ?? 'Admin Access')) ?> - <?= e((string) config('app.name')) ?></title>
    <link rel="stylesheet" href="/public/css/app.css">
</head>
<body class="auth-body">
<main class="auth-wrap">
    <?= $content ?>
</main>
</body>
</html>
