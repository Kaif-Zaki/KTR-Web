<section class="hero">
    <h2>Contact Us</h2>
    <p>Send your message and our admin team will reply to your email.</p>
</section>

<section class="card">
    <?php if (!empty($contactSuccess)): ?>
        <div class="alert success"><?= e($contactSuccess) ?></div>
    <?php endif; ?>

    <?php if (!empty($contactError)): ?>
        <div class="alert error"><?= e($contactError) ?></div>
    <?php endif; ?>

    <form method="post" action="<?= url('/contact') ?>"  class="stack-form">
        <input type="hidden" name="_csrf" value="<?= e($csrfToken) ?>">

        <label>Your Name</label>
        <input type="text" name="name" required>

        <label>Your Email</label>
        <input type="email" name="email" required>

        <label>Subject (optional)</label>
        <input type="text" name="subject">

        <label>Message</label>
        <textarea name="message" rows="5" required></textarea>

        <button type="submit" class="btn-primary">Send Message</button>
    </form>
</section>
