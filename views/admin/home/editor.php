<!-- No <style> tag needed, using public/css/admin/home_editor.css -->
<div class="editor-container">
    <!-- EDITOR LEFT SIDE -->
    <div class="editor-panels">
        <form action="<?= url('/admin/home/update') ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_csrf" value="<?= $csrfToken ?>">
            
            <div class="editor-header">
                <h2 class="editor-title">Home Editor</h2>
                <button type="submit" class="btn-save-home">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Save All Changes
                </button>
            </div>

            <?php if ($success): ?><div class="alert success"><?= e($success) ?></div><?php endif; ?>
            <?php if ($error): ?><div class="alert error"><?= e($error) ?></div><?php endif; ?>

            <!-- HERO SECTION -->
            <div class="editor-card">
                <div class="editor-card-title">🚀 Hero Section</div>
                <div class="form-group">
                    <label class="form-label">Kicker Text</label>
                    <input type="text" name="hero_kicker" class="form-input" value="<?= e($settings['hero_kicker']) ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Main Title</label>
                    <textarea name="hero_title" class="form-input" rows="2" placeholder="Empowering Communities."><?= e($settings['hero_title']) ?></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Title Accent / Subtitle (The highlighted part)</label>
                    <textarea name="hero_subtitle" class="form-input" rows="2" placeholder="Inspiring Real Hope."><?= e($settings['hero_subtitle'] ?? '') ?></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Lead Paragraph</label>
                    <textarea name="hero_lead" class="form-input" rows="3"><?= e($settings['hero_lead']) ?></textarea>
                </div>
            </div>

            <!-- LEGACY SECTION -->
            <div class="editor-card">
                <div class="editor-card-title">🏛️ Legacy Section</div>
                <div class="form-group">
                    <label class="form-label">Section Kicker</label>
                    <input type="text" name="legacy_kicker" class="form-input" value="<?= e($settings['legacy_kicker'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">About Image</label>
                    <input type="file" name="legacy_image" class="form-input" accept="image/*" style="padding: 9px 16px;">
                    <?php if ($settings['legacy_image']): ?>
                        <div style="margin-top:10px"><img src="<?= url('/public/images/home/'.$settings['legacy_image']) ?>" height="60" style="border-radius:8px; border: 1px solid var(--border-color);"></div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label class="form-label">Title</label>
                    <input type="text" name="legacy_title" class="form-input" value="<?= e($settings['legacy_title']) ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Description Body</label>
                    <textarea name="legacy_body" class="form-input" rows="4"><?= e($settings['legacy_body']) ?></textarea>
                </div>
                <div class="input-grid">
                    <div class="form-group">
                        <label class="form-label">Stat 1 Number</label>
                        <input type="text" name="stat1_num" class="form-input" value="<?= e($settings['stat1_num']) ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Stat 1 Label</label>
                        <input type="text" name="stat1_label" class="form-input" value="<?= e($settings['stat1_label']) ?>">
                    </div>
                </div>
                <div class="input-grid">
                    <div class="form-group">
                        <label class="form-label">Stat 2 Number</label>
                        <input type="text" name="stat2_num" class="form-input" value="<?= e($settings['stat2_num']) ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Stat 2 Label</label>
                        <input type="text" name="stat2_label" class="form-input" value="<?= e($settings['stat2_label']) ?>">
                    </div>
                </div>
            </div>

            <!-- INITIATIVES SECTION -->
            <div class="editor-card">
                <div class="editor-card-title">🎯 Focus Areas Header</div>
                <div class="form-group">
                    <label class="form-label">Section Kicker</label>
                    <input type="text" name="initiatives_kicker" class="form-input" value="<?= e($settings['initiatives_kicker'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Section Title</label>
                    <input type="text" name="initiatives_title" class="form-input" value="<?= e($settings['initiatives_title']) ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Section Description</label>
                    <textarea name="initiatives_lead" class="form-input" rows="2"><?= e($settings['initiatives_lead']) ?></textarea>
                </div>
            </div>

            <!-- CTA SECTION -->
            <div class="editor-card">
                <div class="editor-card-title">✉️ Bottom CTA</div>
                <div class="form-group">
                    <label class="form-label">CTA Title</label>
                    <input type="text" name="cta_title" class="form-input" value="<?= e($settings['cta_title']) ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">CTA Paragraph</label>
                    <textarea name="cta_body" class="form-input" rows="2"><?= e($settings['cta_body']) ?></textarea>
                </div>
            </div>

            <div class="editor-card">
                <div class="editor-card-title">🛤️ Journey Highlights Section</div>
                <div class="form-group">
                    <label class="form-label">Section Kicker</label>
                    <input type="text" name="journey_kicker" class="form-input" value="<?= e($settings['journey_kicker'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Section Title</label>
                    <input type="text" name="journey_title" class="form-input" value="<?= e($settings['journey_title'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Section Lead</label>
                    <textarea name="journey_lead" class="form-input" rows="2"><?= e($settings['journey_lead'] ?? '') ?></textarea>
                </div>

                <div class="input-grid">
                    <div class="form-group">
                        <label class="form-label">Item 1 Year</label>
                        <input type="text" name="journey_item1_year" class="form-input" value="<?= e($settings['journey_item1_year'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Item 1 Title</label>
                        <input type="text" name="journey_item1_title" class="form-input" value="<?= e($settings['journey_item1_title'] ?? '') ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Item 1 Description</label>
                    <textarea name="journey_item1_body" class="form-input" rows="2"><?= e($settings['journey_item1_body'] ?? '') ?></textarea>
                </div>

                <div class="input-grid">
                    <div class="form-group">
                        <label class="form-label">Item 2 Year</label>
                        <input type="text" name="journey_item2_year" class="form-input" value="<?= e($settings['journey_item2_year'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Item 2 Title</label>
                        <input type="text" name="journey_item2_title" class="form-input" value="<?= e($settings['journey_item2_title'] ?? '') ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Item 2 Description</label>
                    <textarea name="journey_item2_body" class="form-input" rows="2"><?= e($settings['journey_item2_body'] ?? '') ?></textarea>
                </div>

                <div class="input-grid">
                    <div class="form-group">
                        <label class="form-label">Item 3 Year</label>
                        <input type="text" name="journey_item3_year" class="form-input" value="<?= e($settings['journey_item3_year'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Item 3 Title</label>
                        <input type="text" name="journey_item3_title" class="form-input" value="<?= e($settings['journey_item3_title'] ?? '') ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Item 3 Description</label>
                    <textarea name="journey_item3_body" class="form-input" rows="2"><?= e($settings['journey_item3_body'] ?? '') ?></textarea>
                </div>
            </div>

            <div class="editor-card">
                <div class="editor-card-title">🧭 Our Approach Section</div>
                <div class="form-group">
                    <label class="form-label">Section Kicker</label>
                    <input type="text" name="approach_kicker" class="form-input" value="<?= e($settings['approach_kicker'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Section Title</label>
                    <input type="text" name="approach_title" class="form-input" value="<?= e($settings['approach_title'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label class="form-label">Card 1 Title</label>
                    <input type="text" name="approach_item1_title" class="form-input" value="<?= e($settings['approach_item1_title'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Card 1 Description</label>
                    <textarea name="approach_item1_body" class="form-input" rows="2"><?= e($settings['approach_item1_body'] ?? '') ?></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Card 2 Title</label>
                    <input type="text" name="approach_item2_title" class="form-input" value="<?= e($settings['approach_item2_title'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Card 2 Description</label>
                    <textarea name="approach_item2_body" class="form-input" rows="2"><?= e($settings['approach_item2_body'] ?? '') ?></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Card 3 Title</label>
                    <input type="text" name="approach_item3_title" class="form-input" value="<?= e($settings['approach_item3_title'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Card 3 Description</label>
                    <textarea name="approach_item3_body" class="form-input" rows="2"><?= e($settings['approach_item3_body'] ?? '') ?></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Card 4 Title</label>
                    <input type="text" name="approach_item4_title" class="form-input" value="<?= e($settings['approach_item4_title'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Card 4 Description</label>
                    <textarea name="approach_item4_body" class="form-input" rows="2"><?= e($settings['approach_item4_body'] ?? '') ?></textarea>
                </div>
            </div>
        </form>

        <!-- FEATURES MANAGER -->
        <div class="editor-card">
            <div class="editor-card-title">🧩 Initiative Cards</div>
            <div id="features-list">
                <?php foreach ($features as $f): ?>
                    <form action="<?= url('/admin/home/features/edit?id='.$f['id']) ?>" method="post" class="feature-item">
                        <input type="hidden" name="_csrf" value="<?= $csrfToken ?>">
                        <div class="feature-row">
                            <input type="text" name="icon" class="form-input" style="width:70px; text-align:center" value="<?= e($f['icon']) ?>" title="Emoji Icon">
                            <input type="text" name="title" class="form-input" style="flex:1" value="<?= e($f['title']) ?>" placeholder="Title">
                            <input type="number" name="sort_order" class="form-input" style="width:80px; text-align:center" value="<?= (int)$f['sort_order'] ?>" title="Sort Order">
                        </div>
                        <textarea name="description" class="form-input" rows="2" placeholder="Description"><?= e($f['description']) ?></textarea>
                        <div class="feature-actions">
                            <button type="submit" class="btn-feature-update">Update</button>
                            <button type="submit" formaction="<?= url('/admin/home/features/delete?id='.$f['id']) ?>" class="btn-feature-delete" onclick="return confirm('Delete card?')">Remove</button>
                        </div>
                    </form>
                <?php endforeach; ?>
            </div>

            <button type="button" class="btn-add-feature" onclick="document.getElementById('new-feature-form').style.display='flex'; this.style.display='none'">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Add New Card
            </button>

            <form id="new-feature-form" action="<?= url('/admin/home/features/create') ?>" method="post" class="feature-item" style="display:none;">
                <input type="hidden" name="_csrf" value="<?= $csrfToken ?>">
                <div style="font-size:0.85rem; font-weight:800; color:var(--primary); text-transform:uppercase; letter-spacing:0.05em; margin-bottom:8px">New Strategic Initiative</div>
                <div class="feature-row">
                    <input type="text" name="icon" class="form-input" style="width:70px; text-align:center" placeholder="Icon">
                    <input type="text" name="title" class="form-input" style="flex:1" placeholder="Card Title">
                </div>
                <textarea name="description" class="form-input" rows="2" placeholder="Brief description..."></textarea>
                <div class="feature-actions">
                    <button type="button" class="btn-feature-update" style="background:transparent;" onclick="location.reload()">Cancel</button>
                    <button type="submit" class="btn-save-home" style="padding: 8px 16px;">Create Now</button>
                </div>
            </form>
        </div>
    </div>

    <!-- PREVIEW RIGHT SIDE -->
    <div class="preview-panel">
        <div class="preview-header">
            <div style="display:flex; align-items:center; gap:12px">
                <span class="preview-badge"><div class="pulse"></div> Live Preview</span>
                <span id="preview-status">Ready</span>
            </div>
            <a href="<?= url('/') ?>" target="_blank" class="preview-link">
                Open in active tab
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
            </a>
        </div>
        <!-- Iframe gets a white background rule in CSS to ensure the user site doesn't adopt admin dark mode if transparent -->
        <iframe id="home-preview" class="preview-frame" src="<?= url('/') ?>?preview=1"></iframe>
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
