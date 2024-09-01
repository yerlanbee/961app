<?php
declare(strict_types=1);

namespace App\Domains\Auth\Dto;

use Illuminate\Support\Facades\Hash;
use App\Support\Core\BaseDto;
use App\Support\Helpers\Phone;

class RegisterDto extends BaseDto
{
    public function __construct(
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly ?string $phone,
        public readonly string $password,
    )
    {}

    /**
     * @param array $data
     * @return static
     */
    public static function fromArray(array $data): static
    {
        $phone      = Phone::normalize($data['phone']);
        $password   = encrypt($data['password']);

        return new self(
            $data['first_name'],
            $data['last_name'],
            $phone ?? null,
            $password
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'first_name'     => $this->firstName,
            'last_name'     => $this->lastName,
            'phone'         => $this->phone,
            'password'      => $this->password,
        ];
    }
}
