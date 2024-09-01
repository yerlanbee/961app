<?php

namespace App\Domains\Buildings\Handlers\Buildings\Address;

use App\Application\Repositories\Buildings\AddressRepository;
use App\Support\Core\BaseRepository;

class GetAllAddressByBuildingHandler
{
    protected BaseRepository $repository;

    public function __construct()
    {
        $this->repository = new AddressRepository();
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
