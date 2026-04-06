<section class="card">
    <h2>Welcome, <?= e((string) $admin['name']) ?></h2>
    <p>Use this panel to manage project records shown on the public website.</p>
    <div class="stats">
        <div><strong>Total Projects</strong><span><?= (int) $projectCount ?></span></div>
        <div><strong>Categories</strong><span><?= count($categories) ?></span></div>
        <div><strong>Unread Messages</strong><span><?= (int) $unreadMessages ?></span></div>
    </div>
</section>
