<link rel="stylesheet" href="<?= url('/public/css/admin/forms.css') ?>">

<div class="admin-page-header">
    <div class="admin-page-title">
        <p>Portfolio</p>
        <h1><?= e($heading) ?></h1>
    </div>
    <a href="<?= url('/admin/projects') ?>" class="btn-secondary-admin">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="m12 19-7-7 7-7"/></svg>
        Cancel & Back
    </a>
</div>

<?php if (!empty($error)): ?>   
    <div class="alert error"><?= e($error) ?></div>
<?php endif; ?>

<div class="admin-card">
    <form method="post" action="<?= e($action) ?>">
        <input type="hidden" name="_csrf" value="<?= e($csrfToken) ?>">

        <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 24px;">
            <div class="admin-form-group">
                <label class="admin-label" for="f-category">Project Category</label>
                <select id="f-category" name="category_id" required class="admin-select">
                    <option value="">Select category</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= (int) $category['id'] ?>" <?= $project && (int) $project['category_id'] === (int) $category['id'] ? 'selected' : '' ?>>
                            <?= e($category['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="admin-form-group">
                <label class="admin-label" for="f-title">Project Title</label>
                <input id="f-title" class="admin-input" type="text" name="title" value="<?= e((string) ($project['title'] ?? '')) ?>" required placeholder="e.g. Village Water Well Project">
            </div>
        </div>

        <div class="admin-form-group">
            <label class="admin-label" for="f-desc">Full Description</label>
            <textarea id="f-desc" class="admin-textarea" name="description" rows="5" placeholder="Details about this initiative…"><?= e((string) ($project['description'] ?? '')) ?></textarea>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 24px;">
            <div class="admin-form-group">
                <label class="admin-label" for="f-photo">Photo/Media Status</label>
                <?php $currentStatus = (string) ($project['photo_status'] ?? 'NO Photos'); ?>
                <select id="f-photo" name="photo_status" class="admin-select">
                    <option value="Photos sent" <?= $currentStatus === 'Photos sent' ? 'selected' : '' ?>>Photos sent</option>
                    <option value="Photos Pending" <?= $currentStatus === 'Photos Pending' ? 'selected' : '' ?>>Photos Pending</option>
                    <option value="NO Photos" <?= $currentStatus === 'NO Photos' ? 'selected' : '' ?>>NO Photos</option>
                </select>
            </div>
            <div class="admin-form-group">
                <label class="admin-label" for="f-amount">Budget Amount (LKR)</label>
                <input id="f-amount" class="admin-input" type="number" step="0.01" name="amount_lkr" value="<?= e((string) ($project['amount_lkr'] ?? '')) ?>" placeholder="0.00">
            </div>
            <div class="admin-form-group">
                <label class="admin-label" for="f-date">Completion Date</label>
                <input id="f-date" class="admin-input" type="date" name="project_date" value="<?= e((string) ($project['project_date'] ?? '')) ?>">
            </div>
        </div>

        <div style="margin-top: 32px; padding-top: 32px; border-top: 1px solid var(--border-color); display: flex; gap: 16px;">
            <button type="submit" class="btn-primary-admin" style="padding: 14px 32px; font-size: 1rem;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                Publish Project
            </button>
            <a href="<?= url('/admin/projects') ?>" class="btn-danger-admin" style="background: transparent; color: #94a3b8; border: 1px solid #e2e8f0;">Discard Changes</a>
        </div>
    </form>
</div>