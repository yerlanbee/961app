<?php

namespace App\Application\Repositories\Buildings;

use App\Domains\Buildings\Contracts\AddressRepositoryContract;
use App\Infrastructure\Models\Address;
use App\Support\Core\BaseRepository;
use Illuminate\Database\Eloquent\Builder;

class AddressRepository extends BaseRepository implements AddressRepositoryContract
{
    /**
     * @return Builder
     */
    public function getQueryBuilder(): Builder
    {
        return Address::query();
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
