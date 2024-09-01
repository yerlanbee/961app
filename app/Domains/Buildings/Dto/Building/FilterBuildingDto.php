<?php

namespace App\Domains\Buildings\Dto\Building;

use App\Support\Core\BaseDto;

class FilterBuildingDto extends BaseDto
{
    /**
     * @param string|null $squareFrom
     * @param string|null $squareTo
     * @param string|null $numberFloors
     * @param string|null $numberParkingSpaces
     */
    public function __construct(
        public ?string $squareFrom,
        public ?string $squareTo,
        public ?string $numberFloors,
        public ?string $numberParkingSpaces,
    )
    {}

    /**
     * @param array $data
     * @return static
     */
    public static function fromArray(array $data): static
    {
        return new self(
            $data['square_from'] ?? null,
            $data['square_to'] ?? null,
            $data['number_floors'] ?? null,
            $data['number_parking_spaces'] ?? null
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [];
    }
}
