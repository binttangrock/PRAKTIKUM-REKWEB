@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-2xl font-bold mb-4">Daftar Post</h1>

    {{-- Tampilkan pesan sukses --}}
    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-3">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tombol tambah post hanya untuk user login --}}
    @auth
        <a href="{{ route('posts.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Tambah Post</a>
    @endauth

    <ul class="mt-6 space-y-4">
        @forelse ($posts as $post)
            <li class="border p-4 rounded shadow">
                <h3 class="font-bold text-lg">{{ $post->title }}</h3>
                <p class="text-gray-700 mb-2">{{ $post->content }}</p>
                <small class="text-gray-500">Oleh: {{ $post->user_id }}</small>

                <div class="mt-2 flex gap-2">
                    @can('update', $post)
                        <a href="{{ route('posts.edit', $post) }}" class="text-blue-500">Edit</a>
                    @endcan

                    @can('delete', $post)
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus post ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Hapus</button>
                        </form>
                    @endcan
                </div>
            </li>
        @empty
            <p>Belum ada post.</p>
        @endforelse
    </ul>
</div>
@endsection
