<?php include __DIR__ . '/../layouts/header.php'; ?>

<main>
    <div class="wrap">
        <?php if ($project): ?>
            <div class="profile-grid">
                <div class="card" style="align-self: start;">
                    <span class="category-tag"><?php echo htmlspecialchars($project['category']); ?></span>
                    <h1 style="margin-top: 0.5rem;"><?php echo htmlspecialchars($project['title']); ?></h1>
                    
                    <div class="stack-form" style="margin-top: 1.5rem;">
                        <div style="padding: 0.8rem; background: var(--surface-soft); border-radius: 10px;">
                            <strong>Status:</strong> <span style="color: var(--primary);"><?php echo ucfirst($project['status']); ?></span>
                        </div>
                        <div style="padding: 0.8rem; background: var(--surface-soft); border-radius: 10px;">
                            <strong>NGO Partner:</strong> <?php echo htmlspecialchars($project['ngo_partner'] ?? 'None'); ?>
                        </div>
                    </div>
                    <a href="/kottramulla-website/projects" class="btn-primary" style="width: 100%; margin-top: 1.5rem; background: var(--muted);">← Back</a>
                </div>

                <div class="card" style="padding: 0; overflow: hidden;">
                    <img src="/kottramulla-website/public/images/projects/<?php echo htmlspecialchars($project['main_image'] ?? 'default-project.jpg'); ?>" 
                         style="width: 100%; height: 300px; object-fit: cover;" alt="Project Hero">
                    
                    <div style="padding: 1.5rem;">
                        <p class="kicker">Case Study</p>
                        <h2>About This Project</h2>
                        <div class="subtle" style="line-height: 1.8;">
                            <?php echo nl2br(htmlspecialchars($project['description'] ?? '')); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>