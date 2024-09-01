<?php
declare(strict_types=1);

namespace App\Ports\API\Requests\Buildings\Buildings;

use App\Domains\Buildings\Dto\Building\AddressDto;
use App\Support\Core\BaseFormRequest;

class UpdateAddressRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'address'       => 'string|max:200',
            'longitude'     => 'numeric|between:-180,180',
            'latitude'      => 'numeric|between:-90,90',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return AddressDto
     */
    public function toDto(): AddressDto
    {
        $validated = $this->validated();

        return AddressDto::fromArray($validated);
    }
}
