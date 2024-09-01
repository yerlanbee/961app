<?php

namespace App\Domains\Buildings\Handlers\Buildings;

use App\Application\Repositories\Buildings\AddressRepository;
use App\Application\Repositories\Buildings\BuildingRepository;
use App\Application\Repositories\Buildings\LayoutRepository;
use App\Application\Repositories\Buildings\LocationRepository;
use App\Application\Repositories\Buildings\PriceRepository;
use App\Domains\Buildings\Dto\Building\AddressDto;
use App\Domains\Buildings\Dto\Building\BuildingDto;
use App\Domains\Buildings\Dto\Building\LayoutDto;
use App\Domains\Buildings\Dto\Building\LocationDto;
use App\Domains\Buildings\Dto\Building\PriceDto;
use App\Domains\Buildings\Traits\UploadFile;
use App\Infrastructure\Models\Building;
use App\Support\Core\BaseRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Throwable;

class CreateBuildingHandler
{
    protected BaseRepository $repository;

    use UploadFile;

    /**
     * @param BuildingDto $dto
     * @return array|\Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection
     * @throws Exception
     */
    public function handle(BuildingDto $dto): array|\Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection
    {
        try {
            DB::beginTransaction();

            if ($dto->photo)
            {
                $url = $this->upload($dto->photo, 'buildings');

                $dto->setFilePath($url);
            }

            /**
             * @var Building $building
             */
            $building =(new BuildingRepository)->create($dto->toArray());

            if ($dto->relations)
            {
                foreach ($dto->relations as $table => $relation)
                {
                    $building->{$table}()->attach($relation['id'], [
                        'title' => $relation['title']
                    ]);
                }
            }


            $this->createAddress($building->id, $dto->address);

            $this->createLayout($building->id, $dto->layouts);

            $this->createPrice($building->id, $dto->price);

            $this->createLocations($building->id, $dto->locations);

            DB::commit();

            return $building;
        } catch (Throwable $exception) {
            DB::rollBack();

            throw new Exception($exception->getMessage());
        }
    }

    /**
     * @param int $buildingId
     * @param array $locations
     * @return void
     */
    private function createLocations(int $buildingId, array $locations): void
    {
        foreach($locations as $location)
        {
            /**
             * @var LocationDto $location
             */
            $location->setBuildingId($buildingId);

            (new LocationRepository)->create($location->toArray());
        }
    }

    /**
     * @param int $buildingId
     * @param PriceDto $dto
     * @return void
     */
    private function createPrice(int $buildingId, PriceDto $dto): void
    {
        $dto->setBuildingId($buildingId);

        (new PriceRepository)->create($dto->toArray());
    }

    /**
     * @param int $buildingId
     * @param AddressDto $dto
     * @return void
     */
    private function createAddress(int $buildingId, AddressDto $dto): void
    {
        $dto->setBuildingId($buildingId);

        (new AddressRepository)->create($dto->toArray());
    }

    /**
     * @param int $buildingId
     * @param array $layouts
     * @return void
     */
    private function createLayout(int $buildingId, array $layouts): void
    {
        foreach ($layouts as $layout)
        {
            /**
             * @var LayoutDto $layout
             */
            $layout->setBuildingId($buildingId);

            if ($layout->photo)
            {
                $url = $this->upload($layout->photo, 'layouts');

                $layout->setFilePath($url);

                (new LayoutRepository)->create($layout->toArray());
            }
        }
    }
}
