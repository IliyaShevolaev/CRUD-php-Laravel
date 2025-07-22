<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Post\BaseControllers\BaseLikeController;
use App\Models\Like;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Post\LikeRequest;

class LikeController extends BaseLikeController
{
    public function create(LikeRequest $likeRequest)
    {
        $data = $likeRequest->validated();

        $this->service->LikePost($data);

        return redirect()->back();
    }

    public function show()
    {
        $likes = Like::where('user_id', Auth::id())->get();

        $posts = [];

        foreach($likes as $like) {
            array_push($posts, $like->post);
        }

        return view('posts.show-as-list', compact('posts'));
    }
}
