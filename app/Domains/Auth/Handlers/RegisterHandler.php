<?php

namespace App\Domains\Auth\Handlers;

use App\Domains\Auth\Dto\RegisterDto;
use App\Domains\Auth\Support\ErrorMessages;
use App\Infrastructure\Models\User;
use App\Application\Repositories\Auth\RoleRepository;
use App\Application\Repositories\Auth\UserRepository;
use App\Support\Core\BaseDto;
use App\Support\Core\BaseRepository;
use App\Support\Core\CustomException;
use Symfony\Component\HttpFoundation\Response;

class RegisterHandler
{
    protected BaseRepository $userRepository;
    protected BaseRepository $roleRepository;

    public function __construct()
    {
        $this->userRepository   = new UserRepository;
        $this->roleRepository   = new RoleRepository;
    }

    /**
     * @param BaseDto $dto
     * @return array
     */
    public function handle(BaseDto $dto): array
    {
        /**
         * @var RegisterDto $dto
         */
        $exist = $this->userRepository->wherePhone($dto->phone)->first();

        if ($exist)
        {
            new CustomException(ErrorMessages::USER_ALREADY_EXIST, Response::HTTP_BAD_REQUEST, []);
        }

        $user = $this->userRepository->create($dto->toArray());

        return [
            'user' => $user,
            'token' => $user->createToken("AUTH TOKEN")->plainTextToken
        ];
    }
}
