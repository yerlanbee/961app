<?php

namespace App\Domains\Buildings\Dto\Building;

use App\Support\Core\BaseDto;

class AddressDto extends BaseDto
{
    private int $buildingId;

    /**
     * @param string|null $address
     * @param float|null $longitude
     * @param float|null $latitude
     */
    public function __construct(
        public ?string $address,
        public ?float $longitude,
        public ?float $latitude
    )
    {}

    public static function fromArray(array $data): static
    {
        return new self(
            $data['address'] ?? null,
            $data['longitude'] ?? null,
            $data['latitude'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'building_id'   => $this->buildingId,
            'address'       => $this->address,
            'longitude'     => $this->longitude,
            'latitude'      => $this->latitude
        ];
    }

    /**
     * @param int $id
     * @return void
     */
    public function setBuildingId(int $id): void
    {
        $this->buildingId = $id;
    }

    /**
     * @return int
     */
    public function getBuildingId(): int
    {
        return $this->buildingId;
    }
}
