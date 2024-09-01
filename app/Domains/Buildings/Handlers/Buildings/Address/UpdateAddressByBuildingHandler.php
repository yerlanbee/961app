<?php

namespace App\Domains\Buildings\Handlers\Buildings\Address;

use App\Application\Repositories\Buildings\AddressRepository;
use App\Domains\Buildings\Dto\Building\AddressDto;
use App\Support\Core\BaseRepository;
use Illuminate\Database\Eloquent\Builder;

class UpdateAddressByBuildingHandler
{
    protected BaseRepository $repository;

    public function __construct()
    {
        $this->repository = new AddressRepository();
    }

    /**
     * @param AddressDto $dto
     * @return void
     */
    public function handle(AddressDto $dto): void
    {
        /**
         * @var Builder $address
         */
        $address = $this->repository->whereBuildingId($dto->getBuildingId());


        $address?->update([
            'address'   => $dto->address,
            'longitude' => $dto->longitude,
            'latitude'  => $dto->latitude
        ]);
    }
}
