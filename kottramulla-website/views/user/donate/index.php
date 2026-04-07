

<main class="donate-wrapper">
    <div class="donate-grid">
        
        <div class="impact-side">
            <span class="kicker">Support Our Mission</span>
            <h1 class="donate-title">Make a <br>Contribution.</h1>
            
            <div class="impact-card">
                <div class="impact-item">
                    <div class="icon-box">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <div class="impact-content">
                        <h4>Transparency</h4>
                        <p>100% of donations are tracked and utilized exclusively for community welfare activities.</p>
                    </div>
                </div>

                <div class="impact-item">
                    <div class="icon-box">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <div class="impact-content">
                        <h4>Impact</h4>
                        <p>Your support directly fuels relief, education, health, and livelihood projects in the region.</p>
                    </div>
                </div>

                <div class="impact-item">
                    <div class="icon-box">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <div class="impact-content">
                        <h4>Collective Power</h4>
                        <p>Join a network of volunteers and well-wishers dedicated to making a tangible difference.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="donate-form-area">
            <?php if (!empty($success)): ?>
                <div class="alert success"><?= e($success) ?></div>
            <?php endif; ?>
            <?php if (!empty($error)): ?>
                <div class="alert error"><?= e($error) ?></div>
            <?php endif; ?>

            <form method="post" action="<?= url('/donate') ?>">
                <input type="hidden" name="_csrf" value="<?= e($csrfToken) ?>">

                <div class="form-group">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="donor_name" class="form-input" placeholder="Your identity" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-input" placeholder="name@provider.com" required>
                </div>

                <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                    <div class="form-group">
                        <label class="form-label">Amount (LKR)</label>
                        <input type="number" name="amount" class="form-input" placeholder="Min. 100" step="0.01" required min="100">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Target Project</label>
                        <select name="project_id">
                            <option value="">General Welfare</option>
                            <?php foreach ($projects as $project): ?>
                                <option value="<?= (int) $project['id'] ?>"><?= e($project['title']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Personal Message</label>
                    <textarea name="message" class="form-input" rows="2" placeholder="Your words of support (optional)"></textarea>
                </div>

                <button type="submit" class="btn-donate">Submit Donation</button>
            </form>
        </div>

    </div>
</main>