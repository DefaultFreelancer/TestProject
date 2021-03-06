<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'string',
            'category_id' => 'required|integer',
            'starts_at' => 'required|date',
            'ends_at' => 'date',
        ];
    }
}
