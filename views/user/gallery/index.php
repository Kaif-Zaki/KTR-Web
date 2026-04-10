<link rel="stylesheet" href="<?= asset_url('/public/css/user/gallery.css') ?>">
<?php $webSettings = website_settings() ?? []; ?>

<section class="gallery-hero-section">
    <div class="page-shell">
        <span class="hero-kicker reveal-text">Our Gallery</span>
        <h1 class="page-title reveal-text">Moments of <span class="accent-text">Impact.</span></h1>
        <p class="hero-lead reveal-text">A collective record of moments that define our journey in community service.</p>
    </div>
</section>

<section class="gallery-overview reveal-container">
    <article class="gallery-overview-card">
        <h3><?= e($webSettings['gallery_overview1_title'] ?? 'Living archive of service') ?></h3>
        <p><?= e($webSettings['gallery_overview1_body'] ?? 'Every image captures volunteer effort, community participation, and progress across initiatives.') ?></p>
    </article>
    <article class="gallery-overview-card">
        <h3><?= count($images) ?></h3>
        <p>Documented moments currently available in this public gallery.</p>
    </article>
    <article class="gallery-overview-card">
        <h3><?= e($webSettings['gallery_overview3_title'] ?? 'People-centered stories') ?></h3>
        <p><?= e($webSettings['gallery_overview3_body'] ?? 'Captions and tags help connect each photo to the welfare journey behind it.') ?></p>
    </article>
</section>

<div class="gallery-shell">
    <?php if (!empty($images)): ?>
        <div class="gallery-masonry reveal-stagger reveal">
            <?php foreach ($images as $image): ?>
                <article class="gallery-card">
                    <div class="gallery-visual">
                        <?php
                            $path = (string)$image['image_path'];
                            if (!str_starts_with($path, 'http') && !str_starts_with($path, '/public/')) {
                                $path = '/public/images/gallery/' . ltrim($path, '/');
                            }
                        ?>
                        <img src="<?= url($path) ?>"
                             alt="<?= !empty($image['caption']) ? e($image['caption']) : 'Gallery image' ?>"
                             loading="lazy">
                    </div>

                    <div class="gallery-card-meta">
                        <p class="caption">
                            <?= !empty($image['caption']) ? e($image['caption']) : 'Preserving moments of community growth.' ?>
                        </p>
                        <span class="tag">
                            <?= !empty($image['project_title']) ? e($image['project_title']) : 'Kottramulla' ?>
                        </span>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="empty-gallery-card reveal-container">
            <p>No photos have been added to the gallery yet. Check back soon!</p>
        </div>
    <?php endif; ?>
</div>
