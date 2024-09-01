<?php

namespace App\Domains\Buildings\Handlers\Buildings;

use App\Application\Repositories\Buildings\BuildingRepository;
use App\Support\Core\BaseRepository;

class DeleteBuildingHandler
{
    protected BaseRepository $repository;

    public function __construct()
    {
        $this->repository = new BuildingRepository();
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
