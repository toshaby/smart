<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StoreTicketRequest extends FormRequest
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
    public function rules(Request $request): array
    {
        return [
            'name' => 'required|max:255',
            'phone' => ['nullable', 'phone:E164', Rule::requiredIf(fn() => !$request->input('email'))],
            'email' => ['nullable', 'email', Rule::requiredIf(fn() => !$request->input('phone'))],
            'theme' => 'required|max:32',
            'text' => 'required',
            'files' => 'array',
            'files.*' => 'file|max:2048|extensions:jpg,jpeg,png,gif,doc,docs,pdf|mimes:jpg,jpeg,png,gif,doc,docs,pdf'
        ];
    }

    public function messages()
    {
        return [
            'name' => [
                'required' => 'Укажите ваше имя',
                'max' => 'Слишком длинное имя'
            ],
            'phone' => [
                'phone' => 'Укажите правильный номер',
                'required' => "Укажите телефон если не указан Email",
            ],
            'email' => [
                'email' => 'Укажите правильный Email',
                'required' => 'Укажите Email если не указан телефон'
            ],
            'theme' => [
                'required' => 'Укажите тему сообщения',
                'max' => 'Тема должна быть не длиннее :max символов'
            ],
            'text' => [
                'required' => 'Текст сообщения обязателен'
            ],
            'files.*' => [
                'max' => 'Файл должен быть не более :max кб',
                'extensions' => '',
                'mimes' => 'Файлы должны быть только :values',
            ]
        ];
    }
}
