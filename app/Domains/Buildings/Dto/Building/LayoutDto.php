<?php

namespace App\Domains\Buildings\Dto\Building;

use App\Support\Core\BaseDto;
use Illuminate\Http\UploadedFile;

class LayoutDto extends BaseDto
{
    private int $buildingId;

    private int $id;

    private string $filePath;

    /**
     * @param float|null $squareFrom
     * @param float|null $squareTo
     * @param int|null $rooms
     * @param UploadedFile|null $photo
     */
    public function __construct(
        public ?float $squareFrom,
        public ?float $squareTo,
        public ?int $rooms,
        public ?UploadedFile $photo
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
            $data['rooms'] ?? null,
            $data['photo'] ?? null
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'building_id'   => $this->buildingId,
            'square_from'   => $this->squareFrom,
            'square_to'     => $this->squareTo,
            'rooms'         => $this->rooms,
            'photo'         => $this->filePath ?? 'default.png',
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
     * @param string $path
     * @return void
     */
    public function setFilePath(string $path): void
    {
        $this->filePath = $path;
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

    /**
     * @return string
     */
    public function getFilePath(): string
    {
        return $this->filePath;
    }
}
