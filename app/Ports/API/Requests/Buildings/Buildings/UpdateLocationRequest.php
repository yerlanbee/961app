<?php
declare(strict_types=1);

namespace App\Ports\API\Requests\Buildings\Buildings;

use App\Domains\Buildings\Dto\Building\AddressDto;
use App\Domains\Buildings\Dto\Building\LayoutDto;
use App\Domains\Buildings\Dto\Building\LocationDto;
use App\Support\Core\BaseFormRequest;

class UpdateLocationRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'building_id' => 'required|integer|exists:buildings,id',
            'name'        => 'string|max:100',
            'description' => 'string|max:200',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return LocationDto
     */
    public function toDto(): LocationDto
    {
        $validated = $this->validated();

        $dto = LocationDto::fromArray($validated);

        $dto->setBuildingId((int) $validated['building_id']);

        return $dto;
    }
}
