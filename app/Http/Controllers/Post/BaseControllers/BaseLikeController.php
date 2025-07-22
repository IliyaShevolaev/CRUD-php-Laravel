<?php

namespace App\Http\Controllers\Post\BaseControllers;

use App\Http\Controllers\Controller;
use App\Services\Post\LikeService;

class BaseLikeController extends Controller
{
    protected $service;

    public function __construct(LikeService $service)
    {
        $this->service = $service;
    }
}
