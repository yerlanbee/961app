<?php

namespace App\Domains\Buildings\Dto\Recource;

use App\Support\Core\BaseDto;
use Illuminate\Http\UploadedFile;

class TechnologyDto extends BaseDto
{
    private int $id;

    private ?string $filePath;

    /**
     * @param ?string $title
     * @param ?string $description
     * @param UploadedFile|null $photo
     */
    public function __construct(
        public ?string $title,
        public ?string $description,
        public ?UploadedFile $photo,
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
            $data['photo'] ?? null,
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'title'                 => $this->title ?? null,
            'description'           => $this->description ?? null,
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
        $this->id = $id;
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
