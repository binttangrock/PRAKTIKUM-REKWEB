<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * Siapa saja boleh melihat daftar postingan.
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Siapa saja boleh melihat satu postingan.
     */
    public function view(?User $user, Post $post): bool
    {
        return true;
    }

    /**
     * Hanya user login yang boleh membuat postingan.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Hanya pemilik postingan atau admin yang boleh edit.
     */
    public function update(User $user, Post $post): bool
    {
        return $user->id === $post->user_id || $user->is_admin;
    }

    /**
     * Hanya pemilik postingan atau admin yang boleh delete.
     */
    public function delete(User $user, Post $post): bool
    {
        return $user->id === $post->user_id || $user->is_admin;
    }

    /**
     * Tidak dipakai.
     */
    public function restore(User $user, Post $post): bool
    {
        return false;
    }

    /**
     * Tidak dipakai.
     */
    public function forceDelete(User $user, Post $post): bool
    {
        return false;
    }
}
