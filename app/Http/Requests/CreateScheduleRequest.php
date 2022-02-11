<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateScheduleRequest extends FormRequest
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
            'lesson' => 'required',
            'teacher' => 'required',
            'classroom' => 'required',
            'building' => 'required',
            'type' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ];
    }
}
