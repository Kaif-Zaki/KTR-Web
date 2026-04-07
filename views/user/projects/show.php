<section class="hero">
    <p class="kicker">Project Details</p>
    <h2><?= e($project['title']) ?></h2>
</section>

<section class="profile-grid">
    <article class="card">
        <h3>Overview</h3>
        <p><?= nl2br(e((string) ($project['description'] ?: 'No description provided.'))) ?></p>
        <div class="stats" style="grid-template-columns: 1fr;">
            <div><strong>Photo Status</strong><span><?= e($project['photo_status']) ?></span></div>
            <div><strong>Project Date</strong><span><?= e((string) ($project['project_date'] ?: '-')) ?></span></div>
            <div><strong>Amount</strong><span><?= $project['amount_lkr'] ? 'LKR ' . e(number_format((float) $project['amount_lkr'], 2)) : '-' ?></span></div>
        </div>
        <p style="margin-top:1rem;"><a class="btn-primary" href="<?= url('/projects') ?>" >Back to Projects</a></p>
    </article>
</section>
