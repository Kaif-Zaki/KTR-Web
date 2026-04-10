<link rel="stylesheet" href="<?= url('/public/css/user/members.css') ?>">

<div class="member-show-wrapper">
    
    <a href="<?= url('/members') ?>" class="back-link reveal-text">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        <span>Back to Members</span>
    </a>

    <div class="member-profile-card reveal-container">
        
        <div class="profile-visual">
            <div class="profile-avatar-large <?= !$member['image_path'] ? 'no-img' : '' ?>">
                <?php if ($member['image_path']): ?>
                    <img src="<?= url('/public/images/members/' . $member['image_path']) ?>" alt="<?= e($member['name']) ?>">
                <?php else: ?>
                    <span><?= strtoupper(substr($member['name'], 0, 1)) ?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="profile-info">
            <h1 class="reveal-text"><?= e($member['name']) ?></h1>
            <p class="profile-occupation reveal-text"><?= e($member['occupation']) ?></p>

        </div>
    </div>
</div>

