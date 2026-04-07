<div class="proj-header">
    <div>
        <p class="proj-eyebrow">Gallery</p>
        <h1 class="proj-title">Manage Gallery</h1>
    </div>
    <a class="proj-add-btn" href="<?= url('/admin/gallery/create') ?>">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Upload Image
    </a>
</div>

<?php if (!empty($success)): ?>
    <div class="alert success"><?= e($success) ?></div>
<?php endif; ?>

<?php if (!empty($error)): ?>
    <div class="alert error"><?= e($error) ?></div>
<?php endif; ?>

<?php if (empty($rows)): ?>
    <div class="gal-empty">
        <div class="gal-empty-icon">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-5-5L5 21"/></svg>
        </div>
        <p class="gal-empty-text">No gallery items yet. Upload your first image.</p>
        <a class="proj-add-btn" href="<?= url('/admin/gallery/create') ?>">Upload Image</a>
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
                    <img src="<?= url($path) ?>" alt="<?= e((string) ($row['caption'] ?? 'Gallery image')) ?>">
                    <div class="gal-thumb-overlay">
                        <a class="gal-btn-edit" href="<?= url('/admin/gallery/edit?id=' . (int) $row['id']) ?>">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5Z"/></svg>
                            Edit
                        </a>
                        <form method="post" action="<?= url('/admin/gallery/delete?id=' . (int) $row['id']) ?>" onsubmit="return confirm('Delete this image?');">
                            <input type="hidden" name="_csrf" value="<?= e(\App\Core\Csrf::token()) ?>">
                            <button type="submit" class="gal-btn-delete">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
                <div class="gal-info">
                    <p class="gal-caption"><?= e((string) ($row['caption'] ?? 'No caption')) ?></p>
                    <?php if (!empty($row['project_title'])): ?>
                        <span class="proj-category-chip"><?= e($row['project_title']) ?></span>
                    <?php else: ?>
                        <span class="gal-general-tag">General</span>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>