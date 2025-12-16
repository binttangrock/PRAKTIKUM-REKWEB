@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #0f172a, #1e293b);
        font-family: 'Poppins', sans-serif;
        color: #f8fafc;
        margin: 0;
        padding: 0;
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

    .content-box {
        margin: 60px auto;
        max-width: 950px;
        background: rgba(30, 41, 59, 0.85);
        padding: 35px;
        border-radius: 18px;
        backdrop-filter: blur(10px);
        box-shadow: 0 6px 25px rgba(0, 0, 0, 0.4);
        animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    /* Tombol Tambah */
    .btn-add {
        display: inline-block;
        padding: 12px 28px;
        background: linear-gradient(90deg, #2563eb, #3b82f6);
        border-radius: 30px;
        color: #fff !important;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.25s ease-in-out;
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
    }

    .btn-add:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.6);
    }

    /* TABEL */
    .table {
        width: 100%;
        margin-top: 25px;
        border-collapse: collapse;
        color: #f1f5f9;
        background: transparent;
        border-radius: 12px;
        overflow: hidden;
    }

    .table th {
        background: rgba(15, 23, 42, 0.85);
        padding: 14px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-bottom: 2px solid rgba(255, 255, 255, 0.1);
    }

    .table td {
        background: rgba(255, 255, 255, 0.05);
        padding: 14px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        transition: 0.3s;
    }

    .table tbody tr:hover td {
        background: rgba(59, 130, 246, 0.15);
    }

    /* Tombol Aksi */
    .btn-warning {
        background: linear-gradient(90deg, #facc15, #fde047);
        border: none;
        border-radius: 10px;
        padding: 6px 14px;
        font-weight: bold;
        color: #111827;
        transition: 0.25s;
    }

    .btn-warning:hover {
        transform: scale(1.08);
        box-shadow: 0 0 12px rgba(250, 204, 21, 0.5);
    }

    .btn-danger {
        background: linear-gradient(90deg, #ef4444, #f87171);
        border: none;
        border-radius: 10px;
        padding: 6px 14px;
        font-weight: bold;
        color: #fff;
        transition: 0.25s;
    }

    .btn-danger:hover {
        transform: scale(1.08);
        box-shadow: 0 0 12px rgba(239, 68, 68, 0.6);
    }

    .alert-success {
        background: rgba(34, 197, 94, 0.15);
        border: 1px solid rgba(34, 197, 94, 0.3);
        color: #bbf7d0;
        padding: 12px;
        margin-top: 20px;
        border-radius: 10px;
        text-align: center;
    }
</style>

<h1>Daftar Mahasiswa</h1>

<div class="content-box">
    <a href="{{ route('mahasiswas.create') }}" class="btn-add">+ Tambah Mahasiswa</a>

    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Fakultas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mahasiswas as $mhs)
                <tr>
                    <td>{{ $mhs->id }}</td>
                    <td>{{ $mhs->nama }}</td>
                    <td>{{ $mhs->nim }}</td>
                    <td>{{ $mhs->fakultas }}</td>
                    <td>
                        <a href="{{ route('mahasiswas.edit', $mhs->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('mahasiswas.destroy', $mhs->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
