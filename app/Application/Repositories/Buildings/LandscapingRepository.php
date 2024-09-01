<?php

namespace App\Application\Repositories\Buildings;

use App\Domains\Buildings\Contracts\LandscapingRepositoryContract;
use App\Infrastructure\Models\Landscaping;
use App\Support\Core\BaseRepository;
use Illuminate\Database\Eloquent\Builder;

class LandscapingRepository extends BaseRepository implements LandscapingRepositoryContract
{
    /**
     * @return Builder
     */
    public function getQueryBuilder(): Builder
    {
        return Landscaping::query();
    }
}
