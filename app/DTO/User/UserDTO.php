<?php

declare(strict_types=1);

namespace App\DTO\User;

class UserDTO
{
    public int $id;
    public string $name;
    public string $email;
    public ?string $password = null;
    public ?int $department_id = null;
    public ?int $position_id = null;
    public string $gender;
    public string $status;
}
