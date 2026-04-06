<?php include __DIR__ . '/../layouts/header.php'; ?>

<main>
    <div class="wrap">
        <div class="profile-grid">
            <div class="card">
                <p class="kicker">Support Our Mission</p>
                <h1>Make a Contribution</h1>
                <p class="subtle">Your contribution helps the <strong>Kottramulla United Welfare Society</strong> continue its work, from distributing 400 packs of dry food to empowering families with sewing machines.</p>
                
                <div class="category-block">
                    <div class="stats" style="grid-template-columns: 1fr;">
                        <div><strong>Transparency</strong>100% of donations go to projects.</div>
                        <div><strong>Impact</strong>View our project reports in the gallery.</div>
                    </div>
                </div>
            </div>

            <div class="card">
                <?php if (isset($status) && $status === 'success'): ?>
                    <div class="alert success">Thank you! Your donation has been submitted.</div>
                <?php elseif (isset($status) && $status === 'error'): ?>
                    <div class="alert error">Something went wrong. Please try again.</div>
                <?php endif; ?>

                <form action="/kottramulla-website/donate/submit" method="POST" class="stack-form">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="donor_name" required placeholder="Enter your name">
                    </div>

                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" required placeholder="email@example.com">
                    </div>

                    <div class="row-between">
                        <div style="flex: 1;">
                            <label>Amount (Rs.)</label>
                            <input type="number" name="amount" style="width: 100%;" required min="100">
                        </div>
                        <div style="flex: 1;">
                            <label>Type</label>
                            <select name="type" style="width: 100%;" required>
                                <option value="one-time">One-time</option>
                                <option value="monthly">Monthly</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Message (Optional)</label>
                        <textarea name="message" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn-primary" style="width: 100%;">Submit Donation</button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include __DIR__ . '/../layouts/footer.php'; ?>