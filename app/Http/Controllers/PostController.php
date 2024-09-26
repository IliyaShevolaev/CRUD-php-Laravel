<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    public function create() 
    {
        return view('posts.create');
    }

    public function store() 
    {
        $data = request()->validate([
            'name' => 'string',
            'content' => 'string',
            'price' => 'integer'
        ]);

        Post::create($data);

        return redirect()->route("post.index");
    }

    public function show($id)
    {
        $posts = Post::where('id', $id)->get();
        return view('posts.show', compact('posts'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Post $post) 
    {
        $data = request()->validate([
            'name' => 'string',
            'content' => 'string',
            'price' => 'integer'
        ]);

        $post->update($data);
        return redirect()->route('post.show', $post->id);
    }

    public function destroy(Post $post) 
    {
        $post->delete();
        return redirect()->route('post.index');
    }
}
