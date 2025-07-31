<?php

namespace App\Repositories\User\Position;

use App\Models\User\Position;
use App\Repositories\Interfaces\User\Position\PositionRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PositionRepository implements PositionRepositoryInterface
{

    public function all(): Collection
    {
        return Position::all();
    }

    public function create(array $data): void
    {
        Position::create($data);
    }

    public function update(int $position_id, array $data): void
    {
        $position = Position::findOrFail($position_id);
        $position->update($data);
    }

    public function delete(int $position_id): void
    {
        $position = Position::findOrFail($position_id);
        $position->delete();
    }

    public function find(int $position_id): Position
    {
        return Position::findOrFail($position_id);
    }
}
