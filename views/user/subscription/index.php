<section class="hero">
    <p class="kicker">Monthly Support</p>
    <h2>Become a KUWS Subscriber</h2>
    <p class="subtle">Choose a plan and support ongoing welfare projects in a sustainable way.</p>
</section>

<section class="profile-grid">
    <article class="card">
        <h3>Subscription Plans</h3>
        <div class="plan-grid">
            <?php foreach ($plans as $planCode => $plan): ?>
                <div class="plan-card">
                    <h4><?= e((string) $plan['name']) ?></h4>
                    <p class="subtle">Monthly: LKR <?= number_format((float) $plan['monthly'], 2) ?></p>
                    <p class="subtle">Yearly: LKR <?= number_format((float) $plan['yearly'], 2) ?></p>
                    <small>Code: <?= e((string) $planCode) ?></small>
                </div>
            <?php endforeach; ?>
        </div>
    </article>

    <article class="card">
        <h3>Start Subscription</h3>

        <?php if (!empty($success)): ?>
            <div class="alert success"><?= e($success) ?></div>
        <?php endif; ?>
        <?php if (!empty($error)): ?>
            <div class="alert error"><?= e($error) ?></div>
        <?php endif; ?>

        <form method="post" action="/subscription" class="stack-form">
            <input type="hidden" name="_csrf" value="<?= e($csrfToken) ?>">

            <label>Full Name</label>
            <input type="text" name="full_name" required>

            <label>Email Address</label>
            <input type="email" name="email" required>

            <label>Phone (optional)</label>
            <input type="text" name="phone" maxlength="40">

            <label>Plan</label>
            <select name="plan_code" required>
                <option value="">Select plan</option>
                <?php foreach ($plans as $planCode => $plan): ?>
                    <option value="<?= e((string) $planCode) ?>"><?= e((string) $plan['name']) ?></option>
                <?php endforeach; ?>
            </select>

            <label>Billing Cycle</label>
            <select name="billing_cycle" required>
                <option value="">Select cycle</option>
                <option value="monthly">Monthly</option>
                <option value="yearly">Yearly</option>
            </select>

            <label>Notes (optional)</label>
            <textarea name="notes" rows="3"></textarea>

            <button type="submit" class="btn-primary">Submit Subscription</button>
        </form>
    </article>
</section>
