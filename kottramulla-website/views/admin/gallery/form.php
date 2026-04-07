<style>
    /* ── Header ── */
    .proj-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 2rem;
    }

    .proj-eyebrow {
        text-transform: uppercase;
        font-size: 0.75rem;
        font-weight: 800;
        letter-spacing: 0.1em;
        color: var(--emerald);
        margin: 0 0 0.5rem 0;
    }

    .proj-title {
        font-size: 1.85rem;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
        letter-spacing: -0.02em;
    }

    .proj-back-btn {
        text-decoration: none;
        color: #64748b;
        font-size: 0.9rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: color 0.2s;
    }

    .proj-back-btn:hover { color: var(--emerald); }

    /* ── Card & Form ── */
    .proj-form-card {
        background: white;
        border-radius: 20px;
        padding: 2.5rem;
        border: 1px solid rgba(0,0,0,0.05);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
    }

    .proj-form { display: flex; flex-direction: column; gap: 1.5rem; }

    .pf-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }

    .pf-field { display: flex; flex-direction: column; gap: 0.6rem; }

    .pf-label {
        font-size: 0.85rem;
        font-weight: 700;
        color: #475569;
        margin-left: 2px;
    }

    .pf-optional { color: #94a3b8; font-weight: 400; font-size: 0.8rem; }

    /* ── Upload Zone ── */
    .gal-upload-zone {
        border: 2px dashed #e2e8f0;
        background: #f8fafc;
        border-radius: 16px;
        padding: 2.5rem 1.5rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
    }

    .gal-upload-zone:hover {
        border-color: var(--emerald);
        background: #f0fdf4;
    }

    .gal-upload-zone--sm { padding: 1.5rem; }

    .gal-file-input {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
    }

    .gal-upload-icon { color: #94a3b8; margin-bottom: 0.75rem; transition: color 0.3s; }
    .gal-upload-zone:hover .gal-upload-icon { color: var(--emerald); }

    .gal-upload-text { margin: 0; font-weight: 600; color: #334155; font-size: 0.95rem; }
    .gal-upload-hint { margin: 4px 0 0 0; color: #94a3b8; font-size: 0.8rem; }

    /* ── Image Preview ── */
    .gal-current-img {
        width: 100%;
        max-width: 300px;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
    }

    .gal-current-img img { width: 100%; display: block; object-fit: cover; }

    .pf-input {
        background: #f8fafc;
        border: 2px solid #f1f5f9;
        border-radius: 12px;
        padding: 0.75rem 1rem;
        font-family: inherit;
        font-size: 0.95rem;
        transition: all 0.2s ease;
    }

    .pf-input:focus { outline: none; border-color: var(--emerald); background: white; }

    /* ── Actions ── */
    .pf-actions {
        margin-top: 1rem;
        padding-top: 2rem;
        border-top: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .pf-btn-save {
        background: var(--emerald);
        color: white;
        border: none;
        padding: 0.9rem 2rem;
        border-radius: 12px;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
        box-shadow: 0 10px 20px -5px var(--emerald-glow);
    }

    .pf-btn-save:hover { transform: translateY(-2px); filter: brightness(1.1); }

    .pf-btn-cancel { text-decoration: none; color: #94a3b8; font-weight: 600; transition: color 0.2s; }
    .pf-btn-cancel:hover { color: #ef4444; }
</style>

<div class="proj-header">
    <div>
        <p class="proj-eyebrow">Gallery Creator</p>
        <h1 class="proj-title"><?= e($heading) ?></h1>
    </div>
    <a class="proj-back-btn" href="<?= url('/admin/gallery') ?>">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="m12 19-7-7 7-7"/></svg>
        Back to Gallery
    </a>
</div>

<?php if (!empty($error)): ?>
    <div class="alert error"><?= e($error) ?></div>
<?php endif; ?>

<div class="proj-form-card">
    <form method="post" action="<?= e($action) ?>" class="proj-form" enctype="multipart/form-data">
        <input type="hidden" name="_csrf" value="<?= e($csrfToken) ?>">

        <?php if (!$item): ?>
            <div class="pf-field">
                <label class="pf-label">Primary Image</label>
                <label class="gal-upload-zone" id="upload-zone">
                    <input type="file" name="image" accept="image/*" required class="gal-file-input" id="gal-file-input">
                    <div class="gal-upload-content" id="gal-upload-content">
                        <div class="gal-upload-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-5-5L5 21"/></svg>
                        </div>
                        <p class="gal-upload-text">Click or drag image here</p>
                        <p class="gal-upload-hint">Recommended size: 1200x900px</p>
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
            <div class="pf-row">
                <div class="pf-field">
                    <label class="pf-label">Current Asset</label>
                    <div class="gal-current-img">
                        <img src="<?= url($path) ?>" alt="Current image">
                    </div>
                </div>
                <div class="pf-field">
                    <label class="pf-label">Change Image <span class="pf-optional">(Optional)</span></label>
                    <label class="gal-upload-zone gal-upload-zone--sm" id="upload-zone">
                        <input type="file" name="image" accept="image/*" class="gal-file-input" id="gal-file-input">
                        <div class="gal-upload-content" id="gal-upload-content">
                            <div class="gal-upload-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                            </div>
                            <p class="gal-upload-text">Upload Replacement</p>
                        </div>
                    </label>
                </div>
            </div>
        <?php endif; ?>

        <div class="pf-row">
            <div class="pf-field">
                <label class="pf-label" for="f-project">Associated Project <span class="pf-optional">(Optional)</span></label>
                <select id="f-project" name="project_id" class="pf-input">
                    <option value="">No specific project</option>
                    <?php foreach ($projects as $project): ?>
                        <option value="<?= (int) $project['id'] ?>" <?= $item && (int) $item['project_id'] === (int) $project['id'] ? 'selected' : '' ?>>
                            <?= e($project['title']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="pf-field">
                <label class="pf-label" for="f-caption">Image Caption</label>
                <textarea id="f-caption" class="pf-input pf-textarea" name="caption" rows="3" placeholder="Briefly describe this photo..."><?= e((string) ($item['caption'] ?? '')) ?></textarea>
            </div>
        </div>

        <div class="pf-actions">
            <button type="submit" class="pf-btn-save">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                Save to Gallery
            </button>
            <a href="<?= url('/admin/gallery') ?>" class="pf-btn-cancel">Discard</a>
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
            <div class="gal-upload-icon" style="color:var(--emerald)">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
            <p class="gal-upload-text" style="color:var(--emerald)">${file.name}</p>
            <p class="gal-upload-hint">${(file.size / 1024).toFixed(0)} KB Selected</p>`;
    });
})();
</script>