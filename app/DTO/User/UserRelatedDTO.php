<?php

namespace App\DTO\User;

class UserRelatedDTO
{
    public ?UserDTO $userDTO = null;

    /**
     * Dto отделов
     * @var \App\DTO\User\Department\DepartmentDTO[]
     */
    public array $departments;

    /**
     * Dto должностей
     * @var \App\DTO\User\Position\PositionDTO[]
     */
    public array $positions;
}
