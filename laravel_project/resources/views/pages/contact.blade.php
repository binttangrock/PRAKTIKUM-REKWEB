@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #0f172a, #1e293b);
        font-family: 'Poppins', sans-serif;
        color: #e2e8f0;
        margin: 0;
        padding: 0;
    }

    .contact-container {
        max-width: 750px;
        margin: 120px auto;
        background: rgba(255, 255, 255, 0.08);
        padding: 45px;
        border-radius: 18px;
        backdrop-filter: blur(18px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.4);
        text-align: center;
        animation: fadeIn 1.3s ease-in-out;
    }

    h1 {
        font-size: 2.8rem;
        margin-bottom: 18px;
        font-weight: 600;
        color: #ffffff;
        text-shadow: 0 3px 12px rgba(0,0,0,0.5);
        animation: fadeInDown 1s ease-in-out;
    }

    p {
        font-size: 1.1rem;
        opacity: 0.9;
        line-height: 1.7;
        animation: fadeIn 1.6s ease-in-out;
    }

    .contact-info {
        margin-top: 28px;
        font-weight: 500;
    }

    .contact-info a {
        color: #38bdf8;
        text-decoration: none;
        transition: 0.3s;
        font-weight: 600;
    }

    .contact-info a:hover {
        color: #60a5fa;
        text-shadow: 0 0 12px #38bdf8;
    }

    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-35px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
</style>

<div class="contact-container">
    <h1>Hubungi Kami</h1>
    <p>Jika kamu punya pertanyaan atau butuh bantuan, jangan ragu kontak kami 👇</p>

    <div class="contact-info">
        <p>Email: <a href="mailto:admin@laravelpraktikum.com">admin@laravelpraktikum.com</a></p>
    </div>
</div>
@endsection
