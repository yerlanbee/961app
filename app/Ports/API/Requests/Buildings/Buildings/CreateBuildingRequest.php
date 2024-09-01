<?php
declare(strict_types=1);

namespace App\Ports\API\Requests\Buildings\Buildings;

use App\Domains\Buildings\Dto\Building\BuildingDto;
use App\Support\Core\BaseFormRequest;

class CreateBuildingRequest extends BaseFormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'                  => 'required|string|max:200',
            'square_from'           => 'required|numeric',
            'square_to'             => 'required|numeric',
            'number_floors'          => 'required|integer|min:1',
            'number_apartments'     => 'required|integer|min:1',
            'number_parking_spaces' => 'required|integer|min:1',
            'photo'                 => 'required|file|mimes:jpg,png|max:2024',
            'is_mock'               => 'bool',

            /**
             * Information about additional.
             */
            'relations'                     => 'required|array',
            'relations.technologies.id'     => 'integer|exists:technologies,id',
            'relations.technologies.title'  => 'string|max:100',
            'relations.advantages.id'       => 'integer|exists:advantages,id',
            'relations.advantages.title'    => 'string|nullable',
            'relations.house_classes.id'    => 'integer|exists:house_classes,id',
            'relations.house_classes.title' => 'string|nullable',
            'relations.landscapings.id'     => 'integer|exists:landscapings,id',
            'relations.landscapings.title'  => 'string|nullable',
            'relations.issuances.id'        => 'integer|exists:landscapings,id',
            'relations.issuances.title'     => 'string|max:100',

            /**
             * Information about address.
             */
            'address_info'             => 'required|array',
            'address_info.address'     => 'required|string|max:100',
            'address_info.longitude'   => 'required|numeric|between:-180,180',
            'address_info.latitude'    => 'required|numeric|between:-90,90',

            /**
             * Information about location.
             */
            'location_info'               => 'array',
            'location_info.*.name'        => 'required|string|max:100',
            'location_info.*.description' => 'string|max:200',

            /**
             * Information about price billing.
             */
            'price_info'                => 'required|array',
            'price_info.price_from'     => 'required|numeric',
            'price_info.price_to'       => 'required|numeric',
            'price_info.discount'       => 'required|numeric', // Скидка,
            'price_info.installment'    => 'required|numeric', // Рассрочка

            /**
             * Information about layout.
             */
            'layout_info'                 => 'required|array',
            'layout_info.*.square_from'   => 'required|numeric',
            'layout_info.*.square_to'     => 'required|numeric',
            'layout_info.*.rooms'         => 'required|integer',
            'layout_info.*.photo'         => 'required|file|mimes:jpg,png|max:2024',
        ];
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
