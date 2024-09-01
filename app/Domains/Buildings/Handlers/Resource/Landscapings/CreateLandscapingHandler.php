<?php

namespace App\Domains\Buildings\Handlers\Resource\Landscapings;

use App\Application\Repositories\Buildings\LandscapingRepository;
use App\Domains\Buildings\Dto\Recource\LandscapingDto;
use App\Domains\Buildings\Traits\UploadFile;
use App\Support\Core\BaseRepository;

class CreateLandscapingHandler
{
    use UploadFile;

    protected BaseRepository $repository;

    public function __construct()
    {
        $this->repository = new LandscapingRepository();
    }

    /**
     * @param LandscapingDto $dto
     * @return array|\Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection
     */
    public function handle(LandscapingDto $dto): array|\Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection
    {
        if ($dto->photo)
        {
            $url = $this->upload($dto->photo, 'landscapings');

            $dto->setFilePath($url);
        }

        return $this->repository->create($dto->toArray());
    }
}
