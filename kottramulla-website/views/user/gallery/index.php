

<section class="gallery-hero">
    <span class="kicker">Visual Impact</span>
    <h1 class="gallery-title">Project Gallery</h1>
    <p class="subtle-lead">Visual records of our community initiatives.</p>
</section>

<section class="gallery-section">
    <?php if (!empty($images)): ?>
        <div class="gallery-masonry">
            <?php foreach ($images as $image): ?>
                <article class="gallery-item">
                    <div class="gallery-img-wrapper">
                        <?php 
                            $path = (string)$image['image_path'];
                            if (!str_starts_with($path, 'http') && !str_starts_with($path, '/public/')) {
                                $path = '/public/images/gallery/' . ltrim($path, '/');
                            }
                        ?>
                        <img src="<?= url($path) ?>" alt="Gallery image">
                    </div>
                    
                    <div class="gallery-info">
                        <?php if (!empty($image['caption'])): ?>
                            <p class="gallery-caption"><?= e($image['caption']) ?></p>
                        <?php else: ?>
                            <p class="gallery-caption" style="font-style:italic; color:#d1d5db;">Perspective of growth.</p>
                        <?php endif; ?>

                        <span class="gallery-tag">
                            <?= !empty($image['project_title']) ? e($image['project_title']) : 'Community Milestone' ?>
                        </span>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="empty-gallery">
            <p>No gallery records found. Check back soon for new impact visuals.</p>
        </div>
    <?php endif; ?>
</section>