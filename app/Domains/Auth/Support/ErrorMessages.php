<?php
declare(strict_types=1);

namespace App\Domains\Auth\Support;

class ErrorMessages
{
    const USER_ALREADY_EXIST = 'Пользователь с таким номером телефона уже существует';
    const USER_NOT_FOUND = 'Пользователь с таким номером телефона не сущетсвует';
    const INCORRECT_PASSWORD = 'Введенный пароль не верный';
}
