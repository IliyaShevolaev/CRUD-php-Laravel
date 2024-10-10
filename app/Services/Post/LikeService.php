<?php

namespace App\Services\Post;

use App\Models\Like;
use App\Models\Post;

class LikeService
{
    public function LikePost($data)
    {
        $like = Like::where('user_id', $data['user_id'])->where('post_id', $data['post_id'])->first();
        $post = Post::find($data['post_id']);

        if (isset($like)) {
            $this->DestroyLikePost($like);
            $post->likes--;
            $post->save();
        } else {
            $post->likes++;
            $post->save();

            Like::create($data);
        }
    }

    public function DestroyLikePost($like)
    {
        $like->delete();
    }
}