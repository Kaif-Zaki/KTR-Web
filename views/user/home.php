<link rel="stylesheet" href="<?= asset_url('/public/css/user/home.css') ?>">

<!-- ═══════════════════════════════════════════════
     HERO SECTION
════════════════════════════════════════════════ -->
<section class="home-hero">
    <div class="hero-bloom"></div>
    
    <div class="hero-content">
        <span class="hero-kicker"><?= e($settings['hero_kicker']) ?></span>
        <h1 class="hero-title">
            <?= nl2br(e($settings['hero_title'])) ?>
            <?php if (!empty($settings['hero_subtitle'])): ?>
                <br><span class="dim"><?= e($settings['hero_subtitle']) ?></span>
            <?php endif; ?>
        </h1>
        <p class="hero-lead">
            <?= e($settings['hero_lead']) ?>
        </p>
        
        <div class="hero-actions">
            <a href="<?= url('/projects') ?>" class="btn-primary-home">View Our Projects</a>
            <a href="<?= url('/about') ?>" class="btn-ghost-home">Our Story</a>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════
     ABOUT / LEGACY SECTION
     ════════════════════════════════════════════════ -->
<section class="section-wrapper reveal">
    <div class="grid-2">
        
        <div class="image-frame">
            <?php if ($settings['legacy_image']): ?>
                <img src="<?= url('/public/images/home/' . $settings['legacy_image']) ?>" alt="Our Legacy" style="width: 100%; height: 100%; object-fit: cover;">
            <?php else: ?>
                <div class="image-placeholder"></div>
            <?php endif; ?>
        </div>

        <div class="content-block">
            <span class="hero-kicker"><?= e($settings['legacy_kicker']) ?></span>
            <h2><?= $settings['legacy_title'] ?></h2>
            <p>
                <?= e($settings['legacy_body']) ?>
            </p>

            <div class="stat-grid">
                <div class="stat-card">
                    <span class="stat-num"><?= e($settings['stat1_num']) ?></span>
                    <span class="stat-label"><?= e($settings['stat1_label']) ?></span>
                </div>
                <div class="stat-card">
                    <span class="stat-num"><?= e($settings['stat2_num']) ?></span>
                    <span class="stat-label"><?= e($settings['stat2_label']) ?></span>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- ═══════════════════════════════════════════════
     INITIATIVES SECTION
     ════════════════════════════════════════════════ -->
<section class="section-wrapper reveal">
    <div class="initiatives-header">
        <span class="hero-kicker"><?= e($settings['initiatives_kicker']) ?></span>
        <h2><?= e($settings['initiatives_title']) ?></h2>
        <p><?= e($settings['initiatives_lead']) ?></p>
    </div>

    <div class="feature-grid reveal reveal-stagger">
        <?php foreach ($features as $feature): ?>
            <div class="feature-card">
                <div class="feature-icon">
                    <?php
                        $iconName = strtolower($feature['icon'] ?? '');
                        switch ($iconName) {
                            case 'heart':
                                echo '<svg width="32" height="32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>';
                                break;
                            case 'book':
                                echo '<svg width="32" height="32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>';
                                break;
                            case 'shield':
                                echo '<svg width="32" height="32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>';
                                break;
                            default:
                                echo '<svg width="32" height="32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>';
                        }
                    ?>
                </div>
                <h3 class="feature-title"><?= e($feature['title']) ?></h3>
                <p class="feature-desc"><?= e($feature['description']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- ═══════════════════════════════════════════════
     JOURNEY HIGHLIGHTS
     ════════════════════════════════════════════════ -->
<section class="section-wrapper reveal">
    <div class="detail-section-head">
        <span class="hero-kicker"><?= e($settings['journey_kicker'] ?? 'Journey Highlights') ?></span>
        <h2><?= e($settings['journey_title'] ?? 'How our community story keeps growing') ?></h2>
        <p><?= e($settings['journey_lead'] ?? 'From the first volunteer circle to today, every milestone reflects consistent grassroots action and trusted partnerships.') ?></p>
    </div>

    <div class="timeline-grid reveal reveal-stagger">
        <article class="timeline-card">
            <span class="timeline-year"><?= e($settings['journey_item1_year'] ?? '2016') ?></span>
            <h3><?= e($settings['journey_item1_title'] ?? 'Society Formation') ?></h3>
            <p><?= e($settings['journey_item1_body'] ?? 'KUWS started with local volunteers focused on urgent household support and shared welfare activities.') ?></p>
        </article>
        <article class="timeline-card">
            <span class="timeline-year"><?= e($settings['journey_item2_year'] ?? '2019') ?></span>
            <h3><?= e($settings['journey_item2_title'] ?? 'Structured Programs') ?></h3>
            <p><?= e($settings['journey_item2_body'] ?? 'We expanded into recurring education, relief, and family assistance programs with clearer planning cycles.') ?></p>
        </article>
        <article class="timeline-card">
            <span class="timeline-year"><?= e($settings['journey_item3_year'] ?? 'Today') ?></span>
            <h3><?= e($settings['journey_item3_title'] ?? 'Long-Term Impact') ?></h3>
            <p><?= e($settings['journey_item3_body'] ?? 'Our team now balances immediate aid and sustainable initiatives to build resilience across the community.') ?></p>
        </article>
    </div>
</section>

<!-- ═══════════════════════════════════════════════
     HOW WE WORK
     ════════════════════════════════════════════════ -->
<section class="section-wrapper reveal">
    <div class="detail-section-head">
        <span class="hero-kicker"><?= e($settings['approach_kicker'] ?? 'Our Approach') ?></span>
        <h2><?= e($settings['approach_title'] ?? 'A transparent model for meaningful outcomes') ?></h2>
    </div>

    <div class="work-model-grid reveal reveal-stagger">
        <article class="work-model-card">
            <h3><?= e($settings['approach_item1_title'] ?? 'Listen First') ?></h3>
            <p><?= e($settings['approach_item1_body'] ?? 'We assess needs directly with families and neighbors before planning any intervention.') ?></p>
        </article>
        <article class="work-model-card">
            <h3><?= e($settings['approach_item2_title'] ?? 'Mobilize Fast') ?></h3>
            <p><?= e($settings['approach_item2_body'] ?? 'Volunteers, donors, and partners coordinate quickly to ensure support reaches people on time.') ?></p>
        </article>
        <article class="work-model-card">
            <h3><?= e($settings['approach_item3_title'] ?? 'Measure & Improve') ?></h3>
            <p><?= e($settings['approach_item3_body'] ?? 'Each cycle is reviewed so future programs deliver stronger and more sustainable community results.') ?></p>
        </article>
        <article class="work-model-card work-model-card--highlight">
            <h3><?= e($settings['approach_item4_title'] ?? 'Active Focus Areas') ?></h3>
            <p>
                <?php
                    $approachItem4Body = trim((string) ($settings['approach_item4_body'] ?? ''));
                    if ($approachItem4Body === '') {
                        echo e((string) count($features)) . ' key initiative areas are currently active with recurring community engagement.';
                    } elseif (stripos($approachItem4Body, '{count}') !== false) {
                        echo e(str_replace('{count}', (string) count($features), $approachItem4Body));
                    } else {
                        echo e($approachItem4Body);
                    }
                ?>
            </p>
        </article>
    </div>
</section>

<!-- ═══════════════════════════════════════════════
     FINAL CTA / VISION
     ════════════════════════════════════════════════ -->
<section class="section-wrapper cta-section">
    <div class="cta-banner">
        <div class="cta-glow"></div>
        
        <h2><?= e($settings['cta_title']) ?></h2>
        <p><?= e($settings['cta_body']) ?></p>
        
        <div class="cta-actions">
            <a href="<?= url('/projects') ?>" class="btn-primary-home">Browse Projects</a>
        </div>
    </div>
</section>
