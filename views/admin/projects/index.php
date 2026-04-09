<link rel="stylesheet" href="<?= url('/public/css/admin/projects.css') ?>">

<div class="admin-page-header">
    <div class="admin-page-title">
        <p>Portfolio</p>
        <h1>Manage Projects</h1>
    </div>
    <a href="<?= url('/admin/projects/create') ?>" class="btn-primary-admin">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Add New Project
    </a>
</div>

<?php if (!empty($success)): ?><div class="alert success"><?= e($success) ?></div><?php endif; ?>
<?php if (!empty($error)): ?><div class="alert error"><?= e($error) ?></div><?php endif; ?>

<div class="table-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Project Name</th>
                <th>Category</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row): ?>
                <tr>
                    <td style="font-weight: 700; color: var(--navy-900);"><?= e($row['title']) ?></td>
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
                    <td><span style="color: var(--text-light); font-size: 0.85rem;"><?= e((string) ($row['project_date'] ?? '—')) ?></span></td>
                    <td>
                        <div class="proj-actions">
                            <a href="<?= url('/admin/projects/edit?id=' . (int) $row['id']) ?>" class="btn-secondary-admin btn-icon-only" title="Edit">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5Z"/></svg>
                            </a>
                            <form method="post" action="<?= url('/admin/projects/delete') ?>" onsubmit="return confirm('Delete this project?');" style="margin:0">
                                <input type="hidden" name="_csrf" value="<?= e(\App\Core\Csrf::token()) ?>">
                                <input type="hidden" name="id" value="<?= (int) $row['id'] ?>">
                                <button type="submit" class="btn-danger-admin btn-icon-only" title="Delete">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
