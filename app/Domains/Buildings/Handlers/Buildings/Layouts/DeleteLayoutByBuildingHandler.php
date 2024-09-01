<?php

namespace App\Domains\Buildings\Handlers\Buildings\Layouts;

use App\Application\Repositories\Buildings\AddressRepository;
use App\Application\Repositories\Buildings\LayoutRepository;
use App\Support\Core\BaseRepository;

class DeleteLayoutByBuildingHandler
{
    protected BaseRepository $repository;

    public function __construct()
    {
        $this->repository = new LayoutRepository();
    }

    /**
     * @param int $id
     * @return void
     */
    public function handle(int $id): void
    {
        $this->repository->findOneOrFail($id)->delete();
    }
}
