<?php include __DIR__ . '/../layouts/header.php'; ?>

<main>
    <div class="wrap">
        <section class="hero" style="margin-bottom: 2rem;">
            <p class="kicker">Impact Report</p>
            <h1>Our Welfare Initiatives</h1>
            <p class="subtle">Explore the projects driven by our 28 active volunteers.</p>
        </section>
        
        <div class="gallery-grid">
            <?php if (!empty($projects)): ?>
                <?php foreach ($projects as $project): ?>
                    <div class="card gallery-card">
                        <div class="gallery-img-wrapper">
                            <img src="/kottramulla-website/public/images/projects/<?php echo htmlspecialchars($project['main_image'] ?? 'default-project.jpg'); ?>" alt="Project Image">
                        </div>
                        <div class="gallery-content">
                            <span class="category-tag"><?php echo htmlspecialchars($project['category']); ?></span>
                            <h3 style="margin: 0.5rem 0;"><?php echo htmlspecialchars($project['title']); ?></h3>
                            <p class="subtle" style="font-size: 0.85rem; height: 3em; overflow: hidden;">
                                <?php echo htmlspecialchars($project['description']); ?>
                            </p>
                            
                            <div class="row-between" style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid var(--border);">
                                <small class="subtle">Status: <strong style="color: var(--primary);"><?php echo ucfirst($project['status']); ?></strong></small>
                                <a href="/kottramulla-website/project-details?id=<?php echo $project['id']; ?>" class="btn-primary" style="padding: 0.4rem 0.8rem; font-size: 0.8rem;">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="card" style="grid-column: 1 / -1; text-align: center;">
                    <p class="subtle">No projects found.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php include __DIR__ . '/../layouts/footer.php'; ?>