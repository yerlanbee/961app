<?php

namespace App\Domains\Buildings\Handlers\Resource\Advantages;

use App\Application\Repositories\Buildings\AdvantageRepository;
use App\Domains\Buildings\Dto\Recource\AdvantageDto;
use App\Domains\Buildings\Traits\UploadFile;
use App\Infrastructure\Models\Advantage;
use App\Support\Core\BaseRepository;

class UpdateAdvantageHandler
{
    use UploadFile;

    protected BaseRepository $repository;

    public function __construct()
    {
        $this->repository = new AdvantageRepository();
    }

    /**
     * @param AdvantageDto $dto
     * @return void
     */
    public function handle(AdvantageDto $dto): void
    {
        if ($dto->photo)
        {
            /**
             * @var Advantage $advantage
             */
            $advantage = $this->repository->findOneOrFail($dto->getId());

            $this->deleteFile($advantage->photo);

            $path = $this->upload($dto->photo, 'advantages');

            $dto->setFilePath($path);
        }
        $this->repository->update($dto->toArray(), $dto->getId());
    }
}
