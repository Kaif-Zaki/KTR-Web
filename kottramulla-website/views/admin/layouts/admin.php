<?php
$currentUri = $_SERVER['REQUEST_URI'] ?? '/';

/**
 * Checks if the current URI matches or contains the given path.
 * Updated to use str_contains so "Messages" stays active on /admin/messages?id=...
 */
function isActive($path, $currentUri) {
    if ($path === '/admin') {
        return ($currentUri === '/admin' || $currentUri === '/admin/') ? 'active' : '';
    }
    return str_contains($currentUri, $path) ? 'active' : '';
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - <?= e((string) config('app.name')) ?></title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= url('/public/css/app.css') ?>">
</head>
<body class="admin-body">

<div class="admin-shell">
    <aside class="sidebar">
        <div class="sidebar-inner">
            
            <div class="sb-top">
                <div class="sb-avatar">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
                </div>
                <span class="sb-brand-name">KUWS Control</span>
            </div>

            <nav class="sb-nav">
                <a href="<?= url('/admin') ?>" class="sb-item <?= isActive('/admin', $currentUri) ?>">
                    <span class="sb-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                    </span>
                    <span class="sb-label">Dashboard</span>
                </a>

                <a href="<?= url('/admin/projects') ?>" class="sb-item <?= isActive('/admin/projects', $currentUri) ?>">
                    <span class="sb-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
                    </span>
                    <span class="sb-label">Projects</span>
                </a>

                <a href="<?= url('/admin/gallery') ?>" class="sb-item <?= isActive('/admin/gallery', $currentUri) ?>">
                    <span class="sb-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-5-5L5 21"/></svg>
                    </span>
                    <span class="sb-label">Gallery</span>
                </a>

                <a href="<?= url('/admin/profile') ?>" class="sb-item <?= isActive('/admin/profile', $currentUri) ?>">
                    <span class="sb-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </span>
                    <span class="sb-label">Profile</span>
                </a>

                <?php $unreadCount = (new \App\Models\ContactMessageModel())->unreadCount(); ?>
                <a href="<?= url('/admin/messages') ?>" class="sb-item <?= isActive('/admin/messages', $currentUri) ?>">
                    <span class="sb-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        <?= $unreadCount > 0 ? '<span class="sb-badge">' . (int) $unreadCount . '</span>' : '' ?>
                    </span>
                    <span class="sb-label">Messages</span>
                </a>
            </nav>

            <div class="sb-bottom">
                <a href="<?= url('/') ?>" class="sb-visit-btn">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                    <span class="sb-visit-label">Live Site</span>
                </a>

                <form method="post" action="<?= url('/admin/logout') ?>" style="margin-top:4px">
                    <input type="hidden" name="_csrf" value="<?= e(\App\Core\Csrf::token()) ?>">
                    <button type="submit" class="sb-item sb-logout-btn">
                        <span class="sb-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 3H6a2 2 0 0 0-2 2v14c0 1.1.9 2 2 2h4M16 17l5-5-5-5M13.8 12H21"/></svg>
                        </span>
                        <span class="sb-label">Exit System</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <div class="admin-main">
        <main class="admin-content wrap">
            <?= $content ?>
        </main>
    </div>
</div>

</body>
</html>