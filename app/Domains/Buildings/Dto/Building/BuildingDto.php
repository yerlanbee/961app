<?php

namespace App\Domains\Buildings\Dto\Building;

use App\Support\Core\BaseDto;
use Illuminate\Http\UploadedFile;

class BuildingDto extends BaseDto
{
    private int $buildingId;

    private ?string $filePath;

    /**
     * @param string $name
     * @param float $squareFrom
     * @param float $squareTo
     * @param int $numberFloors
     * @param int $numberApartments
     * @param int $numberParkingSpaces
     * @param UploadedFile|null $photo
     * @param bool $isMock
     * @param array|null $relations
     * @param AddressDto|null $address
     * @param PriceDto|null $price
     * @param array|null $layouts
     * @param array|null $locations
     */
    public function __construct(
        public string $name,
        public float $squareFrom,
        public float $squareTo,
        public int $numberFloors,
        public int $numberApartments,
        public int $numberParkingSpaces,
        public ?UploadedFile $photo,
        public bool $isMock,
        public ?array $relations,
        public ?AddressDto $address,
        public ?PriceDto $price,
        public ?array $layouts,
        public ?array $locations,
    )
    {}

    /**
     * @param array $data
     * @return static
     */
    public static function fromArray(array $data): static
    {
        $address    = isset($data['address_info']) ? AddressDto::fromArray($data['address_info']) : null;

        $layout     = isset($data['layout_info']) ? array_map(function ($layout){
            return LayoutDto::fromArray($layout);
        }, $data['layout_info']) : null;

        $price      = isset($data['price_info']) ? PriceDto::fromArray($data['price_info']) : null;

        $location   = isset($data['location_info']) ? array_map(function ($location){
            return LocationDto::fromArray($location);

        }, $data['location_info']) : null;

        return new self(
            $data['name'],
            $data['square_from'],
            $data['square_to'],
            $data['number_floors'],
            $data['number_apartments'],
            $data['number_parking_spaces'],
            $data['photo'] ?? null,
            $data['is_mock'] ?? false,
            $data['relations'] ?? null,
            $address,
            $price,
            $layout,
            $location
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name'                  => $this->name,
            'square_from'           => $this->squareFrom,
            'square_to'             => $this->squareTo,
            'number_floors'          => $this->numberFloors,
            'number_apartments'     => $this->numberApartments,
            'number_parking_spaces' => $this->numberParkingSpaces,
            'is_mock'               => $this->isMock,
            'photo'                 => $this->filePath ?? null
        ];
    }

    /**
     * @param string $path
     * @return void
     */
    public function setFilePath(string $path): void
    {
        $this->filePath = $path;
    }

    /**
     * @param int $id
     * @return void
     */
    public function setId(int $id): void
    {
        $this->buildingId = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->buildingId;
    }

    /**
     * @return string
     */
    public function getFilePath(): string
    {
        return $this->filePath;
    }
}
