<section class="hero">
    <p class="kicker">Visual Impact</p>
    <h2>Project Gallery</h2>
    <p class="subtle">Visual records of our community initiatives.</p>
</section>

<section class="gallery-grid">
    <?php if (!empty($images)): ?>
        <?php foreach ($images as $image): ?>
            <article class="card gallery-card">
                <div class="gallery-img-wrapper">
                    <?php 
                        $path = (string)$image['image_path'];
                        if (!str_starts_with($path, 'http') && !str_starts_with($path, '/public/')) {
                            $path = '/public/images/gallery/' . ltrim($path, '/');
                        }
                    ?>
                    <img src="<?= url($path) ?>" alt="Gallery image">
                </div>
                <div class="gallery-content">
                    <?php if (!empty($image['caption'])): ?>
                        <p><?= e($image['caption']) ?></p>
                    <?php else: ?>
                        <p class="subtle"><em>No caption provided.</em></p>
                    <?php endif; ?>

                    <?php if (!empty($image['project_title'])): ?>
                        <small class="subtle">Project: <?= e($image['project_title']) ?></small>
                    <?php else: ?>
                        <small class="subtle">General Gallery</small>
                    <?php endif; ?>
                </div>
            </article>
        <?php endforeach; ?>
    <?php else: ?>
        <article class="card"><p>No gallery images available yet.</p></article>
    <?php endif; ?>
</section>
