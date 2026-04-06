<section class="card">
    <div class="row-between">
        <h2>Manage Projects</h2>
        <a class="button-link" href="/admin/projects/create">Add Project</a>
    </div>

    <?php if (!empty($success)): ?>
        <div class="alert success"><?= e($success) ?></div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <div class="alert error"><?= e($error) ?></div>
    <?php endif; ?>

    <div class="table-wrap">
        <table>
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
                    <tr>
                        <td><?= e($row['title']) ?></td>
                        <td><?= e($row['category_name']) ?></td>
                        <td><?= e($row['photo_status']) ?></td>
                        <td><?= e((string) ($row['project_date'] ?? '-')) ?></td>
                        <td class="actions">
                            <a href="/admin/projects/edit?id=<?= (int) $row['id'] ?>">Edit</a>
                            <form method="post" action="/admin/projects/delete?id=<?= (int) $row['id'] ?>" onsubmit="return confirm('Delete this project?');">
                                <input type="hidden" name="_csrf" value="<?= e(\App\Core\Csrf::token()) ?>">
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
