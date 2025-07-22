<?php

namespace App\Http\Controllers\Post\BaseControllers;

use App\Http\Controllers\Controller;
use App\Services\Post\CategoryService;

class BaseCategoryController extends Controller
{
    protected $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

}
