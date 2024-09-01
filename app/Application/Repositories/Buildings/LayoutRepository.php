<?php

namespace App\Application\Repositories\Buildings;

use App\Domains\Buildings\Contracts\LayoutRepositoryContract;
use App\Infrastructure\Models\Layout;
use App\Support\Core\BaseRepository;
use Illuminate\Database\Eloquent\Builder;

class LayoutRepository extends BaseRepository implements LayoutRepositoryContract
{
    /**
     * @return Builder
     */
    public function getQueryBuilder(): Builder
    {
        return Layout::query();
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
