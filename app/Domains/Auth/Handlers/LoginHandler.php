<?php
declare(strict_types=1);

namespace App\Domains\Auth\Handlers;

use App\Domains\Auth\Dto\LoginDto;
use App\Domains\Auth\Support\ErrorMessages;
use App\Infrastructure\Models\User;
use App\Support\Core\BaseDto;
use App\Support\Core\CustomException;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class LoginHandler
{
    /**
     * @param BaseDto $dto
     * @return array
     */
    public function handle(BaseDto $dto): array
    {
        /**
         * @var LoginDto $dto
         */
        $user = User::wherePhone($dto->phone)->first();

        if (!$user)
        {
            new CustomException(ErrorMessages::USER_NOT_FOUND, Response::HTTP_BAD_REQUEST, []);
        }

        if (Hash::check($dto->password, $user->password))
        {
            new CustomException(ErrorMessages::INCORRECT_PASSWORD, Response::HTTP_BAD_REQUEST, []);
        }

        /**
         * Удаляем все токены когда пользователь заходит заново.
         */
        $user?->tokens()->delete();

        return [
            'user'  => $user,
            'token' => $user?->createToken('authorization')->plainTextToken,
        ];
    }
}
