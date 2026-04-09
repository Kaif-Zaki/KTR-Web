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
    </style>
</head>
<body class="auth-body">

<section class="auth-container single reveal-container">
    <article class="auth-side form-side">
        <h3>Forgot Password</h3>
        <p class="subtle">Enter your administrative email address to receive a secure reset code.</p>

        <?php if (!empty($success)): ?>
            <div class="alert success"><?= e($success) ?></div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="alert error"><?= e($error) ?></div>
        <?php endif; ?>

        <form method="post" action="<?= url('/admin/forgot-password') ?>">
            <input type="hidden" name="_csrf" value="<?= e($csrfToken) ?>">

            <div class="input-wrapper">
                <label>Admin Email Address</label>
                <input type="email" name="email" autocomplete="email" placeholder="admin@kuws.org" required>
            </div>

            <button type="submit" class="btn-login">Request Reset Code</button>
        </form>

        <div class="auth-footer">
            <a href="<?= url('/admin/login') ?>">Back to Login</a>
            <a href="<?= url('/admin/reset-password') ?>">Have a code?</a>
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
