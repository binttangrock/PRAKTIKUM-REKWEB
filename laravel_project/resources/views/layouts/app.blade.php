<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- STYLE LANGSUNG DI FILE -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0f172a, #0e1525, #000000);
            color: #e5e7eb;
            min-height: 100vh;
            scroll-behavior: smooth;
        }

        /* Navbar Glass Effect */
        .navbar-glass {
            backdrop-filter: blur(18px);
            background: rgba(255, 255, 255, 0.05);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            padding: 15px 50px;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 50;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Link Glow Effect */
        .nav-link {
            margin: 0 14px;
            font-weight: 500;
            transition: 0.25s;
            position: relative;
        }
        .nav-link:hover {
            color: #38bdf8;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: -3px;
            width: 0%;
            height: 2px;
            background: #38bdf8;
            transform: translateX(-50%);
            transition: 0.3s;
        }
        .nav-link:hover::after {
            width: 60%;
        }

        /* Glow Button */
        .btn-glow {
            background: linear-gradient(90deg, #2563eb, #06b6d4);
            padding: 8px 20px;
            border-radius: 999px;
            font-weight: 600;
            transition: 0.3s;
            color: white;
        }
        .btn-glow:hover {
            box-shadow: 0 0 20px #0ea5e9;
            transform: translateY(-2px);
        }

        /* Fade Animation */
        .fade {
            animation: fadeIn 0.9s ease forwards;
            opacity: 0;
        }
        @keyframes fadeIn {
            to { opacity: 1; }
        }

        main {
            padding-top: 100px;
            padding-left: 28px;
            padding-right: 28px;
        }
    </style>
</head>

<body>

    @auth
    <nav class="navbar-glass">
        <div class="text-lg font-semibold tracking-wide" style="color:#38bdf8; font-weight:700;">
                 🌙 BintangRockAroma
        </div>


        <div class="flex gap-4 text-sm">
            <a href="/home" class="nav-link">Home</a>
            <a href="/about" class="nav-link">About</a>
            <a href="/contact" class="nav-link">Contact</a>
            <a href="/posts" class="nav-link">Posts</a>
            <a href="/mahasiswas" class="nav-link">Mahasiswa</a>
        </div>

        <div class="flex items-center gap-3">
            <span class="text-sm">👋 {{ Auth::user()->name }}</span>
            <form action="/logout" method="POST">@csrf
                <button class="btn-glow" type="submit">Logout</button>
            </form>
        </div>
    </nav>
    @endauth

    <main class="fade">
        @yield('content')
        {{ $slot ?? '' }}
    </main>

</body>
</html>
