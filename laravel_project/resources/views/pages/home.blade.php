@extends('layouts.app')

@section('content')
<section class="home-wrapper">
    <div class="home-content">
        <h1 class="home-title">Welcome to Laravel Home Page</h1>
        <p class="home-subtitle">Ini adalah halaman utama dari aplikasi Laravel Anda.</p>

        <a href="#" class="home-button">Mulai Sekarang</a>
    </div>
</section>

<style>
    .home-wrapper {
        min-height: 80vh;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 30px;
    }

    .home-content {
        animation: fadeIn 1.3s ease forwards;
        opacity: 0;
    }

    .home-title {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 15px;
        color: #e2e8f0; /* teks putih lembut */
    }

    .home-subtitle {
        font-size: 1.2rem;
        margin-bottom: 30px;
        color: #94a3b8; /* abu lembut */
    }

    .home-button {
        padding: 12px 28px;
        border-radius: 999px;
        font-size: 1rem;
        font-weight: 600;
        text-decoration: none;
        background: linear-gradient(90deg, #2563eb, #06b6d4);
        color: white;
        transition: 0.3s;
    }

    .home-button:hover {
        box-shadow: 0 0 25px #0ea5e9;
        transform: translateY(-3px);
    }

    @keyframes fadeIn {
        to { opacity: 1; }
    }
</style>
@endsection
