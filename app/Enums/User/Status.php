<?php

namespace App\Enums\User;

/**
 * Enum статусов
 */
enum Status : string
{
    case Active = 'active';
    case Unactive = 'unactive';
}
