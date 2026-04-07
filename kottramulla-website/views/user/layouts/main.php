<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KUWS | Kottramulla United Welfare Society</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= url('/public/css/app.css') ?>">
</head>
<body>

<div class="ambient-glow"></div>

<div id="nav-wrapper">
    <span style="font-size:1.1rem; letter-spacing:0.2em; font-weight:700; color:#111827; font-family:'SesamiFutura', sans-serif;">KUWS</span>
    <nav style="display:flex; gap:1.5rem; align-items:center;">
        <a href="<?= url('/home') ?>"     class="nav-link <?= ($activePage ?? '') === 'home' ? 'active' : '' ?>">Home</a>
        <a href="<?= url('/about') ?>"    class="nav-link <?= ($activePage ?? '') === 'about' ? 'active' : '' ?>">About</a>
        <a href="<?= url('/projects') ?>" class="nav-link <?= ($activePage ?? '') === 'projects' ? 'active' : '' ?>">Projects</a>
        <a href="<?= url('/gallery') ?>"  class="nav-link <?= ($activePage ?? '') === 'gallery' ? 'active' : '' ?>">Gallery</a>
        <a href="<?= url('/contact') ?>"  class="nav-link <?= ($activePage ?? '') === 'contact' ? 'active' : '' ?>">Contact</a>
        <a href="<?= url('/donate') ?>" class="btn-donate-nav">Donate</a>
    </nav>
</div>

<main style="flex: 1;">
    <?= $content ?>
</main>

<footer>
    <div class="footer-grid">
        <div class="footer-brand">
            <h2 style="font-weight:700; letter-spacing:0.2em; font-size:1.2rem; color:#111827; margin-bottom:1.5rem;">KUWS</h2>
            <p style="color:#9ca3af; font-size:0.85rem; line-height:1.8; max-width:280px;">Empowering communities and inspiring hope through unity and collective welfare since 2016.</p>
        </div>

        <div>
            <h4 class="footer-heading">Navigate</h4>
            <div class="footer-links" style="display:flex; flex-direction:column; gap:0.8rem;">
                <a href="<?= url('/about') ?>">Our Story</a>
                <a href="<?= url('/projects') ?>">Projects</a>
                <a href="<?= url('/gallery') ?>">Gallery</a>
                <a href="<?= url('/donate') ?>">Support Us</a>
                <a class="admin-link" href="<?= url('/admin/login') ?>">Admin Login</a>
            </div>
        </div>

        <div>
            <h4 class="footer-heading">Get in Touch</h4>
            <div class="footer-links" style="display:flex; flex-direction:column; gap:0.8rem;">
                <a href="mailto:info@kuws.org">info@kuws.org</a>
                <a href="tel:+94112345678">+94 11 234 5678</a>
                <span style="color:#6b7280; font-size:0.85rem;">Kottramulla, Sri Lanka</span>
            </div>
        </div>

        <div>
            <h4 class="footer-heading">Social</h4>
            <div class="footer-links" style="display:flex; flex-direction:column; gap:0.8rem;">
                <a href="#">Facebook</a>
                <a href="#">Instagram</a>
                <a href="#">LinkedIn</a>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <span>&copy; <?php echo date('Y'); ?> Kottramulla United Welfare Society.</span>
        <span style="text-transform: uppercase; letter-spacing: 0.1em;">Unity • Hope • Welfare</span>
    </div>
</footer>

<script>
    const navWrapper = document.getElementById('nav-wrapper');
    window.addEventListener('scroll', () => {
        navWrapper.classList.toggle('nav-scrolled', window.scrollY > 80);
    }, { passive: true });
</script>

</body>
</html>