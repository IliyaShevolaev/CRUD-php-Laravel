<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\LikeRequest;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends BaseLikeController
{
    public function create(LikeRequest $likeRequest)
    {
        $data = $likeRequest->validated();
        
        $this->service->LikePost($data);

        return redirect()->back();
    }
}
