<?php

namespace App\Domains\Buildings\Handlers\Buildings\Locations;

use App\Application\Repositories\Buildings\AddressRepository;
use App\Application\Repositories\Buildings\LayoutRepository;
use App\Application\Repositories\Buildings\LocationRepository;
use App\Application\Repositories\Buildings\PriceRepository;
use App\Domains\Buildings\Dto\Building\AddressDto;
use App\Domains\Buildings\Dto\Building\LayoutDto;
use App\Domains\Buildings\Dto\Building\LocationDto;
use App\Domains\Buildings\Dto\Building\PriceDto;
use App\Domains\Buildings\Traits\UploadFile;
use App\Infrastructure\Models\Layout;
use App\Infrastructure\Models\Location;
use App\Support\Core\BaseRepository;
use App\Support\Core\CustomException;
use Illuminate\Database\Eloquent\Builder;

class UpdateLocationByBuildingHandler
{
    use UploadFile;

    protected BaseRepository $repository;

    public function __construct()
    {
        $this->repository = new LocationRepository;
    }

    /**
     * @param LocationDto $dto
     * @return void
     */
    public function handle(LocationDto $dto): void
    {
        /**
         * @var Location $location
         */
        $location = $this->repository->findOneOrFail($dto->getId())->first();

        if ($location->building_id != $dto->getBuildingId())
        {
            new CustomException('Location not from this building');
        }

        $location?->update([
            'name' => $dto->name,
            'description' => $dto->description
        ]);
    }
}
