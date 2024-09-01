<?php

namespace App\Domains\Buildings\Dto\Building;

use App\Support\Core\BaseDto;

class LocationDto extends BaseDto
{
    private int $id;

    private int $buildingId;

    /**
     * @param string|null $name
     * @param string|null $description
     */
    public function __construct(
        public ?string $name,
        public ?string $description
    )
    {}

    /**
     * @param array $data
     * @return static
     */
    public static function fromArray(array $data): static
    {
        return new self(
            $data['name'] ?? null,
            $data['description'] ?? null
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'building_id'   => $this->buildingId,
            'name'          => $this->name,
            'description'   => $this->description
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
     * @param int $id
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getBuildingId(): int
    {
        return $this->buildingId;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
