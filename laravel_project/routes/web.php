<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Halaman Awal
|--------------------------------------------------------------------------
*/

// Jika user login → home
// Jika guest → welcome
Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/home');
    }
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Guest boleh akses daftar posts
|--------------------------------------------------------------------------
*/
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

/*
|--------------------------------------------------------------------------
| Semua route berikut butuh login
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // halaman utama setelah login
    Route::get('/home', [PageController::class, 'home'])->name('home');
    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');

    // mahasiswa CRUD
    Route::resource('mahasiswas', MahasiswaController::class);

    // Posts CRUD kecuali index (index sudah di luar)
    Route::resource('posts', PostController::class)->except(['index']);

    // Profile bawaan breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Auth routes Breeze
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
