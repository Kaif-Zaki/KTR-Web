<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restore Access | KUWS</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="<?= url('/public/css/admin/auth.css') ?>">
    <style>
        .auth-container.single { grid-template-columns: 1fr; max-width: 550px; min-height: auto; }
        .form-side { padding: 60px; }
        input[name="token"] { letter-spacing: 0.5em; font-family: monospace; text-align: center; font-weight: 800; color: var(--auth-accent) !important; }
    </style>
</head>
<body class="auth-body">

<section class="auth-container single reveal-container">
    <article class="auth-side form-side">
        <h3>Reset Password</h3>
        <p class="subtle">Enter your reset code and define a new secure password for your account.</p>

        <?php if (!empty($success)): ?>
            <div class="alert success"><?= e($success) ?></div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="alert error"><?= e($error) ?></div>
        <?php endif; ?>

        <form method="post" action="<?= url('/admin/reset-password') ?>">
            <input type="hidden" name="_csrf" value="<?= e($csrfToken) ?>">

            <div class="input-wrapper">
                <label>Admin Email</label>
                <input type="email" name="email" value="<?= e((string) ($prefillEmail ?? '')) ?>" autocomplete="email" placeholder="admin@kuws.org" required>
            </div>

            <div class="input-wrapper">
                <label>Security Code</label>
                <input type="text" name="token" inputmode="numeric" pattern="[0-9]{6}" maxlength="6" placeholder="000000" required>
            </div>

            <div class="input-wrapper">
                <label>New Password</label>
                <input type="password" name="new_password" autocomplete="new-password" placeholder="••••••••" required>
            </div>

            <div class="input-wrapper">
                <label>Confirm Password</label>
                <input type="password" name="new_password_confirmation" autocomplete="new-password" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-login">Update Security Key</button>
        </form>

        <div class="auth-footer">
            <a href="<?= url('/admin/forgot-password') ?>">Send Code Again</a>
            <a href="<?= url('/admin/login') ?>">Back to Login</a>
        </div>
    </article>
</section>

<script>
    (function() {
        document.querySelector('.reveal-container').classList.add('active');
    })();
</script>

</body>
</html>
