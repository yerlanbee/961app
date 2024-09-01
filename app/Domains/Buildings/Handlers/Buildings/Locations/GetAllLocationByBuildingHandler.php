<?php

namespace App\Domains\Buildings\Handlers\Buildings\Locations;

use App\Application\Repositories\Buildings\AddressRepository;
use App\Application\Repositories\Buildings\LayoutRepository;
use App\Application\Repositories\Buildings\LocationRepository;
use App\Application\Repositories\Buildings\PriceRepository;
use App\Support\Core\BaseRepository;

class GetAllLocationByBuildingHandler
{
    protected BaseRepository $repository;

    public function __construct()
    {
        $this->repository = new LocationRepository;
    }

    /**
     * @param int|null $buildingId
     * @return array|\Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection
     */
    public function handle(int $buildingId = null): array|\Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection
    {
        $locations = $this->repository->all();

        if ($buildingId)
        {
            return $this->repository->whereBuildingId($buildingId)->get();
        }

        return $locations;
    }
}
