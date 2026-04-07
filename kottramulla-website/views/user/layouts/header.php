<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KUWS | Kottramulla United Welfare Society</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'headline': ['"Helvetica Light"', 'Helvetica', 'Arial', 'sans-serif'],
                        'links': ['"SesamiFutura"', 'Futura', 'sans-serif'],
                    }
                }
            }
        }
    </script>
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

        *, *::before, *::after { box-sizing: border-box; }

        html, body {
            margin: 0;
            padding: 0;
            background: #ffffff;
            overflow-x: hidden;
        }

        /* Strip all link underlines globally */
        a {
            text-decoration: none;
        }

        /* ── Fixed floating nav ── */
        #nav-wrapper {
            position: fixed;
            top: 2rem;
            left: 5rem;
            z-index: 1000;
            display: flex;
            align-items: center;
            gap: 3rem;
            transition: left 0.8s cubic-bezier(0.16, 1, 0.3, 1),
                        transform 0.8s cubic-bezier(0.16, 1, 0.3, 1),
                        background 0.8s ease,
                        padding 0.8s ease,
                        border-radius 0.8s ease,
                        box-shadow 0.8s ease;
        }

        /* Pill style when scrolled */
        #nav-wrapper.nav-scrolled {
            left: 50%;
            transform: translateX(-50%);
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            padding: 0.75rem 2.5rem;
            border-radius: 100px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.6);
        }
    </style>
</head>
<body>

<header>
    <div id="nav-wrapper">
        <span style="font-size:1.2rem; letter-spacing:0.3em; font-weight:700; color:#111827;">KUWS</span>
        <nav style="display:flex; gap:2rem; align-items:center;">
            <a href="<?= url('/home') ?>"     style="font-size:11px; letter-spacing:0.15em; text-transform:uppercase; color:#ec4899;">Home</a>
            <a href="<?= url('/about') ?>"    style="font-size:11px; letter-spacing:0.15em; text-transform:uppercase; color:#1f2937;">About</a>
            <a href="<?= url('/projects') ?>" style="font-size:11px; letter-spacing:0.15em; text-transform:uppercase; color:#1f2937;">Projects</a>
            <a href="<?= url('/gallery') ?>"  style="font-size:11px; letter-spacing:0.15em; text-transform:uppercase; color:#1f2937;">Gallery</a>
            <a href="<?= url('/contact') ?>"  style="font-size:11px; letter-spacing:0.15em; text-transform:uppercase; color:#1f2937;">Contact</a>
        </nav>
    </div>
</header>