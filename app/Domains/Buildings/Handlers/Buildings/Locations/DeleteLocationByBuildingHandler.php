<?php

namespace App\Domains\Buildings\Handlers\Buildings\Locations;

use App\Application\Repositories\Buildings\AddressRepository;
use App\Application\Repositories\Buildings\LayoutRepository;
use App\Application\Repositories\Buildings\LocationRepository;
use App\Application\Repositories\Buildings\PriceRepository;
use App\Support\Core\BaseRepository;

class DeleteLocationByBuildingHandler
{
    protected BaseRepository $repository;

    public function __construct()
    {
        $this->repository = new LocationRepository;
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
