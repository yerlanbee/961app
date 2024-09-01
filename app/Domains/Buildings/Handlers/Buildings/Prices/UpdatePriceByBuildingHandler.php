<?php

namespace App\Domains\Buildings\Handlers\Buildings\Prices;

use App\Application\Repositories\Buildings\AddressRepository;
use App\Application\Repositories\Buildings\LayoutRepository;
use App\Application\Repositories\Buildings\PriceRepository;
use App\Domains\Buildings\Dto\Building\AddressDto;
use App\Domains\Buildings\Dto\Building\LayoutDto;
use App\Domains\Buildings\Dto\Building\PriceDto;
use App\Domains\Buildings\Traits\UploadFile;
use App\Infrastructure\Models\Layout;
use App\Support\Core\BaseRepository;
use Illuminate\Database\Eloquent\Builder;

class UpdatePriceByBuildingHandler
{
    use UploadFile;

    protected BaseRepository $repository;

    public function __construct()
    {
        $this->repository = new PriceRepository;
    }

    /**
     * @param PriceDto $dto
     * @return void
     */
    public function handle(PriceDto $dto): void
    {
        /**
         * @var Layout $layout
         */
        $layout = $this->repository->whereBuildingId($dto->getBuildingId())->first();

        $layout?->update($dto->toArray());
    }
}
