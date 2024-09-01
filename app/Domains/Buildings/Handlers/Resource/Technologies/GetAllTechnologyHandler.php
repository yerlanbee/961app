<?php

namespace App\Domains\Buildings\Handlers\Resource\Technologies;

use App\Application\Repositories\Buildings\TechnologyRepository;
use App\Domains\Buildings\Handlers\Technologies\Storage;
use App\Infrastructure\Models\Technology;
use App\Support\Core\BaseRepository;
use Illuminate\Support\Collection;

class GetAllTechnologyHandler
{
    protected BaseRepository $repository;

    public function __construct()
    {
        $this->repository = new TechnologyRepository();
    }

    /**
     * @param int|null $id
     * @return Collection|Technology
     */
    public function handle(
        int $id = null
    ): Collection|Technology
    {
        if ($id)
        {
            /**
             * @var Technology $technology
             */
            $technology          = $this->repository->findOneOrFail($id);
            $technology->photo   = $technology->photo ? Storage::url($technology->photo) : 'default.png';

            return $technology;
        }

        return $this->repository->all();
    }
}
