<?php

declare(strict_types=1);

namespace App\DTO\User;

use ClassTransformer\Attributes\WritingStyle;

class UserDTO
{
    public int $id;
    public string $name;
    public string $email;
    public ?string $password = null;

    #[WritingStyle(WritingStyle::STYLE_CAMEL_CASE, WritingStyle::STYLE_SNAKE_CASE)]
    public ?int $department_id = null;

    #[WritingStyle(WritingStyle::STYLE_CAMEL_CASE, WritingStyle::STYLE_SNAKE_CASE)]
    public ?int $position_id = null;

    public string $gender;
    public string $status;
}
