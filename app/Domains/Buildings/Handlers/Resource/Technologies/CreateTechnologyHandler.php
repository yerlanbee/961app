<?php

namespace App\Domains\Buildings\Handlers\Resource\Technologies;

use App\Application\Repositories\Buildings\TechnologyRepository;
use App\Domains\Buildings\Dto\Recource\TechnologyDto;
use App\Domains\Buildings\Traits\UploadFile;
use App\Support\Core\BaseRepository;

class CreateTechnologyHandler
{
    use UploadFile;

    protected BaseRepository $repository;

    public function __construct()
    {
        $this->repository = new TechnologyRepository();
    }

    /**
     * @param TechnologyDto $dto
     * @return array|\Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection
     */
    public function handle(TechnologyDto $dto): array|\Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection
    {
        if ($dto->photo)
        {
            $url = $this->upload($dto->photo, 'technologies');
            $dto->setFilePath($url);
        }

        return $this->repository->create($dto->toArray());
    }
}
