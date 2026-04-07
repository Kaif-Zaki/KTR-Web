<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - <?= e((string) config('app.name')) ?></title>
    <link rel="stylesheet" href="<?= url('/public/css/app.css') ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
</head>
<body class="admin-body">

<div class="admin-shell">

    <!-- Collapsible Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-inner">

            <!-- Brand -->
            <div class="sb-brand">
                <div class="sb-logo">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
                </div>
                <span class="sb-brand-name">KUWS Admin</span>
            </div>

            <!-- Main Nav -->
            <div class="sb-section-label">Main</div>
            <nav class="sb-nav">

                <a href="<?= url('/admin') ?>" class="sb-item">
                    <span class="sb-icon">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                    </span>
                    <span class="sb-label">Dashboard</span>
                </a>

                <a href="<?= url('/admin/projects') ?>" class="sb-item">
                    <span class="sb-icon">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 7a2 2 0 0 1 2-2h4l2 3H4a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-6l-2-3H4"/></svg>
                    </span>
                    <span class="sb-label">Projects</span>
                </a>

                <a href="<?= url('/admin/gallery') ?>" class="sb-item">
                    <span class="sb-icon">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-5-5L5 21"/></svg>
                    </span>
                    <span class="sb-label">Gallery</span>
                </a>

                <?php $unreadCount = (new \App\Models\ContactMessageModel())->unreadCount(); ?>
                <a href="<?= url('/admin/messages') ?>" class="sb-item">
                    <span class="sb-icon">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        <?= $unreadCount > 0 ? '<span class="sb-badge">' . (int) $unreadCount . '</span>' : '' ?>
                    </span>
                    <span class="sb-label">Messages<?= $unreadCount > 0 ? ' <em class="sb-count">(' . (int) $unreadCount . ')</em>' : '' ?></span>
                </a>

                <a href="<?= url('/admin/profile') ?>" class="sb-item">
                    <span class="sb-icon">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </span>
                    <span class="sb-label">Profile</span>
                </a>

            </nav>

            <!-- Bottom actions -->
            <div class="sb-bottom">
                <a href="<?= url('/') ?>" class="sb-item sb-item--muted">
                    <span class="sb-icon">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    </span>
                    <span class="sb-label">Public Site</span>
                </a>

                <form method="post" action="<?= url('/admin/logout') ?>" class="sb-logout-form">
                    <input type="hidden" name="_csrf" value="<?= e(\App\Core\Csrf::token()) ?>">
                    <button type="submit" class="sb-item sb-item--danger">
                        <span class="sb-icon">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                        </span>
                        <span class="sb-label">Logout</span>
                    </button>
                </form>
            </div>

        </div>
    </aside>

    <!-- Main area -->
    <div class="admin-main">
        <main class="admin-content wrap">
            <?= $content ?>
        </main>
    </div>

</div>

</body>
</html>