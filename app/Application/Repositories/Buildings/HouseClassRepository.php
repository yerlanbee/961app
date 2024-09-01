<?php

namespace App\Application\Repositories\Buildings;

use App\Domains\Buildings\Contracts\HouseClassRepositoryContract;
use App\Infrastructure\Models\HouseClass;
use App\Support\Core\BaseRepository;
use Illuminate\Database\Eloquent\Builder;

class HouseClassRepository extends BaseRepository implements HouseClassRepositoryContract
{
    /**
     * @return Builder
     */
    public function getQueryBuilder(): Builder
    {
        return HouseClass::query();
    }
}
