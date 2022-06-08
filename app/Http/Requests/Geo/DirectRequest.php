<?php

namespace App\Http\Requests\Geo;

use App\Rules\ValidCountryCode;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DirectRequest extends FormRequest
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
            'city' => 'required|string',
            'state_code' => [
                'sometimes',
                'required',
                'string',
                'exclude_unless:country_code,US',
                Rule::in(array_keys(config('services.open_weather.state_codes'))),
            ],
            'country_code' => [
                'required',
                'string',
                'max:2',
                new ValidCountryCode,
            ],
            'limit' => 'sometimes|required|numeric',
        ];
    }
}
