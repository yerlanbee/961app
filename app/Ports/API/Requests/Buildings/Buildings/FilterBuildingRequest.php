<?php
declare(strict_types=1);

namespace App\Ports\API\Requests\Buildings\Buildings;

use App\Domains\Buildings\Dto\Building\FilterBuildingDto;
use App\Support\Core\BaseFormRequest;

class FilterBuildingRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'square_from'   => 'nullable|numeric',
            'square_to'     => 'nullable|numeric',
            'number_floors'  => 'nullable|numeric',
            'number_parking_spaces'  => 'nullable|numeric',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return FilterBuildingDto
     */
    public function toDto(): FilterBuildingDto
    {
        $validated = $this->validated();

        return FilterBuildingDto::fromArray($validated);
    }
}
