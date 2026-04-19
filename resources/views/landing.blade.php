<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management Portal Gordon College</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; color: #1A5C2A; }
        .navbar { background-color: #1A5C2A; padding: 14px 40px; display: flex; justify-content: space-between; align-items: center; }
        .navbar .brand { color: #fff; font-size: 20px; font-weight: bold; }
        .btn { padding: 10px 22px; border-radius: 6px; font-weight: bold; font-size: 14px; text-decoration: none; cursor: pointer; }
        .btn-outline { background: transparent; color: #fff; border: 2px solid #A8D5B5; }
        .btn-primary { background: #276835; color: #fff; }
        .hero { background: linear-gradient(135deg, #1A5C2A 0%, #276835 100%); min-height: 88vh; display: flex; align-items: center; padding: 60px 40px; gap: 60px; color: #fff; }
        .hero-text h1 { font-size: 48px; line-height: 1.2; margin-bottom: 20px; }
        .hero-image img { max-width: 480px; width: 100%; border-radius: 16px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); }
        .footer { background: #1A5C2A; color: #A8D5B5; text-align: center; padding: 28px 40px; }
    </style>
</head>
<body>
    <nav class="navbar">
        <span class="brand">GC Student Portal</span>
        <div class="nav-links">
            <a href="{{ route('login') }}" class="btn btn-outline">Login</a>
            <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
        </div>
    </nav>
    <section class="hero">
        <div class="hero-text">
            <h1>Student Management Portal</h1>
            <p>A centralized platform for managing student enrollment records at Gordon College, Olongapo City.</p>
            <div class="hero-buttons" style="margin-top: 20px; display: flex; gap: 10px;">
                <a href="{{ route('login') }}" class="btn btn-primary">Login to Portal</a>
                <a href="{{ route('register') }}" class="btn btn-primary" style="background:#8B3A00;">Create Account</a>
            </div>
        </div>
        <div class="hero-image">
            <img src="{{ asset('images/hero.jpg') }}" alt="Students at Gordon College" />
        </div>
    </section>
    <footer class="footer">
        <p>&copy; {{ date('Y') }} Gordon College College of Computer Studies.</p>
    </footer>
</body>
</html>