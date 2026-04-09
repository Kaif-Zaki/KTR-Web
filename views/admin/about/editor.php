<!-- Using public/css/admin/home_editor.css via layout CSS map -->
<div class="editor-container">
    <!-- EDITOR LEFT SIDE -->
    <div class="editor-panels">
        <form action="<?= url('/admin/about/update') ?>" method="post">
            <input type="hidden" name="_csrf" value="<?= $csrfToken ?>">
            
            <div class="editor-header">
                <h2 class="editor-title">About Editor</h2>
                <button type="submit" class="btn-save-home">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Save Changes
                </button>
            </div>

            <?php if ($success): ?><div class="alert success"><?= e($success) ?></div><?php endif; ?>
            <?php if ($error): ?><div class="alert error"><?= e($error) ?></div><?php endif; ?>

            <!-- MAIN CONTENT -->
            <div class="editor-card">
                <div class="editor-card-title">📝 Main Narrative</div>
                <div class="form-group">
                    <label class="form-label">Page Title</label>
                    <input type="text" name="title" class="form-input" value="<?= e($about['title'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Body Text (Story)</label>
                    <textarea name="body" class="form-input" rows="8"><?= e($about['body'] ?? '') ?></textarea>
                </div>
            </div>

            <!-- QUOTE SECTION -->
            <div class="editor-card">
                <div class="editor-card-title">💬 Featured Quote</div>
                <div class="form-group">
                    <label class="form-label">Quote Text</label>
                    <textarea name="quote" class="form-input" rows="3"><?= e($about['quote'] ?? '') ?></textarea>
                </div>
            </div>

            <!-- STATISTICS -->
            <div class="editor-card">
                <div class="editor-card-title">📊 Historical Data</div>
                <div class="input-grid">
                    <div class="form-group">
                        <label class="form-label">Established Year</label>
                        <input type="number" name="established_year" class="form-input" value="<?= (int)($about['established_year'] ?? 2016) ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Active Volunteers</label>
                        <input type="number" name="volunteer_count" class="form-input" value="<?= (int)($about['volunteer_count'] ?? 0) ?>">
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- PREVIEW RIGHT SIDE -->
    <div class="preview-panel">
        <div class="preview-header">
            <div style="display:flex; align-items:center; gap:12px">
                <span class="preview-badge"><div class="pulse"></div> Live Preview</span>
                <span id="preview-status">Ready</span>
            </div>
            <a href="<?= url('/about') ?>" target="_blank" class="preview-link">
                Open in active tab
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
            </a>
        </div>
        <iframe id="about-preview" class="preview-frame" src="<?= url('/about') ?>"></iframe>
    </div>
</div>

<script>
    const inputs = document.querySelectorAll('.form-input');
    const statusEl = document.getElementById('preview-status');
    inputs.forEach(input => {
        input.addEventListener('input', () => {
             statusEl.innerText = 'Unsaved changes...';
             statusEl.style.color = '#f59e0b';
        });
    });
</script>
