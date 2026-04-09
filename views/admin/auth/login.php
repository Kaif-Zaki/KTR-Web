<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Access | KUWS</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="<?= url('/public/css/admin/auth.css') ?>">
</head>
<body class="auth-body">

<section class="auth-container">
    <article class="auth-side brand-side reveal-text">
        <span class="kicker">Security Protocol</span>
        <h2>Secure<br>System<br>Access.</h2>
        <p>Authorized personnel only. Please verify your credentials to manage society operations.</p>
    </article>

    <article class="auth-side form-side reveal-container">
        <h3>Welcome Back</h3>
        <p class="subtle">Access your administrative dashboard.</p>

        <?php if (!empty($success)): ?>
            <div class="alert success"><?= e($success) ?></div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="alert error"><?= e($error) ?></div>
        <?php endif; ?>

        <form method="post" action="<?= url('/admin/login') ?>">
            <input type="hidden" name="_csrf" value="<?= e($csrfToken) ?>">

            <div class="input-wrapper">
                <label>System Identifier</label>
                <input type="email" name="email" autocomplete="username" placeholder="admin@kuws.org" required>
            </div>

            <div class="input-wrapper">
                <label>Security Key</label>
                <input type="password" name="password" autocomplete="current-password" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-login">Open Dashboard</button>
        </form>

        <div class="auth-footer">
            <a href="<?= url('/admin/forgot-password') ?>">Forgot Credentials?</a>
            <a href="<?= url('/') ?>">Public Website</a>
        </div>
    </article>
</section>

<script>
    (function() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('active');
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.reveal-text, .reveal-container').forEach(el => observer.observe(el));
        
        // Immediate activation for login components
        setTimeout(() => {
            document.querySelectorAll('.reveal-text, .reveal-container').forEach(el => el.classList.add('active'));
        }, 100);
    })();
</script>

</body>
</html>
