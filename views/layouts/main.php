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
        <h1><a class="brand-link" href="/"><?= e((string) config('app.name')) ?></a></h1>
        <nav class="public-nav">
            <a href="/" class="<?= ($activePage ?? '') === 'home' ? 'active' : '' ?>">Home</a>
            <a href="/about" class="<?= ($activePage ?? '') === 'about' ? 'active' : '' ?>">About</a>
            <a href="/projects" class="<?= ($activePage ?? '') === 'projects' ? 'active' : '' ?>">Projects</a>
            <a href="/contact" class="<?= ($activePage ?? '') === 'contact' ? 'active' : '' ?>">Contact</a>
            <a class="admin-link" href="/admin/login">Admin Login</a>
        </nav>
    </div>
</header>
<main class="wrap">
    <?= $content ?>
</main>
</body>
</html>
