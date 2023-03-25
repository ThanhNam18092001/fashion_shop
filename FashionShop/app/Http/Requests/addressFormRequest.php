<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addressFormRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'last_name' => [
                'required',
                'string'
            ],
            'fist_name' => [
                'required',
                'string'
            ],
            'address' => [
                'required',
                'string'
            ],
            'pin_code' => [
                'required',
                'integer'
            ],
            'city' => [
                'required',
            ],
            'country' => [
                'required',
                'string'
            ],
            'state' => [
                'required',
                'string'
            ],
        ];
    }
}
