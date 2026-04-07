<section class="hero">
    <p class="kicker">Impact Report</p>
    <h2>Our Welfare Initiatives</h2>
    <p class="subtle">Explore the projects driven by our volunteers.</p>
</section>

<section class="card">
    <h3>Filter Projects</h3>
    <form method="get" action="<?= url('/projects') ?>"  class="filters">
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
</section>

<?php if (empty($projects)): ?>
    <section class="card"><p>No projects found.</p></section>
<?php endif; ?>

<?php foreach ($projects as $categoryName => $items): ?>
    <section class="card">
        <h3><?= e((string) $categoryName) ?></h3>
        <div class="gallery-grid">
            <?php foreach ($items as $item): ?>
                <article class="card gallery-card">
                    <div class="gallery-content">
                        <span class="category-tag"><?= e((string) $categoryName) ?></span>
                        <h4><?= e($item['title']) ?></h4>
                        <p class="subtle"><?= e((string) ($item['description'] ?: 'No description available.')) ?></p>
                        <div class="row-between">
                            <small>Photo: <?= e($item['photo_status']) ?></small>
                            <a class="btn-primary" href="<?= url('/project-details?id=' . (int) $item['id']) ?>">View Details</a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
<?php endforeach; ?>
