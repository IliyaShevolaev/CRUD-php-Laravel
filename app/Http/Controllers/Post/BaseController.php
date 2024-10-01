<?php

namespace App\Http\Controllers\Post;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Post\Service;

class BaseController extends Controller
{
    protected $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function showIndex($posts, $currentSelected = 0)
    {
        $categories = Category::all();

        return view('posts.index', compact('posts', 'categories', 'currentSelected'));
    }
}
