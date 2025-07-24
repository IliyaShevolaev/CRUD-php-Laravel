<?php

namespace App\Http\Controllers\User;

use App\DataTables\UsersDataTable;
use App\Http\Requests\Users\CreateRequest;
use App\Http\Requests\Users\EditRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserController extends BaseUserController
{
    use AuthorizesRequests;

    // public function index(): View
    // {
    //     $this->authorize('viewAdmin', Auth::user());

    //     $users = User::all();

    //     return view('admin.users.index', compact('users'));
    // }

    public function index(UsersDataTable $usersDataTable)
    {
        $this->authorize('viewAdmin', Auth::user());

        return $usersDataTable->render('admin.users.table-index');
    }

    public function show(User $user): View
    {
        $this->authorize('viewAdmin', Auth::user());

        return view('admin.users.show', compact('user'));
    }

    public function create(): View
    {
        $this->authorize('viewAdmin', Auth::user());

        $roles = config('roles.roles');

        return view('admin.users.change-user-table', compact('roles'));
    }

    public function store(CreateRequest $createRequest): RedirectResponse
    {
        $this->authorize('viewAdmin', Auth::user());

        $newUserData = $createRequest->validated();

        $this->service->create($newUserData);

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user): View
    {
        $this->authorize('viewAdmin', Auth::user());

        $roles = config('roles.roles');

        return view('admin.users.change-user-table', compact('user', 'roles'));
    }

    public function update(EditRequest $editRequest, User $user): RedirectResponse
    {
        $this->authorize('viewAdmin', Auth::user());

        $editedData = $editRequest->validated();

        $this->service->update($editedData, $user);

        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user): JsonResponse
    {
        $this->authorize('viewAdmin', Auth::user());

        $this->service->delete($user);

        return response()->json([
            'message' => 'success',
        ]);
    }
}
