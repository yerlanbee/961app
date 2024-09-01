<?php
declare(strict_types=1);

namespace App\Ports\API\Requests\Buildings\Technologies;

use App\Domains\Buildings\Dto\Recource\TechnologyDto;
use App\Support\Core\BaseFormRequest;

class UpdateTechnologyRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'title'         => 'required|string|max:100',
            'description'   => 'nullable|string|max:300',
            'photo'         => 'nullable|file|mimes:jpg,png|max:5000'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function toDto(): TechnologyDto
    {
        return TechnologyDto::fromArray($this->validated());
    }
}
