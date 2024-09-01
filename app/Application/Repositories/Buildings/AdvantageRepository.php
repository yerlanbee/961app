<?php

namespace App\Application\Repositories\Buildings;

use App\Domains\Buildings\Contracts\AdvantageRepositoryContract;
use App\Infrastructure\Models\Advantage;
use App\Support\Core\BaseRepository;
use Illuminate\Database\Eloquent\Builder;

class AdvantageRepository extends BaseRepository implements AdvantageRepositoryContract
{
    /**
     * @return Builder
     */
    public function getQueryBuilder(): Builder
    {
        return Advantage::query();
    }
}
