<?php

namespace App\Domains\Buildings\Handlers\Resource\Landscapings;

use App\Application\Repositories\Buildings\LandscapingRepository;
use App\Infrastructure\Models\Landscaping;
use App\Support\Core\BaseRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class GetAllLandscapingHandler
{
    protected BaseRepository $repository;

    public function __construct()
    {
        $this->repository = new LandscapingRepository();
    }

    /**
     * @param int|null $id
     * @return Collection|Landscaping
     */
    public function handle(
        int $id = null
    ): Collection|Landscaping
    {
        if ($id)
        {
            /**
             * @var Landscaping $landscaping
             */
            $landscaping          = $this->repository->findOneOrFail($id);
            $landscaping->photo   = $landscaping->photo ? Storage::url($landscaping->photo) : 'default.png';

            return $landscaping;
        }

        return $this->repository->all();
    }
}
