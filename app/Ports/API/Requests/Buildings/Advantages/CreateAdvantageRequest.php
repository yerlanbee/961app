<?php
declare(strict_types=1);

namespace App\Ports\API\Requests\Buildings\Advantages;

use App\Domains\Buildings\Dto\Recource\AdvantageDto;
use App\Support\Core\BaseFormRequest;

class CreateAdvantageRequest extends BaseFormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'         => 'required|string|max:100',
            'description'   => 'nullable|string|max:300',
            'photo'         => 'required|file|mimes:jpg,png|max:2024'
        ];
    }

    /**
     * @return AdvantageDto
     */
    public function toDto(): AdvantageDto
    {
        return AdvantageDto::fromArray($this->validated());
    }
}
