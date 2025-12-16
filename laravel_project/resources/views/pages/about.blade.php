@extends('layouts.app')

@section('content')

<section class="about-wrapper">
    <div class="about-container">
        <h2 class="about-title">Halaman About</h2>
        <p class="about-text">Aplikasi ini dibuat untuk belajar Laravel.</p>
    </div>
</section>

<style>
    .about-wrapper {
        min-height: 70vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 30px;
    }

    .about-container {
        max-width: 800px;
        background: #1a2336;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
        animation: fadeIn 1.2s ease forwards;
        opacity: 0;
        text-align: left;
    }

    .about-title {
        font-size: 1.9rem;
        font-weight: 700;
        color: #38bdf8; /* biru soft */
        margin-bottom: 10px;
    }

    .about-text {
        font-size: 1.1rem;
        color: #cbd5e1;
        line-height: 1.6rem;
    }

    @keyframes fadeIn {
        to { opacity: 1; }
    }
</style>

@endsection
