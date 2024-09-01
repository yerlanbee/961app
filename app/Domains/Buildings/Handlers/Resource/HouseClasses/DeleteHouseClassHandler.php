<?php

namespace App\Domains\Buildings\Handlers\Resource\HouseClasses;

use App\Application\Repositories\Buildings\HouseClassRepository;
use App\Support\Core\BaseRepository;

class DeleteHouseClassHandler
{
    protected BaseRepository $repository;

    public function __construct()
    {
        $this->repository = new HouseClassRepository();
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
