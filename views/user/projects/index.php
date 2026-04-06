<section class="hero">
    <h2>Projects</h2>
    <p>Browse our projects by category and search by keywords.</p>
</section>

<section class="card">
    <h3>Project Directory</h3>
    <form method="get" action="/projects" class="filters">
        <input type="text" name="search" placeholder="Search projects..." value="<?= e($search) ?>">
        <select name="category">
            <option value="">All categories</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= (int) $category['id'] ?>" <?= $selectedCategoryId === (int) $category['id'] ? 'selected' : '' ?>>
                    <?= e($category['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit" class="btn-primary">Filter</button>
    </form>

    <?php if (empty($projects)): ?>
        <p>No projects found for this filter.</p>
    <?php endif; ?>

    <?php foreach ($projects as $categoryName => $items): ?>
        <div class="category-block">
            <h4><?= e((string) $categoryName) ?></h4>
            <ul class="project-list">
                <?php foreach ($items as $item): ?>
                    <li>
                        <h5><?= e($item['title']) ?></h5>
                        <?php if (!empty($item['description'])): ?>
                            <p><?= e($item['description']) ?></p>
                        <?php endif; ?>
                        <small>
                            Photo Status: <?= e($item['photo_status']) ?>
                            <?php if (!empty($item['project_date'])): ?>
                                | Date: <?= e($item['project_date']) ?>
                            <?php endif; ?>
                            <?php if (!empty($item['amount_lkr'])): ?>
                                | Value: LKR <?= e(number_format((float) $item['amount_lkr'], 2)) ?>
                            <?php endif; ?>
                        </small>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endforeach; ?>
</section>
