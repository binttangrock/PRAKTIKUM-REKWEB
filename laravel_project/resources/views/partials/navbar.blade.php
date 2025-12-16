<!-- resources/views/partials/navbar.blade.php -->
<style>
    nav {
        background: linear-gradient(90deg, #0072ff, #00c6ff);
        padding: 15px 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 30px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    nav a {
        color: #fff;
        text-decoration: none;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        font-size: 1.1rem;
        transition: color 0.3s ease, transform 0.2s ease;
        position: relative;
    }

    nav a::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: -5px;
        width: 0%;
        height: 2px;
        background: #fff;
        transition: width 0.3s ease;
    }

    nav a:hover {
        color: #f5f5f5;
        transform: translateY(-2px);
    }

    nav a:hover::after {
        width: 100%;
    }

    /* Responsive navbar for mobile */
    @media (max-width: 768px) {
        nav {
            flex-direction: column;
            gap: 15px;
        }

        nav a {
            font-size: 1rem;
        }
    }
</style>

<nav>
    <div class="nav-links">
        <a href="/">Home</a>
        <a href="/about">About</a>
        <a href="/contact">Contact</a>
        <a href="/posts">Posts</a>
        <a href="/mahasiswas">Mahasiswa</a>
    </div>

    @auth
        <div class="user-info">
            <span>👋 {{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    @else
        <div class="user-info">
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        </div>
    @endauth
</nav>
