<div class="proj-header">
    <div>
        <p class="proj-eyebrow">Gallery</p>
        <h1 class="proj-title"><?= e($heading) ?></h1>
    </div>
    <a class="proj-back-btn" href="<?= url('/admin/gallery') ?>">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="m12 19-7-7 7-7"/></svg>
        Back to Gallery
    </a>
</div>

<?php if (!empty($error)): ?>
    <div class="alert error"><?= e($error) ?></div>
<?php endif; ?>

<div class="proj-form-card">
    <form method="post" action="<?= e($action) ?>" class="proj-form" enctype="multipart/form-data">
        <input type="hidden" name="_csrf" value="<?= e($csrfToken) ?>">

        <!-- Image upload -->
        <?php if (!$item): ?>
            <div class="pf-field">
                <label class="pf-label">Image File</label>
                <label class="gal-upload-zone" id="upload-zone">
                    <input type="file" name="image" accept="image/*" required class="gal-file-input" id="gal-file-input">
                    <div class="gal-upload-content" id="gal-upload-content">
                        <div class="gal-upload-icon">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-5-5L5 21"/></svg>
                        </div>
                        <p class="gal-upload-text">Click to browse or drag &amp; drop</p>
                        <p class="gal-upload-hint">PNG, JPG, WEBP accepted</p>
                    </div>
                </label>
            </div>
        <?php else: ?>
            <?php
                $path = (string)$item['image_path'];
                if (!str_starts_with($path, 'http') && !str_starts_with($path, '/public/')) {
                    $path = '/public/images/gallery/' . ltrim($path, '/');
                }
            ?>
            <div class="pf-field">
                <label class="pf-label">Current Image</label>
                <div class="gal-current-img">
                    <img src="<?= url($path) ?>" alt="Current image">
                </div>
            </div>
            <div class="pf-field">
                <label class="pf-label">Replace Image <span class="pf-optional">(Optional)</span></label>
                <label class="gal-upload-zone gal-upload-zone--sm" id="upload-zone">
                    <input type="file" name="image" accept="image/*" class="gal-file-input" id="gal-file-input">
                    <div class="gal-upload-content" id="gal-upload-content">
                        <div class="gal-upload-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                        </div>
                        <p class="gal-upload-text">Upload a replacement image</p>
                        <p class="gal-upload-hint">Leave empty to keep the current image</p>
                    </div>
                </label>
            </div>
        <?php endif; ?>

        <!-- Project link & Caption -->
        <div class="pf-row">
            <div class="pf-field">
                <label class="pf-label" for="f-project">Link to Project <span class="pf-optional">(Optional)</span></label>
                <select id="f-project" name="project_id" class="pf-input">
                    <option value="">General / No Specific Project</option>
                    <?php foreach ($projects as $project): ?>
                        <option value="<?= (int) $project['id'] ?>" <?= $item && (int) $item['project_id'] === (int) $project['id'] ? 'selected' : '' ?>>
                            <?= e($project['title']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="pf-field">
                <label class="pf-label" for="f-caption">Caption</label>
                <textarea id="f-caption" class="pf-input pf-textarea" name="caption" rows="3" placeholder="Enter a brief description…"><?= e((string) ($item['caption'] ?? '')) ?></textarea>
            </div>
        </div>

        <!-- Actions -->
        <div class="pf-actions">
            <button type="submit" class="pf-btn-save">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                Save Gallery Item
            </button>
            <a href="<?= url('/admin/gallery') ?>" class="pf-btn-cancel">Cancel</a>
        </div>
    </form>
</div>

<script>
(function () {
    const input = document.getElementById('gal-file-input');
    const content = document.getElementById('gal-upload-content');
    if (!input || !content) return;
    input.addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;
        content.innerHTML = `
            <div class="gal-upload-icon" style="color:var(--primary)">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
            <p class="gal-upload-text" style="color:var(--primary)">${file.name}</p>
            <p class="gal-upload-hint">${(file.size / 1024).toFixed(0)} KB</p>`;
    });
})();
</script>