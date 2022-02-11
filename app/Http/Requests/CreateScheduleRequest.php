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
            'lesson_id' => 'required',
            'day' => 'required',
            'teacher_id' => 'required',
            'classroom' => 'required',
            'building' => 'required',
            'type_id' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'week_num' => 'required',
        ];
    }
}
