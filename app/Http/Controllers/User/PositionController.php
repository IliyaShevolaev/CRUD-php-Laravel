<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\Users\Position\PositionRequest;
use App\Models\User\Position;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\PositionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PositionController extends Controller
{
    public function index(): JsonResource
    {
        $departments = Position::all();

        return PositionResource::collection($departments);
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
        $position->delete();

        return response()->json(['message' => 'success']);
    }
}
