{{-- resources/views/landing.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management Portal — Gordon College</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --navy: #1B2A4A;
            --navy-dark: #111D35;
            --navy-mid: #243459;
            --gold: #C9A84C;
            --gold-light: #E2C170;
            --gold-pale: #FDF6E3;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Figtree', Arial, sans-serif; color: var(--navy); background: #fff; }

        /* NAVBAR */
        .navbar {
            background: var(--navy);
            padding: 0 40px;
            height: 68px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 12px rgba(0,0,0,0.25);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .navbar .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }
        .navbar .brand img { height: 44px; width: auto; }
        .navbar .brand-text { display: flex; flex-direction: column; }
        .navbar .brand-name {
            color: var(--gold);
            font-size: 17px;
            font-weight: 700;
            line-height: 1.1;
            letter-spacing: 0.3px;
        }
        .navbar .brand-sub {
            color: rgba(255,255,255,0.55);
            font-size: 11px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        .navbar .nav-links { display: flex; gap: 10px; align-items: center; }

        /* BUTTONS */
        .btn {
            padding: 9px 22px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .btn-ghost {
            background: transparent;
            color: rgba(255,255,255,0.85);
            border: 1.5px solid rgba(255,255,255,0.3);
        }
        .btn-ghost:hover { background: rgba(255,255,255,0.1); border-color: rgba(255,255,255,0.6); }
        .btn-gold {
            background: var(--gold);
            color: var(--navy-dark);
        }
        .btn-gold:hover { background: var(--gold-light); transform: translateY(-1px); box-shadow: 0 4px 14px rgba(201,168,76,0.4); }
        .btn-navy {
            background: var(--navy);
            color: #fff;
            border: 1.5px solid rgba(255,255,255,0.15);
        }
        .btn-navy:hover { background: var(--navy-mid); }
        .btn-lg { padding: 13px 30px; font-size: 15px; border-radius: 10px; }

        /* HERO */
        .hero {
            background: linear-gradient(135deg, var(--navy-dark) 0%, var(--navy) 50%, var(--navy-mid) 100%);
            min-height: 88vh;
            display: flex;
            align-items: center;
            padding: 70px 60px;
            gap: 70px;
            position: relative;
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute;
            top: -80px; right: -80px;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(201,168,76,0.12) 0%, transparent 70%);
            border-radius: 50%;
        }
        .hero::after {
            content: '';
            position: absolute;
            bottom: -100px; left: 10%;
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(201,168,76,0.07) 0%, transparent 70%);
            border-radius: 50%;
        }
        .hero-text { flex: 1; color: #fff; position: relative; z-index: 1; }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(201,168,76,0.15);
            border: 1px solid rgba(201,168,76,0.4);
            color: var(--gold-light);
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            padding: 6px 14px;
            border-radius: 100px;
            margin-bottom: 24px;
        }
        .hero-text h1 {
            font-size: 52px;
            line-height: 1.15;
            margin-bottom: 10px;
            font-weight: 800;
            letter-spacing: -0.5px;
        }
        .hero-text h1 span { color: var(--gold); }
        .hero-text .sub-h1 {
            font-size: 20px;
            color: var(--gold-light);
            font-weight: 600;
            margin-bottom: 18px;
        }
        .hero-text p {
            font-size: 16px;
            color: rgba(255,255,255,0.65);
            margin-bottom: 38px;
            line-height: 1.75;
            max-width: 480px;
        }
        .hero-buttons { display: flex; gap: 14px; flex-wrap: wrap; }
        .hero-image {
            flex: 1;
            display: flex;
            justify-content: center;
            position: relative;
            z-index: 1;
        }
        .hero-image-wrap {
            position: relative;
            display: inline-block;
        }
        .hero-image-wrap::before {
            content: '';
            position: absolute;
            inset: -4px;
            border-radius: 22px;
            background: linear-gradient(135deg, var(--gold) 0%, transparent 60%);
            opacity: 0.5;
        }
        .hero-image img {
            max-width: 460px;
            width: 100%;
            border-radius: 18px;
            box-shadow: 0 24px 60px rgba(0,0,0,0.45);
            display: block;
            position: relative;
        }

        /* STATS BAR */
        .stats-bar {
            background: var(--gold-pale);
            border-top: 3px solid var(--gold);
            padding: 28px 60px;
            display: flex;
            justify-content: center;
            gap: 80px;
        }
        .stat { text-align: center; }
        .stat-num { font-size: 28px; font-weight: 800; color: var(--navy); line-height: 1; }
        .stat-label { font-size: 12px; color: #666; margin-top: 4px; text-transform: uppercase; letter-spacing: 0.5px; }

        /* FEATURES */
        .features {
            padding: 90px 60px;
            background: #f8f9fc;
            text-align: center;
        }
        .section-tag {
            display: inline-block;
            background: rgba(27,42,74,0.08);
            color: var(--navy);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 5px 14px;
            border-radius: 100px;
            margin-bottom: 14px;
        }
        .features h2 {
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 12px;
            color: var(--navy);
        }
        .features .subtitle {
            color: #6b7280;
            margin-bottom: 56px;
            font-size: 16px;
            max-width: 480px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.6;
        }
        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 24px;
            max-width: 1060px;
            margin: 0 auto;
        }
        .feature-card {
            background: #fff;
            border-radius: 16px;
            padding: 36px 26px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.06);
            border-top: 4px solid var(--gold);
            text-align: left;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .feature-card:hover { transform: translateY(-4px); box-shadow: 0 8px 28px rgba(27,42,74,0.12); }
        .feature-icon {
            width: 52px; height: 52px;
            background: linear-gradient(135deg, var(--navy) 0%, var(--navy-mid) 100%);
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 24px;
            margin-bottom: 18px;
        }
        .feature-card h3 { font-size: 17px; font-weight: 700; margin-bottom: 10px; color: var(--navy); }
        .feature-card p { font-size: 14px; color: #6b7280; line-height: 1.65; }

        /* CTA SECTION */
        .cta {
            background: linear-gradient(135deg, var(--navy-dark) 0%, var(--navy-mid) 100%);
            padding: 80px 60px;
            text-align: center;
            color: #fff;
        }
        .cta h2 { font-size: 34px; font-weight: 800; margin-bottom: 14px; }
        .cta p { color: rgba(255,255,255,0.65); font-size: 16px; margin-bottom: 36px; max-width: 480px; margin-left: auto; margin-right: auto; }

        /* FOOTER */
        .footer {
            background: var(--navy-dark);
            color: rgba(255,255,255,0.45);
            text-align: center;
            padding: 24px 40px;
            font-size: 13px;
            border-top: 2px solid var(--gold);
        }
        .footer span { color: var(--gold); }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="/" class="brand">
            <img src="{{ asset('images/logo.png') }}" alt="Gordon College Logo">
            <div class="brand-text">
                <span class="brand-name">Student Portal</span>
                <span class="brand-sub">Gordon College · Olongapo City</span>
            </div>
        </a>
        <div class="nav-links">
            <a href="{{ route('login') }}" class="btn btn-ghost">Login</a>
            <a href="{{ route('register') }}" class="btn btn-gold">Get Started</a>
        </div>
    </nav>

    <section class="hero">
        <div class="hero-text">
            <div class="hero-badge">🎓 Gordon College Official Portal</div>
            <h1>Student<br><span>Management</span><br>Portal</h1>
            <p class="sub-h1">Gordon College, Olongapo City</p>
            <p>A centralized platform for managing student enrollment records — fast, secure, and built for the College of Computer Studies.</p>
            <div class="hero-buttons">
                <a href="{{ route('login') }}" class="btn btn-gold btn-lg">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4M10 17l5-5-5-5M15 12H3"/></svg>
                    Login to Portal
                </a>
                <a href="{{ route('register') }}" class="btn btn-ghost btn-lg">Create Account</a>
            </div>
        </div>
        <div class="hero-image">
            <div class="hero-image-wrap">
                <img src="{{ asset('images/hero.png') }}" alt="Students at Gordon College" onerror="this.parentElement.style.display='none'" />
            </div>
        </div>
    </section>

    <div class="stats-bar">
        <div class="stat"><div class="stat-num">4</div><div class="stat-label">Programs</div></div>
        <div class="stat"><div class="stat-num">4</div><div class="stat-label">Year Levels</div></div>
        <div class="stat"><div class="stat-num">100%</div><div class="stat-label">Secure Access</div></div>
        <div class="stat"><div class="stat-num">1</div><div class="stat-label">Platform</div></div>
    </div>

    <section class="features">
        <div class="section-tag">Features</div>
        <h2>What the Portal Offers</h2>
        <p class="subtitle">Everything you need to manage student enrollment records, all in one place.</p>
        <div class="feature-grid">
            <div class="feature-card">
                <div class="feature-icon">🎓</div>
                <h3>Student Records</h3>
                <p>Add, view, update, and delete student enrollment information with ease and confidence.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🔒</div>
                <h3>Secure Access</h3>
                <p>Authentication ensures only authorized faculty and staff can manage student records.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📊</div>
                <h3>Dashboard Overview</h3>
                <p>Get a quick summary of all enrolled students, organized by course, year, and block.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🏫</div>
                <h3>Gordon College</h3>
                <p>Built specifically for BSCS, BSIT, BSCS-EMC DAT, and BSEMC-GD programs.</p>
            </div>
        </div>
    </section>

    <section class="cta">
        <h2>Ready to Get Started?</h2>
        <p>Login to access the student management dashboard, or register a new staff account.</p>
        <a href="{{ route('login') }}" class="btn btn-gold btn-lg">Login to Portal</a>
    </section>

    <footer class="footer">
        <p>&copy; {{ date('Y') }} <span>Gordon College</span> — College of Computer Studies · Olongapo City</p>
    </footer>
</body>
</html>