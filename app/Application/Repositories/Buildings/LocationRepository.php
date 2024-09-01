<?php

namespace App\Application\Repositories\Buildings;

use App\Domains\Buildings\Contracts\LocationRepositoryContract;
use App\Infrastructure\Models\Location;
use App\Support\Core\BaseRepository;
use Illuminate\Database\Eloquent\Builder;

class LocationRepository extends BaseRepository implements LocationRepositoryContract
{
    /**
     * @return Builder
     */
    public function getQueryBuilder(): Builder
    {
        return Location::query();
    }

    /**
     * @param int $id
     * @return Builder
     */
    public function whereBuildingId(int $id): Builder
    {
        return $this->getQueryBuilder()->where('building_id', $id);
    }
}
