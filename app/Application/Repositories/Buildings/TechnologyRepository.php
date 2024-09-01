<?php

namespace App\Application\Repositories\Buildings;

use App\Domains\Buildings\Contracts\TechnologyRepositoryContract;
use App\Infrastructure\Models\Technology;
use App\Support\Core\BaseRepository;
use Illuminate\Database\Eloquent\Builder;

class TechnologyRepository extends BaseRepository implements TechnologyRepositoryContract
{
    /**
     * @return Builder
     */
    public function getQueryBuilder(): Builder
    {
        return Technology::query();
    }
}
