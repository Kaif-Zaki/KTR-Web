<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalize Reset | KUWS</title>
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

        /* ── Centered Vault Card ── */
        .auth-shell {
            width: 100%;
            max-width: 540px;
            padding: 2.5rem;
            animation: slideUp 0.7s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .auth-card {
            background: #ffffff;
            padding: 4rem;
            border-radius: 40px;
            border: 1px solid #f0f0f0;
            /* High-Visibility Elevation */
            box-shadow: 
                0 40px 100px -20px rgba(0, 0, 0, 0.08),
                0 20px 40px -15px rgba(0, 0, 0, 0.05);
        }

        h3 {
            font-family: 'Helvetica Light', sans-serif;
            font-size: 2.25rem;
            color: #111827;
            margin-bottom: 0.75rem;
            letter-spacing: -0.02em;
        }

        .subtle {
            color: #6b7280;
            font-size: 0.85rem;
            line-height: 1.6;
            margin-bottom: 2.5rem;
            display: block;
        }

        /* ── Form Logic ── */
        .stack-form {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .field-unit label {
            display: block;
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: #9ca3af;
            margin-bottom: 0.75rem;
            font-weight: 700;
        }

        .field-unit input {
            width: 100%;
            padding: 1.1rem 1.25rem;
            border-radius: 15px;
            border: 2px solid #f3f4f6;
            background: #f9fafb;
            font-size: 1rem;
            transition: all 0.3s ease;
            outline: none;
            color: #111827;
        }

        .field-unit input:focus {
            border-color: #111827;
            background: #ffffff;
            box-shadow: 0 10px 20px -10px rgba(0,0,0,0.1);
        }

        /* Special Styling for Reset Code */
        input[name="token"] {
            letter-spacing: 0.5em;
            font-family: monospace;
            font-weight: 700;
            text-align: center;
            font-size: 1.2rem;
            color: #10b981;
        }

        /* ── Emerald Action Button ── */
        .btn-primary {
            width: 100%;
            background: #111827;
            color: #ffffff;
            padding: 1.25rem;
            border-radius: 100px;
            font-weight: 700;
            letter-spacing: 0.05em;
            font-size: 0.85rem;
            margin-top: 1.5rem;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            border: none;
            cursor: pointer;
        }

        .btn-primary:hover {
            background: #10b981;
            transform: translateY(-5px);
            box-shadow: 0 20px 30px -10px rgba(16, 185, 129, 0.3);
        }

        /* ── Feedback Alerts ── */
        .alert {
            padding: 1.25rem;
            border-radius: 15px;
            font-size: 0.8rem;
            margin-bottom: 2rem;
            border: 1px solid transparent;
            line-height: 1.5;
        }
        .alert.error { background: #fef2f2; color: #991b1b; border-color: #fee2e2; }
        .alert.success { background: #f0fdf4; color: #166534; border-color: #dcfce7; }

        /* ── Navigation ── */
        .auth-actions {
            margin-top: 2.5rem;
            display: flex;
            justify-content: space-between;
            padding-top: 2rem;
            border-top: 1px solid #f3f4f6;
        }

        .auth-actions a {
            font-size: 0.75rem;
            color: #9ca3af;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
        }

        .auth-actions a:hover {
            color: #111827;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 600px) {
            .auth-card { padding: 2.5rem 2rem; }
            .auth-actions { flex-direction: column; gap: 1rem; text-align: center; }
        }
    </style>
</head>
<body>

<section class="auth-shell single">
    <article class="auth-card">
        <h3>Reset Password</h3>
        <p class="subtle">Enter the verification code dispatched to your inbox and define a new secure password for your administrator account.</p>

        <?php if (!empty($success)): ?>
            <div class="alert success"><?= e($success) ?></div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="alert error"><?= e($error) ?></div>
        <?php endif; ?>

        <form method="post" action="<?= url('/admin/reset-password') ?>" class="stack-form">
            <input type="hidden" name="_csrf" value="<?= e($csrfToken) ?>">

            <div class="field-unit">
                <label>Admin Email</label>
                <input type="email" name="email" value="<?= e((string) ($prefillEmail ?? '')) ?>" autocomplete="email" placeholder="admin@kuws.org" required>
            </div>

            <div class="field-unit">
                <label>6-Digit Reset Code</label>
                <input type="text" name="token" inputmode="numeric" pattern="[0-9]{6}" maxlength="6" placeholder="000000" required>
            </div>

            <div class="field-unit">
                <label>New Security Password</label>
                <input type="password" name="new_password" autocomplete="new-password" placeholder="••••••••" required>
            </div>

            <div class="field-unit">
                <label>Confirm Password</label>
                <input type="password" name="new_password_confirmation" autocomplete="new-password" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-primary">Update Password</button>
        </form>

        <div class="auth-actions">
            <a href="<?= url('/admin/forgot-password') ?>">Resend Code</a>
            <a href="<?= url('/admin/login') ?>">Back to Sign In</a>
        </div>
    </article>
</section>

</body>
</html>