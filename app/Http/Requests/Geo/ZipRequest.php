<?php

namespace App\Http\Requests\Geo;

use App\Rules\ValidCountryCode;
use Illuminate\Foundation\Http\FormRequest;

class ZipRequest extends FormRequest
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
            'zip_code' => 'required|string',
            'country_code' => [
                'required',
                'string',
                'max:2',
                new ValidCountryCode,
            ],
        ];
    }
}
