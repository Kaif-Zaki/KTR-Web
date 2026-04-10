<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Dynamic Title & Meta Tags -->
    <?php $webSettings = website_settings(); ?>
    <title><?= e($webSettings['website_title'] ?? 'KUWS | Kottramulla United Welfare Society'); ?></title>
    <meta name="description" content="<?= e($webSettings['website_description'] ?? 'Kottramulla United Welfare Society (KUWS) - A dedicated volunteer team committed to serving our community since 2016.'); ?>">
    
    <!-- Fonts: Inter & Outfit for a premium feel -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="<?= url('/public/css/user/main.css') ?>">
    
    <!-- Favicon -->
    <?php if (!empty($webSettings['favicon_path'])): ?>
        <link rel="icon" href="<?= url('/public/' . $webSettings['favicon_path']); ?>" type="image/png">
    <?php endif; ?>
    
    <!-- Theme Colors -->
    <style>
        :root {
            --primary-color: <?= htmlspecialchars($webSettings['primary_color'] ?? '#1e40af'); ?>;
            --secondary-color: <?= htmlspecialchars($webSettings['secondary_color'] ?? '#7c3aed'); ?>;
            --accent-color: <?= htmlspecialchars($webSettings['accent_color'] ?? '#f59e0b'); ?>;
        }
    </style>
    
    <script>
        // High-speed theme initialization to prevent flash
        (function() {
            const savedTheme = localStorage.getItem('user-theme') || 'light';
            document.documentElement.setAttribute('data-theme', savedTheme);
        })();
    </script>
</head>
<body class="public-body">

    <!-- Background Decoration -->
    <div class="glow-orb orb-1"></div>
    <div class="glow-orb orb-2"></div>
    <div class="glass-dots"></div>

    <!-- ═══════════════════════════════════════════════
         NAVBAR — Modern Glassmorphism Pill
    ════════════════════════════════════════════════ -->
    <header id="main-nav-wrapper">
        <div class="nav-container">
            <div class="nav-glass-pill rotate-in">
                
                <!-- Logo Zone -->
                <a href="<?= url('/home') ?>" class="nav-logo">
                    <?php if (!empty($webSettings['logo_path'])): ?>
                        <div class="logo-image">
                            <img src="<?= url('/public/' . htmlspecialchars($webSettings['logo_path'])); ?>" alt="<?= htmlspecialchars($webSettings['logo_alt_text'] ?? 'Logo'); ?>" style="height: 100%; max-width: 100%; object-fit: contain;">
                        </div>
                    <?php else: ?>
                        <div class="logo-icon">K</div>
                    <?php endif; ?>
                    <span class="logo-text"><?= htmlspecialchars(substr($webSettings['website_title'] ?? 'KUWS', 0, 4)); ?></span>
                </a>

                <!-- Desktop Navigation Links -->
                <nav class="desktop-links">
                    <a href="<?= url('/home') ?>" class="nav-link <?= ($activePage ?? '') === 'home' ? 'active' : '' ?>">Home</a>
                    <a href="<?= url('/about') ?>" class="nav-link <?= ($activePage ?? '') === 'about' ? 'active' : '' ?>">About</a>
                    <a href="<?= url('/projects') ?>" class="nav-link <?= ($activePage ?? '') === 'projects' ? 'active' : '' ?>">Projects</a>
                    <a href="<?= url('/gallery') ?>" class="nav-link <?= ($activePage ?? '') === 'gallery' ? 'active' : '' ?>">Gallery</a>
                    <a href="<?= url('/members') ?>" class="nav-link <?= ($activePage ?? '') === 'members' ? 'active' : '' ?>">Members</a>
                </nav>

                <!-- Actions: Theme Toggle & Contact -->
                <div class="nav-actions">
                    <button id="theme-toggle" class="icon-btn" aria-label="Toggle Theme">
                        <svg class="sun-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
                        <svg class="moon-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:none"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
                    </button>
                    <a href="<?= url('/contact') ?>" class="btn-cta-nav">Let's Connect</a>
                    
                    <!-- Mobile Hamburger -->
                    <button id="mobile-menu-toggle" class="hamburger-btn" aria-label="Menu">
                        <span></span><span></span><span></span>
                    </button>
                </div>

            </div>
        </div>

        <!-- Mobile Side Menu Overlay -->
        <div id="mobile-overlay" class="mobile-nav-overlay">
            <div class="mobile-menu-card">
                <nav class="mobile-links">
                    <a href="<?= url('/home') ?>">Home</a>
                    <a href="<?= url('/about') ?>">About Us</a>
                    <a href="<?= url('/projects') ?>">Our Projects</a>
                    <a href="<?= url('/gallery') ?>">Visual Gallery</a>
                    <a href="<?= url('/members') ?>">Our Members</a>
                    <a href="<?= url('/contact') ?>" class="mobile-cta">Start Conversation</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- ═══════════════════════════════════════════════
         MAIN CONTENT AREA
    ════════════════════════════════════════════════ -->
    <main class="page-content">
        <?= $content ?>
    </main>

    <!-- ═══════════════════════════════════════════════
         AESTHETIC FOOTER
    ════════════════════════════════════════════════ -->
    <footer class="main-footer">
        <div class="footer-container">
            <div class="footer-top">
                <div class="footer-info">
                    <a href="<?= url('/home') ?>" class="footer-logo">
                        <?php if (!empty($webSettings['logo_path'])): ?>
                            <img src="<?= url('/public/' . htmlspecialchars($webSettings['logo_path'])); ?>" alt="<?= htmlspecialchars($webSettings['logo_alt_text'] ?? 'Logo'); ?>" style="height: 40px; max-width: 100px; object-fit: contain;">
                        <?php else: ?>
                            <?= htmlspecialchars(substr($webSettings['website_title'] ?? 'KUWS', 0, 4)); ?>
                        <?php endif; ?>
                    </a>
                    <p class="footer-tagline"><?= htmlspecialchars($webSettings['website_description'] ?? 'Since 2016, we have been dedicated to uniting hearts and empowering the community through collective welfare and unwavering hope.'); ?></p>
                </div>
                <div class="footer-nav">
                    <div class="footer-col">
                        <h4>Society</h4>
                        <a href="<?= url('/about') ?>">Our Story</a>
                        <a href="<?= url('/members') ?>">Organization</a>
                        <a href="<?= url('/projects') ?>">Initiatives</a>
                    </div>
                    <div class="footer-col">
                        <h4>Community</h4>
                        <a href="<?= url('/gallery') ?>">Gallery</a>
                        <a href="<?= url('/contact') ?>">Get Involved</a>
                        <a href="<?= url('/admin/login') ?>" class="dim-link">Administration</a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="footer-left">
                    <p><?= htmlspecialchars($webSettings['footer_copyright_text'] ?? '© ' . date('Y') . ' Kottramulla United Welfare Society. All Rights Reserved.'); ?></p>
                    <?php if (!empty($webSettings['footer_email']) || !empty($webSettings['footer_phone'])): ?>
                        <div class="footer-contact">
                            <?php if (!empty($webSettings['footer_email'])): ?>
                                <a href="mailto:<?= htmlspecialchars($webSettings['footer_email']); ?>"><?= htmlspecialchars($webSettings['footer_email']); ?></a>
                            <?php endif; ?>
                            <?php if (!empty($webSettings['footer_phone'])): ?>
                                <a href="tel:<?= htmlspecialchars($webSettings['footer_phone']); ?>"><?= htmlspecialchars($webSettings['footer_phone']); ?></a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="footer-socials">
                    <?php if (!empty($webSettings['social_facebook'])): ?>
                        <a href="<?= htmlspecialchars($webSettings['social_facebook']); ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook" title="Facebook">f</a>
                    <?php endif; ?>
                    <?php if (!empty($webSettings['social_twitter'])): ?>
                        <a href="<?= htmlspecialchars($webSettings['social_twitter']); ?>" target="_blank" rel="noopener noreferrer" aria-label="Twitter" title="Twitter">𝕏</a>
                    <?php endif; ?>
                    <?php if (!empty($webSettings['social_instagram'])): ?>
                        <a href="<?= htmlspecialchars($webSettings['social_instagram']); ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram" title="Instagram">📷</a>
                    <?php endif; ?>
                    <?php if (!empty($webSettings['social_linkedin'])): ?>
                        <a href="<?= htmlspecialchars($webSettings['social_linkedin']); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn" title="LinkedIn">in</a>
                    <?php endif; ?>
                    <?php if (!empty($webSettings['social_youtube'])): ?>
                        <a href="<?= htmlspecialchars($webSettings['social_youtube']); ?>" target="_blank" rel="noopener noreferrer" aria-label="YouTube" title="YouTube">▶</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Interactive Logic for UI
        (function() {
            const html = document.documentElement;
            const themeBtn = document.getElementById('theme-toggle');
            const sunIcon = themeBtn.querySelector('.sun-icon');
            const moonIcon = themeBtn.querySelector('.moon-icon');
            const navWrapper = id('main-nav-wrapper');
            const menuBtn = id('mobile-menu-toggle');
            const overlay = id('mobile-overlay');

            function id(name) { return document.getElementById(name); }

            // Theme Management
            function updateIcons(theme) {
                if (theme === 'dark') {
                    sunIcon.style.display = 'none';
                    moonIcon.style.display = 'block';
                } else {
                    sunIcon.style.display = 'block';
                    moonIcon.style.display = 'none';
                }
            }

            const currentTheme = html.getAttribute('data-theme');
            updateIcons(currentTheme);

            themeBtn.addEventListener('click', () => {
                const newTheme = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
                html.setAttribute('data-theme', newTheme);
                localStorage.setItem('user-theme', newTheme);
                updateIcons(newTheme);
            });

            // Mobile Menu Toggle
            menuBtn.addEventListener('click', () => {
                const isOpen = overlay.classList.toggle('active');
                menuBtn.classList.toggle('active');
                document.body.style.overflow = isOpen ? 'hidden' : '';
            });

            // Nav Scroll Effect
            window.addEventListener('scroll', () => {
                navWrapper.classList.toggle('scrolled', window.scrollY > 50);
            }, { passive: true });

            // Global Intersection Observer for specialized reveals
            const revealOptions = { threshold: 0.15, rootMargin: '0px 0px -50px 0px' };
            const revealObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                        // Optional: stop observing once revealed
                        // revealObserver.unobserve(entry.target);
                    }
                });
            }, revealOptions);

            document.querySelectorAll('.reveal-text, .reveal-container, .reveal-stagger, .reveal').forEach(el => {
                revealObserver.observe(el);
            });
        })();
    </script>
</body>
</html>