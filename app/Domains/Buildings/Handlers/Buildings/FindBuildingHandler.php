<?php

namespace App\Domains\Buildings\Handlers\Buildings;

use App\Application\Repositories\Buildings\BuildingRepository;
use App\Domains\Buildings\Dto\Building\FindBuildingDto;
use App\Support\Core\BaseRepository;

class FindBuildingHandler
{
    protected BaseRepository $repository;

    public function __construct()
    {
        $this->repository = new BuildingRepository();
    }


    /**
     * @param FindBuildingDto $dto
     * @return array|\Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection
     */
    public function handle(FindBuildingDto $dto): array|\Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection
    {
        return $this->repository->findWithRelations($dto->getId(), $dto->include);
    }
}
