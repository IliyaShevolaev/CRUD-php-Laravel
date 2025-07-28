<?php

namespace App\Http\Controllers\User;

use App\DataTables\PositionsDataTable;
use App\Http\Requests\Users\Position\PositionRequest;
use App\Models\User\Position;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class PositionController extends Controller
{
    public function index(PositionsDataTable $positionsDataTable)
    {
        return $positionsDataTable->render('positions.index');
    }

    public function store(PositionRequest $positionRequest): JsonResponse
    {
        $data = $positionRequest->validated();

        Position::create($data);

        return response()->json(['message' => 'success']);
    }

    public function update(PositionRequest $positionRequest, Position $position): JsonResponse
    {
        $data = $positionRequest->validated();

        $position->update($data);

        return response()->json(['message' => 'success']);
    }


    public function destroy(Position $position): JsonResponse
    {
        if ($position->users()->get()->isEmpty()) {
            $position->delete();
            return response()->json(['message' => 'success']);
        }

        return response()->json(['message' => 'delete not allowed'], 409);
    }
}
