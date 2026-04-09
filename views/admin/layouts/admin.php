<?php
$currentUri = $_SERVER['REQUEST_URI'] ?? '/';

function isActive($path, $currentUri) {
    if ($path === '/admin') {
        return ($currentUri === '/admin' || $currentUri === '/admin/') ? 'active' : '';
    }
    return str_contains($currentUri, $path) ? 'active' : '';
}
?>
<!doctype html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - <?= e((string) config('app.name')) ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= url('/public/css/admin/layout.css') ?>">
    <link rel="stylesheet" href="<?= url('/public/css/admin/ui.css') ?>">
    <?php
    $pageCssMap = [
        '/admin/messages'  => 'messages',
        '/admin/profile'   => 'profile',
        '/admin/members'   => 'members',
        '/admin/projects'  => 'projects',
        '/admin/gallery'   => 'gallery',
        '/admin/home'      => 'home_editor',
        '/admin/about'     => 'home_editor',
        '/admin/dashboard' => 'dashboard',
        '/admin/auth'      => 'forms',
    ];
    $pageCss = null;
    foreach ($pageCssMap as $uriPrefix => $cssFile) {
        if (str_starts_with($currentUri, $uriPrefix)) {
            $pageCss = $cssFile;
            break;
        }
    }
    // If no specific prefix matched and we are just at /admin, load dashboard css
    if (!$pageCss && ($currentUri === '/admin' || $currentUri === '/admin/')) {
        $pageCss = 'dashboard';
    }

    if ($pageCss):
    ?>
        <link rel="stylesheet" href="<?= url('/public/css/admin/' . $pageCss . '.css') ?>">
    <?php endif; ?>

    <!-- Apply saved theme before paint to avoid flash -->
    <script>
        (function() {
            const saved = localStorage.getItem('admin-theme') || 'dark';
            document.documentElement.setAttribute('data-theme', saved);
        })();
    </script>
</head>
<body class="admin-body">

<div id="admin-sidebar-backdrop" class="admin-sidebar-backdrop"></div>

<div class="admin-shell">

    <!-- ═══ SIDEBAR ═══ -->
    <aside id="admin-sidebar" class="sidebar">
        <!-- Floating expand/collapse pill — visible in BOTH states -->
        <button id="sb-toggle-pill" class="sb-toggle-pill" title="Toggle sidebar" aria-label="Toggle sidebar">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
        </button>
        <div class="sidebar-inner">

            <!-- Brand -->
            <div class="sb-top">
                <div class="sb-logo">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
                </div>
                <span class="sb-brand-name">KUWS Control</span>
            </div>

            <!-- Navigation -->
            <nav class="sb-nav">

                <!-- OVERVIEW -->
                <div class="sb-group">
                    <span class="sb-group-label">Overview</span>
                    <a href="<?= url('/admin') ?>" class="sb-item <?= isActive('/admin', $currentUri) ?>" data-tooltip="Dashboard">
                        <span class="sb-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                        </span>
                        <span class="sb-label">Dashboard</span>
                    </a>
                </div>

                <!-- CONTENT -->
                <div class="sb-group">
                    <span class="sb-group-label">Content</span>
                    <a href="<?= url('/admin/home') ?>" class="sb-item <?= isActive('/admin/home', $currentUri) ?>" data-tooltip="Home Editor">
                        <span class="sb-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                        </span>
                        <span class="sb-label">Home Editor</span>
                    </a>
                    <a href="<?= url('/admin/about') ?>" class="sb-item <?= isActive('/admin/about', $currentUri) ?>" data-tooltip="About Editor">
                        <span class="sb-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                        </span>
                        <span class="sb-label">About Editor</span>
                    </a>
                </div>

                <!-- MANAGEMENT -->
                <div class="sb-group">
                    <span class="sb-group-label">Management</span>
                    <a href="<?= url('/admin/projects') ?>" class="sb-item <?= isActive('/admin/projects', $currentUri) ?>" data-tooltip="Projects">
                        <span class="sb-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
                        </span>
                        <span class="sb-label">Projects</span>
                    </a>
                    <a href="<?= url('/admin/gallery') ?>" class="sb-item <?= isActive('/admin/gallery', $currentUri) ?>" data-tooltip="Gallery">
                        <span class="sb-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-5-5L5 21"/></svg>
                        </span>
                        <span class="sb-label">Gallery</span>
                    </a>
                    <a href="<?= url('/admin/members') ?>" class="sb-item <?= isActive('/admin/members', $currentUri) ?>" data-tooltip="Members">
                        <span class="sb-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </span>
                        <span class="sb-label">Members</span>
                    </a>
                </div>

                <!-- ACCOUNT -->
                <div class="sb-group">
                    <span class="sb-group-label">Account</span>
                    <a href="<?= url('/admin/profile') ?>" class="sb-item <?= isActive('/admin/profile', $currentUri) ?>" data-tooltip="Profile">
                        <span class="sb-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        </span>
                        <span class="sb-label">Profile</span>
                    </a>
                    <?php $unreadCount = (new \App\Models\ContactMessageModel())->unreadCount(); ?>
                    <a href="<?= url('/admin/messages') ?>" class="sb-item <?= isActive('/admin/messages', $currentUri) ?>" data-tooltip="Messages">
                        <span class="sb-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                            <?= $unreadCount > 0 ? '<span class="sb-badge">' . (int) $unreadCount . '</span>' : '' ?>
                        </span>
                        <span class="sb-label">Messages</span>
                        <?= $unreadCount > 0 ? '<span class="sb-label-badge">' . (int) $unreadCount . '</span>' : '' ?>
                    </a>
                </div>

            </nav>

            <!-- Bottom Actions -->
            <div class="sb-bottom">
                <!-- Theme Toggle -->
                <button id="theme-toggle-btn" class="sb-bottom-item sb-theme-btn" title="Toggle light/dark mode" data-tooltip="Toggle Theme">
                    <span class="sb-icon theme-icon-dark">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
                    </span>
                    <span class="sb-icon theme-icon-light" style="display:none">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
                    </span>
                    <span class="sb-label">Light Mode</span>
                </button>

                <a href="<?= url('/') ?>" class="sb-bottom-item" data-tooltip="Live Site">
                    <span class="sb-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                    </span>
                    <span class="sb-label">Live Site</span>
                </a>

                <form method="post" action="<?= url('/admin/logout') ?>">
                    <input type="hidden" name="_csrf" value="<?= e(\App\Core\Csrf::token()) ?>">
                    <button type="submit" class="sb-bottom-item sb-logout-item" data-tooltip="Sign Out">
                        <span class="sb-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path><line x1="12" y1="2" x2="12" y2="12"></line></svg>
                        </span>
                        <span class="sb-label">Sign Out</span>
                    </button>
                </form>
            </div>

        </div>
    </aside>

    <!-- ═══ MAIN CONTENT ═══ -->
    <div class="admin-main">
        <!-- Mobile topbar -->
        <header class="admin-topbar">
            <button id="admin-sidebar-toggle" class="topbar-menu-btn" aria-label="Open sidebar">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
            </button>
            <span class="topbar-brand">KUWS Admin</span>
            <button id="topbar-theme-btn" class="topbar-theme-btn" title="Toggle theme">
                <svg class="theme-icon-dark" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
                <svg class="theme-icon-light" style="display:none" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
            </button>
        </header>
        <main class="admin-content wrap">
            <?= $content ?>
        </main>
    </div>
</div>

<script>
// ── Theme Toggle ──────────────────────────────────────────────
const html = document.documentElement;
const THEME_KEY = 'admin-theme';

function applyTheme(theme) {
    html.setAttribute('data-theme', theme);
    localStorage.setItem(THEME_KEY, theme);
    const isDark = theme === 'dark';
    // Sidebar toggle icons
    document.querySelectorAll('.theme-icon-dark').forEach(el => el.style.display = isDark ? '' : 'none');
    document.querySelectorAll('.theme-icon-light').forEach(el => el.style.display = isDark ? 'none' : '');
    // Sidebar label
    const lbl = document.querySelector('#theme-toggle-btn .sb-label');
    if (lbl) lbl.textContent = isDark ? 'Light Mode' : 'Dark Mode';
}

function toggleTheme() {
    const current = html.getAttribute('data-theme') || 'dark';
    applyTheme(current === 'dark' ? 'light' : 'dark');
}

// Init icons on load
applyTheme(html.getAttribute('data-theme') || 'dark');

document.getElementById('theme-toggle-btn')?.addEventListener('click', toggleTheme);
document.getElementById('topbar-theme-btn')?.addEventListener('click', toggleTheme);

// ── Sidebar Collapse (desktop) ────────────────────────────────
const sidebar = document.getElementById('admin-sidebar');
const pillBtn  = document.getElementById('sb-toggle-pill');
const COLLAPSE_KEY = 'admin-sidebar-collapsed';

function applySidebarState(collapsed) {
    document.body.classList.toggle('sidebar-collapsed', collapsed);
    if (collapsed) {
        localStorage.setItem(COLLAPSE_KEY, '1');
    } else {
        localStorage.removeItem(COLLAPSE_KEY);
    }
}

// Restore saved state on load
if (localStorage.getItem(COLLAPSE_KEY)) {
    applySidebarState(true);
}

pillBtn?.addEventListener('click', () => {
    const collapsed = !document.body.classList.contains('sidebar-collapsed');
    applySidebarState(collapsed);
});

// ── Mobile Sidebar ────────────────────────────────────────────
const mobileToggle = document.getElementById('admin-sidebar-toggle');
const backdrop = document.getElementById('admin-sidebar-backdrop');

function openMobileSidebar() {
    document.body.classList.add('admin-sidebar-open');
}
function closeMobileSidebar() {
    document.body.classList.remove('admin-sidebar-open');
}

mobileToggle?.addEventListener('click', openMobileSidebar);
backdrop?.addEventListener('click', closeMobileSidebar);

sidebar?.querySelectorAll('a').forEach(a => {
    a.addEventListener('click', () => {
        if (window.matchMedia('(max-width: 1024px)').matches) closeMobileSidebar();
    });
});
</script>

</body>
</html>
