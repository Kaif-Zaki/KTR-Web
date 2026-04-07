<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e((string) config('app.name')) ?></title>
    <link rel="stylesheet" href="<?= url('/public/css/app.css') ?>" >
</head>
<body>
<header class="site-header">
    <div class="wrap">
        <h1><a class="brand-link" href="<?= url('/') ?>" ><?= e((string) config('app.name')) ?></a></h1>
        <nav class="public-nav">
            <a href="<?= url('/') ?>"  class="<?= ($activePage ?? '') === 'home' ? 'active' : '' ?>">Home</a>
            <a href="<?= url('/about') ?>"  class="<?= ($activePage ?? '') === 'about' ? 'active' : '' ?>">About</a>
            <a href="<?= url('/projects') ?>"  class="<?= ($activePage ?? '') === 'projects' ? 'active' : '' ?>">Projects</a>
            <a href="<?= url('/gallery') ?>"  class="<?= ($activePage ?? '') === 'gallery' ? 'active' : '' ?>">Gallery</a>
            <a href="<?= url('/donate') ?>"  class="<?= ($activePage ?? '') === 'donate' ? 'active' : '' ?>">Donate</a>
            <a href="<?= url('/contact') ?>"  class="<?= ($activePage ?? '') === 'contact' ? 'active' : '' ?>">Contact</a>
            <a class="admin-link" href="<?= url('/admin/login') ?>" >Admin Login</a>
        </nav>
    </div>
</header>
<main class="wrap">
    <?= $content ?>
</main>
</body>
</html>
