<?php

namespace App\Domains\Buildings\Dto\Recource;

use App\Support\Core\BaseDto;
use Illuminate\Http\UploadedFile;

class HouseClassDto extends BaseDto
{
    private int $id;

    /**
     * @param string|null $title
     * @param string|null $published
     */
    public function __construct(
        public ?string $title,
        public ?string $published
    )
    {}

    /**
     * @param array $data
     * @return static
     */
    public static function fromArray(array $data): static
    {
        return new self(
            $data['title'] ?? null,
            $data['description'] ?? null,
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'title'                 => $this->title ?? null,
            'published'             => $this->published ?? false
        ];
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
    public function getId(): int
    {
        return $this->id;
    }
}
