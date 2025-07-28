<?php

namespace App\Http\Controllers\User;

use App\DataTables\UsersDataTable;
use App\Http\Requests\Users\CreateRequest;
use App\Http\Requests\Users\EditRequest;
use App\Models\Scopes\ActiveUserScope;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserController extends BaseUserController
{
    use AuthorizesRequests;

    public function index(UsersDataTable $usersDataTable)
    {
        return $usersDataTable->render('users.table-index');
    }

    public function create(): View
    {
        $data = $this->service->prepareViewData();

        return view('users.change-user-table', $data);
    }

    public function store(CreateRequest $createRequest): RedirectResponse
    {
        $newUserData = $createRequest->validated();

        $this->service->create($newUserData);

        return redirect()->route('users.index');
    }

    public function edit(int $user_id): View
    {
        $user = User::withoutScopeFind($user_id);

        $data = $this->service->prepareViewData($user);

        return view('users.change-user-table', $data);
    }

    public function update(EditRequest $editRequest, int $user_id): RedirectResponse
    {
        $user = User::withoutScopeFind($user_id);

        $editedData = $editRequest->validated();

        $this->service->update($editedData, $user);

        return redirect()->route('users.index');
    }

    public function destroy(int $user_id): JsonResponse
    {
        $user = User::withoutScopeFind($user_id);

        $this->service->delete($user);

        return response()->json([
            'message' => 'success',
        ]);
    }
}
