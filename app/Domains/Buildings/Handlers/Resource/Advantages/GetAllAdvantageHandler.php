<?php

namespace App\Domains\Buildings\Handlers\Resource\Advantages;

use App\Application\Repositories\Buildings\AdvantageRepository;
use App\Infrastructure\Models\Advantage;
use App\Support\Core\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class GetAllAdvantageHandler
{
    protected BaseRepository $repository;

    public function __construct()
    {
        $this->repository = new AdvantageRepository;
    }

    /**
     * @param int|null $id
     * @return Collection|Model
     */
    public function handle(
        int $id = null
    ): Collection|Model
    {
        if ($id)
        {
            /**
             * @var Advantage $advantage
             */
            $advantage          = $this->repository->findOneOrFail($id);
            $advantage->photo   = $advantage->photo ? Storage::url($advantage->photo) : 'default.png';

            return $advantage;
        }

         return $this->repository->all();
    }
}
