<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Access | KUWS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @font-face {
            font-family: 'Helvetica Light';
            src: url('<?= url("/public/fonts/Helvetica-Light.woff2") ?>') format('woff2');
            font-weight: 300;
        }
        @font-face {
            font-family: 'SesamiFutura';
            src: url('<?= url("/public/fonts/SesamiFutura.woff2") ?>') format('woff2');
            font-weight: 400;
        }

        body {
            margin: 0;
            padding: 0;
            background: #fcfcfc;
            font-family: 'SesamiFutura', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* ── Centered Security Card ── */
        .auth-shell {
            width: 100%;
            max-width: 500px;
            padding: 2rem;
            animation: fadeIn 0.6s ease-out;
        }

        .auth-card {
            background: #ffffff;
            padding: 3.5rem;
            border-radius: 40px;
            border: 1px solid #f0f0f0;
            /* High-Visibility Shadow matching the Login page */
            box-shadow: 
                0 40px 100px -20px rgba(0, 0, 0, 0.08),
                0 20px 40px -15px rgba(0, 0, 0, 0.05);
        }

        h3 {
            font-family: 'Helvetica Light', sans-serif;
            font-size: 2rem;
            color: #111827;
            margin-bottom: 0.75rem;
            letter-spacing: -0.02em;
        }

        .subtle {
            color: #6b7280;
            font-size: 0.9rem;
            line-height: 1.6;
            margin-bottom: 2.5rem;
            display: block;
        }

        /* ── Form Styling ── */
        .stack-form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .stack-form label {
            display: block;
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: #9ca3af;
            margin-bottom: 0.75rem;
            font-weight: 700;
        }

        .stack-form input {
            width: 100%;
            padding: 1.25rem;
            border-radius: 15px;
            border: 2px solid #f3f4f6;
            background: #f9fafb;
            font-size: 1rem;
            transition: all 0.3s ease;
            outline: none;
        }

        .stack-form input:focus {
            border-color: #111827;
            background: #ffffff;
            box-shadow: 0 10px 20px -10px rgba(0,0,0,0.1);
        }

        /* ── Button with Emerald Hover ── */
        .btn-primary {
            width: 100%;
            background: #111827;
            color: #ffffff;
            padding: 1.25rem;
            border-radius: 100px;
            font-weight: 700;
            letter-spacing: 0.05em;
            font-size: 0.85rem;
            margin-top: 1rem;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            border: none;
            cursor: pointer;
        }

        .btn-primary:hover {
            background: #10b981; /* Emerald */
            transform: translateY(-5px);
            box-shadow: 0 20px 30px -10px rgba(16, 185, 129, 0.3);
        }

        /* ── Alerts ── */
        .alert {
            padding: 1.1rem;
            border-radius: 15px;
            font-size: 0.85rem;
            margin-bottom: 2rem;
            border: 1px solid transparent;
            line-height: 1.5;
        }
        .alert.error { background: #fef2f2; color: #991b1b; border-color: #fee2e2; }
        .alert.success { background: #f0fdf4; color: #166534; border-color: #dcfce7; }

        /* ── Footer Actions ── */
        .auth-actions {
            margin-top: 2.5rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            padding-top: 2rem;
            border-top: 1px solid #f3f4f6;
            text-align: center;
        }

        .auth-actions a {
            font-size: 0.8rem;
            color: #9ca3af;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
        }

        .auth-actions a:hover {
            color: #111827;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<section class="auth-shell single">
    <article class="auth-card">
        <h3>Forgot Password</h3>
        <p class="subtle">Provide your administrative email. If the account exists, we will transmit a security reset code immediately.</p>

        <?php if (!empty($success)): ?>
            <div class="alert success"><?= e($success) ?></div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="alert error"><?= e($error) ?></div>
        <?php endif; ?>

        <form method="post" action="<?= url('/admin/forgot-password') ?>" class="stack-form">
            <input type="hidden" name="_csrf" value="<?= e($csrfToken) ?>">

            <div class="field-group">
                <label>Registered Admin Email</label>
                <input type="email" name="email" autocomplete="email" placeholder="e.g. admin@kuws.org" required>
            </div>

            <button type="submit" class="btn-primary">Request Security Code</button>
        </form>

        <div class="auth-actions">
            <a href="<?= url('/admin/reset-password') ?>" style="color: #10b981;">I already have a reset code</a>
            <a href="<?= url('/admin/login') ?>">Return to Login</a>
        </div>
    </article>
</section>

</body>
</html>