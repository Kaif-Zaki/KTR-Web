<link rel="stylesheet" href="<?= asset_url('/public/css/user/members.css') ?>">

<section class="members-hero-section">
    <div class="page-shell">
        <h1 class="page-title reveal-text">Our Society Members</h1>
        <p class="hero-lead reveal-text">The dedicated individuals driving hope and unity through collective welfare service since 2016.</p>
    </div>
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

