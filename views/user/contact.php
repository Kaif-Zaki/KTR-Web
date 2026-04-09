<link rel="stylesheet" href="<?= url('/public/css/user/contact.css') ?>">

<div class="contact-page-wrapper">
    
    <!-- Background Decor (same as home for consistency) -->
    <div class="contact-bloom"></div>

    <div class="contact-container">
        
        <!-- Left Column: Info & Context (Reveal from Left) -->
        <div class="contact-info reveal-text">
            <span class="hero-kicker">Get In Touch</span>
            <h1 class="page-title">Let's start a <span class="accent-text">conversation.</span></h1>
            <p class="page-sub">Whether you're looking to volunteer, donate, or just have a question about our welfare society, our team is ready to listen.</p>

            <div class="contact-methods">
                <div class="method-item">
                    <div class="method-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    </div>
                    <div class="method-content">
                        <h4>Location</h4>
                        <p>Kottramulla, Sri Lanka</p>
                    </div>
                </div>

                <div class="method-item">
                    <div class="method-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </div>
                    <div class="method-content">
                        <h4>Email Us</h4>
                        <p>hello@kuws.org</p>
                    </div>
                </div>

                <div class="method-item">
                    <div class="method-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    </div>
                    <div class="method-content">
                        <h4>Call Us</h4>
                        <p>+94 11 234 5678</p>
                    </div>
                </div>
            </div>

            <div class="social-connect">
                <p>Follow our journey</p>
                <div class="social-links">
                    <a href="#" class="social-btn">FB</a>
                    <a href="#" class="social-btn">IG</a>
                    <a href="#" class="social-btn">LI</a>
                </div>
            </div>
        </div>

        <!-- Right Column: Interactive Form (Reveal from Bottom) -->
        <div class="contact-form-card reveal-container">
            <div class="glass-bg"></div>
            
            <form action="<?= url('/contact') ?>" method="POST" class="form-actual">
                <input type="hidden" name="_csrf" value="<?= \App\Core\Csrf::token() ?>">

                <div class="form-row">
                    <div class="input-group">
                        <label>Your Name</label>
                        <input type="text" name="name" placeholder="John Doe" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="input-group">
                        <label>Email Address</label>
                        <input type="email" name="email" placeholder="john@example.com" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="input-group">
                        <label>Subject (Optional)</label>
                        <input type="text" name="subject" placeholder="What's this about?">
                    </div>
                </div>

                <div class="form-row">
                    <div class="input-group">
                        <label>Message</label>
                        <textarea name="message" rows="5" placeholder="How can we help you today?" required></textarea>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <span>Send Message</span>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="22" y1="2" x2="11" y2="13"/><polyline points="22 2 15 22 11 13 2 9 22 2"/></svg>
                    </button>
                    
                    <a href="https://wa.me/94727429936" target="_blank" class="whatsapp-quick-link">
                        <div class="wa-icon">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.09.543 4.054 1.492 5.762L0 24l6.384-1.472A11.954 11.954 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.007-1.37l-.36-.213-3.724.858.887-3.63-.234-.373A9.818 9.818 0 1112 21.818z"/></svg>
                        </div>
                        <span>WhatsApp Quick Chat</span>
                    </a>
                </div>
            </form>
        </div>

    </div>
</div>

