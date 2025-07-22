<?php

namespace App\Services\Post;

use App\Models\Category;
use Illuminate\Contracts\View\View;

class CategoryService
{

    public function create(array $newData) : void
    {
        Category::create($newData);
    }

    public function update(array $editedData, Category $category) : void
    {
        $category->update($editedData);
    }

    public function delete(Category $category) : void
    {
        $category->delete();
    }

    public function indexViewInCreateMode(): View
    {
        $categories = Category::all();
        $inCreateMode = true;

        return view('admin.categories.index', compact('categories', 'inCreateMode'));
    }

    public function indexViewInEditMode(Category $category): View
    {
        $categories = Category::all();
        $editCategoryId = $category->id;

        return view('admin.categories.index', compact('categories', 'editCategoryId'));
    }
}
