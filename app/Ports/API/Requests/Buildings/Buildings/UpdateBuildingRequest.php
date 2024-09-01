<?php
declare(strict_types=1);

namespace App\Ports\API\Requests\Buildings\Buildings;

use App\Domains\Buildings\Dto\Building\BuildingDto;
use App\Support\Core\BaseFormRequest;

class UpdateBuildingRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name'                 => 'string|max:200',
            'square_from'          => 'numeric',
            'square_to'            => 'numeric',
            'number_floors'         => 'integer|min:1',
            'number_apartments'    => 'integer|min:1',
            'number_parking_spaces' => 'integer|min:1',
            'is_mock'              => 'bool',
            'photo'                 => 'file|mimes:jpg,png|max:2024',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return BuildingDto
     */
    public function toDto(): BuildingDto
    {
        $validated = $this->validated();

        return BuildingDto::fromArray($validated);
    }
}
