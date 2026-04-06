<section class="card">
    <h2><?= e($heading) ?></h2>

    <?php if (!empty($error)): ?>
        <div class="alert error"><?= e($error) ?></div>
    <?php endif; ?>

    <form method="post" action="<?= e($action) ?>" class="stack-form">
        <input type="hidden" name="_csrf" value="<?= e($csrfToken) ?>">

        <label>Category</label>
        <select name="category_id" required>
            <option value="">Select category</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= (int) $category['id'] ?>" <?= $project && (int) $project['category_id'] === (int) $category['id'] ? 'selected' : '' ?>>
                    <?= e($category['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Title</label>
        <input type="text" name="title" value="<?= e((string) ($project['title'] ?? '')) ?>" required>

        <label>Description</label>
        <textarea name="description" rows="4"><?= e((string) ($project['description'] ?? '')) ?></textarea>

        <label>Photo Status</label>
        <select name="photo_status">
            <?php
                $statuses = ['Photos sent', 'Photos Pending', 'NO Photos'];
                $currentStatus = (string) ($project['photo_status'] ?? 'NO Photos');
            ?>
            <?php foreach ($statuses as $status): ?>
                <option value="<?= e($status) ?>" <?= $currentStatus === $status ? 'selected' : '' ?>><?= e($status) ?></option>
            <?php endforeach; ?>
        </select>

        <label>Amount (LKR)</label>
        <input type="number" step="0.01" name="amount_lkr" value="<?= e((string) ($project['amount_lkr'] ?? '')) ?>">

        <label>Project Date</label>
        <input type="date" name="project_date" value="<?= e((string) ($project['project_date'] ?? '')) ?>">

        <div class="row-between">
            <button type="submit">Save</button>
            <a href="/admin/projects">Cancel</a>
        </div>
    </form>
</section>
