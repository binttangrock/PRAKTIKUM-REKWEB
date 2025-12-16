<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->get();
        return response()->json(['status'=>'success','data'=>$posts]);
    }

    public function show($id)
    {
        $post = Post::with('user')->find($id);
        if (! $post) return response()->json(['status'=>'error','message'=>'Post not found'], 404);
        return response()->json(['status'=>'success','data'=>$post]);
    }

    public function store(Request $request)
    {
        $request->validate(['title'=>'required|string|max:255','content'=>'required']);
        $post = Post::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'content' => $request->content,
        ]);
        return response()->json(['status'=>'success','data'=>$post], 201);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        if (! $post) return response()->json(['status'=>'error','message'=>'Post not found'], 404);

        $user = $request->user();
        if ($user->id !== $post->user_id && ! ($user->is_admin ?? false)) {
            return response()->json(['status'=>'error','message'=>'Forbidden'], 403);
        }

        $request->validate(['title'=>'required|string|max:255','content'=>'required']);
        $post->update($request->only(['title','content']));
        return response()->json(['status'=>'success','data'=>$post]);
    }

    public function destroy(Request $request, $id)
    {
        $post = Post::find($id);
        if (! $post) return response()->json(['status'=>'error','message'=>'Post not found'], 404);

        $user = $request->user();
        if ($user->id !== $post->user_id && ! ($user->is_admin ?? false)) {
            return response()->json(['status'=>'error','message'=>'Forbidden'], 403);
        }

        $post->delete();
        return response()->json(['status'=>'success','message'=>'Post deleted']);
    }
}
