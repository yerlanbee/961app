<?php

namespace App\Domains\Buildings\Handlers\Resource\Technologies;

use App\Application\Repositories\Buildings\TechnologyRepository;
use App\Support\Core\BaseRepository;

class DeleteTechnologyHandler
{
    protected BaseRepository $repository;

    public function __construct()
    {
        $this->repository = new TechnologyRepository();
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
