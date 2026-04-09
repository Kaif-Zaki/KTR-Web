<link rel="stylesheet" href="<?= url('/public/css/admin/gallery.css') ?>">
<link rel="stylesheet" href="<?= url('/public/css/admin/forms.css') ?>">

<div class="admin-page-header">
    <div class="admin-page-title">
        <p>Visual Assets</p>
        <h1><?= e($heading) ?></h1>
    </div>
    <a href="<?= url('/admin/gallery') ?>" class="btn-secondary-admin">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="m12 19-7-7 7-7"/></svg>
        Back to Gallery
    </a>
</div>

<?php if (!empty($error)): ?>
    <div class="alert error"><?= e($error) ?></div>
<?php endif; ?>

<div class="admin-card">
    <form method="post" action="<?= e($action) ?>" enctype="multipart/form-data">
        <input type="hidden" name="_csrf" value="<?= e($csrfToken) ?>">

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px;">
            <!-- MEDIA UPLOAD -->
            <div>
                <label class="admin-label">Image File</label>
                <?php if ($item): ?>
                    <?php
                        $path = (string)$item['image_path'];
                        if (!str_starts_with($path, 'http') && !str_starts_with($path, '/public/')) {
                            $path = '/public/images/gallery/' . ltrim($path, '/');
                        }
                    ?>
                    <div style="margin-bottom: 16px; border-radius: 12px; overflow: hidden; border: 1px solid var(--border-color);">
                        <img src="<?= url($path) ?>" style="width: 100%; display: block;">
                    </div>
                <?php endif; ?>

                <div style="position: relative; height: 160px; border: 2px dashed #e2e8f0; border-radius: 16px; display: flex; align-items: center; justify-content: center; background: #f8fafc; cursor: pointer; transition: var(--transition);" onmouseover="this.style.borderColor='var(--primary)'; this.style.background='#eff6ff';" onmouseout="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc';">
                    <input type="file" name="image" accept="image/*" <?= !$item ? 'required' : '' ?> style="position: absolute; inset: 0; opacity: 0; cursor: pointer;" onchange="handleFileChange(this)">
                    <div id="upload-status" style="text-align: center; color: var(--text-light);">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 8px;"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                        <p style="font-size: 0.9rem; font-weight: 700; color: var(--navy-900);"><?= $item ? 'Change Image' : 'Click to Upload' ?></p>
                        <p style="font-size: 0.8rem;">JPG, PNG or WebP</p>
                    </div>
                </div>
            </div>

            <!-- METADATA -->
            <div>
                <div class="admin-form-group">
                    <label class="admin-label">Associated Project (Select 'General' if none)</label>
                    <select name="project_id" class="admin-select">
                        <option value="">General / No Project</option>
                        <?php foreach ($projects as $project): ?>
                            <option value="<?= (int) $project['id'] ?>" <?= $item && (int) $item['project_id'] === (int) $project['id'] ? 'selected' : '' ?>>
                                <?= e($project['title']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="admin-form-group">
                    <label class="admin-label">Caption / Description</label>
                    <textarea name="caption" class="admin-textarea" rows="4" placeholder="Brief description of the image..."><?= e((string) ($item['caption'] ?? '')) ?></textarea>
                </div>
            </div>
        </div>

        <div style="margin-top: 40px; padding-top: 32px; border-top: 1px solid var(--border-color); display: flex; gap: 16px;">
            <button type="submit" class="btn-primary-admin" style="padding: 14px 40px; font-size: 1rem;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                Save Visual Asset
            </button>
        </div>
    </form>
</div>

<script>
    function handleFileChange(input) {
        if (input.files && input.files[0]) {
            const status = document.getElementById('upload-status');
            status.innerHTML = `
                <div style="color: var(--primary)">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 8px;"><polyline points="20 6 9 17 4 12"/></svg>
                    <p style="font-size: 0.9rem; font-weight: 700;">${input.files[0].name}</p>
                    <p style="font-size: 0.8rem;">Ready for upload</p>
                </div>
            `;
        }
    }
</script>