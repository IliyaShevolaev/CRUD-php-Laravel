<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\DataTables\UsersDataTable;
use App\Http\Requests\Users\CreateRequest;
use App\Http\Requests\Users\EditRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * Контроллер пользователей
 *
 * @uses \App\Services\User\UserService
 */
class UserController extends BaseUserController
{
    use AuthorizesRequests;

    /**
     * Отображает всех пользователей через таблицу UserDataTable
     *
     * @param \App\DataTables\UsersDataTable $usersDataTable
     * @return JsonResponse|View
     */
    public function index(UsersDataTable $usersDataTable): JsonResponse | View
    {
        return $usersDataTable->render('users.table-index');
    }

    /**
     * Отображает страницу создания нового пользователя
     *
     * @return View
     */
    public function create(): View
    {
        $data = $this->service->prepareViewData();

        return view('users.change-user-table', $data);
    }

    /**
     * Сохраняет нового пользователя и редиректит на таблицу с пользователями
     *
     * @param \App\Http\Requests\Users\CreateRequest $createRequest
     * @return RedirectResponse
     */
    public function store(CreateRequest $createRequest): RedirectResponse
    {
        $newUserData = $createRequest->validated();

        $this->service->create($newUserData);

        return redirect()->route('users.index');
    }

    /**
     * Отображает страницу редактирования пользователя
     *
     * @param int $user_id
     * @return View
     */
    public function edit(int $user_id): View
    {
        $user = User::withoutScopeFind($user_id);

        $data = $this->service->prepareViewData($user);

        return view('users.change-user-table', $data);
    }

    /**
     * Обновляет данные о пользователе
     *
     * @param \App\Http\Requests\Users\EditRequest $editRequest
     * @param int $user_id
     * @return RedirectResponse
     */
    public function update(EditRequest $editRequest, int $user_id): RedirectResponse
    {
        $user = User::withoutScopeFind($user_id);

        $editedData = $editRequest->validated();

        $this->service->update($editedData, $user);

        return redirect()->route('users.index');
    }

    /**
     * Удаляет пользователя
     *
     * @param int $user_id
     * @return JsonResponse
     */
    public function destroy(int $user_id): JsonResponse
    {
        $user = User::withoutScopeFind($user_id);

        $this->service->delete($user);

        return response()->json([
            'message' => 'success',
        ]);
    }
}
