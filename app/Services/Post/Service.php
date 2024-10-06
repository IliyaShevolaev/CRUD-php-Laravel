<?php 

namespace App\Services\Post;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Service 
{
    use AuthorizesRequests;

    public function storeData($data)
    {
        $data['owner_id'] = Auth::id();
        Post::create($data);
    }

    public function AccessToeditData($post) 
    {
        if ($this->authorize('update', $post)) {
            $categories = Category::all();
            return view('posts.edit', compact('post', 'categories'));
        }
    }

    public function updateData($post, $data)
    {
        if ($this->authorize('update', $post)) {
            $post->update($data);
        }
    }

    public function findData($data)
    {
        $findValue = strtolower($data['findQuery']);
        $posts = Post::whereRaw('LOWER(name) LIKE ?', ["%$findValue%"])->paginate(3);

        return $posts;
    }

    public function sortCategoryData($categoryId)
    {
        if ($categoryId == 0) {
            return Post::paginate(3);
        }
        
        return Post::where('category_id', $categoryId)->paginate(3);
    }

    public function DeleteData($post) 
    {
        if ($this->authorize('delete', $post)) {
            $post->delete();
        }
    }
}