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

    public function index(UsersDataTable $usersDataTable)
    {
        return $usersDataTable->render('users.table-index');
    }

    public function show(User $user): View
    {
        return view('users.show', compact('user'));
    }

    public function create(): View
    {

        return view('users.change-user-table');
    }

    public function store(CreateRequest $createRequest): RedirectResponse
    {
        $newUserData = $createRequest->validated();

        $this->service->create($newUserData);

        return redirect()->route('users.index');
    }

    public function edit(User $user): View
    {
        return view('users.change-user-table', compact('user'));
    }

    public function update(EditRequest $editRequest, User $user): RedirectResponse
    {
        $editedData = $editRequest->validated();

        $this->service->update($editedData, $user);

        return redirect()->route('users.index');
    }

    public function destroy(User $user): JsonResponse
    {
        $this->service->delete($user);

        return response()->json([
            'message' => 'success',
        ]);
    }
}
