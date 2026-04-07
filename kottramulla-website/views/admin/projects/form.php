<style>
    /* ── Form Header ── */
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

    /* ── Form Card ── */
    .proj-form-card {
        background: white;
        border-radius: 20px;
        padding: 2.5rem;
        border: 1px solid rgba(0,0,0,0.05);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
    }

    .proj-form {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .pf-row {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 1.5rem;
    }

    .pf-row--3 {
        grid-template-columns: 1fr 1fr 1fr;
    }

    /* ── Inputs & Labels ── */
    .pf-field {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .pf-label {
        font-size: 0.85rem;
        font-weight: 700;
        color: #475569;
        margin-left: 2px;
    }

    .pf-input {
        background: #f8fafc;
        border: 2px solid #f1f5f9;
        border-radius: 12px;
        padding: 0.75rem 1rem;
        font-family: inherit;
        font-size: 0.95rem;
        color: #1e293b;
        transition: all 0.2s ease;
    }

    .pf-input:focus {
        outline: none;
        border-color: var(--emerald);
        background: white;
        box-shadow: 0 0 0 4px var(--emerald-glow);
    }

    .pf-textarea {
        resize: vertical;
        min-height: 120px;
    }

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
        font-size: 0.95rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
        box-shadow: 0 10px 20px -5px var(--emerald-glow);
    }

    .pf-btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 25px -5px var(--emerald-glow);
        filter: brightness(1.1);
    }

    .pf-btn-cancel {
        text-decoration: none;
        color: #94a3b8;
        font-weight: 600;
        font-size: 0.95rem;
        transition: color 0.2s;
    }

    .pf-btn-cancel:hover { color: #ef4444; }

    @media (max-width: 768px) {
        .pf-row, .pf-row--3 { grid-template-columns: 1fr; }
        .proj-header { flex-direction: column; align-items: flex-start; gap: 1rem; }
    }
</style>

<div class="proj-header">
    <div>
        <p class="proj-eyebrow">Projects</p>
        <h1 class="proj-title"><?= e($heading) ?></h1>
    </div>
    <a class="proj-back-btn" href="<?= url('/admin/projects') ?>">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="m12 19-7-7 7-7"/></svg>
        Back to Projects
    </a>
</div>

<?php if (!empty($error)): ?>   
    <div class="alert error"><?= e($error) ?></div>
<?php endif; ?>

<div class="proj-form-card">
    <form method="post" action="<?= e($action) ?>" class="proj-form">
        <input type="hidden" name="_csrf" value="<?= e($csrfToken) ?>">

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

        <div class="pf-field">
            <label class="pf-label" for="f-desc">Description</label>
            <textarea id="f-desc" class="pf-input pf-textarea" name="description" rows="4" placeholder="Optional project description…"><?= e((string) ($project['description'] ?? '')) ?></textarea>
        </div>

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

        <div class="pf-actions">
            <button type="submit" class="pf-btn-save">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                Save Project
            </button>
            <a href="<?= url('/admin/projects') ?>" class="pf-btn-cancel">Cancel</a>
        </div>
    </form>
</div>