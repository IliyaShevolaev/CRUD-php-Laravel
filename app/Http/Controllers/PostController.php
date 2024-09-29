<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        $categories = Category::all();

        return view('posts.create', compact('categories'));
    }

    public function store() 
    {
        $data = request()->validate([
            'name' => 'string',
            'content' => 'string',
            'price' => 'integer',
            'category_id' => ''
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
        $categories = Category::all();

        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(Post $post) 
    {
        $data = request()->validate([
            'name' => 'string',
            'content' => 'string',
            'price' => 'integer',
            'category_id' => ''
        ]);

        $post->update($data);
        return redirect()->route('post.show', $post->id);
    }

    public function find()
    {
        $data = request()->validate([
            'findRequest' => 'string'
        ]);

        $findRequest = strtolower($data['findRequest']);
        $posts = Post::whereRaw('LOWER(name) LIKE ?', ["%$findRequest%"])->get();

        if (count($posts) == 0) {
            return redirect()->route('post.index');
        }

        $findName = $data['findRequest'];
        
        return view('posts.find', compact('posts', 'findName'));
    }

    public function destroy(Post $post) 
    {
        $post->delete();
        return redirect()->route('post.index');
    }
}
