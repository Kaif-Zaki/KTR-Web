<!DOCTYPE html>
<html lang="en">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= url('/public/css/app.css') ?>">
            .brand-side p { margin: 0 auto; }
            .form-side { padding: 3rem 2rem; }
        }
    </style>
</head>
<body class="auth-body">

<section class="auth-container">
    <article class="auth-side brand-side">
        <span class="kicker">Admin Portal</span>
        <h2>Secure<br>System<br>Access.</h2>
        <p>Authorized access only. Use your encrypted credentials to manage society operations.</p>
    </article>

    <article class="auth-side form-side">
        <h3>Welcome Back</h3>
        <p class="subtle">Please sign in to your dashboard.</p>

        <?php if (!empty($success)): ?>
            <div class="alert success"><?= e($success) ?></div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="alert error"><?= e($error) ?></div>
        <?php endif; ?>

        <form method="post" action="<?= url('/admin/login') ?>">
            <input type="hidden" name="_csrf" value="<?= e($csrfToken) ?>">

            <div class="input-wrapper">
                <label>System Identifier (Email)</label>
                <input type="email" name="email" autocomplete="username" placeholder="admin@kuws.org" required>
            </div>

            <div class="input-wrapper">
                <label>Security Key (Password)</label>
                <input type="password" name="password" autocomplete="current-password" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-login">Open Dashboard</button>
        </form>

        <div class="auth-footer">
            <a href="<?= url('/admin/forgot-password') ?>">Forgot credentials?</a>
            <a href="<?= url('/') ?>">Return to Website</a>
        </div>
    </article>
</section>

</body>
</html>