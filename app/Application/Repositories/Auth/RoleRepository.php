<?php

namespace App\Application\Repositories\Auth;

use App\Domains\Auth\Contracts\RoleRepositoryContract;
use App\Infrastructure\Models\Role;
use App\Support\Core\BaseRepository;
use Illuminate\Database\Eloquent\Builder;

class RoleRepository extends BaseRepository implements RoleRepositoryContract
{
    /**
     * @return Builder
     */
    public function getQueryBuilder(): Builder
    {
        return Role::query();
    }
}
