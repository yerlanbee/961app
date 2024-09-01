<?php

namespace App\Domains\Buildings\Handlers\Resource\HouseClasses;

use App\Application\Repositories\Buildings\HouseClassRepository;
use App\Infrastructure\Models\HouseClass;
use App\Support\Core\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class GetAllHouseClassHandler
{
    protected BaseRepository $repository;

    public function __construct()
    {
        $this->repository = new HouseClassRepository();
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
             * @var HouseClass $houseClass
             */
            $houseClass          = $this->repository->findOneOrFail($id);
            $houseClass->photo   = $houseClass->photo ? Storage::url($houseClass->photo) : 'default.png';

            return $houseClass;
        }

        return $this->repository->all();
    }
}
