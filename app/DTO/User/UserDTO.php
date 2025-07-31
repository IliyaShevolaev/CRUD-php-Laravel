<?php

declare(strict_types=1);

namespace App\DTO\User;

use App\Enums\User\GenderEnum;
use App\Enums\User\StatusEnum;

class UserDTO
{
    public string $name;
    public string $email;
    public ?string $password = null;
    public ?int $department_id = null;
    public ?int $position_id = null;
    public GenderEnum $gender;
    public StatusEnum $status;

    /**
     * Привести DTO к массиву с кастомной логикой
     *
     * @return array<mixed>
     */
    public function toArray(): array
    {
        $result = (array) $this;

        if ($this->password === null) {
            unset($result['password']);
        }

        return $result;
    }
}
