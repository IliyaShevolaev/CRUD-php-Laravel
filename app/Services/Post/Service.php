<?php 

namespace App\Services\Post;

use App\Models\Category;
use App\Models\Post;

class Service 
{
    public function storeData($data)
    {
        Post::create($data);
    }

    public function updateData($post, $data)
    {
        $post->update($data);
    }

    public function findData($data)
    {
        $findValue = strtolower($data['findQuery']);
        $posts = Post::whereRaw('LOWER(name) LIKE ?', ["%$findValue%"])->get();

        return $posts;
    }

    public function sortCategoryData($categoryId)
    {
        if ($categoryId == 0) {
            return Post::all();
        }

        return Category::find($categoryId)->posts;
    }
}