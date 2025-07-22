<?php

namespace App\Http\Controllers\Post;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Categories\CategoryRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\Post\BaseControllers\BaseCategoryController;

class CategoryController extends BaseCategoryController
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAdmin', Auth::user());

        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        $this->authorize('viewAdmin', Auth::user());

        return $this->service->indexViewInCreateMode();
    }

    public function store(CategoryRequest $createRequest): RedirectResponse
    {
        $this->authorize('viewAdmin', Auth::user());

        $newUserData = $createRequest->validated();

        $this->service->create($newUserData);

        return redirect()->route('admin.categories.index');
    }

    public function edit(Category $category): View
    {
        $this->authorize('viewAdmin', Auth::user());

        return $this->service->indexViewInEditMode($category);
    }

    public function update(CategoryRequest $editRequest, Category $category): RedirectResponse
    {
        $this->authorize('viewAdmin', Auth::user());

        $editedData = $editRequest->validated();

        $this->service->update($editedData, $category);

        return redirect()->route('admin.categories.index');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $this->authorize('viewAdmin', Auth::user());

        $this->service->delete($category);

        return redirect()->route('admin.categories.index');
    }
}
