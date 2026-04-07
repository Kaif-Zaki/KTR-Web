<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KUWS | Kottramulla United Welfare Society</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<section class="hero-section">
    <div class="hero-left">
        <div class="hero-entrance-icon">
            <div class="icon-circle">✦</div>
            <span class="text-[0.65rem] uppercase tracking-[0.3em] text-[#4ade80]">Society of Hope</span>
        </div>
        <h1 class="hero-headline">
            Empowering<br>Communities.<br>
            <span class="faded">Inspiring Hope.</span>
        </h1>
        <p class="text-[#9ca3af] text-[0.78rem] max-w-[18rem] leading-[1.8] mt-6 opacity-0" style="animation: fadeInUp 1s cubic-bezier(0.16, 1, 0.3, 1) 0.5s forwards;">
            We bring people together to support, uplift, and create lasting change within our community.
        </p>
        
        <div class="flex items-center gap-5 mt-10 opacity-0" style="animation: fadeInUp 1s cubic-bezier(0.16, 1, 0.3, 1) 0.7s forwards;">
            <a href="<?= url('/projects') ?>" class="flex items-center gap-2 px-8 py-3.5 rounded-full border border-[#fce7f3] text-[0.78rem] text-[#6b7280] hover:text-[#111827] transition-all bg-white shadow-sm hover:-translate-y-1">
                <span class="text-pink-400">❤</span> Projects
            </a>
            <a href="<?= url('/contact') ?>" class="flex items-center gap-2 px-8 py-3.5 rounded-full border border-[#4ade80] text-[0.78rem] text-[#6b7280] hover:text-[#111827] transition-all bg-white shadow-sm hover:-translate-y-1">
                <span class="text-green-400">💬</span> Contact
            </a>
        </div>
    </div>

    <div class="hero-right">
        <div class="thought-overlay">
            <div class="thought-bubble t-1">❤ "We rise by lifting others."</div>
            <div class="thought-bubble t-2">✦ "Kindness is a language."</div>
            <div class="thought-bubble t-3">☀ "Unity is our strength."</div>
            <div class="thought-bubble t-4">🌱 "Small acts, big impact."</div>
            <div class="thought-bubble t-5">🤝 "Stronger together."</div>
            <div class="thought-bubble t-6">✨ "Service is the rent we pay."</div>
        </div>
        <img src="<?= url('/public/images/home/hero.jpg') ?>" alt="Kottramulla United Welfare Society">
    </div>
</section>

<section class="py-32 px-8 md:px-20 bg-white reveal">
    <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-16 items-center">
        <div>
            <h4 class="text-pink-400 font-bold uppercase tracking-[0.3em] text-[10px] mb-4">Our Legacy</h4>
            <h2 class="text-4xl md:text-5xl font-light text-gray-900 leading-tight mb-8" style="font-family: 'Helvetica Light', sans-serif;">
                Since <span class="text-green-500">March 2016</span>,<br>unity has been our foundation.
            </h2>
            <p class="text-gray-500 leading-relaxed mb-10 text-sm">
                Established in Kottramulla, KUWS is dedicated to improving lives through collective welfare. We believe in building a future where no neighbor is left behind.
            </p>
            <div class="flex gap-12">
                <div><span class="block text-3xl font-light text-gray-900">250+</span><span class="text-[10px] uppercase tracking-widest text-gray-400">Active Members</span></div>
                <div><span class="block text-3xl font-light text-gray-900">40+</span><span class="text-[10px] uppercase tracking-widest text-gray-400">Projects Done</span></div>
            </div>
        </div>
        <div class="relative">
            <div class="aspect-[4/5] rounded-[3rem] overflow-hidden shadow-2xl">
                <img src="<?= url('/public/images/home/about-side.jpg') ?>" class="w-full h-full object-cover" alt="Community Support">
            </div>
        </div>
    </div>
</section>

<section class="py-32 px-8 md:px-20 bg-gray-50/20 reveal">
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-end mb-16">
            <div>
                <h4 class="text-green-400 font-bold uppercase tracking-[0.3em] text-[10px] mb-4">Focus Areas</h4>
                <h2 class="text-3xl font-light text-gray-900" style="font-family: 'Helvetica Light', sans-serif;">Strategic Initiatives</h2>
            </div>
            <a href="<?= url('/projects') ?>" class="text-[10px] uppercase tracking-widest font-bold text-pink-500 underline underline-offset-8 decoration-pink-200">Explore All</a>
        </div>
        <div class="grid md:grid-cols-3 gap-10">
            <div class="project-card p-12 rounded-[2.5rem]">
                <div class="text-3xl mb-8">🎓</div>
                <h3 class="text-xs font-bold uppercase tracking-widest text-gray-900 mb-4">Education</h3>
                <p class="text-gray-500 text-xs leading-relaxed">Sponsoring school essentials and tuition for the bright minds of our future.</p>
            </div>
            <div class="project-card p-12 rounded-[2.5rem]">
                <div class="text-3xl mb-8">🏥</div>
                <h3 class="text-xs font-bold uppercase tracking-widest text-gray-900 mb-4">Healthcare</h3>
                <p class="text-gray-500 text-xs leading-relaxed">Regular medical camps and emergency health funding for families in need.</p>
            </div>
            <div class="project-card p-12 rounded-[2.5rem]">
                <div class="text-3xl mb-8">🤝</div>
                <h3 class="text-xs font-bold uppercase tracking-widest text-gray-900 mb-4">Community</h3>
                <p class="text-gray-500 text-xs leading-relaxed">Infrastructure development and social support networks within Kottramulla.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-32 px-8 md:px-20 reveal">
    <div class="membership-box max-w-5xl mx-auto rounded-[3.5rem] p-12 md:p-24 text-center relative overflow-hidden shadow-sm">
        <h2 class="text-4xl md:text-5xl font-light text-gray-900 mb-6" style="font-family: 'Helvetica Light', sans-serif;">Become a <span class="italic text-green-500">Member</span></h2>
        <p class="text-gray-400 max-w-xl mx-auto mb-12 text-sm leading-relaxed">
            Join 250+ dedicated individuals making a real difference. Your contribution sustains our long-term welfare goals and supports the local community.
        </p>
        <a href="<?= url('/membership') ?>" class="inline-block bg-[#111827] text-white px-12 py-5 rounded-full text-[10px] font-bold tracking-[0.25em] hover:scale-105 transition-all shadow-xl shadow-gray-200">
            APPLY FOR MEMBERSHIP
        </a>
        <div class="mt-8 text-[10px] uppercase tracking-widest text-gray-300">Unity • Support • Growth</div>
    </div>
</section>

<script>
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => { 
            if (entry.isIntersecting) entry.target.classList.add('active'); 
        });
    }, { threshold: 0.1 });
    
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
</script>

</body>
</html>