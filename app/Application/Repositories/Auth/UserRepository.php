<?php

namespace App\Application\Repositories\Auth;

use App\Domains\Auth\Contracts\UserRepositoryContract;
use App\Infrastructure\Models\User;
use App\Support\Core\BaseRepository;
use Illuminate\Database\Eloquent\Builder;

class UserRepository extends BaseRepository implements UserRepositoryContract
{
    /**
     * @return Builder
     */
    public function getQueryBuilder(): Builder
    {
        return User::query();
    }

    /**
     * @param string $phone
     * @return Builder
     */
    public function wherePhone(string $phone): Builder
    {
        return $this->getQueryBuilder()->where('phone', $phone);
    }
}
