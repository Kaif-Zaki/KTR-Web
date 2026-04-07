<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?= url('/public/css/app.css') ?>">
</head>
<body class="admin-body">

<div class="dash-welcome">
    <div class="dash-welcome-text">
        <p class="dash-eyebrow">Good to see you back</p>
        <h1 class="dash-heading">Hello, <?= e((string) $admin['name']) ?> 👋</h1>
        <p class="dash-sub">Monitor your community impact and manage society records from your secure dashboard.</p>
    </div>
    <div class="dash-welcome-gfx" aria-hidden="true">
        <svg width="96" height="96" viewBox="0 0 96 96" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect width="96" height="96" rx="28" fill="url(#dg)"/>
            <path d="M32 64V44a4 4 0 0 1 4-4h8v24H32Z" fill="white" fill-opacity=".2"/>
            <path d="M48 64V36a4 4 0 0 1 4-4h8v28H48Z" fill="white" fill-opacity=".4"/>
            <path d="M64 64V52a4 4 0 0 1 4-4h8v16H64Z" fill="white" fill-opacity=".7"/>
            <defs>
                <linearGradient id="dg" x1="0" y1="0" x2="96" y2="96" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#10b981"/>
                    <stop offset="1" stop-color="#059669"/>
                </linearGradient>
            </defs>
        </svg>
    </div>
</div>

<div class="dash-stats">

    <div class="dash-stat-card">
        <div class="dash-stat-icon dash-stat-icon--teal">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
            </svg>
        </div>
        <div class="dash-stat-value"><?= (int) $projectCount ?></div>
        <div class="dash-stat-label">Total Projects</div>
        <div class="dash-stat-bar" style="--fill: 100%"></div>
    </div>

    <div class="dash-stat-card">
        <div class="dash-stat-icon dash-stat-icon--blue">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="7" height="7"></rect>
                <rect x="14" y="3" width="7" height="7"></rect>
                <rect x="14" y="14" width="7" height="7"></rect>
                <rect x="3" y="14" width="7" height="7"></rect>
            </svg>
        </div>
        <div class="dash-stat-value"><?= count($categories) ?></div>
        <div class="dash-stat-label">Categories</div>
        <div class="dash-stat-bar" style="--fill: 70%"></div>
    </div>

    <div class="dash-stat-card <?= ((int) $unreadMessages > 0) ? 'dash-stat-card--alert' : '' ?>">
        <div class="dash-stat-icon dash-stat-icon--indigo">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
            </svg>
        </div>
        <div class="dash-stat-value"><?= (int) $unreadMessages ?></div>
        <div class="dash-stat-label">Unread Messages</div>
        <?php if ((int) $unreadMessages > 0): ?>
            <a href="/admin/messages" class="dash-stat-action">Action Required →</a>
        <?php else: ?>
            <div class="dash-stat-bar" style="--fill: 0%"></div>
        <?php endif; ?>
    </div>

</div>

</body>
</html>