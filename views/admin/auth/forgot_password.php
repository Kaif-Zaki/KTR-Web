<section class="auth-shell single">
    <article class="card auth-card">
        <h3>Forgot Password</h3>
        <p class="subtle">Enter your admin email to receive a reset code.</p>

        <?php if (!empty($success)): ?>
            <div class="alert success"><?= e($success) ?></div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="alert error"><?= e($error) ?></div>
        <?php endif; ?>

        <form method="post" action="<?= url('/admin/forgot-password') ?>"  class="stack-form">
            <input type="hidden" name="_csrf" value="<?= e($csrfToken) ?>">

            <label>Email</label>
            <input type="email" name="email" autocomplete="email" required>

            <button type="submit" class="btn-primary">Send Reset Code</button>
        </form>

        <div class="auth-actions">
            <a href="<?= url('/admin/reset-password') ?>" >I already have a code</a>
            <a href="<?= url('/admin/login') ?>" >Back to login</a>
        </div>
    </article>
</section>
