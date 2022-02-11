<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTeacherRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'email',
            'telegram' => 'string',
            'viber' => 'bool',
            'university_id' => 'required',
        ];
    }
}
