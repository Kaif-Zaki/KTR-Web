<div class="dash-welcome">
    <div class="dash-welcome-text">
        <p class="dash-eyebrow">Good to see you back</p>
        <h1 class="dash-heading">Hello, <?= e((string) $admin['name']) ?> 👋</h1>
        <p class="dash-sub">Manage your project records, gallery, and messages from here.</p>
    </div>
    <div class="dash-welcome-gfx" aria-hidden="true">
        <svg width="96" height="96" viewBox="0 0 96 96" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect width="96" height="96" rx="24" fill="url(#dg)"/>
            <path d="M28 68V44a4 4 0 0 1 4-4h8v28H28Z" fill="white" fill-opacity=".25"/>
            <path d="M44 68V36a4 4 0 0 1 4-4h8v36H44Z" fill="white" fill-opacity=".4"/>
            <path d="M60 68V52a4 4 0 0 1 4-4h8v20H60Z" fill="white" fill-opacity=".6"/>
            <defs>
                <linearGradient id="dg" x1="0" y1="0" x2="96" y2="96" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#0f766e"/>
                    <stop offset="1" stop-color="#0b5ea8"/>
                </linearGradient>
            </defs>
        </svg>
    </div>
</div>

<div class="dash-stats">

    <div class="dash-stat-card">
        <div class="dash-stat-icon dash-stat-icon--teal">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M2 7a2 2 0 0 1 2-2h4l2 3H4a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-6l-2-3H4"/>
            </svg>
        </div>
        <div class="dash-stat-value"><?= (int) $projectCount ?></div>
        <div class="dash-stat-label">Total Projects</div>
        <div class="dash-stat-bar" style="--fill: 100%"></div>
    </div>

    <div class="dash-stat-card">
        <div class="dash-stat-icon dash-stat-icon--blue">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 20h16"/><path d="M4 4h6l2 4H4V4Z"/><path d="M14 4h6v16h-6V4Z"/><path d="M4 12h8v8H4v-8Z"/>
            </svg>
        </div>
        <div class="dash-stat-value"><?= count($categories) ?></div>
        <div class="dash-stat-label">Categories</div>
        <div class="dash-stat-bar" style="--fill: 70%"></div>
    </div>

    <div class="dash-stat-card <?= ((int) $unreadMessages > 0) ? 'dash-stat-card--alert' : '' ?>">
        <div class="dash-stat-icon dash-stat-icon--indigo">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
            </svg>
        </div>
        <div class="dash-stat-value"><?= (int) $unreadMessages ?></div>
        <div class="dash-stat-label">Unread Messages</div>
        <?php if ((int) $unreadMessages > 0): ?>
            <a href="/admin/messages" class="dash-stat-action">View all →</a>
        <?php else: ?>
            <div class="dash-stat-bar" style="--fill: 0%"></div>
        <?php endif; ?>
    </div>

</div>