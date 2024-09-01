<?php

namespace App\Domains\Buildings\Handlers\Resource\Landscapings;

use App\Application\Repositories\Buildings\LandscapingRepository;
use App\Support\Core\BaseRepository;

class DeleteLandscapingHandler
{
    protected BaseRepository $repository;

    public function __construct()
    {
        $this->repository = new LandscapingRepository();
    }

    /**
     * @param int $id
     * @return void
     */
    public function handle(int $id): void
    {
        $this->repository->deleteOne($id);
    }
}
