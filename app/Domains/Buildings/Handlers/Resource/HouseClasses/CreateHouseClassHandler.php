<?php

namespace App\Domains\Buildings\Handlers\Resource\HouseClasses;

use App\Application\Repositories\Buildings\HouseClassRepository;
use App\Domains\Buildings\Dto\Recource\HouseClassDto;
use App\Domains\Buildings\Traits\UploadFile;
use App\Support\Core\BaseRepository;

class CreateHouseClassHandler
{
    use UploadFile;

    protected BaseRepository $repository;

    public function __construct()
    {
        $this->repository = new HouseClassRepository();
    }

    /**
     * @param HouseClassDto $dto
     * @return array|\Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection
     */
    public function handle(HouseClassDto $dto): array|\Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection
    {
        return $this->repository->create($dto->toArray());
    }
}
