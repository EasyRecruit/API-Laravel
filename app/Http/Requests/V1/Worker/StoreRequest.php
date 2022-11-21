<?php

namespace App\Http\Requests\V1\Worker;

use App\Rules\NameRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return accountType() == 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'string', new NameRule(), 'max:255', 'min:3'],
            'last_name' => ['required', 'string', new NameRule()],
            'other_names' => ['nullable', 'string', new NameRule()],
            'email' => ['required', 'string', 'email', 'unique:workers'],
            'mobile_number' => ['required', 'string', 'unique:workers'],
            'position' => ['required', 'string'],
            'qualification' => ['required', 'string'],
            'skills' => ['required', 'array'],
            'cv' => ['required', 'mimes:pdf'],
        ];
    }
}
