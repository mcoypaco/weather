<?php

namespace App\Http\Requests\WeatherForecast;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WeatherRequest extends FormRequest
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
            'lat' => 'required|numeric',
            'lon' => 'required|numeric',
            'mode' => [
                'sometimes',
                'required',
                'string',
                Rule::in([
                    'xml',
                    'html',
                ]),
            ],
            'units' => [
                'sometimes',
                'required',
                'string',
                Rule::in([
                    'standard',
                    'metric',
                    'imperial',
                ]),
            ],
            'lang' => [
                'sometimes',
                'required',
                'string',
                Rule::in(array_keys(config('services.open_weather.lang'))),
            ],
        ];
    }
}
