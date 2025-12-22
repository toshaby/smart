<?php

namespace App\Http\Requests\Manager;

use App\Enums\StatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FilterTicketRequest extends FormRequest
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
            'phone' => 'nullable|phone:E164',
            'email' => 'nullable|email',
            'status' => ['nullable', Rule::enum(StatusEnum::class)],
            'datefrom' => 'nullable|date',
            'dateto' => 'nullable|date|after_or_equal:datefrom',
        ];
    }

    public function messages()
    {
        return [
            'phone' => [
                'phone' => 'Укажите правильный номер',
            ],
            'email' => [
                'email' => 'Укажите правильный Email',
            ],
            'datefrom' => [
                'date' => 'Неверный формат даты',
            ],
            'dateto' => [
                'date' => 'Неверный формат даты',
                'after_or_equal' => 'Дата должна быть больше или равна дате от'
            ]
        ];
    }
}
