<?php
declare(strict_types=1);

namespace App\Ports\API\Requests\Buildings\Buildings;

use App\Domains\Buildings\Dto\Building\AddressDto;
use App\Domains\Buildings\Dto\Building\LayoutDto;
use App\Domains\Buildings\Dto\Building\PriceDto;
use App\Support\Core\BaseFormRequest;

class UpdatePriceRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'price_from'     => 'numeric',
            'price_to'       => 'numeric',
            'discount'       => 'numeric', // Скидка,
            'installment'    => 'numeric', // Рассрочка
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return PriceDto
     */
    public function toDto(): PriceDto
    {
        $validated = $this->validated();

        return PriceDto::fromArray($validated);
    }
}
