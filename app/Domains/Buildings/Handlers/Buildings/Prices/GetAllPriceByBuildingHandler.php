<?php

namespace App\Domains\Buildings\Handlers\Buildings\Prices;

use App\Application\Repositories\Buildings\AddressRepository;
use App\Application\Repositories\Buildings\LayoutRepository;
use App\Application\Repositories\Buildings\PriceRepository;
use App\Support\Core\BaseRepository;

class GetAllPriceByBuildingHandler
{
    protected BaseRepository $repository;

    public function __construct()
    {
        $this->repository = new PriceRepository;
    }

    /**
     * @param int|null $buildingId
     * @return array|\Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection
     */
    public function handle(int $buildingId = null): array|\Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection
    {
        $buildings = $this->repository->all();

        if ($buildingId)
        {
            return $this->repository->whereBuildingId($buildingId)->get();
        }

        return $buildings;
    }
}
