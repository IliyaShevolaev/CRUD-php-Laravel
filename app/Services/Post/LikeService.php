<?php

namespace App\Services\Post;

use App\Models\Like;

class LikeService
{
    public function LikePost($data)
    {
        $like = Like::where('user_id', $data['user_id'])->where('post_id', $data['post_id'])->first();

        if (isset($like)) {
            $this->DestroyLikePost($like);
        } else {
            Like::create($data);
        }
    }

    public function DestroyLikePost($like)
    {
        $like->delete();
    }
}