<link rel="stylesheet" href="<?= url('/public/css/admin/members.css') ?>">

<div class="admin-page-header">
    <div class="admin-page-title">
        <p>Community</p>
        <h1>Manage Members</h1>
    </div>
    <a href="<?= url('/admin/members/create') ?>" class="btn-primary-admin">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Add New Member
    </a>
</div>

<?php if ($success): ?><div class="alert success"><?= e($success) ?></div><?php endif; ?>

<div class="table-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th width="80">Avatar</th>
                <th>Name</th>
                <th>Occupation</th>
                <th>Socials</th>
                <th width="200">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $member): ?>
                <tr>
                    <td>
                        <?php if ($member['image_path']): ?>
                            <img src="<?= url('/public/images/members/' . $member['image_path']) ?>" class="member-mini-avatar" alt="">
                        <?php else: ?>
                            <div class="member-no-avatar"><?= strtoupper(substr($member['name'], 0, 1)) ?></div>
                        <?php endif; ?>
                    </td>
                    <td style="font-weight: 700; color: var(--navy-900);"><?= e($member['name']) ?></td>
                    <td><span style="color: var(--text-light);"><?= e($member['occupation']) ?></span></td>
                    <td>
                        <div style="display: flex; gap: 4px; flex-wrap: wrap;">
                            <?php 
                                $links = json_decode($member['social_links'], true);
                                if (is_array($links)):
                                    foreach ($links as $link):
                            ?>
                                <span class="member-platform-tag"><?= ucfirst($link['platform'] ?? 'Link') ?></span>
                            <?php 
                                    endforeach;
                                endif;
                            ?>
                        </div>
                    </td>
                    <td>
                        <div style="display: flex; gap: 8px;">
                            <a href="<?= url('/admin/members/edit?id=' . (int) $member['id']) ?>" class="btn-secondary-admin btn-icon-only" title="Edit">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5Z"/></svg>
                            </a>
                            <form action="<?= url('/admin/members/delete') ?>" method="post" onsubmit="return confirm('Remove member?')" style="margin:0;">
                                <input type="hidden" name="_csrf" value="<?= e(\App\Core\Csrf::token()) ?>">
                                <input type="hidden" name="id" value="<?= (int) $member['id'] ?>">
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
