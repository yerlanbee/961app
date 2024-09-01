<?php

namespace App\Domains\Buildings\Handlers\Resource\Advantages;

use App\Application\Repositories\Buildings\AdvantageRepository;
use App\Support\Core\BaseRepository;

class DeleteAdvantageHandler
{
    protected BaseRepository $repository;

    public function __construct()
    {
        $this->repository = new AdvantageRepository();
    }

    /**
     * @param int $id
     * @return void
     */
    public function handle(int $id): void
    {
        $this->repository->deleteOne($id);
    }
}
