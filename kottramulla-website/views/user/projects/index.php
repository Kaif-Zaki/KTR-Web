

<section class="projects-hero">
    <span class="kicker">Impact Report</span>
    <h1 class="projects-title">Our Welfare <br>Initiatives</h1>
    <p style="color:#9ca3af; font-size:0.9rem; max-width:24rem; line-height:1.8;">
        Explore the projects driven by our 28 dedicated volunteers, focused on long-term community growth.
    </p>
</section>

<section class="filter-container">
    <form method="get" action="<?= url('/projects') ?>">
        <div class="filter-pill">
            <input type="text" name="search" class="filter-input" placeholder="Search projects..." value="<?= e($search) ?>">
            
            <div style="width: 1px; height: 20px; background: #e5e7eb;" class="hidden md:block"></div>
            
            <select name="category" class="filter-select">
                <option value="">All categories</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= (int) $category['id'] ?>" <?= $selectedCategoryId === (int) $category['id'] ? 'selected' : '' ?>>
                        <?= e($category['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit" class="btn-filter-trigger">Filter</button>
        </div>
    </form>
</section>

<?php if (empty($projects)): ?>
    <section class="project-section">
        <p class="project-meta" style="color:#9ca3af;">No projects found matching your criteria.</p>
    </section>
<?php endif; ?>

<?php foreach ($projects as $categoryName => $items): ?>
    <section class="project-section">
        <span class="category-label"><?= e((string) $categoryName) ?></span>
        
        <div class="projects-grid">
            <?php foreach ($items as $item): ?>
                <article class="project-item">
                    <span class="project-meta"><?= e((string) $categoryName) ?></span>
                    <h4 class="project-h4"><?= e($item['title']) ?></h4>
                    <p class="project-desc"><?= e((string) ($item['description'] ?: 'Transforming lives through dedicated community service and support.')) ?></p>
                    
                    <div style="display:flex; justify-content:space-between; align-items:center;">
                        <span style="font-family:'SesamiFutura'; font-size:0.6rem; color:#d1d5db;">STATUS: <?= e($item['photo_status']) ?></span>
                        <a class="btn-details" href="<?= url('/project-details?id=' . (int) $item['id']) ?>">
                            View Details <span>→</span>
                        </a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
<?php endforeach; ?>