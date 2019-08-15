<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        return Post::all();
    }

    public function show (Post $post) {
        return $post;
    }

    public function store(Request $request) {
        $post = Post::create($request->all());
        return response()->json($post, 201);
    }

    public function update(Request $request, Post $post) {
        $post->update($request->all());
        return response()->json($post);
    }

    public function destroy(Post $post) {
        $post->delete();
        return response()->json(null, 204);
    }
}
