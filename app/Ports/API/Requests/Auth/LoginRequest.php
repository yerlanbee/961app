<?php

namespace App\Ports\API\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use App\Domains\Auth\Dto\LoginDto;
use App\Support\Core\BaseDto;
use App\Support\Core\BaseFormRequest;

class LoginRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'phone'     => 'required|string|min:10',
            'password'  => 'required|string|min:10'
        ];
    }

    /**
     * @return BaseDto
     */
    public function toDto(): BaseDto
    {
        return LoginDto::fromArray($this->validated());
    }
}
