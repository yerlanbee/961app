<?php

namespace App\Domains\Buildings\Handlers\Buildings\Layouts;

use App\Application\Repositories\Buildings\AddressRepository;
use App\Application\Repositories\Buildings\LayoutRepository;
use App\Domains\Buildings\Dto\Building\AddressDto;
use App\Domains\Buildings\Dto\Building\LayoutDto;
use App\Domains\Buildings\Traits\UploadFile;
use App\Infrastructure\Models\Layout;
use App\Support\Core\BaseRepository;
use App\Support\Core\CustomException;
use Illuminate\Database\Eloquent\Builder;

class UpdateLayoutByBuildingHandler
{
    use UploadFile;

    protected BaseRepository $repository;

    public function __construct()
    {
        $this->repository = new LayoutRepository;
    }

    /**
     * @param LayoutDto $dto
     * @return void
     */
    public function handle(LayoutDto $dto): void
    {
        /**
         * @var Layout $layout
         */
        $layout = $this->repository->findOneOrFail($dto->getId());

        if ($layout->building_id != $dto->getBuildingId())
        {
            new CustomException('Layout scheme not from this building');
        }

        $data   = [
            'square_from'   => $dto->squareFrom,
            'square_to'     => $dto->squareTo,
            'rooms'         => $dto->rooms
        ];

        if ($dto->photo && $layout->photo)
        {
            $this->deleteFile($layout->photo);
            $path = $this->upload($dto->photo, 'layouts');

            $data['photo'] = $path;
        }

        $layout?->update($data);
    }
}
