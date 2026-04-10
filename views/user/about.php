<link rel="stylesheet" href="<?= asset_url('/public/css/user/about.css') ?>">

<div class="about-page-wrapper">
    
    <header class="about-hero reveal">
        <span class="hero-kicker reveal-text">Our Story</span>
        <h1 class="page-title reveal-text">Driven by <span class="accent-text">Compassion.</span></h1>
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

            <div class="about-stats reveal reveal-stagger">
                <div class="stat-item">
                    <label>Established</label>
                    <span class="stat-value"><?= e((string) $about['established_year']) ?></span>
                </div>
                <div class="stat-item">
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

            <div class="about-stats reveal reveal-stagger">
                <div class="stat-item">
                    <label>Established</label>
                    <span class="stat-value">2016</span>
                </div>
                <div class="stat-item">
                    <label>Active Volunteers</label>
                    <span class="stat-value">50+</span>
                </div>
            </div>
        <?php endif; ?>

    </main>

    <section class="about-detail-grid reveal reveal-stagger">
        <article class="about-detail-card">
            <h3><?= e($about['mission_title'] ?? 'Our Mission') ?></h3>
            <p><?= e($about['mission_body'] ?? 'To uplift vulnerable families through consistent welfare support, dignity-focused outreach, and long-term community empowerment.') ?></p>
        </article>
        <article class="about-detail-card">
            <h3><?= e($about['vision_title'] ?? 'Our Vision') ?></h3>
            <p><?= e($about['vision_body'] ?? 'To build a compassionate, resilient society where every household has access to care, opportunity, and collective strength.') ?></p>
        </article>
        <article class="about-detail-card">
            <h3><?= e($about['values_title'] ?? 'Our Core Values') ?></h3>
            <ul class="about-values-list">
                <li><?= e($about['values_item1'] ?? 'Compassion in action') ?></li>
                <li><?= e($about['values_item2'] ?? 'Transparency in every initiative') ?></li>
                <li><?= e($about['values_item3'] ?? 'Unity through volunteerism') ?></li>
            </ul>
        </article>
    </section>

    <section class="about-milestones reveal">
        <div class="about-milestone-head">
            <span class="hero-kicker"><?= e($about['timeline_kicker'] ?? 'Progress Timeline') ?></span>
            <h3><?= e($about['timeline_title'] ?? 'Important milestones in our journey') ?></h3>
        </div>
        <div class="about-milestone-list">
            <article>
                <span><?= e($about['timeline_item1_year'] ?? '2016') ?></span>
                <p><?= e($about['timeline_item1_body'] ?? 'KUWS established in Kottramulla with an initial volunteer-driven welfare network.') ?></p>
            </article>
            <article>
                <span><?= e($about['timeline_item2_year'] ?? '2020') ?></span>
                <p><?= e($about['timeline_item2_body'] ?? 'Expanded recurring support programs for education, emergency relief, and family assistance.') ?></p>
            </article>
            <article>
                <span><?= e($about['timeline_item3_year'] ?? 'Today') ?></span>
                <p><?= e($about['timeline_item3_body'] ?? 'Growing partnerships and stronger community coordination to scale sustainable social impact.') ?></p>
            </article>
        </div>
    </section>

    <section class="reveal" style="text-align: center; margin-top: 80px;">
        <h3 style="font-family: var(--font-heading); font-size: 1.8rem; font-weight: 800; color: var(--text-heading); margin-bottom: 24px;">Want to be part of our story?</h3>
        <a href="<?= url('/contact') ?>" class="btn-primary-home">Join the Society</a>
    </section>

</div>
