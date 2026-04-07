<style>
    /* Premium design preserved exactly */
    .contact-wrapper { padding: 12rem 5rem 10rem; background-color: #ffffff; background-image: radial-gradient(circle at 2px 2px, #f1f5f9 1px, transparent 0); background-size: 40px 40px; min-height: 100vh; }
    .contact-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 6rem; max-width: 1200px; margin: 0 auto; align-items: center; }
    .kicker { font-family: 'SesamiFutura', sans-serif; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.4em; color: #ec4899; margin-bottom: 2rem; display: block; }
    .contact-title { font-family: 'Helvetica Light', Helvetica, sans-serif; font-size: clamp(2.5rem, 4vw, 4rem); font-weight: 300; line-height: 1.1; color: #0f172a; margin-bottom: 3.5rem; }
    .form-group { margin-bottom: 2.5rem; }
    .form-label { font-family: 'SesamiFutura', sans-serif; font-size: 0.6rem; text-transform: uppercase; letter-spacing: 0.2em; color: #94a3b8; margin-bottom: 0.5rem; display: block; }
    .form-input { width: 100%; background: transparent; border: none; border-bottom: 1px solid #e2e8f0; padding: 0.75rem 0; font-family: 'SesamiFutura', sans-serif; font-size: 0.95rem; color: #0f172a; outline: none; transition: border-color 0.4s ease; }
    .form-input:focus { border-bottom-color: #ec4899; }
    .btn-submit { background: #0f172a; color: #ffffff; border: none; padding: 1rem 3.5rem; border-radius: 8px; font-family: 'SesamiFutura', sans-serif; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.3em; cursor: pointer; transition: all 0.3s ease; }
    .btn-submit:hover { background: #ec4899; transform: translateY(-2px); box-shadow: 0 10px 20px rgba(236, 72, 153, 0.2); }
    .premium-dark-card { background: #0f172a; padding: 4rem; border-radius: 32px; color: #ffffff; box-shadow: 0 40px 80px -15px rgba(15, 23, 42, 0.25); border: 1px solid rgba(255, 255, 255, 0.05); display: flex; flex-direction: column; gap: 3rem; position: relative; overflow: hidden; }
    .info-item { display: flex; align-items: flex-start; gap: 1.5rem; }
    .icon-box { width: 44px; height: 44px; background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #ec4899; flex-shrink: 0; }
    .info-content { display: flex; flex-direction: column; gap: 0.4rem; }
    .info-label { font-family: 'SesamiFutura', sans-serif; font-size: 0.6rem; text-transform: uppercase; letter-spacing: 0.25em; color: #64748b; }
    .info-text { font-family: 'SesamiFutura', sans-serif; font-size: 1rem; color: #f8fafc; line-height: 1.5; font-weight: 300; }
    
    /* Added subtle alert styles */
    .alert-container { margin-bottom: 2rem; font-family: 'SesamiFutura', sans-serif; font-size: 0.85rem; border-radius: 12px; padding: 1rem; }
    .alert-success { background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; }
    .alert-error { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }

    @media (max-width: 1024px) { .contact-grid { grid-template-columns: 1fr; gap: 4rem; } .contact-wrapper { padding: 10rem 2rem 5rem; } }
</style>

<main class="contact-wrapper">
    <div class="contact-grid">
        <div class="contact-form-area">
            <span class="kicker">Inquiry</span>
            <h1 class="contact-title">Reach out to <br>our foundation.</h1>

            <?php if ($success = \App\Core\Session::flash('success')): ?>
                <div class="alert-container alert-success">
                    <strong>Success!</strong> <?= e($success) ?>
                </div>
            <?php endif; ?>

            <?php if ($error = \App\Core\Session::flash('error')): ?>
                <div class="alert-container alert-error">
                    <strong>Error:</strong> <?= e($error) ?>
                </div>
            <?php endif; ?>
            <form action="<?= url('/contact') ?>" method="POST">
                <input type="hidden" name="_csrf" value="<?= \App\Core\Csrf::token() ?>">

                <div class="form-group">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-input" placeholder="Your name" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-input" placeholder="email@example.com" required>
                </div>

                <div class="form-group">
                    <label class="form-label">How can we help?</label>
                    <textarea name="message" class="form-input" rows="2" placeholder="Tell us about your interest" required></textarea>
                </div>

                <button type="submit" class="btn-submit">Send</button>
            </form>
        </div>

        <div class="premium-dark-card">
            <div class="info-item">
                <div class="icon-box">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <div class="info-content">
                    <span class="info-label">Presence</span>
                    <p class="info-text">Kottramulla, <br>Sri Lanka</p>
                </div>
            </div>

            <div class="info-item">
                <div class="icon-box">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <div class="info-content">
                    <span class="info-label">Connection</span>
                    <p class="info-text">hello@kuws.org <br>+94 000 000 000</p>
                </div>
            </div>

            <div class="info-item">
                <div class="icon-box">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <div class="info-content">
                    <span class="info-label">Foundation</span>
                    <p class="info-text">28 Volunteers <br>Since March 2016</p>
                </div>
            </div>
        </div>
    </div>
</main>