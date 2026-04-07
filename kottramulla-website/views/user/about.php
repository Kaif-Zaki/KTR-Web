

<section class="about-hero">
    <span class="kicker">Who We Are</span>
    <h1 class="about-title">Know who we are <br>and why we serve.</h1>
</section>

<div class="about-container">
    <?php if ($about): ?>
        <div class="about-text-content">
            <h3 class="kicker" style="color: #9ca3af; margin-bottom: 1rem;"><?= e($about['title']) ?></h3>
            
            <div class="about-body">
                <?= nl2br(e($about['body'])) ?>
            </div>

            <div class="mission-highlight">
                "Together, we can create lasting change and inspire others to lend a helping hand."
            </div>

            <div class="about-stats">
                <div class="stat-pill">
                    <span class="stat-label">Established</span>
                    <span class="stat-value"><?= e((string) $about['established_year']) ?></span>
                </div>
                <div class="stat-pill">
                    <span class="stat-label">Dedicated Volunteers</span>
                    <span class="stat-value"><?= e((string) $about['volunteer_count']) ?></span>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="about-text-content">
            <p class="about-body" style="color: #9ca3af;">
                [cite_start]The Kottramulla United Welfare Society was established in March 2016[cite: 1]. 
                [cite_start]We are a dedicated team of 28 volunteers driven by our passion to serve our community[cite: 2].
            </p>
            <p class="about-body">
                [cite_start]Every member of our team is a volunteer, committing their time and expertise to our cause[cite: 5]. 
                [cite_start]We operate on a subscription-based model to fuel our mission of helping others[cite: 4, 9].
            </p>
        </div>
    <?php endif; ?>
</div>