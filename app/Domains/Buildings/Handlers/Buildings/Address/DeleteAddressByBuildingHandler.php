<?php

namespace App\Domains\Buildings\Handlers\Buildings\Address;

use App\Application\Repositories\Buildings\AddressRepository;
use App\Support\Core\BaseRepository;

class DeleteAddressByBuildingHandler
{
    protected BaseRepository $repository;

    public function __construct()
    {
        $this->repository = new AddressRepository();
    }

    /**
     * @param int $id
     * @return void
     */
    public function handle(int $id): void
    {
        $this->repository->whereBuildingId($id)->delete();
    }
}
