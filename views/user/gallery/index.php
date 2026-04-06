<?php include __DIR__ . '/../layouts/header.php'; ?>

<main>
    <div class="wrap">
        <section class="hero" style="margin-bottom: 2rem;">
            <p class="kicker">Visual Impact</p>
            <h1>Project Gallery</h1>
            <p class="subtle">Visual records of our community impact and volunteer initiatives since 2016.</p>
        </section>

        <div class="gallery-grid">
            <?php if (!empty($images)): ?>
                <?php foreach ($images as $image): ?>
                    <div class="card gallery-card">
                        <div class="gallery-img-wrapper">
                            <img src="/kottramulla-website/public/images/<?php echo htmlspecialchars($image['image_path']); ?>" alt="Project Photo">
                        </div>
                        <div class="gallery-content">
                            <p class="kicker" style="font-size: 0.7rem;"><?php echo htmlspecialchars($image['project_title'] ?? 'General Event'); ?></p>
                            <p class="subtle" style="margin: 0; font-size: 0.85rem;"><?php echo htmlspecialchars($image['caption']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="card" style="grid-column: 1 / -1; text-align: center; padding: 3rem;">
                    <p class="subtle">No photos found. Photos are currently being processed for recent projects.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php include __DIR__ . '/../layouts/footer.php'; ?>