<section class="hero">
    <h2>About Us</h2>
    <p>Know who we are and why we serve.</p>
</section>

<section class="card">
    <?php if ($about): ?>
        <h3><?= e($about['title']) ?></h3>
        <p><?= nl2br(e($about['body'])) ?></p>
        <div class="stats">
            <div><strong>Established</strong><span><?= e((string) $about['established_year']) ?></span></div>
            <div><strong>Volunteers</strong><span><?= e((string) $about['volunteer_count']) ?></span></div>
        </div>
    <?php else: ?>
        <p>About content will appear here after database migration.</p>
    <?php endif; ?>
</section>
