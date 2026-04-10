<link rel="stylesheet" href="<?= url('/public/css/user/projects.css') ?>">

<!-- ── HERO ── -->
<section class="projects-hero-section">
    <div class="page-shell">
        <h1 class="page-title reveal-text">Transforming <span class="accent-text">Futures</span></h1>
        <p class="hero-lead reveal-text">Explore our welfare initiatives driven by the heart and dedication of our volunteers since 2016.</p>

        <div class="filter-wrapper reveal-container">
            <form method="get" action="<?= url('/projects') ?>">
                <div class="filter-glass-pill">
                    <input
                        type="text"
                        name="search"
                        class="search-input-field"
                        placeholder="Search initiatives..."
                        value="<?= e($search) ?>"
                    >
                    
                    <select name="category" class="filter-category-select">
                        <option value="">All Categories</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= (int) $category['id'] ?>"
                                <?= $selectedCategoryId === (int) $category['id'] ? 'selected' : '' ?>>
                                <?= e($category['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <button type="submit" class="btn-search-trigger" aria-label="Search">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- ── PROJECTS GRID ── -->
<div class="project-sections-container">
    
    <?php if (empty($projects)): ?>
        <div class="members-empty reveal-container" style="grid-column: 1/-1;">
            <p>No projects matched your criteria.</p>
        </div>
    <?php endif; ?>

    <?php foreach ($projects as $categoryName => $items): ?>
        <section class="category-group reveal-container">
            <div class="category-header">
                <h2 class="category-title"><?= e((string) $categoryName) ?></h2>
                <div class="category-line"></div>
            </div>

            <div class="projects-flex-grid reveal reveal-stagger">
                <?php foreach ($items as $item): ?>
                    <article class="project-card" onclick="window.location.href='<?= url('/project-details?id=' . (int) $item['id']) ?>'">
                        <div class="card-body">
                            <span class="proj-tag"><?= e((string) $categoryName) ?></span>
                            <h4><?= e($item['title']) ?></h4>
                            <p>
                                <?= e((string) ($item['description'] ?: 'Contributing to sustainable growth and long-term community welfare in Kottramulla.')) ?>
                            </p>
                        </div>
                        
                        <div class="project-card-footer">
                            <div class="status-badge">
                                <span>Status:</span>
                                <span class="accent-text"><?= ucwords(strtolower(e($item['photo_status']))) ?></span>
                            </div>
                            <div class="btn-card-details">
                                <span>View Details</span>
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endforeach; ?>
</div>
