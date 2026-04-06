<section class="auth-shell">
    <article class="auth-brand">
        <p class="kicker">Admin Portal</p>
        <h2>Kottramulla United Welfare Society</h2>
        <p>Manage projects, update records, and keep the public site up to date from one secure place.</p>
    </article>

    <article class="card auth-card">
        <h3>Sign In</h3>
        <p class="subtle">Only administrators can access this panel.</p>

        <?php if (!empty($success)): ?>
            <div class="alert success"><?= e($success) ?></div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="alert error"><?= e($error) ?></div>
        <?php endif; ?>

        <form method="post" action="/admin/login" class="stack-form">
            <input type="hidden" name="_csrf" value="<?= e($csrfToken) ?>">

            <label>Email</label>
            <input type="email" name="email" autocomplete="username" required>

            <label>Password</label>
            <input type="password" name="password" autocomplete="current-password" required>

            <button type="submit" class="btn-primary">Log In</button>
        </form>

        <div class="auth-actions">
            <a href="/admin/forgot-password">Forgot password?</a>
            <a href="/">Back to website</a>
        </div>
    </article>
</section>
