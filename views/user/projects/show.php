<link rel="stylesheet" href="<?= asset_url('/public/css/user/project-details.css') ?>">

<div class="project-details-wrapper">
    
    <a href="<?= url('/projects') ?>" class="back-link reveal-text">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        <span>Back to Projects</span>
    </a>

    <article class="details-hero">
        
        <div class="details-info-side reveal-text">
            <span class="hero-kicker">Case Study &bull; Welfare</span>
            <h1><?= e($project['title']) ?></h1>
            
            <div class="details-description">
                <?= nl2br(e((string) ($project['description'] ?: 'Contributing to sustainable growth and long-term community welfare through dedicated service and support initiatives in Kottramulla.'))) ?>
            </div>

            <div class="details-summary-grid">
                <div class="summary-card reveal-container">
                    <label>Funding / Investment</label>
                    <span class="accent-text">
                        <?= $project['amount_lkr'] ? 'LKR ' . e(number_format((float) $project['amount_lkr'], 0)) : 'Community Managed' ?>
                    </span>
                </div>
                
                <div class="summary-card reveal-container">
                    <label>Execution Timeline</label>
                    <span><?= e((string) ($project['project_date'] ?: 'Ongoing')) ?></span>
                </div>
            </div>
        </div>

        <div class="details-visual-side reveal-container">
            <div class="details-main-frame">
                <?php
                    $heroImage = !empty($project['gallery_image'])
                        ? url('/public/images/gallery/' . (string) $project['gallery_image'])
                        : url('/public/images/projects/dry-food-relief.jpg');
                ?>
                <img src="<?= e($heroImage) ?>" alt="<?= e($project['title']) ?>">
            </div>
        </div>

    </article>

    <section class="project-impact-banner reveal-container">
        <span class="hero-kicker reveal-text">Our Commitment</span>
        <h2 class="reveal-text">Integrity in Service,<br>Hope in Action.</h2>
        <p class="reveal-text">
            At KUWS, we believe that transparency and collective action are the keys to 
            transforming lives. Every project is a testament to the power of unity.
        </p>
        <a href="<?= url('/contact') ?>" class="btn-primary-home reveal-container">Join This Initiative</a>
    </section>

</div>

