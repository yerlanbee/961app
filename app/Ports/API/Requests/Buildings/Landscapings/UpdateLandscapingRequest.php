<?php
declare(strict_types=1);

namespace App\Ports\API\Requests\Buildings\Landscapings;

use App\Domains\Buildings\Dto\Recource\LandscapingDto;
use App\Support\Core\BaseFormRequest;

class UpdateLandscapingRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'title'         => 'nullable|string|max:100',
            'description'   => 'nullable|string|max:300',
            'photo'         => 'nullable|file|mimes:jpg,png|max:5000'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function toDto(): LandscapingDto
    {
        return LandscapingDto::fromArray($this->validated());
    }
}
