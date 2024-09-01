<?php

namespace App\Domains\Buildings\Handlers\Buildings;

use App\Application\Repositories\Buildings\BuildingRepository;
use App\Domains\Buildings\Dto\Building\FilterBuildingDto;
use App\Support\Core\BaseRepository;
use App\Support\Core\CustomException;

class GetAllBuildingHandler
{
    protected BaseRepository $repository;

    public function __construct()
    {
        $this->repository = new BuildingRepository();
    }


    public function handle(FilterBuildingDto $dto): array|\Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection
    {
        $buildings = $this->repository->all();

        if ($buildings->isEmpty())
        {
            new CustomException('Buildings is empty');
        }

        return $buildings;
    }
}
