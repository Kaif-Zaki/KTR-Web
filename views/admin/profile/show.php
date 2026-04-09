<div class="profile-container">
    <div class="profile-page-header">
        <div class="header-content">
            <span class="preview-badge">Security Hub</span>
            <h1 class="page-title">Profile Settings</h1>
            <p class="page-desc">Manage your administrative credentials and security preferences.</p>
        </div>
        
        <div class="profile-id-card">
            <div class="id-avatar">
                <?= mb_strtoupper(mb_substr(e($admin['name']), 0, 1)) ?>
            </div>
            <div class="id-meta">
                <div class="id-name"><?= e($admin['name']) ?></div>
                <div class="id-email"><?= e($admin['email']) ?> <span class="status-dot"></span> Active</div>
            </div>
        </div>
    </div>

    <?php if (!empty($success)): ?>
        <div class="alert success"><?= e($success) ?></div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <div class="alert error"><?= e($error) ?></div>
    <?php endif; ?>

    <div class="profile-grid">
        <!-- EMAIL CARD -->
        <article class="interactive-card form-card">
            <div class="card-hero bluish">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
            </div>
            <div class="card-content">
                <h3 class="card-title">Update Email Address</h3>
                <p class="card-sub">Updating your primary contact requires your current password to verify your identity.</p>
                
                <form method="post" action="<?= url('/admin/profile/email') ?>" class="profile-form">
                    <input type="hidden" name="_csrf" value="<?= e($csrfToken) ?>">
                    
                    <div class="form-group">
                        <label class="form-label">New Email Address</label>
                        <div class="input-icon-wrap">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path></svg>
                            <input type="email" name="email" class="form-input" value="<?= e($admin['email']) ?>" autocomplete="email" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Current Password</label>
                        <div class="input-icon-wrap">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                            <input type="password" name="current_password" class="form-input" autocomplete="current-password" required>
                        </div>
                    </div>

                    <button type="submit" class="btn-primary-admin">Verify & Update Email</button>
                </form>
            </div>
        </article>

        <!-- PASSWORD CARD -->
        <article class="interactive-card form-card">
            <div class="card-hero purplish">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 18v3c0 .6.4 1 1 1h4v-3h3v-3h2l1.4-1.4a6.5 6.5 0 1 0-4-4Z"></path><circle cx="16.5" cy="7.5" r=".5" fill="currentColor"></circle></svg>
            </div>
            <div class="card-content">
                <h3 class="card-title">Change Password</h3>
                <p class="card-sub">Ensure your account uses a long, random password to stay secure.</p>
                
                <form method="post" action="<?= url('/admin/profile/password') ?>" class="profile-form">
                    <input type="hidden" name="_csrf" value="<?= e($csrfToken) ?>">
                    
                    <div class="form-group">
                        <label class="form-label">Wait, verify current password</label>
                        <div class="input-icon-wrap">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                            <input type="password" name="current_password" class="form-input" autocomplete="current-password" required>
                        </div>
                    </div>

                    <div class="form-group border-top">
                        <label class="form-label">New Secure Password</label>
                        <div class="input-icon-wrap">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                            <input type="password" name="new_password" class="form-input" autocomplete="new-password" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Confirm New Password</label>
                        <div class="input-icon-wrap">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                            <input type="password" name="new_password_confirmation" class="form-input" autocomplete="new-password" required>
                        </div>
                    </div>

                    <button type="submit" class="btn-primary-admin feature-btn">Save New Password</button>
                </form>
            </div>
        </article>
    </div>
</div>
