<div class="proj-header">
    <div>
        <p class="proj-eyebrow">Projects</p>
        <h1 class="proj-title">Manage Projects</h1>
    </div>
    <a class="proj-add-btn" href="<?= url('/admin/projects/create') ?>">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Add Project
    </a>
</div>

<?php if (!empty($success)): ?>
    <div class="alert success"><?= e($success) ?></div>
<?php endif; ?>

<?php if (!empty($error)): ?>
    <div class="alert error"><?= e($error) ?></div>
<?php endif; ?>

<div class="proj-table-card">
    <div class="table-wrap">
        <table class="proj-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Photo Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $row): ?>
                    <tr class="proj-row">
                        <td class="proj-td-title"><?= e($row['title']) ?></td>
                        <td>
                            <span class="proj-category-chip"><?= e($row['category_name']) ?></span>
                        </td>
                        <td>
                            <?php
                                $ps = $row['photo_status'];
                                $badgeClass = match($ps) {
                                    'Photos sent'    => 'photo-badge--sent',
                                    'Photos Pending' => 'photo-badge--pending',
                                    default          => 'photo-badge--none',
                                };
                            ?>
                            <span class="photo-badge <?= $badgeClass ?>"><?= e($ps) ?></span>
                        </td>
                        <td class="proj-td-date"><?= e((string) ($row['project_date'] ?? '—')) ?></td>
                        <td>
                            <div class="proj-actions">
                                <a class="proj-btn-edit" href="<?= url('/admin/projects/edit?id=' . (int) $row['id']) ?>">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5Z"/></svg>
                                    Edit
                                </a>
                                <form method="post" action="<?= url('/admin/projects/delete?id=' . (int) $row['id']) ?>" onsubmit="return confirm('Delete this project?');">
                                    <input type="hidden" name="_csrf" value="<?= e(\App\Core\Csrf::token()) ?>">
                                    <button type="submit" class="proj-btn-delete">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>