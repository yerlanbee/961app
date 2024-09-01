<?php
declare(strict_types=1);

namespace App\Domains\Auth\Dto;

use App\Support\Core\BaseDto;
use App\Support\Helpers\Phone;

class LoginDto extends BaseDto
{
    /**
     * @param string $phone
     * @param string $password
     */
    public function __construct(
        public readonly string $phone,
        public readonly string $password
    )
    {}

    /**
     * @param array $data
     * @return static
     */
    public static function fromArray(array $data): static
    {
        return new self(
            Phone::normalize($data['phone']),
            $data['password']
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'phone'     => $this->phone,
            'password'  => $this->password
        ];
    }
}
