

<article class="details-hero">
    <div class="details-left">
        <span class="kicker">Project Case Study</span>
        <h1 class="project-title"><?= e($project['title']) ?></h1>
        
        <div class="project-overview">
            <?= nl2br(e((string) ($project['description'] ?: 'Transforming lives through dedicated community service and support.'))) ?>
        </div>

        <div class="details-stats">
            <div class="stat-pill">
                <span class="stat-label">Investment</span>
                <span class="stat-value">
                    <?= $project['amount_lkr'] ? 'LKR ' . e(number_format((float) $project['amount_lkr'], 2)) : 'Grant Funded' ?>
                </span>
            </div>
            
            <div class="stat-pill">
                <span class="stat-label">Timeline</span>
                <span class="stat-value"><?= e((string) ($project['project_date'] ?: 'Active')) ?></span>
            </div>

            <div class="stat-pill">
                <span class="stat-label">Verification</span>
                <span class="stat-value" style="color: #4ade80;"><?= e($project['photo_status']) ?></span>
            </div>
        </div>

        <div class="back-nav">
            <a href="<?= url('/projects') ?>" class="btn-back">
                <span>←</span> Back to Projects
            </a>
        </div>
    </div>

    <div class="details-right">
        <img src="<?= url('/public/images/projects/detail-hero.jpg') ?>" alt="<?= e($project['title']) ?>">
        <div class="absolute inset-y-0 left-0 w-32 bg-gradient-to-r from-white to-transparent hidden md:block"></div>
    </div>
</article>

<section style="padding: 8rem 5rem; background: #fdfdfd;">
    <div style="max-width: 42rem;">
        <h2 class="kicker" style="color: #9ca3af;">Impact Mission</h2>
        <p style="font-family: 'Helvetica Light', sans-serif; font-size: 1.5rem; color: #1f2937; line-height: 1.6;">
            Every initiative by the Kottramulla United Welfare Society is a step towards a better tomorrow. Join our 28 volunteers in creating lasting change.
        </p>
    </div>
</section>