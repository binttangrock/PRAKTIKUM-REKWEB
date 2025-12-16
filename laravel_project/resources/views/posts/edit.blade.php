@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-2xl font-bold mb-4">Edit Post</h1>

    <form action="{{ route('posts.update', $post) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium">Judul</label>
            <input type="text" name="title" class="w-full border rounded p-2" value="{{ old('title', $post->title) }}">
            @error('title')
                <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>

        <div>
            <label class="block font-medium">Konten</label>
            <textarea name="content" rows="5" class="w-full border rounded p-2">{{ old('content', $post->content) }}</textarea>
            @error('content')
                <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
            <a href="{{ route('posts.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded">Kembali</a>
        </div>
    </form>
</div>
@endsection
