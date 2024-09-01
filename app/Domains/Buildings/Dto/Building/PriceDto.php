<?php

namespace App\Domains\Buildings\Dto\Building;

use App\Support\Core\BaseDto;

class PriceDto extends BaseDto
{
    private int $buildingId;

    /**
     * @param float|null $priceFrom
     * @param float|null $priceTo
     * @param float|null $discount
     * @param float|null $installment
     */
    public function __construct(
        public ?float $priceFrom,
        public ?float $priceTo,
        public ?float $discount,
        public ?float $installment
    )
    {}

    /**
     * @param array $data
     * @return static
     */
    public static function fromArray(array $data): static
    {
        return new self(
            $data['price_from'] ?? null,
            $data['price_to'] ?? null,
            $data['discount'] ?? null,
            $data['installment'] ?? null
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'building_id'   => $this->buildingId,
            'price_from'    => $this->priceFrom,
            'price_to'      => $this->priceTo,
            'discount'      => $this->discount,
            'installment'   => $this->installment,
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
