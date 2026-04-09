<link rel="stylesheet" href="<?= url('/public/css/user/about.css') ?>">

<div class="about-page-wrapper">
    
    <header class="about-hero reveal">
        <span class="hero-kicker">Our Story</span>
        <h1 class="page-title">Driven by <span class="accent-text">Compassion.</span></h1>
    </header>

    <main class="about-card reveal">
        
        <?php if ($about): ?>
            <h2 class="section-title"><?= e($about['title']) ?></h2>
            
            <div class="about-text">
                <?= nl2br(e($about['body'])) ?>
            </div>

            <div class="quote-box reveal">
                <div class="quote-content">
                    "<?= e($about['quote'] ?? 'Together, we can create lasting change and inspire others to lend a helping hand.') ?>"
                </div>
            </div>

            <div class="about-stats">
                <div class="stat-item reveal">
                    <label>Established</label>
                    <span class="stat-value"><?= e((string) $about['established_year']) ?></span>
                </div>
                <div class="stat-item reveal">
                    <label>Active Volunteers</label>
                    <span class="stat-value"><?= e((string) $about['volunteer_count']) ?>+</span>
                </div>
            </div>
            
        <?php else: ?>
            <h2 class="section-title">Rooted in Kottramulla, reaching beyond.</h2>
            
            <div class="about-text">
                <p>The Kottramulla United Welfare Society was established in March 2016. We are a dedicated volunteer team driven by compassion and community service.</p>
                <p>Every member gives time and expertise to support welfare initiatives and help families in need. We continue to grow through collective support from our community. Our mission is to bridge the gap between resources and those who need them most.</p>
            </div>
            
            <div class="quote-box reveal">
                <div class="quote-content">
                    "Compassion is the heartbeat of our society, and unity is our greatest strength."
                </div>
            </div>

            <div class="about-stats">
                <div class="stat-item reveal">
                    <label>Established</label>
                    <span class="stat-value">2016</span>
                </div>
                <div class="stat-item reveal">
                    <label>Active Volunteers</label>
                    <span class="stat-value">50+</span>
                </div>
            </div>
        <?php endif; ?>

    </main>

    <section class="reveal" style="text-align: center; margin-top: 80px;">
        <h3 style="font-family: var(--font-heading); font-size: 1.8rem; font-weight: 800; color: var(--text-heading); margin-bottom: 24px;">Want to be part of our story?</h3>
        <a href="<?= url('/contact') ?>" class="btn-primary-home">Join the Society</a>
    </section>

</div>

<script>
    (function() {
        const rev = document.querySelectorAll('.reveal');
        const options = { threshold: 0.1 };
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if(entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, options);
        rev.forEach(r => observer.observe(r));
    })();
</script>
