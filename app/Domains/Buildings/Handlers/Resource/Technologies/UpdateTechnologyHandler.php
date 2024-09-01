<?php

namespace App\Domains\Buildings\Handlers\Resource\Technologies;

use App\Application\Repositories\Buildings\TechnologyRepository;
use App\Domains\Buildings\Dto\Recource\TechnologyDto;
use App\Domains\Buildings\Traits\UploadFile;
use App\Infrastructure\Models\Landscaping;
use App\Infrastructure\Models\Technology;
use App\Support\Core\BaseRepository;

class UpdateTechnologyHandler
{
    use UploadFile;

    protected BaseRepository $repository;

    public function __construct()
    {
        $this->repository = new TechnologyRepository();
    }

    /**
     * @param TechnologyDto $dto
     * @return void
     */
    public function handle(TechnologyDto $dto): void
    {
        if ($dto->photo)
        {
            /**
             * @var Technology $technology
             */
            $technology = $this->repository->findOneOrFail($dto->getId());

            $this->deleteFile($technology->photo);

            $path = $this->upload($dto->photo, 'technologies');

            $dto->setFilePath($path);
        }

        $this->repository->update($dto->toArray(), $dto->getId());
    }
}
