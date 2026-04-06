<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - <?= e((string) config('app.name')) ?></title>
    <link rel="stylesheet" href="/public/assets/css/app.css">
</head>
<body>
<header class="site-header admin-header">
    <div class="wrap">
        <h1>Admin Panel</h1>
        <nav class="admin-nav">
            <a href="/admin">Dashboard</a>
            <a href="/admin/projects">Projects</a>
            <a href="/admin/profile">Profile</a>
            <a href="/">Public Site</a>
            <form method="post" action="/admin/logout" class="logout-form">
                <input type="hidden" name="_csrf" value="<?= e(\App\Core\Csrf::token()) ?>">
                <button type="submit">Logout</button>
            </form>
        </nav>
    </div>
</header>
<main class="wrap">
    <?= $content ?>
</main>
</body>
</html>
