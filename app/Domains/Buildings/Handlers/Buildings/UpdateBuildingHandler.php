<?php

namespace App\Domains\Buildings\Handlers\Buildings;

use App\Application\Repositories\Buildings\BuildingRepository;
use App\Domains\Buildings\Dto\Building\BuildingDto;
use App\Domains\Buildings\Traits\UploadFile;
use App\Infrastructure\Models\Building;
use App\Support\Core\BaseRepository;

class UpdateBuildingHandler
{
    use UploadFile;
    protected BaseRepository $repository;

    public function __construct()
    {
        $this->repository = new BuildingRepository;
    }

    /**
     * @param BuildingDto $dto
     * @return void
     */
    public function handle(BuildingDto $dto): void
    {
        /**
         * @var Building $building
         */
        $building = $this->repository->findOneOrFail($dto->getId());

        if ($dto->photo && $building->photo)
        {
            $this->deleteFile($building->photo);

            $url = $this->upload($dto->photo, 'buildings');

            $dto->setFilePath($url);
        }

        $this->repository->update($dto->toArray(), $dto->getId());
    }
}
