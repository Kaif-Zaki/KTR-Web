<link rel="stylesheet" href="<?= url('/public/css/user/gallery.css') ?>">

<section class="gallery-hero-section">
    <div class="page-shell">
        <span class="hero-kicker reveal-text">Visual Storytelling</span>
        <h1 class="page-title reveal-text">Reflections of <span class="accent-text">Impact.</span></h1>
        <p class="hero-lead reveal-text">A collective record of moments that define our journey in community service.</p>
    </div>
</section>

<div class="gallery-shell">
    <?php if (!empty($images)): ?>
        <div class="gallery-masonry">
            <?php foreach ($images as $image): ?>
                <article class="gallery-card reveal-container">
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
            <p>Our visual story is being curated. Check back soon for new impact records.</p>
        </div>
    <?php endif; ?>
</div>
