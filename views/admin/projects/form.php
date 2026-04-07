<div class="proj-header">
    <div>
        <p class="proj-eyebrow">Projects</p>
        <h1 class="proj-title"><?= e($heading) ?></h1>
    </div>
    <a class="proj-back-btn" href="<?= url('/admin/projects') ?>">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="m12 19-7-7 7-7"/></svg>
        Back to Projects
    </a>
</div>

<?php if (!empty($error)): ?>
    <div class="alert error"><?= e($error) ?></div>
<?php endif; ?>

<div class="proj-form-card">
    <form method="post" action="<?= e($action) ?>" class="proj-form">
        <input type="hidden" name="_csrf" value="<?= e($csrfToken) ?>">

        <!-- Category & Title -->
        <div class="pf-row">
            <div class="pf-field">
                <label class="pf-label" for="f-category">Category</label>
                <select id="f-category" name="category_id" required class="pf-input">
                    <option value="">Select category</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= (int) $category['id'] ?>" <?= $project && (int) $project['category_id'] === (int) $category['id'] ? 'selected' : '' ?>>
                            <?= e($category['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="pf-field">
                <label class="pf-label" for="f-title">Title</label>
                <input id="f-title" class="pf-input" type="text" name="title" value="<?= e((string) ($project['title'] ?? '')) ?>" required placeholder="Project title…">
            </div>
        </div>

        <!-- Description -->
        <div class="pf-field">
            <label class="pf-label" for="f-desc">Description</label>
            <textarea id="f-desc" class="pf-input pf-textarea" name="description" rows="4" placeholder="Optional project description…"><?= e((string) ($project['description'] ?? '')) ?></textarea>
        </div>

        <!-- Photo status, Amount, Date -->
        <div class="pf-row pf-row--3">
            <div class="pf-field">
                <label class="pf-label" for="f-photo">Photo Status</label>
                <?php
                    $statuses = ['Photos sent', 'Photos Pending', 'NO Photos'];
                    $currentStatus = (string) ($project['photo_status'] ?? 'NO Photos');
                ?>
                <select id="f-photo" name="photo_status" class="pf-input">
                    <?php foreach ($statuses as $status): ?>
                        <option value="<?= e($status) ?>" <?= $currentStatus === $status ? 'selected' : '' ?>><?= e($status) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="pf-field">
                <label class="pf-label" for="f-amount">Amount (LKR)</label>
                <input id="f-amount" class="pf-input" type="number" step="0.01" name="amount_lkr" value="<?= e((string) ($project['amount_lkr'] ?? '')) ?>" placeholder="0.00">
            </div>
            <div class="pf-field">
                <label class="pf-label" for="f-date">Project Date</label>
                <input id="f-date" class="pf-input" type="date" name="project_date" value="<?= e((string) ($project['project_date'] ?? '')) ?>">
            </div>
        </div>

        <!-- Actions -->
        <div class="pf-actions">
            <button type="submit" class="pf-btn-save">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                Save Project
            </button>
            <a href="<?= url('/admin/projects') ?>" class="pf-btn-cancel">Cancel</a>
        </div>
    </form>
</div>