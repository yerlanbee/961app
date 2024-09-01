<?php

namespace App\Domains\Buildings\Dto\Building;

use App\Support\Core\BaseDto;

class FindBuildingDto extends BaseDto
{
    private int $buildingId;

    /**
     * @param array|string|null $include
     */
    public function __construct(
        public array|string|null $include
    )
    {}

    /**
     * @param array $data
     * @return static
     */
    public static function fromArray(array $data): static
    {
        $data['include'] = explode(',', $data['include']);

        return new self(
            $data['include'] ?? null
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [];
    }

    public function setId(int $id): void
    {
        $this->buildingId = $id;
    }

    public function getId(): int
    {
        return $this->buildingId;
    }
}
