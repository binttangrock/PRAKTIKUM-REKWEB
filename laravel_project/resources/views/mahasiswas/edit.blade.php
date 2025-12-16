@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #0f172a, #1e293b);
        font-family: 'Poppins', sans-serif;
        color: #f8fafc;
    }

    h1 {
        text-align: center;
        margin-top: 40px;
        font-size: 2.8rem;
        font-weight: 700;
        color: #e2e8f0;
        text-shadow: 0 3px 10px rgba(0, 0, 0, 0.6);
        animation: fadeInDown 1s ease-in-out;
    }

    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-25px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .form-box {
        background: rgba(30, 41, 59, 0.9);
        padding: 40px;
        border-radius: 18px;
        max-width: 650px;
        margin: 50px auto;
        box-shadow: 0 6px 25px rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(8px);
        animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        font-weight: 600;
        color: #cbd5e1;
        display: block;
        margin-bottom: 8px;
    }

    .form-control {
        width: 100%;
        background: rgba(255, 255, 255, 0.1);
        border: none;
        color: #f8fafc;
        border-radius: 10px;
        padding: 14px 16px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-control::placeholder {
        color: #94a3b8;
    }

    .form-control:focus {
        background: rgba(255, 255, 255, 0.15);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.4);
        outline: none;
    }

    .btn-success {
        background: linear-gradient(90deg, #2563eb, #3b82f6);
        border: none;
        border-radius: 30px;
        padding: 12px 28px;
        font-weight: bold;
        transition: 0.3s;
        color: #fff;
        box-shadow: 0 6px 15px rgba(37, 99, 235, 0.4);
    }

    .btn-success:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.6);
    }

    .btn-secondary {
        background: linear-gradient(90deg, #475569, #64748b);
        border: none;
        border-radius: 30px;
        padding: 12px 28px;
        font-weight: bold;
        transition: 0.3s;
        color: #fff;
        margin-left: 10px;
    }

    .btn-secondary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(100, 116, 139, 0.6);
    }

    .text-center {
        text-align: center;
        margin-top: 25px;
    }
</style>

<h1>Edit Mahasiswa</h1>

<div class="form-box">
    <form action="{{ route('mahasiswas.update', $mahasiswa->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $mahasiswa->nama }}" required>
        </div>

        <div class="form-group">
            <label>NIM</label>
            <input type="text" name="nim" class="form-control" value="{{ $mahasiswa->nim }}" required>
        </div>

        <div class="form-group">
            <label>Fakultas</label>
            <input type="text" name="fakultas" class="form-control" value="{{ $mahasiswa->fakultas }}" required>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('mahasiswas.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection
