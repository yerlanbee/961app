<?php

namespace App\Domains\Buildings\Handlers\Buildings\Prices;

use App\Application\Repositories\Buildings\AddressRepository;
use App\Application\Repositories\Buildings\LayoutRepository;
use App\Application\Repositories\Buildings\PriceRepository;
use App\Support\Core\BaseRepository;

class DeletePriceByBuildingHandler
{
    protected BaseRepository $repository;

    public function __construct()
    {
        $this->repository = new PriceRepository;
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
