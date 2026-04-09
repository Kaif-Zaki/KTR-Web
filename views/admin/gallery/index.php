<link rel="stylesheet" href="<?= url('/public/css/admin/gallery.css') ?>">
<link rel="stylesheet" href="<?= url('/public/css/admin/projects.css') ?>">

<div class="admin-page-header">
    <div class="admin-page-title">
        <p>Visual Assets</p>
        <h1>Manage Gallery</h1>
    </div>
    <a href="<?= url('/admin/gallery/create') ?>" class="btn-primary-admin">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Upload Image
    </a>
</div>

<?php if (!empty($success)): ?><div class="alert success"><?= e($success) ?></div><?php endif; ?>
<?php if (!empty($error)): ?><div class="alert error"><?= e($error) ?></div><?php endif; ?>

<?php if (empty($rows)): ?>
    <div class="admin-card" style="text-align: center; padding: 100px 40px;">
        <div style="color: #e2e8f0; margin-bottom: 24px;">
            <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-5-5L5 21"/></svg>
        </div>
        <h3 style="color: var(--navy-900); font-weight: 800; margin-bottom: 8px;">Your gallery is empty</h3>
        <p style="color: var(--text-light); margin-bottom: 24px;">Start building your story by uploading your first project image.</p>
        <a href="<?= url('/admin/gallery/create') ?>" class="btn-primary-admin">Get Started</a>
    </div>
<?php else: ?>
    <div class="gal-grid">
        <?php foreach ($rows as $row): ?>
            <?php
                $path = (string)$row['image_path'];
                if (!str_starts_with($path, 'http') && !str_starts_with($path, '/public/')) {
                    $path = '/public/images/gallery/' . ltrim($path, '/');
                }
            ?>
            <div class="gal-card">
                <div class="gal-thumb">
                    <img src="<?= url($path) ?>" alt="<?= e((string) ($row['caption'] ?? 'Gallery image')) ?>" loading="lazy">
                    <div class="gal-thumb-overlay">
                        <a href="<?= url('/admin/gallery/edit?id=' . (int) $row['id']) ?>" class="gal-btn-edit btn-icon-only" title="Edit text">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5Z"/></svg>
                        </a>
                        <form method="post" action="<?= url('/admin/gallery/delete?id=' . (int) $row['id']) ?>" onsubmit="return confirm('Delete this image?');" style="margin:0">
                            <input type="hidden" name="_csrf" value="<?= e(\App\Core\Csrf::token()) ?>">
                            <button type="submit" class="gal-btn-delete btn-icon-only" title="Delete image">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="gal-info">
                    <p class="gal-caption" title="<?= e((string) ($row['caption'] ?? 'No caption')) ?>">
                        <?= e((string) ($row['caption'] ?? 'No text provided')) ?>
                    </p>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <?php if (!empty($row['project_title'])): ?>
                            <span class="proj-category-chip" style="font-size: 10px;"><?= e($row['project_title']) ?></span>
                        <?php else: ?>
                            <span class="gal-general-tag">General</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>