<link rel="stylesheet" href="<?= asset_url('/public/css/user/members.css') ?>">
<?php $webSettings = website_settings() ?? []; ?>

<section class="members-hero-section">
    <div class="page-shell">
        <h1 class="page-title reveal-text">Our Society Members</h1>
        <p class="hero-lead reveal-text">The dedicated individuals driving hope and unity through collective welfare service since 2016.</p>
    </div>
</section>

<section class="members-overview reveal-container">
    <article class="members-overview-card">
        <h3><?= count($members) ?>+</h3>
        <p>Dedicated members actively supporting community welfare activities.</p>
    </article>
    <article class="members-overview-card">
        <h3><?= e($webSettings['members_overview2_title'] ?? 'Volunteer-led') ?></h3>
        <p><?= e($webSettings['members_overview2_body'] ?? 'Our initiatives are organized and delivered through collaborative volunteer leadership.') ?></p>
    </article>
    <article class="members-overview-card">
        <h3><?= e($webSettings['members_overview3_title'] ?? 'Open to all') ?></h3>
        <p><?= e($webSettings['members_overview3_body'] ?? 'We welcome compassionate people who want to contribute skills, time, or guidance.') ?></p>
    </article>
</section>

<div class="members-shell">
    <div class="members-grid reveal reveal-stagger">
        <?php if (empty($members)): ?>
            <div class="members-empty reveal-container">
                <p>No members listed at the moment.</p>
            </div>
        <?php else: ?>
            <?php foreach ($members as $member): ?>
                <div class="member-card">
                    
                    <div class="member-card-avatar <?= !$member['image_path'] ? 'no-img' : '' ?>">
                        <?php if ($member['image_path']): ?>
                            <img src="<?= url('/public/images/members/' . $member['image_path']) ?>" alt="<?= e($member['name']) ?>">
                        <?php else: ?>
                            <span><?= strtoupper(substr($member['name'], 0, 1)) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="member-card-info">
                        <h3><?= e($member['name']) ?></h3>
                        <p class="occupation"><?= e($member['occupation']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
