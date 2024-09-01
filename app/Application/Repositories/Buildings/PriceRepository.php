<?php

namespace App\Application\Repositories\Buildings;

use App\Domains\Buildings\Contracts\PriceRepositoryContract;
use App\Infrastructure\Models\BuildingPricing;
use App\Support\Core\BaseRepository;
use Illuminate\Database\Eloquent\Builder;

class PriceRepository extends BaseRepository implements PriceRepositoryContract
{
    /**
     * @return Builder
     */
    public function getQueryBuilder(): Builder
    {
        return BuildingPricing::query();
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
