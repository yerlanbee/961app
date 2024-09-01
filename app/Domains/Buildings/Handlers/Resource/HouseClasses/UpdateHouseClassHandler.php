<?php

namespace App\Domains\Buildings\Handlers\Resource\HouseClasses;

use App\Application\Repositories\Buildings\HouseClassRepository;
use App\Domains\Buildings\Dto\Recource\HouseClassDto;
use App\Support\Core\BaseRepository;

class UpdateHouseClassHandler
{
    protected BaseRepository $repository;

    public function __construct()
    {
        $this->repository = new HouseClassRepository();
    }

    /**
     * @param HouseClassDto $dto
     * @return void
     */
    public function handle(HouseClassDto $dto): void
    {
        $this->repository->update($dto->toArray(), $dto->getId());
    }
}
