<section class="auth-shell single">
    <article class="card auth-card">
        <h3>Reset Password</h3>
        <p class="subtle">Paste your reset code from email and set a new password.</p>

        <?php if (!empty($success)): ?>
            <div class="alert success"><?= e($success) ?></div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="alert error"><?= e($error) ?></div>
        <?php endif; ?>

        <form method="post" action="<?= url('/admin/reset-password') ?>"  class="stack-form">
            <input type="hidden" name="_csrf" value="<?= e($csrfToken) ?>">

            <label>Email</label>
            <input type="email" name="email" value="<?= e((string) ($prefillEmail ?? '')) ?>" autocomplete="email" required>

            <label>Reset Code</label>
            <input type="text" name="token" inputmode="numeric" pattern="[0-9]{6}" maxlength="6" placeholder="6-digit code" required>

            <label>New Password</label>
            <input type="password" name="new_password" autocomplete="new-password" required>

            <label>Confirm New Password</label>
            <input type="password" name="new_password_confirmation" autocomplete="new-password" required>

            <button type="submit" class="btn-primary">Reset Password</button>
        </form>

        <div class="auth-actions">
            <a href="<?= url('/admin/forgot-password') ?>" >Request a new code</a>
            <a href="<?= url('/admin/login') ?>" >Back to login</a>
        </div>
    </article>
</section>
