<?php

namespace App\Application\Repositories\Buildings;

use App\Domains\Auth\Contracts\UserRepositoryContract;
use App\Domains\Buildings\Contracts\BuildingRepositoryContract;
use App\Infrastructure\Models\Building;
use App\Infrastructure\Models\User;
use App\Support\Core\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BuildingRepository extends BaseRepository implements BuildingRepositoryContract
{
    /**
     * @return Builder
     */
    public function getQueryBuilder(): Builder
    {
        return Building::query();
    }

    /**
     * @param int $id
     * @param array|string $relations
     * @return Model
     */
    public function findWithRelations(int $id, array|string $relations): Model
    {
        return $this->getQueryBuilder()->with($relations)->findOrFail($id);
    }
}
