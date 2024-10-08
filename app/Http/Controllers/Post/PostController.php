<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use App\Models\Category;
use App\Http\Requests\Post\FindRequest;
use App\Http\Requests\Post\PostRequest;

class PostController extends BaseController
{
    public function index()
    {
        $posts = Post::paginate(3);

        return $this->showIndex($posts);
    }

    public function create()
    {
        $categories = Category::all();

        return view('posts.create', compact('categories'));
    }

    public function store(PostRequest $postRequest)
    {
        $data = $postRequest->validated();

        $this->service->storeData($data);

        return redirect()->route("post.index");
    }

    public function show(Post $post)
    {
        $category = Category::find($post->category_id);
        return view('posts.show', compact('post', 'category'));
    }

    public function edit(Post $post)
    {
        return $this->service->AccessToeditData($post);
    }

    public function update(PostRequest $postRequest, Post $post)
    {
        $data = $postRequest->validated();

        $this->service->updateData($post, $data);

        return redirect()->route('post.show', $post->id);
    }

    public function find(FindRequest $findRequest)
    {
        $data = $findRequest->validated();

        $posts = $this->service->findData($data);

        return $this->showIndex($posts);
    }

    public function sort($categoryId)
    {
        $posts = $this->service->sortCategoryData($categoryId);

        return $this->showIndex($posts, $categoryId);
    }

    public function myPosts() 
    {
        $posts = $this->service->getUserPosts();

        return $this->showIndex($posts);
    }

    public function viewOwner(Post $post)
    {
        $owner = $this->service->getOwerOfPost($post);

        return view('auth.profile', compact('owner'));
    }

    public function destroy(Post $post)
    {
        $this->service->DeleteData($post);

        return redirect()->route('post.index');
    }
}
