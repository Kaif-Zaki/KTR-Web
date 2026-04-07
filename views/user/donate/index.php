<section class="hero">
    <p class="kicker">Support Our Mission</p>
    <h2>Make a Contribution</h2>
    <p class="subtle">Your support helps us continue welfare projects for the community.</p>
</section>

<section class="profile-grid">
    <article class="card">
        <h3>Why Donate?</h3>
        <div class="stats" style="grid-template-columns: 1fr;">
            <div><strong>Transparency</strong><span>Donations are tracked and used for welfare activities.</span></div>
            <div><strong>Impact</strong><span>Supports relief, education, health, and livelihood projects.</span></div>
        </div>
    </article>

    <article class="card">
        <?php if (!empty($success)): ?>
            <div class="alert success"><?= e($success) ?></div>
        <?php endif; ?>
        <?php if (!empty($error)): ?>
            <div class="alert error"><?= e($error) ?></div>
        <?php endif; ?>

        <form method="post" action="<?= url('/donate') ?>"  class="stack-form">
            <input type="hidden" name="_csrf" value="<?= e($csrfToken) ?>">

            <label>Full Name</label>
            <input type="text" name="donor_name" required>

            <label>Email Address</label>
            <input type="email" name="email" required>

            <label>Amount (LKR)</label>
            <input type="number" name="amount" step="0.01" required min="100">

            <label>Project (optional)</label>
            <select name="project_id">
                <option value="">Select project</option>
                <?php foreach ($projects as $project): ?>
                    <option value="<?= (int) $project['id'] ?>"><?= e($project['title']) ?></option>
                <?php endforeach; ?>
            </select>

            <label>Message (optional)</label>
            <textarea name="message" rows="3"></textarea>

            <button type="submit" class="btn-primary">Submit Donation</button>
        </form>
    </article>
</section>
