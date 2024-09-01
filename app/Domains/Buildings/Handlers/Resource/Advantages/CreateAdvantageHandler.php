<?php

namespace App\Domains\Buildings\Handlers\Resource\Advantages;

use App\Application\Repositories\Buildings\AdvantageRepository;
use App\Domains\Buildings\Dto\Recource\AdvantageDto;
use App\Domains\Buildings\Traits\UploadFile;
use App\Support\Core\BaseRepository;

class CreateAdvantageHandler
{
    use UploadFile;

    protected BaseRepository $repository;

    public function __construct()
    {
        $this->repository = new AdvantageRepository();
    }

    /**
     * @param AdvantageDto $dto
     * @return array|\Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection
     */
    public function handle(AdvantageDto $dto): array|\Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection
    {
        if ($dto->photo)
        {
            $url = $this->upload($dto->photo, 'advantages');

            $dto->setFilePath($url);
        }

        return $this->repository->create($dto->toArray());
    }
}
