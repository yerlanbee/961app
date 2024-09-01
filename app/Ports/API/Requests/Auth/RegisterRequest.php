<?php
declare(strict_types=1);

namespace App\Ports\API\Requests\Auth;

use App\Domains\Auth\Dto\RegisterDto;
use App\Support\Core\BaseDto;
use App\Support\Core\BaseFormRequest;

class RegisterRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'first_name'    => 'required|string|min:3|max:60',
            'last_name'    => 'required|string|min:3|max:60',
            'password'  => [
                'required',
                'string',
                'confirmed',
                'min:10',
                'regex:/[a-z]/',      // Должна быть хотябы одна нижний регистр буква.
                'regex:/[A-Z]/',      // Должна быть хотябы одна верхний регистр буква.
                'regex:/[0-9]/',      // Должен быть хотябы одна цифра.
                'regex:/[@$!%*#?&]/', // Должен быть хотябы один символ.
            ],
            'phone'   => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return BaseDto
     */
    public function toDto(): BaseDto
    {
        $validated = $this->validated();

        return RegisterDto::fromArray($validated);
    }
}
