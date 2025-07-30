<?php
declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Models\User\Position;
use App\Services\User\Position\PositionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\DataTables\PositionsDataTable;
use App\Http\Requests\Users\Position\PositionRequest;

/**
 * Контрллер должностей пользователей
 *
 * @uses PositionService
 */
class PositionController extends Controller
{
    /**
     * Сервис для контроллера
     *
     * @var PositionService
     */
    private PositionService $service;

    public function __construct(PositionService $service)
    {
        $this->service = $service;
    }

    /**
     * Отображает все должности через таблицу PositionsDataTable
     *
     * @param PositionsDataTable $positionsDataTable
     * @return JsonResponse|View
     */
    public function index(PositionsDataTable $positionsDataTable): JsonResponse|View
    {
        return $positionsDataTable->render('positions.index');
    }

    /**
     * Возвращает форму создания новой должности
     *
     * @return JsonResponse
     */
    public function create()
    {
        return response()->json(view('positions.form')
            ->with(['route' => route('positions.store')])
            ->render());
    }

    /**
     * Сохраняет новую должность
     *
     * @param PositionRequest $positionRequest
     * @return JsonResponse 200 - {'message' => 'success'}
     */
    public function store(PositionRequest $positionRequest): JsonResponse
    {
        $data = $positionRequest->validated();

        Position::create($data);

        return response()->json(['message' => 'success']);
    }

    /**
     * Возвращает форму редактирования передаваемой должности
     *
     * @param Position $position
     * @return JsonResponse
     */
    public function edit(Position $position)
    {
        return response()->json(view('positions.form')
            ->with([
                'route' => route('positions.update', $position),
                'element' => $position
            ])->render());
    }

    /**
     * Обновляет должность
     *
     * @param PositionRequest $positionRequest
     * @param Position $position
     * @return JsonResponse 200 - {'message' => 'success'}
     */
    public function update(PositionRequest $positionRequest, Position $position): JsonResponse
    {
        $data = $positionRequest->validated();

        $position->update($data);

        return response()->json(['message' => 'success']);
    }

    /**
     * Удаляет должность при отсутствии связей
     *
     * @param Position $position
     * @return JsonResponse 200 - {'message' => 'success'} | 409 - {'message' => 'delete not allowed'}
     */
    public function destroy(Position $position): JsonResponse
    {
        $deleteResult = $this->service->delete($position);

        return response()->json(['message' => $deleteResult['message']], $deleteResult['code']);
    }
}
