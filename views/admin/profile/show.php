<section class="card profile-header">
    <p class="kicker">Admin Security</p>
    <h2>Profile Settings</h2>
    <p>Update your login email and password with current-password verification.</p>

    <?php if (!empty($success)): ?>
        <div class="alert success"><?= e($success) ?></div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <div class="alert error"><?= e($error) ?></div>
    <?php endif; ?>

    <div class="stats">
        <div>
            <strong>Name</strong>
            <span><?= e($admin['name']) ?></span>
        </div>
        <div>
            <strong>Current Email</strong>
            <span><?= e($admin['email']) ?></span>
        </div>
    </div>
</section>

<section class="profile-grid">
    <article class="card">
        <h3>Change Email</h3>
        <p class="subtle">We verify your current password before email updates.</p>
        <form method="post" action="/admin/profile/email" class="stack-form">
            <input type="hidden" name="_csrf" value="<?= e($csrfToken) ?>">

            <label>New Email</label>
            <input type="email" name="email" value="<?= e($admin['email']) ?>" autocomplete="email" required>

            <label>Current Password</label>
            <input type="password" name="current_password" autocomplete="current-password" required>

            <button type="submit" class="btn-primary">Update Email</button>
        </form>
    </article>

    <article class="card">
        <h3>Change Password</h3>
        <p class="subtle">Set your new password below.</p>
        <form method="post" action="/admin/profile/password" class="stack-form">
            <input type="hidden" name="_csrf" value="<?= e($csrfToken) ?>">

            <label>Current Password</label>
            <input type="password" name="current_password" autocomplete="current-password" required>

            <label>New Password</label>
            <input type="password" name="new_password" autocomplete="new-password" required>

            <label>Confirm New Password</label>
            <input type="password" name="new_password_confirmation" autocomplete="new-password" required>

            <button type="submit" class="btn-primary">Update Password</button>
        </form>
    </article>
</section>
