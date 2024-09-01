<?php
declare(strict_types=1);

namespace App\Ports\API\Requests\Buildings\Buildings;

use App\Domains\Buildings\Dto\Building\FindBuildingDto;
use App\Support\Core\BaseFormRequest;

class FindBuildingRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'include' => 'nullable|string'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return FindBuildingDto
     */
    public function toDto(): FindBuildingDto
    {
        $validated = $this->validated();

        return FindBuildingDto::fromArray($validated);
    }
}
