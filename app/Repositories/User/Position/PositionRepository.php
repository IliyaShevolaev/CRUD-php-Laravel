<?php

declare(strict_types=1);

namespace App\Repositories\User\Position;

use App\DTO\User\Position\PositionDTO;
use App\Models\User\Position;
use App\Repositories\Interfaces\User\Position\PositionRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PositionRepository implements PositionRepositoryInterface
{

    public function all(): Collection
    {
        return Position::all();
    }

    public function create(PositionDTO $dto): void
    {
        Position::create((array) $dto);
    }

    public function update(int $position_id, PositionDTO $dto): void
    {
        $position = Position::findOrFail($position_id);
        $position->update((array) $dto);
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
