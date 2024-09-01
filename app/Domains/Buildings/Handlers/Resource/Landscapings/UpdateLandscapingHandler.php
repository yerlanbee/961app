<?php

namespace App\Domains\Buildings\Handlers\Resource\Landscapings;

use App\Application\Repositories\Buildings\LandscapingRepository;
use App\Domains\Buildings\Dto\Recource\LandscapingDto;
use App\Domains\Buildings\Traits\UploadFile;
use App\Infrastructure\Models\Landscaping;
use App\Support\Core\BaseRepository;

class UpdateLandscapingHandler
{
    use UploadFile;

    protected BaseRepository $repository;

    public function __construct()
    {
        $this->repository = new LandscapingRepository();
    }

    /**
     * @param LandscapingDto $dto
     * @return void
     */
    public function handle(LandscapingDto $dto): void
    {
        if ($dto->photo)
        {
            /**
             * @var Landscaping $landscaping
             */
            $landscaping = $this->repository->findOneOrFail($dto->getId());

            $this->deleteFile($landscaping->photo);

            $path = $this->upload($dto->photo, 'landscapings');

            $dto->setFilePath($path);
        }
        $this->repository->update($dto->toArray(), $dto->getId());
    }
}
