<?php

namespace App\Domains\Auth\Enums;

enum Roles: int
{
    case ADMIN = 1;
    case GUEST = 2;
}
