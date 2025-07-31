<?php

declare(strict_types=1);

namespace App\Repositories\User\Position;

use App\DTO\User\UserDTO;
use App\Models\User\Position;
use ClassTransformer\Hydrator;
use App\DTO\User\Position\PositionDTO;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Interfaces\User\Position\PositionRepositoryInterface;

class PositionRepository implements PositionRepositoryInterface
{

    public function all()
    {
        $positions = Position::all();
        $positionsDto = [];

        foreach($positions as $position) {
            $positionsDto[] = Hydrator::init()->create(PositionDTO::class, $position->toArray());
        }

        return $positionsDto;
    }

    public function collection(): Collection
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

    public function find(int $position_id): PositionDTO
    {
        return Hydrator::init()->create(PositionDTO::class, Position::findOrFail($position_id)->toArray());
    }

    public function findRelatedUsers(int $position_id): array
    {
        $users = Position::findOrFail($position_id)->users()->get();
        $usersDto = [];

        foreach($users as $user) {
            $usersDto[] = Hydrator::init()->create(UserDTO::class, $user->toArray());
        }

        return $usersDto;
    }
}
