<?php
declare(strict_types=1);

namespace App\Ports\API\Requests\Buildings\Buildings;

use App\Domains\Buildings\Dto\Building\AddressDto;
use App\Domains\Buildings\Dto\Building\LayoutDto;
use App\Support\Core\BaseFormRequest;

class UpdateLayoutRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'building_id'   => 'required|integer|exists:buildings,id',
            'square_from'   => 'numeric',
            'square_to'     => 'numeric',
            'rooms'         => 'integer',
            'photo'         => 'file|mimes:jpg,png|max:2024',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return LayoutDto
     */
    public function toDto(): LayoutDto
    {
        $validated = $this->validated();

        $dto = LayoutDto::fromArray($validated);

        $dto->setBuildingId((int) $validated['building_id']);

        return $dto;
    }
}
